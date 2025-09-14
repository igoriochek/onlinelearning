<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Course extends Model
{
	use HasFactory;

	protected $keyType = 'string';

	public $incrementing = false;

	protected $fillable = [
		'author_id',
		'title',
		'description',
		'level',
		'price',
		'image_url',
	];

	protected static function boot()
	{
		parent::boot();

		static::creating(function ($model) {
			if (empty($model->id)) {
				$model->id = (string) Str::uuid();
			}
		});
	}

	public function getLevelNameAttribute()
	{
		return match ((int) $this->level) {
			1 => 'Beginner',
			2 => 'Intermediate',
			3 => 'Advanced',
			default => 'Unknown',
		};
	}

	public function getAverageRatingAttribute()
	{
		return $this->reviews()->count()
			? round($this->reviews()->avg('rating'), 1)
			: null;
	}

	public function getVideoLessonsCountAttribute()
	{
		return $this->sections
			->flatMap(fn($section) => $section->lessons)
			->flatMap(fn($lesson) => $lesson->steps)
			->where('type', 'video')
			->count();
	}

	public function getTextLessonsCountAttribute()
	{
		return $this->sections
			->flatMap(fn($section) => $section->lessons)
			->flatMap(fn($lesson) => $lesson->steps)
			->where('type', 'text')
			->count();
	}

	public function getQuizzesCountAttribute()
	{
		return $this->sections
			->flatMap(fn($section) => $section->lessons)
			->flatMap(fn($lesson) => $lesson->steps)
			->where('type', 'quiz')
			->count();
	}

	public function sections()
	{
		return $this->hasMany(Section::class);
	}

	public function author()
	{
		return $this->belongsTo(User::class, 'author_id');
	}

	public function reviews()
	{
		return $this->hasMany(Review::class);
	}
}
