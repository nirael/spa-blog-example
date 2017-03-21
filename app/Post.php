<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    protected $fillable = ['name','content','cat_id'];
    public function category(){
    	return $this->belongsTo('App\Category','cat_id');
    }
   /* public function cat_name(){
    	return Category::find($this->cat_id)->name;
    }*/
    public function comments(){
    	return $this->hasMany('App\Comment','post_id','id');
    }
    public static function recent(){
    	return static::all(['id','name'])->take(-5);
    	
    }
    public static function dates($three=false){
    	$val = static::all(['created_at'])->unique()->map(function($obj){
    		return ['pres' => $obj->created_at->format("F, Y"),'link' =>$obj->created_at->format("FY")];
    	});
    	return $three?$val->take(-3):$val;
    }
    public function excerpt($s=1000){
        return substr($this->content, 0,$s) . "...";
    }
}
