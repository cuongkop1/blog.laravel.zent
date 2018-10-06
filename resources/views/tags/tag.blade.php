@extends('layouts.master')
@section('content')
	{{-- {{dd($tags)}} --}}
	{{-- @foreach($tags->posts as $post)
		<h3>{{$post->title}}</h3>
		<h4>{{$post->content}}</h4>
	@endforeach --}}
	@foreach($tagss->posts as $post)
		<div class="post-image">
	    	<img src="{{$post->thumbnail}}" alt="post image 1">
	        {{-- <div class="category"><a href="#">IMG</a></div> --}}
	    </div>
	    <div class="post-text">
	    	<span class="date">07 Jun 2016</span>
	        <h2><a href="#">{{$post->title}}</a></h2>
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