@extends('backend::layouts.master')
@section('title', $title)
@section('content')
	@if (Session::has('message'))
		<div class="alert alert-info">{{ Session::get('message') }}</div>
	@endif

	<div class="" ng-app="service" ng-controller="services" ng-init="view='form';id='{{$post->id}}'">
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
						<label class="col-md-12 control-label">Short description</label>
						<div class="col-md-12">
							<?php echo Form::textarea('short_description', $post->short_description,['ready'=>"onReady()" , 'data-ck-editor ckeditor' =>"options" ,'ng-model' => 'post.short_description' ,'class' => 'form-control awesome', 'placeholder' => 'Short Description']);?>
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
					<div class="form-group row">
						<label class="col-md-12 control-label">File</label>
						<div class="col-md-12">
							<button class="btn btn-file" ngf-select='uploadFiles($files)' ng-model="post.file" name="file" ngf-pattern="'image/*'"
							ngf-accept="'image/*'" ngf-max-size="20MB" ngf-min-height="100"
							ngf-resize="{width: 600, height: 600}">Select file</button>
						</div>
						
					</div>
					<div class="form-group row">
						<div class="col-md-12">
							<img class="img-responsive" ngf-src="post.file || '<?php echo  $post->file; ?>'">
						</div>
					</div>
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