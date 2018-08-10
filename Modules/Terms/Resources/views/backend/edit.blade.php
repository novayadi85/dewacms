@extends('backend::layouts.master')
@section('title', $title)
@section('content')
	@if (Session::has('message'))
		<div class="alert alert-info">{{ Session::get('message') }}</div>
	@endif

	<div class="" ng-app="term" ng-controller="terms" ng-init="view='form';id='{{$post->id}}'">
	{{ Form::open(['ng-submit' => 'submit()', 'onsubmit' => 'return false']) }}
		<div class="form-body">
			<div class="form-group row">
				<label class="col-md-12 control-label">Title</label>
				<div class="col-md-12">
					<?php echo Form::text('title', $post->title , ['ng-change'=>'slugify()' ,'init-model' => 'title','ng-model' => 'post.title' ,'class' => 'form-control awesome', 'placeholder' => 'Title']); ?>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-12 control-label">Slug</label>
				<div class="col-md-12">
					<?php echo Form::text('slug', $post->slug , ['init-model' => 'slug' , 'ng-model' => 'post.slug' , 'class' => 'form-control awesome', 'placeholder' => 'Slug']); ?>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-md-12 control-label">Location</label>
				<div class="col-md-12">
					<?php echo Form::select("location", $options_values , $post->location ,['init-model' => 'location' , 'ng-model' => 'post.location' , 'class' => 'form-control awesome', 'placeholder' => 'Location']); ?>
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
					<?php echo Form::textarea('description', $post->description ,['ready'=>"onReady()" , 'data-ck-editor ckeditor' =>"options",'init-model' => 'description' ,'ng-model' => 'post.description' ,'class' => 'form-control awesome editor1', 'placeholder' => 'Desc']);?>
				</div>
			</div>
			
			<div class="form-group">
				<a href="{{Route('articles')}}" class="btn default" title="Back">Back</a> &nbsp;
				<button type="submit"  class="btn btn-primary green">Save</button>
			</div>
		</div>
	
		{{Form::close()}}
	</div>
@stop