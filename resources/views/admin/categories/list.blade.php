@extends('admin.master')
@section('content')
	<button class="btn btn-info">Add</button>
	<div class="card-body table-reponsive">
		<table class="tabble table-bordered" id="categories-table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Thumbnail</th>
					<th>Description</th>
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
		        	<center><img width="50%" id="show_thumbnail" src=""></center><br>
		        	<h4 id="show_description"></h4>
		      	</div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      	</div>
	    	</div>
	  	</div>
	</div>

	{{-- modal-edit --}}
	<div id="edit_category" class="modal fade" role="dialog">
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
		        			<input name="name" id="edit_name" type="text" class="form-control">
		        		</div>
		        		<div class="form-group">
		        			<label for="">Description</label>
		        			<input name="description" type="text" id="edit_description" class="form-control">
		        		</div>
		        		<div class="form-group">
		        			<label for="">Thumbnail</label>
		        			<input name="thumbnail" type="text" class="form-control" id="edit_thumbnail">
		        		</div>

		        		<button id="update_category" data-id="" type="submit" class="btn btn-primary">Update</button>
		        	</form>
		      	</div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      	</div>
	    	</div>
	  	</div>
	</div>

	{{-- modal-add --}}
	<div id="add_category" class="modal fade" role="dialog">
	  	<div class="modal-dialog" style="max-width: 800px; margin-left: 30%;">
	    	<div class="modal-content">
	      		<div class="modal-header">
	      			<h4 class="modal-title">Add</h4>
	        		<button type="button" class="close" data-dismiss="modal">&times;</button>
	      		</div>
		      	<div class="modal-body">
		        	<form action="" method="POST" role="form">
		        		@csrf
		        		<div class="form-group">
		        			<label for="">Name</label>
		        			<input type="text" class="form-control" id="name">
		        		</div>
		        		<div class="form-group">
		        			<label for="">Description</label>
		        			<input type="text" class="form-control" id="description">
		        		</div>
		        		<div class="form-group">
		        			<label for="">Thumbnail</label>
		        			<input type="file" class="form-control" id="thumbnail">
		        		</div>

		        		<button id="submit_category" type="submit" class="btn btn-primary">Create</button>
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
	<script type="text/javascript" src="{{ asset('js/category.js') }}"></script>
	
@endsection