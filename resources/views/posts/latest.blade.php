@extends('layouts.master')
@section('content')
	<center><h1>Đây là trang Latest Post</h1></center>
		@foreach($lastpost as $post)
			<h1>{{$post->title}}</h1>
			<h2>{{$post->description}}</h2>
			<img src="{{$post->thumbnail}}" alt="">
		@endforeach
@endsection