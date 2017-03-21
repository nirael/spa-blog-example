<?php

namespace App\Http\Controllers;
use EllipseSynergie\ApiResponse\Contracts\Response;
use Illuminate\Http\Request;
use Request as R;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Events\BanListEvent;

class CommentController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function forpost($id){
        $comments = Comment::where('post_id',$id)->get();
        return response()->json(['comments' => $comments]);
    }
    public function index()
    {
       $posts = Comment::all();
       return response()->json($posts);   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }
    public function ban(Request $request){
        event(new BanListEvent($request->ip));
    }
    public function unban(Request $request){
        event(new BanListEvent(null,$request->ip));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ip = R::ip(); 
        if(in_array($ip,Cache::get('banned')))
            return;
        $data = array_map(function($x){
            return  utf8_encode(strip_tags($x));
        }, $request->only('name','email','message','post_id'));

        $additive = ['valid' => false,'parent_id' => 0,'ip' => $ip];
        $data = array_merge($data,$additive);
        try{
           $comment = Comment::create($data);
        }
        catch(Exception $e){
            return response()->json(['comment' => null]);
        }
        return response()->json(['comment' => $comment]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Comment::find($id);
        return $post?response()->json(['data' => $post]):response()->json(['data' => 'Unable to find the expected comment']);
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
        $data = array_map(function($x){return strip_tags($x);}, $request->only('message','name','email','valid'));
            $comment = Comment::find($id);
        try{
            if($comment)
                $comment = $comment->update($data);
        }catch(Exception $e){
            return response()->json(['message' => $e->message]);
        }
        return response()->json(['message' => 'Comment updated!','comment' => $comment]);
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
            Comment::find($id)->delete();
        }catch(Exception $e){
            return response()->json(['message' => $e->message,'y' => false]);
        }
        return response()->json(['message' => 'Comment deleted!','y' => true]);
    }
}
