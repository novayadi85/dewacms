@extends('backend::layouts.master')
@section('title', $title)
@section('content')
	<!-- will be used to show any messages -->
	@if (Session::has('message'))
		<div class="alert alert-info">{{ Session::get('message') }}</div>
	@endif
		<div ng-app="navigation" ng-controller="organizer">
			<div class="block">
				<div class="btn-group">
					<a ng-click="create(); $event.preventDefault();" class="btn blue" title="Add New">Create New</a>
				</div>
			</div>
			<br>
			<div class="dd" id="nestable_lists">
				<ol class="dd-list">
					<li data-id="<%item.id%>" class="dd-item" ng-repeat="item in results">
						<div data-id="<%item.id%>" class="dd-handle"><%item.title%></div>
						<span ng-click="remove()" class="remove-collection glyphicon glyphicon-remove" style="right:2px; top:7px; z-index:10; position:absolute; cursor:pointer;"></span>
						<span ng-click="edit()" class="edit-collection glyphicon glyphicon-edit" style="right: 20px;top:7px;z-index:10;position:absolute;cursor:pointer;"></span>
					
						<ol class="dd-list" ng-if="item.children.length > 0" ng-include="'{{Module::asset('navigation:html/list.html')}}'">

						</ol>
					</li>
				</ol>
			</div>
			
			<div id="modal_response" class="modal fade" role="dialog">
				<div class="modal-dialog modal-md">
					<div class="modal-content">
					  <form ng-submit="save()" name="menuForm">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Create Menu</h4>
					  </div>
					  <div class="modal-body">
						
						<div class="form-group row">
							<label class="col-sm-3 control-label">Title</label>
							<div class="col-sm-9">
								<div class="input-group1">
									<input ng-model="menu.title" type="text" name="title" class="form-control" required>
								</div>
								
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 control-label">Link</label>
							<div class="col-sm-9">
								<div class="input-group1">
									<input ng-model="menu.link" type="text" name="link" class="form-control">
								</div>
							</div>
						</div>
						
						<div class="form-group row">
							<label class="col-md-3 control-label">Target <%menu.target%></label>
							<div class="col-md-4">
								<select class="form-control" ng-model="menu.target"
									  ng-options="v.value as (v.name + v.value) group by v.shade for v in dropdowns">
								</select>
							</div>
						</div>
						
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" ng-disabled="menuForm.title.$dirty && menuForm.title.$invalid ||  
	menuForm.link.$dirty && menuForm.link.$invalid" class="btn btn-primary green">Save</button>
					  </div>
					  </form>
					</div>
				</div>
			</div>
			
		</div>
@stop