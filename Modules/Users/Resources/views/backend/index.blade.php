@extends('backend::layouts.master')
@section('content')
	<!-- will be used to show any messages -->
	@if (Session::has('message'))
		<div class="alert alert-info">{{ Session::get('message') }}</div>
	@endif
	
	<div class="" ng-app="scraper" ng-controller="user">
	<div class="block">
		<div class="btn-group">
			<a ng-click="openForm()" class="btn blue" title="Add New">Create New</a>
		</div>
	</div>
	<br>
	<table id="tableUsers" class="table table-bordered bordered table-striped table-condensed datatable" datatable="ng">
        <thead>
            <tr>
                <th>#ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
                
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>#ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
                
            </tr>
        </tfoot>
        <tbody>
			<tr ng-repeat="item in results">
				<td><%item.id%></td>
				<td><%item.name%></td>
				<td><%item.email%></td>
				<td><a ng-click="openData()" data-id="<%item.id%>" class="btn green">Edit</a><a ng-click="deleteData()" data-id="<%item.id%>" class="btn red">Remove</a></td>
			</tr>
		<tbody>
		</table>
		
		<div id="modal_response" class="modal fade" role="dialog">
			<div class="modal-dialog modal-md">
				<div class="modal-content">
				  <form ng-submit="addUser()" name="userForm">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Create User</h4>
				  </div>
				  <div class="modal-body">
					
					<div class="form-group row">
						<label class="col-sm-3 control-label">Name</label>
						<div class="col-sm-9">
							<div class="input-group1">
								<input ng-model="user.name" type="text" name="name" class="form-control" required>
							</div>
							
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 control-label">Email</label>
						<div class="col-sm-9">
							<div class="input-group1">
								<input ng-model="user.email" type="email" name="email" class="form-control" required>
							</div>
						</div>
					</div>
					
					
					<div class="form-group row">
						<label class="col-sm-3 control-label">Password</label>
						<div class="col-sm-9">
							<div class="input-group1">
								<input ng-model="user.password" class="form-control" name="password" rows="3">
							</div>
							
						</div>
					</div>
					
					<div class="form-group row">
						<label class="col-md-3 control-label">Role</label>
						<div class="col-md-4">
							<select name="role" class="form-control" ng-model="user.role">
								<option value="1">Admin</option>
								<option value="2">Manager</option>
								<option value="3">User</option>
							</select>
						</div>
					</div>
					
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" ng-disabled="userForm.name.$dirty && userForm.name.$invalid ||  
userForm.email.$dirty && userForm.email.$invalid" class="btn btn-primary green">Save</button>
				  </div>
				  </form>
				</div>
			</div>
		</div>

		
	</div>

@stop
