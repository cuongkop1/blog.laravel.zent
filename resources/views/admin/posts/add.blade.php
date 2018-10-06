@extends('admin.master')
@section('content')
	<form enctype="multipart/form-data" action="{{asset('')}}admin/post/add_post" method="POST" role="form">
		@csrf
		<legend>Thêm mới bài viết</legend>
	
		<div class="form-group">
			<label for="">Title</label>
			<input name="title" type="text" class="form-control" id="">
		</div>
		<div class="form-group">
			<label for="">Description</label>
			<input name="description" type="text" class="form-control" id="">
		</div>
		<div class="form-group">
			<label for="">Thumbnail</label>
			<input name="thumbnail" type="file" class="form-control" id="">
		</div>
		<div class="form-group">
			<label for="">Content</label>
			<input  name="content" type="text" class="form-control" id="">
		</div>
		<div class="form-group">
			<label for="">Category</label>
			<select class="form-control" name="category_id" id="edit_category_id">
				@foreach($categories as $category)
			  		<option value="{{$category->id}}">{{$category->name}}</option>
			  	@endforeach
			</select>
		</div>

		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
@endsection