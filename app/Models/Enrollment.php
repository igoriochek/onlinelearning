<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Enrollment extends Model
{
	use HasFactory;

	protected $fillable = ['user_id', 'course_id', 'purchased_at'];

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function course(): BelongsTo
	{
		return $this->belongsTo(Course::class);
	}
}
