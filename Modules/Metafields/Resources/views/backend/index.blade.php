@extends('backend::layouts.master')
@section('title', $title)
@section('content')
	<!-- will be used to show any messages -->
	@if (Session::has('message'))
		<div class="alert alert-info">{{ Session::get('message') }}</div>
	@endif
	<div class="" ng-app="metafield" ng-controller="metafields" ng-init="view='list'"> 
	<div class="block">
		<div class="btn-group">
			<a href="{{Route('metafields.create')}}" class="btn blue" title="Add New">Create New</a>
		</div>

		<div class="table-group-actions pull-right">
			<span></span>
			<select ng-change="filter()" ng-model="post.lang" id="language" class="table-group-action-input form-control input-inline input-small input-sm">
				<option value="">Language...</option>
				<option value="en">English</option>
				<option value="id">Indonesia</option>
			</select>
		</div>
		
	</div>
	<br>
	<table id="table" class="table table-bordered bordered table-striped table-condensed datatable" datatable="ng">
        <thead>
            <tr>
                <th width="60">#ID</th>
                <th>Title</th>
                <th width="100">Action</th>
                
            </tr>
        </thead>
        <tfoot>
            <tr>
				<th width="60">#ID</th>
				<th>Title</th>
				<th width="100">Action</th>
            </tr>
        </tfoot>
        <tbody>
			<tr ng-repeat="item in results">
				<td><%item.id%></td>
				<td><%item.title%></td>
				<td align="center"><a ng-click="editData()"  class="btn green"><i class="fa fa-pencil"></i></a>
				<a ng-click="deleteData()" data-id="<%item.id%>" class="btn red"><i class="fa fa-trash"></i></a></td>
			</tr>
		<tbody>
		</table>
	</div>
@stop