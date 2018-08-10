@extends('backend::layouts.master')
@section('title', $title)
@section('content')
	@if (Session::has('message'))
		<div class="alert alert-info">{{ Session::get('message') }}</div>
	@endif
	<div class="" ng-app="term" ng-controller="terms">
	{{ Form::open(['ng-submit' => 'submit()', 'onsubmit' => 'return false']) }}
		<div class="form-body">
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
				<label class="col-md-12 control-label">Location</label>
				<div class="col-md-12">
					<?php echo Form::select("location", $options_values , "" ,['init-model' => 'location' , 'ng-model' => 'post.location' , 'class' => 'form-control awesome', 'placeholder' => 'Location']); ?>
				</div>
			</div>
			
			<div class="form-group row">
				<label class="col-md-12 control-label">Taxonomy</label>
				<div class="col-md-12">
					<?php echo Form::select('taxonomy', array("product" => "product","post" => "post"), '', ['ng-model' => 'post.taxonomy' , 'class' => 'form-control awesome', 'placeholder' => 'Taxonomy']); ?>
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