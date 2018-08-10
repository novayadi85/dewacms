@extends('backend::layouts.master')
@section('title', $title)
@section('content')
	@if (Session::has('message'))
		<div class="alert alert-info">{{ Session::get('message') }}</div>
	@endif
	<div class="" ng-init="load()"  ng-app="product" ng-controller="products">
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
					<label class="col-md-12 control-label">Short Description</label>
					<div class="col-md-12">
						<?php echo Form::textarea('short_description', "" ,['ng-model' => 'post.short_description' ,'class' => 'form-control awesome', 'placeholder' => 'Desc']);?>
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
												<?php echo Form::textarea('description', '',['ready'=>"onReady()" , 'data-ck-editor ckeditor' =>"options" ,'ng-model' => 'post.description' ,'class' => 'form-control awesome editor1', 'placeholder' => 'Desc']);?>
											</div>
										</div>

										<div class="form-group row">
											<label class="col-md-12 control-label">Additional Text</label>
											<div class="col-md-12">
												<?php echo Form::textarea('notes', "" ,['ready'=>"onReady()" , 'data-ck-editor ckeditor' =>"options" ,'ng-model' => 'post.notes' ,'class' => 'form-control awesome editor2', 'placeholder' => 'Desc']);?>
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
							<div ng-if="group.id != ''" ng-init="$last ? repeat_done() : null" class="panel panel-default" ng-repeat="group in groups">
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
												<?php echo Form::textarea('content_<%group.id%>', '',['ready'=>"onReady()" ,'data-ck-editor ckeditor' =>"options" , 'data-model' => 'post_group.id' , 'ng-model' => 'post.content["<%group.id%>"]' ,'class' => 'form-control awesome editor_tab', 'placeholder' => 'Desc','id' => 'content__collapse_group_<%group.id%>']);?>
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
								<a ng-click="addTab()" class="btn blue btn-default pull-right">Add Tab</a>
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
													<?php echo Form::text('from', "<%x.start%>" , ['ng-model' => 'post["dates"]["start"][x.id]' ,'class' => 'form-control awesome datepicker', 'placeholder' => 'Start']); ?>
													<span class="input-group-addon"> to </span>
													<?php echo Form::text('to', "<%x.end%>" , ['ng-model' => 'post["dates"]["end"][x.id]' ,'class' => 'form-control awesome datepicker', 'placeholder' => 'To']); ?>
													<span class="input-group-btn">
														<button class="btn yellow" type="button">
															<i class="fa fa-calendar"></i>
														</button>
													</span>
												</div>	
													
											</div>				
											
											<div class="col-md-4">
												<?php echo Form::number('date_price_<%x.id%>', "" , ['ng-model' => 'post["dates"]["price"][x.id]' ,'class' => 'form-control awesome', 'placeholder' => 'Price']); ?>
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
				<h3>Metafields</h3>
				<?php echo $metafields;?>
				
			</div>
			</div>
			<button type="submit"  class="btn btn-primary green">Save</button>
		</div>


		<div class="container">
			
				<?php /*
				<accordion-group heading="<%group.title%>" ng-repeat="group in groups">
				<%group.content%>
				</accordion-group>
				<accordion-group heading="Dynamic Body Content">
				<p>The body of the accordion group grows to fit the contents</p>
					<button class="btn btn-default btn-sm" ng-click="addItem()">Add Item</button>
					<div ng-repeat="item in items"><%item%></div>
				</accordion-group>
				<accordion-group is-open="isopen">
					<accordion-heading>
						I can have markup, too! 
					</accordion-heading>
					<div ng-switch on="isopen">
					<div ng-switch-when="true">
						<%callMeWhenCompiled()%>
					</div>
					</div>
				</accordion-group>
				*/
				?>
			


		</div>
	
		{{Form::close()}}
	</div>
@stop