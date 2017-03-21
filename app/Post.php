<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    protected $fillable = ['name','content','cat_id'];
    public function category(){
    	return $this->belongsTo('App\Category','cat_id');
    }
    public function comments(){
    	return $this->hasMany('App\Comment','post_id','id');
    }
    public static function recent(){
    	return static::all(['id','name'])->take(-5);
    	
    }
 
}
