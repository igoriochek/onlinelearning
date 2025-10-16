<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Lesson extends Model
{
	use HasFactory;

	protected $keyType = 'string';

	public $incrementing = false;

	protected $fillable = ['title', 'section_id', 'position'];

	protected static function boot()
	{
		parent::boot();

		static::creating(function ($model) {
			if (empty($model->id)) {
				$model->id = (string) Str::uuid();
			}
		});
	}

	public function section()
	{
		return $this->belongsTo(Section::class);
	}

	public function steps()
	{
		return $this->hasMany(Step::class)->orderBy('position');
	}
}
