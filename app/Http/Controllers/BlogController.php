<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{
    public function index(){
    	$posts  = Post::all(); // lấy tất cả bài viết bằng câu lệnh hàm all()

    	return view('index',[
    		'posts' => $posts // dữ liệu được truyền qua view bằng biến posts
    	]);
    }
    public function post(){
    	$posts  = Post::find(1); // lấy tất cả bài viết bằng câu lệnh hàm all()

    	return $posts->Category->name;
    }
    public function phone(){
        $phone  = Phone::find(1); // lấy tất cả bài viết bằng câu lệnh hàm all()

        return $phone->User->name;
    }
}
