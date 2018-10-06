@extends('admin.master')
@section('content')
	<button class="btn btn-info">Add</button> <button class="btn btn-primary"><a style="color: white; text-decoration: none;" href="{{ asset('admin/post/add') }}">Thêm mới</a></button>
	<div class="card-body table-reponsive">
		<table class="tabble table-bordered" id="posts-table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Title</th>
					<th>Thumbnail</th>
					<th>Category</th>
					<th>Action</th>
				</tr>
			</thead>
		</table>
	</div>
	{{-- modal-show --}}
	<div id="show" class="modal fade" role="dialog">
	  	<div class="modal-dialog" style="max-width: 800px; margin-left: 30%">
	    	<div class="modal-content">
	      		<div class="modal-header">
	      			<h4 class="modal-title">Detail</h4>
	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
	        	
	      		</div>
		      	<div class="modal-body">
		        	<h2 id="show_title"></h2>
		        	<h4 id="show_description"></h4>
		        	<center><img id="show_thumbnail" src=""></center><br>
		        	<p style="text-indent: 30px" id="show_content"></p>
		      	</div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      	</div>
	    	</div>
	  	</div>
	</div>

	{{-- modal-edit --}}
	<div id="edit_post" class="modal fade" role="dialog">
	  	<div class="modal-dialog" style="max-width: 800px; margin-left: 30%">
	    	<div class="modal-content">
	      		<div class="modal-header">
	      			<h4 class="modal-title">Edit</h4>
	        		<button type="button" class="close" data-dismiss="modal">&times;</button>
	      		</div>
		      	<div class="modal-body">
		        	<form action="" method="" role="form">
		        		@csrf
		        		{{method_field('put')}}
		        		<div class="form-group">
		        			<label for="">Title</label>
		        			<input value="" id="edit_title" name="title" type="text" class="form-control">
		        		</div>
		        		<div class="form-group">
		        			<label for="">Description</label>
		        			<textarea class="form-control" name="description" id="edit_description" rows="5"></textarea>
		        		</div>
		        		<div class="form-group">
		        			<label for="">Thumbnail</label>
		        			<input name="thumbnail" type="text" class="form-control" id="edit_thumbnail">
		        		</div>
		        		<div class="form-group">
		        			<label for="">Content</label>
		        			<textarea class="form-control" name="content1" id="edit_content" rows="15"></textarea>
		        		</div>
						{{-- <div class="form-group">
		        			<label for="">Slug</label>
		        			<input value="" id="edit_slug" name="slug" type="text" class="form-control">
		        		</div> --}}
		        		<div class="form-group">
		        			<label for="">Category</label>
		        			<select class="form-control" id="edit_category_id">
		        				@foreach($categories as $category)
							  		<option value="{{$category->id}}">{{$category->name}}</option>
							  	@endforeach
							</select>
		        		</div>

		        		<button id="update_post" data-id="" type="submit" class="btn btn-primary">Update</button>
		        	</form>
		      	</div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      	</div>
	    	</div>
	  	</div>
	</div>

	{{-- modal-add --}}
	<div id="add_post" class="modal fade" role="dialog">
	  	<div class="modal-dialog" style="max-width: 800px; margin-left: 30%;">
	    	<div class="modal-content">
	      		<div class="modal-header">
	      			<h4 class="modal-title">Add</h4>
	        		<button type="button" class="close" data-dismiss="modal">&times;</button>
	      		</div>
		      	<div class="modal-body">
		        	<form enctype="multipart/form-data" action="" method="POST" role="form">
		        		@csrf
		        		<div class="form-group">
		        			<label for="">Title</label>
		        			<input name="title" type="text" class="form-control" id="title">
		        		</div>
		        		<div class="form-group">
		        			<label for="">Description</label>
		        			<textarea class="form-control" name="description" id="description" rows="5"></textarea>
		        		</div>
		        		<div class="form-group">
		        			<label for="">Thumbnail</label>
		        			<input name="thumbnail" type="file" class="form-control" id="thumbnail">
		        		</div>
		        		<div class="form-group">
		        			<label for="">Content</label>
		        			<textarea class="form-control" name="content" id="content" rows="15"></textarea>
		        		</div>
		        		<div class="form-group">
		        			<label for="">Category</label>
		        			<select class="form-control" id="category_id">
		        				@foreach($categories as $category)
							  		<option value="{{$category->id}}">{{$category->name}}</option>
							  	@endforeach
							</select>
		        		</div>
						{{-- Storage::('url') --}}
		        		<button id="submit_post" type="submit" class="btn btn-primary">Create</button>
		        	</form>
		      	</div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      	</div>
	    	</div>
	  	</div>
	</div>

@endsection
@section('footer')
	<script type="text/javascript">
		var asset='{{asset('/')}}';
	</script>
	<script type="text/javascript" src="{{ asset('js/post.js') }}"></script>
	
@endsection