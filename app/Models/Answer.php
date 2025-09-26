<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
	protected $fillable = ['user_id', 'step_id', 'answer_id', 'selected_options'];

	public function step()
	{
		return $this->belongsTo(Step::class);
	}
	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
