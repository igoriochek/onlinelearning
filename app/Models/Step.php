<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Step extends Model
{
	use HasFactory;
	public function lesson()
	{
		return $this->belongsTo(Lesson::class);
	}
	public function options()
	{
		return $this->hasMany(Option::class);
	}
	public function expectedAnswer()
	{
		return $this->hasOne(ExpectedAnswer::class);
	}
}
