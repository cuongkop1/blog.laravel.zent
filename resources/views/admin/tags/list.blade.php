@extends('admin.master')
@section('content')
	<button class="btn btn-info">Add</button>
	<div class="card-body table-reponsive">
		<table class="tabble table-bordered" id="tags-table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Created at</th>
					<th>Updated at</th>
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
		        	<h2 id="show_name"></h2>
		        	<p id="show_slug"></p>
		        	<p id="show_created_at"></p>
		        	<p id="show_updated_at"></p>
		      	</div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      	</div>
	    	</div>
	  	</div>
	</div>

	{{-- modal-edit --}}
	<div id="edit_tag" class="modal fade" role="dialog">
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
		        			<label for="">Name</label>
		        			<input value="" id="edit_name" type="text" class="form-control">
		        		</div>
		        		<div class="form-group">
		        			<label for="">Slug</label>
		        			<input type="text" class="form-control" id="edit_slug">
		        		</div>

		        		<button id="update_tag" data-id="" type="submit" class="btn btn-primary">Update</button>
		        	</form>
		      	</div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      	</div>
	    	</div>
	  	</div>
	</div>

	{{-- modal-add --}}
	<div id="add_tag" class="modal fade" role="dialog">
	  	<div class="modal-dialog" style="max-width: 800px; margin-left: 30%;">
	    	<div class="modal-content">
	      		<div class="modal-header">
	      			<h4 class="modal-title">Add</h4>
	        		<button type="button" class="close" data-dismiss="modal">&times;</button>
	      		</div>
		      	<div class="modal-body">
		        	<form id="form_add" action="" method="POST" role="form">
		        		@csrf
		        		<div class="form-group">
		        			<label for="">Name</label>
		        			<input name="name1" type="text" class="form-control" id="name">
		        		</div>
		        		<div class="form-group">
		        			<label for="">Slug</label>
		        			<input name="slug1" type="text" class="form-control" id="slug">
		        		</div>

		        		<button id="submit_tag" type="submit" class="btn btn-primary">Create</button>
		        	</form>
		      	</div>
		      	<div class="modal-footer">
		        	<button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
		      	</div>
	    	</div>
	  	</div>
	</div>

@endsection
@section('footer')
	<script type="text/javascript">
		var asset='{{asset('/')}}';
	</script>
	<script type="text/javascript" src="{{ asset('js/tag.js') }}"></script>
	
@endsection