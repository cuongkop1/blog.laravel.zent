<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => 'required',
            'email' => 'required|email',
            'username' => 'required',
            'password' => 'required',
        ]);
        $user = new User();
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->save();

        return response()->json($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return $user;
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
        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required',
        // ]);
        $users = User::find($id);
        $users->name = $request->name;
        $users->email = $request->email;
        $users->save();
        return response()->json(['noti' => 'edited'],200);
        // return redirect('/admin/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return response()->json(['error' => false]);
    }
    public function getList(){
        // $users = Post::select('posts.id','posts.title','posts.thumbnail','posts.user_id','users.name')
        // ->join('users', 'users.id', '=', 'posts.user_id');
        $users = User::orderBy('id', 'desc');
        return datatables()->eloquent($users)
        ->addColumn('action', function($user){
            return '<button class="btn btn-success" userId="'.$user->id.'">Show </button> <button class="btn btn-warning btn_edit" userId="'.$user->id.'">Edit </button> <button userId="'.$user->id.'" class="btn btn-danger">Delete </button>';
        })
        ->rawColumns(['action'])
        ->toJson();
    }
}
