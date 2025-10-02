<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

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
		'public',
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

	public function isInWishlist(): bool
	{
		$user = Auth::user();
		return $user
			? $user->wishlist()->where('course_id', $this->id)->exists()
			: false;
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
			->whereIn('type', ['quiz_multiple', 'quiz_single'])
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
