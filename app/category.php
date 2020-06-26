<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
	public function children()
	{
		return $this->hasMany('App\Category', 'parent_id');
	}
}
