@extends('backend::layouts.master')
@section('title', $title)
@section('content')
	@if (Session::has('message'))
		<div class="alert alert-info">{{ Session::get('message') }}</div>
	@endif
	<div class="" ng-app="metafield" ng-controller="metafields">
	{{ Form::open(['ng-submit' => 'submit()', 'onsubmit' => 'return false']) }}
		<div class="form-body">
			<div class="form-group row">
				<label class="col-md-12 control-label">Title</label>
				<div class="col-md-12">
					<?php echo Form::text('title', "" , ['ng-change'=>'slugify()','ng-model' => 'post.title' ,'class' => 'form-control awesome', 'placeholder' => 'Title']); ?>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-12 control-label">Handle</label>
				<div class="col-md-12">
					<?php echo Form::text('handle', "" , ['ng-model' => 'post.handle' , 'class' => 'form-control awesome', 'placeholder' => 'Handle']); ?>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-12 control-label">Post Type</label>
				<div class="col-md-12">
					<?php echo Form::select('post_type', array("page" => "page","post" => "post","product" => "product"), '', ['ng-model' => 'post.post_type' , 'class' => 'form-control awesome', 'placeholder' => 'Post type']); ?>
				
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-12 control-label">Type</label>
				<div class="col-md-12">
					<?php echo Form::select('type', array("text" => "Text","string" => "String","select" => "TrueFalse"), '', ['ng-model' => 'post.type' , 'class' => 'form-control awesome', 'placeholder' => 'Type']); ?>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-12 control-label">Text</label>
				<div class="col-md-12">
					<?php echo Form::textarea('description', '',['ready'=>"onReady()" , 'data-ck-editor ckeditor' =>"options" ,'ng-model' => 'post.description' ,'class' => 'form-control awesome editor1', 'placeholder' => 'Desc']);?>
				</div>
			</div>
			<button type="submit"  class="btn btn-primary green">Save</button>
		</div>
	
		{{Form::close()}}
	</div>
@stop