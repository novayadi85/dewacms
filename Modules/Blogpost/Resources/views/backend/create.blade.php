@extends('backend::layouts.master')
@section('title', $title)
@section('content')
	@if (Session::has('message'))
		<div class="alert alert-info">{{ Session::get('message') }}</div>
	@endif
	<div class="" ng-app="blogpost" ng-controller="posts">
	{{ Form::open(['ng-submit' => 'submit()', 'onsubmit' => 'return false']) }}
		<div class="form-body">
		<div class="row">
			<div class="col-md-8">
			<div class="form-group row">
				<label class="col-md-12 control-label">Title</label>
				<div class="col-md-12">
					<?php echo Form::text('title', "" , ['ng-change'=>'slugify()','ng-model' => 'post.title' ,'class' => 'form-control awesome', 'placeholder' => 'Title']); ?>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-12 control-label">Slug</label>
				<div class="col-md-12">
					<?php echo Form::text('slug', "" , ['ng-model' => 'post.slug' , 'class' => 'form-control awesome', 'placeholder' => 'Slug']); ?>
				</div>
			</div>
			
			<div class="form-group row">
				<label class="col-md-12 control-label">Text</label>
				<div class="col-md-12">
					<?php echo Form::textarea('description', '',['ready'=>"onReady()" , 'data-ck-editor ckeditor' =>"options" ,'ng-model' => 'post.description' ,'class' => 'form-control awesome editor1', 'id' => 'editor' , 'placeholder' => 'Desc']);?>
				</div>
			</div>
			</div>
			<div class="col-md-4">
				<h3>Metafields</h3>
				<?php echo $metafields;?>
				
			</div>
			</div>
			<button type="submit"  class="btn btn-primary green">Save</button>
		</div>
	
		{{Form::close()}}
	</div>
@stop