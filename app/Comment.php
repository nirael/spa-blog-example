<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	//protected $fillable = ['name','email','message','valid','post_id','parent_id','ip'];
    protected $guarded = [];
    public function post(){
    	return $this->belongsTo('App\Post','post_id');
    }
    public function in_reply(){
    	return static::where('id',$this->parent_id)->first()?
    					static::where('id',$this->parent_id)->first()->name:NULL;
    }
    public function getChildrenAttribute(){
    	return static::where('parent_id',$this->id)->get();
    }
    public function scopeValid(){
    	return $query->where('valid',1);
    }
}
