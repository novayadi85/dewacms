@extends('backend::layouts.master')
@section('content')
    <h1>Edit User</h1>
	<?php  
	echo Form::open(array('action' => array('\Modules\Users\Http\Controllers\Admin\UsersController@update', $user->id), 'method' => 'PUT')) ;
	//echo Form::token();
	
	?>
	<div class="form-body">
		<div class="form-group">
			<label class="col-md-3 control-label">Email</label>
			<div class="col-md-4">
				<?php echo Form::text('email', $user->email , ['class' => 'form-control awesome', 'placeholder' => 'Email']); ?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Username</label>
			<div class="col-md-4">
				<?php echo Form::text('username', $user->name , ['class' => 'form-control awesome', 'placeholder' => 'Username']); ?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Password</label>
			<div class="col-md-4">
				<?php echo Form::password('password', ['class' => 'form-control']);?>
			</div>
		</div>
		<button type="submit" class="btn blue">Save</button>
	</div>
	<?php echo Form::close() ?>
	
	
@stop
