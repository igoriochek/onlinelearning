<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
	use HasFactory;
	public function lessons()
	{
		return $this->hasMany(Lesson::class);
	}

	public function course()
	{
		return $this->belongsTo(Course::class);
	}
}
