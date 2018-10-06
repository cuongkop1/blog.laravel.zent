@extends('admin.master')
@section('content')
	<button class="btn btn-info">Add</button>
	<div class="card-body table-reponsive">
		<table class="tabble table-bordered" id="users-table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Email</th>
					<th>Created At</th>
					<th>Updated At</th>
					<th>Action</th>
				</tr>
			</thead>
		</table>
	</div>
	{{-- modal-show --}}
	<div id="show" class="modal fade" role="dialog">
	  	<div class="modal-dialog">
	    	<div class="modal-content">
	      		<div class="modal-header">
	      			<h4 class="modal-title">Detail</h4>
	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
	        	
	      		</div>
		      	<div class="modal-body">
		        	<p id="show_name"></p>
		        	<p id="show_email"></p>
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
	<div id="edit" class="modal fade" role="dialog">
	  	<div class="modal-dialog">
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
		        			<input value="" id="edit_name" name="name" type="text" class="form-control" placeholder="Name">
		        		</div>
		        		<div class="form-group">
		        			<label for="">Email</label>
		        			<input value="" id="edit_email" name="email" type="text" class="form-control" placeholder="Email">
		        		</div>

		        		<button id="sub_update" data-id="" type="submit" class="btn btn-primary">Update</button>
		        	</form>
		      	</div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      	</div>
	    	</div>
	  	</div>
	</div>

	{{-- modal-add --}}
	<div id="add" class="modal fade" role="dialog">
	  	<div class="modal-dialog">
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
		        			<label for="">Username</label>
		        			<input type="text" class="form-control" id="username">
		        		</div>
		        		<div class="form-group">
		        			<label for="">Password</label>
		        			<input type="password" class="form-control" id="password">
		        		</div>
		        		<div class="form-group">
		        			<label for="">Confirm Password</label>
		        			<input type="password" class="form-control" id="confirm_password">
		        		</div>
		        		<div class="form-group">
		        			<label for="">Email</label>
		        			<input type="email" class="form-control" id="email">
		        		</div>

		        		<button id="submit" type="submit" class="btn btn-primary">Create</button>
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
	<script type="text/javascript" src="{{ asset('js/home_user.js') }}"></script>
@endsection