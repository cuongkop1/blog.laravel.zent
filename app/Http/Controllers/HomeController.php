<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests;
// use Yajra\Datatables\Datatables;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function post(){
        $posts  = Post::find(1); // lấy tất cả bài viết bằng câu lệnh hàm all()

        return $posts->Category->name;
    }
    public function phone(){
        $phone  = Phone::find(1); // lấy tất cả bài viết bằng câu lệnh hàm all()

        return $phone->User->name;
    }
    public function getList(){
        // $users = Post::select('posts.id','posts.title','posts.thumbnail','posts.user_id','users.name')
        // ->join('users', 'users.id', '=', 'posts.user_id');
        $users = User::query();
        return datatables()->eloquent($users)
        ->addColumn('action', function($user){
            return '<button class="btn btn-success" userId="'.$user->id.'">Show </button> <button class="btn btn-warning" userId="'.$user->id.'">Edit </button> <button userId="'.$user->id.'" class="btn btn-danger">Delete </button>';
        })
        ->rawColumns(['action'])
        ->toJson();
    }
    public function destroy($id){
        User::find($id)->delete();
        return response()->json(['error' => false]);
    }
    public static function show($id){
        $user = User::find($id);
        return $user;
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
       $users = User::find($id);
       $users->name = $request->input('name');
       $users->email = $request->input('email');
       $users->save();

        return redirect('/admin/user');
    }
    // public function update(Request $request, $id){
    //     $product = Product::find($id);
    //     $data = $request->all();
    //     $product->update($data);
    //     $request->validate([
    //     'name' => 'required',
    //     'price' => 'required|numeric',
    //     'quantity' => 'required|numeric',
    // ]);
    //     return redirect('demo')->with('flag','Cập nhật thành công!');
    // }
}
