<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
	use HasFactory;

	protected $fillable = ['course_id', 'title', 'position'];

	public function lessons()
	{
		return $this->hasMany(Lesson::class)->orderBy('position');
	}

	public function course()
	{
		return $this->belongsTo(Course::class);
	}
}
