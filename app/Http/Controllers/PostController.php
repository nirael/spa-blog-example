<?php

namespace App\Http\Controllers;
use EllipseSynergie\ApiResponse\Contracts\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $posts = Post::all();
       return response()->json(['posts' => $posts]);   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }
    public function recent(){
        $posts = Post::all()->take(-5);
        return response()->json(['posts' => $posts]);
    }
    public function category($id){
        $post = Post::find($id);
        if($post)
            return response()->json(['category' => $post->category]);
        return response()->json(['message' => 'An error occured']);
    }
    public function comments($id){
        $post = Post::find($id);
        if($post)
            return response()->json(['comments' => $post->comments]);
        return response()->json(['message' => 'No comments']);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$data = array_map(function($x){return strip_tags($x);}, $request->only('name','content','cat_id'));
        $data = $request->only('name','content','cat_id');
        $data['user_id'] = Auth::id();
        try{
            $post = Post::create($data);
        }
        catch(Exception $e){
            return response()->json(['message' => 'Unable to create a new post!','post' => null]);
        }
        return response()->json(['message' => 'Post created','post' => $post]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return $post?response()->json(['post' => $post]):response()->json(['message' => 'Unable to find the expected post']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //$data = array_map(function($x){return strip_tags($x);}, $request->only('name','content','cat_id'));
        $data = $request->only('name','content','cat_id');
        $post = Post::find($id);
        try{
            if($post)
                $post = $post->update($data);
        }catch(Exception $e){
            return response()->json(['message' => $e->message]);
        }
        return response()->json(['message' => 'Post updated!','post' => $post]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            Post::find($id)->delete();
        }catch(Exception $e){
            return response()->json(['message' => $e->message,'y' => false]);
        }
        return response()->json(['message' => 'Post deleted!','y' => true]);
    }
}
