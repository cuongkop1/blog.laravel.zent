<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Respose
     */
    public function index()
    {
        return view('admin.posts.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'thumbnail' => 'required',
            'description' => 'required',
            'content' => 'required',
            // 'slug' => 'required',
            'category_id' => 'required',
        ]);
        // dd($request);
        // $path = $request->thumbnail->store('image');

        $post = new Post();
        $post->title = $request->input('title');
        $post->thumbnail = $request->file('thumbnail')->store('images');
        // $post->thumbnail = $path;
        $post->description = $request->input('description');
        $post->content = $request->input('content');
        // $post->slug = $request->input('slug');
        $post->slug = $request->title;
        $post->category_id = $request->input('category_id');
        $post->save();

        return response()->json(['noti'=>'added'],200);
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
        return $post;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        // return $request;
        $request->validate([
            'title' => 'required',
            'thumbnail' => 'required',
            'description' => 'required',
            'content' => 'required',
            'slug' => 'required',
            'category_id' => 'required',
        ]);
        $post = Post::where('id',$id)->first();
        $post->title = $request->title;
        $post->thumbnail = $request->thumbnail;
        $post->description = $request->description;
        $post->content = $request->content;
        // $post->slug = $request->slug;
        $post->slug = str_slug($request->title);
        $post->category_id = $request->category_id;
        $post->save();
        return response()->json(['noti' => 'edited'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::find($id)->delete();
        return response()->json(['error' => false]);
    }
    public function detail($category_slug, $post_slug){
        $posts = Post::where('slug','=',$post_slug )->firstOrFail();
        return view('posts.detail', ['posts' => $posts]);
    }
    public function getList(){
        $posts = Post::join('categories', 'categories.id', '=', 'posts.category_id')->select('posts.title','posts.id','posts.thumbnail','posts.description','posts.content','posts.slug','posts.category_id', 'categories.description as categories_description')
        ->orderBy('posts.id', 'desc');
        // $posts = Post::query();
        return datatables()->eloquent($posts)
        ->addColumn('action', function($post){
            return '<button style="width:68.75px; margin-bottom:5px;" class="btn btn-success" postID="'.$post->id.'">Show </button> <button style="width:68.75px; margin-bottom:5px;" class="btn btn-warning btn_post_edit" postID="'.$post->id.'">Edit </button> <button postID="'.$post->id.'" class="btn btn-danger">Delete </button>';
        })
        ->addColumn('thumbnail', function($post){
            return '<img class="img-fluid" src="'.'http://blog.laravel.zent/storage/'.$post->thumbnail.'">';
        })
        ->rawColumns(['action','thumbnail'])
        ->toJson();
    }
    public function add_post(Request $request){
        $path = $request->thumbnail->store('image');
        $post = new Post();
        $post->title = $request->input('title');
        $post->thumbnail = $path;
        $post->description = $request->input('description');
        $post->content = $request->input('content');
        // $post->slug = $request->input('slug');
        $post->slug = $request->title;
        $post->category_id = $request->input('category_id');
        $post->save();

        return redirect('admin/post');
    }
}
