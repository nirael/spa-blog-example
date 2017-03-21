<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function getimages(){
    	return response()->json(['images' => Storage::files('public/images')]);
    }
    public function store(Request $request){
    	$response = ['message' => "File not uploaded!"];
    	if($request->file){
    		$name = $request->file->hashName();
    		$request->file->storeAs('public/images',$name);
    		return response()->json(['message' => 'File uploaded!','name' => $name]);
    	}
    	return response()->json($response);
    }
    public function deleteImage(Request $request){
    	if($request->file){
    		if(Storage::delete("public/images/" . $request->file))
    				return response()->json(['message' => 'File deleted!']);
    	}
    	return response()->json(['message' => 'File not deleted!']);
    }
}
