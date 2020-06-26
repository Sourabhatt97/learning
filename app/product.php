<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $fillable = [
    	'category_id','color_id','brand_id','name','access_url','description','price','stock','UPC','status','image',];

    	public function children()
    	{
    		return $this->hasMany('App\Product', 'parent_id');
    	}
}
