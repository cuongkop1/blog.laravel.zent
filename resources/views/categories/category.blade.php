@extends('layouts.master')
@section('content')
		{{-- @foreach($category->posts as $post)
			<div>
				<a href="{{asset('')}}{{$category->slug}}/{{$post->slug}}"><h2>{{$post->title}}</h2></a>
				<h3>{{$post->description}}</h3>
				<img src="{{$post->thumbnail}}" alt="">
				<p>{{$post->content}}</p>
			</div>
		@endforeach --}}
		@foreach($category->posts as $post)
		<div class="post-image">
	    	<img src="{{$post->thumbnail}}" alt="post image 1">
	        {{-- <div class="category"><a href="#">IMG</a></div> --}}
	    </div>
	    <div class="post-text">
	    	<span class="date">07 Jun 2016</span>
	        <h2><a href="{{asset('')}}{{$category->slug}}/{{$post->slug}}">{{$post->title}}</a></h2>
	        <p class="text">{{$post->description}}</p>                                 
	    </div>
	    <div class="post-info">
	    	<div class="post-by">Post By <a href="#">AD-Theme</a></div>
	        <div class="extra-info">
	        	<a href="#"><i class="icon-facebook5"></i></a>
	    		<a href="#"><i class="icon-twitter4"></i></a>
	    		<a href="#"><i class="icon-google-plus"></i></a>
	            <span class="comments">25 <i class="icon-bubble2"></i></span>
	        </div>
	        <div class="clearfix"></div>
	    </div>
	    @endforeach
@endsection