@extends('layouts.master')
@section('content')

	@foreach($posts as $post)
	<div class="col-xs-6" style="position: relative; width: 356.66px; height: 490px">
        	<!-- ARTICLE 1 -->      
        	<article>
            	<div class="post-image">
                	<img style="width: 329.16px; height: 219.33px" src="{{$post->thumbnail}}" alt="post image 1">
                    <div class="category" style="position: absolute; top: 0; display: table; background-color: transparent">
                    		<a style="margin: 0" href="#">{{$post->category->name}}</a>
                    </div>
                </div>
                
                <div class="post-text" style="padding: 0">
                    <h2><a href="{{asset('')}}{{$post->category->slug}}/{{$post->slug}}">{{$post->title}}</a></h2>
                    <p class="text">{{$post->description}}</p>                                 
                </div>
                
                <div class="post-info">
                	<div class="post-by">Post By <a href="#">AD-Theme</a></div>
                </div>
            </article>
       </div>
	@endforeach
	
@endsection