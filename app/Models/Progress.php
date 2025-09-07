<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
	public function step()
	{
		return $this->belongsTo(Step::class);
	}
	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
