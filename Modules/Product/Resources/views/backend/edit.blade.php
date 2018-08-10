@extends('backend::layouts.master')
@section('title', $title)
@section('content')
	@if (Session::has('message'))
		<div class="alert alert-info">{{ Session::get('message') }}</div>
	@endif
	
	<div class="" ng-init="view='form';id='{{$post->id}}'"  ng-app="product" ng-controller="products">
	{{ Form::open(['ng-submit' => 'submit()', 'onsubmit' => 'return false']) }}
		<div class="form-body">
		<div class="row">
			<div class="col-md-8">
				<div class="form-group row">
					<label class="col-md-12 control-label">Title</label>
					<div class="col-md-12">
						<?php echo Form::text('title', $post->title  , ['ng-change'=>'slugify()','ng-model' => 'post.title' ,'class' => 'form-control awesome', 'placeholder' => 'Title']); ?>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-12 control-label">Slug</label>
					<div class="col-md-12">
						<?php echo Form::text('slug', $post->slug  , ['ng-model' => 'post.slug' , 'class' => 'form-control awesome', 'placeholder' => 'Slug']); ?>
					</div>
				</div>
				
				<div class="form-group row">
					<label class="col-md-12 control-label">Short Description</label>
					<div class="col-md-12">
						<?php echo Form::textarea('short_description', $post->short_description ,['ng-model' => 'post.short_description' , 'id' => 'editor1' , 'class' => 'form-control awesome', 'placeholder' => 'Desc']);?>
					</div>
				</div>

				<div class="form-group row">
						<div class="col-md-12">
						<div class="panel-group accordion" id="accordion1">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion1" href="#collapse_1" aria-expanded="false"> Intro </a>
									</h4>
								</div>
								<div id="collapse_1" class="panel-collapse collapse in" aria-expanded="true">
									<div class="panel-body">
										<div class="form-group row">
											<label class="col-md-12 control-label">Text</label>
											<div class="col-md-12">
												<?php echo Form::textarea('description', $post->description ,['ready'=>"onReady()" , 'data-ck-editor ckeditor' =>"options" ,'ng-model' => 'post.description' ,'class' => 'form-control awesome editor1', 'placeholder' => 'Desc' , 'id' => 'editor2']);?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-md-12 control-label">Additional Text</label>
											<div class="col-md-12">
												<?php echo Form::textarea('notes', $post->notes ,['ready'=>"onReady()" , 'data-ck-editor ckeditor' =>"options" ,'ng-model' => 'post.notes' ,'class' => 'form-control awesome editor2', 'placeholder' => 'Desc' , 'id' => 'editor3']);?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapse_2" aria-expanded="false"> Photos </a>
									</h4>
								</div>
								<div id="collapse_2" class="panel-collapse collapse" aria-expanded="false">
									<div class="panel-body">
										<div class="form-group">
											<div data-ng-init="gallery()" class="dropzone" options="dzOptions" callbacks="dzCallbacks" methods="dzMethods" ng-dropzone></div>
											<div class="gallery" style="margin-top:15px;">
												<div class="form-group row">
													<div ng-repeat="image in galleries" class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter hdpe" style="margin-bottom:25px;">
														<a ng-click="openLightboxModal($index)">
															<img src="<%image.guid%>" class="img-responsive">
														</a>
														<br>
														<center><a ng-click="removeImage()" class="btn red">Remove</a></center>
													</div>	
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="panel-group accordion" id="accordion2">
							<!-- start dynamic accordion -->
							<div ng-init="instansce()" ng-if="group.id != ''" ng-init="$last ? repeat_done() : null" class="panel panel-default" ng-repeat="group in groups">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapse_group_<%group.id%>"> <%group.title%> <strong><%post["tabs"][group.id]%></strong></a>
									</h4>
								</div>
								<div  id="collapse_group_<%group.id%>" class="panel-collapse collapse">
									<div class="panel-body">
										<div class="form-group row">
											<label class="col-md-12 control-label">Title</label>
											<div class="col-md-12">
												<?php echo Form::text('title_<%group.id%>', "" , ['ng-model' => 'post["tabs"][group.id]' ,'class' => 'form-control awesome', 'placeholder' => 'Title']); ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-md-12 control-label">Content</label>
											<div class="col-md-12">
												<?php echo Form::textarea('content_<%group.id%>', '',['ready'=>"instansce()" ,'data-ck-editor ckeditor' =>"options" , 'data-model' => 'post_group.id' , 'ng-model' => 'post["contents"][group.id]' ,'class' => 'form-control awesome editor_tab', 'placeholder' => 'Desc','id' => 'content__collapse_group_<%group.id%>']);?>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-md-12">
												<p><a ng-click="removeTab()" class="btn red pull-right"> Remove </a></p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- end dynamic accordion -->
							
						</div>
						<div class="form-group row">
							<div class="col-md-12">
								<a ng-click="addTab()" class="btn blue btn-default pull-right">Add New</a>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group row">
					<div class="col-md-12">
						<div class="portlet light bordered">
							<div class="portlet-title">
								<div class="caption">
									<h3><strong>Avilability</strong></h3>
								</div>
							</div>
							<div class="portlet-body">
								<div class="well bg-default">
									<div class="row">	
										<div class="column-headline" style="background:#e4e1e1;">
											<label class="control-label col-md-6"><h5>Date range</h5></label>	
											<label class="control-label col-md-4"><h5>Price</h5></label>
											<label class="control-label col-md-2">&nbsp;</label>
										</div>	
									</div>				
									<div ng-repeat="x in dates" ng-init="$last ? date_done() : null" class="tab-child">
										
										<div class="form-group row">
											<div class="col-md-6">
												<div class="input-group input-large date-picker input-daterange" data-date-format="mm/dd/yyyy">
													<?php echo Form::text('from', "" , ['ng-model' => 'post["dates"]["start"][x.id]' ,'class' => 'form-control awesome datepicker', 'placeholder' => 'Start']); ?>
													<span class="input-group-addon"> to </span>
													<?php echo Form::text('to', "" , ['ng-model' => 'post["dates"]["end"][x.id]' ,'class' => 'form-control awesome datepicker', 'placeholder' => 'To']); ?>
													<span class="input-group-btn">
														<button class="btn yellow" type="button">
															<i class="fa fa-calendar"></i>
														</button>
													</span>
												</div>	
													
											</div>				
											
											<div class="col-md-4">
												<?php echo Form::text('price', "" , ['ng-model' => 'post["dates"]["price"][x.id]' ,'class' => 'form-control awesome', 'placeholder' => 'Price']); ?>
											</div>
											<div class="col-md-2">
												<a class="btn red remove-date" ng-click="removeDate()"><i class="fa fa-trash"></i></a>
											</div>
										</div>
									</div>
									<div ng-if='dates.length < 1'>
										<div class="form-group row">
											<div class="col-md-12">
												<p class="alert alert-warning" role="alert"> Add availibility </p>
											</div>
										</div>
									</div>
									
								</div>

								<div class="form-group row">
									<div class="col-md-12">
										<a ng-click="addDate()" class="btn blue btn-default pull-right">Add Date</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			
				<?php /*
				<div class="form-group row">
					<label class="col-md-12 control-label">Days</label>
					<div class="col-md-12">
						<?php 
						echo "<div class=\"days-tabs\">
						<div ng-repeat=\"x in days\" class=\"tab-child\">
							<ul class=\"nav nav-tabs\">
								<li class=\"active\"><a href=\"#<%x.id%>\"><%x.title%></a></li>
							</ul>
							<div class=\"tab-content\" style=\"margin-bottom:25px;\">
								<div id=\"<%x.id%>\" class=\"tab-pane fade in active\">
									<p>
										<label class=\"control-label\">Title</label><br>
										<input value=\"\" type=\"text\" init-model=\"x.title\" ng-model=\"x.title\" class=\"form-control\">
									</p>
									<p>
										<label class=\"control-label\">File</label><br>
										<button class=\"btn btn-file\" ngf-select='uploadFiles($files)' ng-model=\"x.file\" name=\"file\" ngf-pattern=\"'image/*'\"
										ngf-accept=\"'image/*'\" ngf-max-size=\"20MB\" ngf-min-height=\"100\"
										ngf-resize=\"{width: 100, height: 100}\" >Select file</button>
									</p>	
									<textarea ckeditor=\"options\"  data-ck-editor init-model=\"x.text\" ng-model=\"x.text\" cols=\"60\" rows=\"5\" class=\"days_textarea editor<%x.uid%> form-control\"><%x.text%></textarea>
								</div>
								<br><a ng-click=\"removeDay()\" class=\"btn red pull-right\"> Remove </a>
							</div>
						
						</div>
					</div>";
					?>
					</div>
				</div>
				
				<div class="form-group row">
					<div class="col-md-12">
						<a ng-click="addDays()" class="btn blue btn-default pull-right">Add New</a>
					</div>
				</div>
				*/ ?>
				<div class="form-group row">
					

					<?php 
					/*
					<div class="ui-sortable" ui-sortable="sortableOptions" ng-model="items">
						<div class="ui-state-default box-sortable" ng-repeat="item in items"><%item%></div>
					</div>
					*/
					?>
				</div>
				
				<?php  
				 /* <ul>
					<li ng-repeat="f in files" style="font:smaller">{{f.name}} {{f.$errorParam}}
					<span class="progress" ng-show="f.progress >= 0">
						<div style="width:{{f.progress}}%"  
							ng-bind="f.progress + '%'"></div>
					</span>
					</li>
					<li ng-repeat="f in errFiles" style="font:smaller">{{f.name}} {{f.$error}} {{f.$errorParam}}
					</li> 
				</ul>
				{{errorMsg}}
				 */
					?>
			</div>
			
			<div class="col-md-4">
				<div class="form-group row">
					<label class="col-md-12 control-label">Categories</label>
					<div class="col-md-12">
					{{Form::select('feeling', $categories, $post->category_id , ['class' => 'form-control'])}}
						
					</div>
				</div>
				<hr>
				<h3>Metafields</h3>
				<?php echo $metafields;?>
				
			</div>
			</div>
			<button type="submit"  class="btn btn-primary green">Save</button>
		</div>
	
		{{Form::close()}}
	</div>
@stop