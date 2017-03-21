<?php

namespace App\Http\Controllers;
use EllipseSynergie\ApiResponse\Contracts\Response;
use Illuminate\Http\Request;
use App\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function posts($id){
        $cat = Category::find($id);
        $posts = null;
        if($cat)$posts = $cat->posts;
        return response()->json(['posts' => $posts]);
    }
    public function index()
    {
       $cats = Category::all();
       return response()->json(['cats' => $cats]);   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = array_map(function($x){return strip_tags($x);}, $request->only('name','description'));
        $data['user_id'] = 1;
        try{
           $cat =  Category::create($data);
        }
        catch(Exception $e){
            return response()->json(['message' => 'Unable to create a new post!','cat' => null]);
        }
        return response()->json(['message' => 'Category created','cat' => $cat]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cat= Category::find($id);
        return $cat?response()->json(['cat' => $cat]):response()->json(['cat' => 'Unable to find the expected category']);
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
        $data = array_map(function($x){return strip_tags($x);}, $request->only('name','description'));
        $cat = Category::find($id);
        try{
            if($cat)$cat->update($data);
        }catch(Exception $e){
            return response()->json(['message' => $e->message]);
        }
        return response()->json(['message' => 'Category updated!','cat' => $cat]);
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
            Category::find($id)->delete();
        }catch(Exception $e){
            return response()->json(['message' => $e->message,'y' => false]);
        }
        return response()->json(['message' => 'Category deleted!','y' => true]);
    }
}
