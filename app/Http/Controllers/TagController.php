<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagController extends Controller
{
    public function list($slug){
    	$tag = Tag::where('slug','=',$slug )->firstOrFail();
    	return view('tags.tag', ['tagss' => $tag]);
    }
    public function getList(){
        $tags = Tag::orderBy('id', 'desc');
        return datatables()->eloquent($tags)
        ->addColumn('action', function($tag){
            return '<button class="btn btn-success" tagId="'.$tag->id.'">Show </button> <button class="btn btn-warning btn_edit" tagId="'.$tag->id.'">Edit </button> <button tagId="'.$tag->id.'" class="btn btn-danger">Delete </button>';
        })
        ->rawColumns(['action'])
        ->toJson();
    }
    public function show($id)
    {
        $tag = Tag::find($id);
        return $tag;
    }
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'slug' => 'required',
        // ]);
        $tag = new Tag();
        $tag->name = $request->input('name');
        $tag->slug = $request->input('slug');
        $tag->save();

        return response()->json($tag);
    }
    public function destroy($id)
    {
        Tag::find($id)->delete();
        return response()->json(['error' => false]);
    }
    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required',
        // ]);
        $tags = Tag::find($id);
        $tags->name = $request->name;
        $tags->slug = $request->slug;
        $tags->save();
        return response()->json(['noti' => 'edited'],200);
        // return redirect('/admin/user');
    }
}
