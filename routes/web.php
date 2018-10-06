<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/', function(){
// 	return view('welcome');
// })->middleware('CheckAge');
use Illuminate\Http\Request;


Route::get('/welcome', function(){
	return view('welcome');
});

Route::get('/', 'BlogController@index');

Route::get('/about', function () {
    return view('layouts.about');
});
Route::get('/contact', function () {
    return view('layouts.contact');
});
Route::get('/list', function(){
	return view('posts.list');
});
// Route::get('/', 'HomeController@index');
Route::get('/test', 'HomeController@post');
Route::get('/phone', 'HomeController@phone');
// Route::get('/testphone');
Route::get('/latest', function(){
	return view('posts.latest');
});
// Route::get('/latest', function(){
// 	$data = DB::select('SELECT id FROM posts ORDER BY id DESC LIMIT 5');
// 	dd($data);
// });
Route::get('/tag1', function(){
	$post = \App\Post::find(51);
	dd($post->tags);
});
// Route::get('/', function(){
// 	abort(404);
// });
Route::get('/join', function(){
	$user = \App\User::select('users.name', 'users.email', 'phones.phone')
	->join('phones', 'users.id', '=', 'phones.id')
	// ->where('users.name', 'LIKE', '%xxx%')->first()
	->where('users.id', 1)->first();
	dd($user);
});
Route::get('/pagi', function(){
	$posts = App\Post::simplepaginate(10);
	return view('pagi')->with('posts', $posts);
});
Route::prefix('tag')->group(function(){
	route::get('/{slug}', 'TagController@list');
});

Route::post('upload', function(Request $request){
	// $path = $request->image->store('image');
	// dd($path);
	foreach($request->images as $key => $image){
		$image->store('ahihi');
	};
	// dd($image);
	// Storage::delete('file.jpg');
});
Route::get('/jju', function(){
	// $user = App\User::onlyTrashed()->where('email','ads@gmail.com')->first();
	$user = App\User::onlyTrashed()->where('email','ads@gmail.com')->restore();
});
// Route::get('delete', function(){
// 	$user = App\User::find(1)->delete();
// });
// Route::get('/query', function(){
	
// });
Route::prefix('admin')->group(function(){
	// Auth::routes();
	// Route::get('/home', 'HomeController@index')->name('home');
	Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
	Route::post('login', 'Auth\LoginController@login');
	Route::post('logout', 'Auth\LoginController@logout')->name('logout');

	// Registration Routes...
	Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
	Route::post('register', 'Auth\RegisterController@register');

	// Password Reset Routes...
	Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
	Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
	Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
	Route::post('password/reset', 'Auth\ResetPasswordController@reset');

	Route::middleware('auth')->group(function(){
		Route::get('/dashboard', 'HomeController@index')->name('home');
		Route::get('post', function(){
		});
		Route::prefix('user')->group(function(){
			// Route::resource('/', 'UserController', ['except'=>['create', 'edit', 'update']]);
			Route::get('/',function(){
				return view('admin.users.home');
			});
			Route::get('/list', 'UserController@getList');
			Route::get('/{id}','UserController@show')->name('user.show');
			Route::delete('/{id}', 'UserController@destroy');
			Route::put('/{id}','UserController@update')->name('user.edit');
			Route::post('/store', 'UserController@store');
		});
		Route::prefix('post')->group(function(){
			Route::get('/', function(){
				return view('admin.posts.list');
			});
			Route::get('/add', 'PostController@create');
			Route::get('/list', 'PostController@getList');
			Route::get('/{id}','PostController@show')->name('post.show');
			Route::delete('/{id}', 'PostController@destroy');
			Route::put('/{id}','PostController@update');
			Route::post('/store', 'PostController@store');
			Route::post('/add_post', 'PostController@add_post');
		});

		Route::prefix('tag')->group(function(){
			Route::get('/', function(){
				return view('admin.tags.list');
			});
			Route::get('/list', 'TagController@getList');
			Route::get('/{id}','TagController@show');
			Route::delete('/{id}', 'TagController@destroy');
			Route::put('/{id}','TagController@update');
			Route::post('/store', 'TagController@store');
		});

		Route::prefix('category')->group(function(){
			Route::get('/', function(){
				return view('admin.categories.list');
			});
			Route::get('/list', 'CategoryController@getList');
			Route::get('/{id}','CategoryController@show');
			Route::delete('/{id}', 'CategoryController@destroy');
			Route::put('/{id}','CategoryController@update');
			Route::post('/store', 'CategoryController@store');
		});
		
	});
});
	Route::get('/{slug}', 'CategoryController@detail');
	Route::get('/{category}/{slug}', 'PostController@detail');
