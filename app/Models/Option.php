<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
	protected $fillable = ['step_id', 'text', 'is_correct'];

	public function step()
	{
		return $this->belongsTo(Step::class);
	}
}
