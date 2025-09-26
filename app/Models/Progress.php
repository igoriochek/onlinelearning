<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
	protected $fillable = ['user_id', 'step_id', 'is_completed'];
	public function step()
	{
		return $this->belongsTo(Step::class);
	}
	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
