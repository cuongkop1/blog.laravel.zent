<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests;

class CategoryController extends Controller
{
    ///
    function detail($slug){
    	$category = Category::where(
    		'slug','=',$slug
    	)->firstOrFail();
    	// $posts = $category->posts;
    	 // dd($posts);
    	return view('categories.category',[
    		// 'posts' => $posts,	
    		'category' => $category
    	]);
    }
    public function getList(){
        $categories = Category::orderBy('id', 'desc');
        return datatables()->eloquent($categories)
        ->addColumn('action', function($category){
            return '<button class="btn btn-success" CategoryId="'.$category->id.'">Show </button> <button class="btn btn-warning btn_edit" CategoryId="'.$category->id.'">Edit </button> <button CategoryId="'.$category->id.'" class="btn btn-danger">Delete </button>';
        })
        ->addColumn('thumbnail', function($category){
            return '<img style="width:340px; height:auto" class="img-fluid" src="'.$category->thumbnail.'">';
        })
        ->rawColumns(['action','thumbnail'])
        ->toJson();
    }
    public function show($id)
    {
        $category = Category::find($id);
        return $category;
    }
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'slug' => 'required',
        // ]);
        $category = new Category();
        $category->name = $request->input('name');
        $category->thumbnail = $request->input('thumbnail');
        // $category->thumbnail = $request->file('thumbnail')->store('images');
        $category->description = $request->input('description');
        $category->slug = $request->description;
        $category->save();

        return response()->json($category);
    }
    public function destroy($id)
    {
        Category::find($id)->delete();
        return response()->json(['error' => false]);
    }
    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required',
        // ]);
        $category = Category::find($id);
        $category->name = $request->name;
        $category->thumbnail = $request->thumbnail;
        $category->description = $request->description;
        $category->slug = $request->description;
        $category->save();
        return response()->json(['noti' => 'edited'],200);
        // return redirect('/admin/user');
    }
}
