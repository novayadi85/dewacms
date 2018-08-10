@extends('backend::layouts.master')
@section('title', $title)
@section('content')
	@if (Session::has('message'))
		<div class="alert alert-info">{{ Session::get('message') }}</div>
	@endif

	<div class="" ng-app="page" ng-controller="pages" ng-init="view='form';id='{{$post->id}}'">
	{{ Form::open(['ng-submit' => 'submit()', 'onsubmit' => 'return false']) }}
		<div class="form-body">
			<div class="row">
				<div class="col-md-8">
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
						<label class="col-md-12 control-label">Text</label>
						<div class="col-md-12">
							<?php echo Form::textarea('description', $post->description ,['ready'=>"onReady()" , 'data-ck-editor ckeditor' =>"options",'init-model' => 'description' ,'ng-model' => 'post.description' ,'class' => 'form-control awesome editor1', 'id' => 'editor', 'placeholder' => 'Desc']);?>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<h3>Metafields</h3>
					<?php echo $metafields;?>
					
				</div>	
				
			</div>
			<div class="row">
				<div class="col-md-12">	
					<div class="form-group">
						<a href="{{Route('articles')}}" class="btn default" title="Back">Back</a> &nbsp;
						<button type="submit"  class="btn btn-primary green">Save</button>
					</div>
				</div>
			</div>
		</div>
	
		{{Form::close()}}
	</div>
@stop