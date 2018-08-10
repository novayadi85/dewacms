@section('title', $title)
@section('language', '')
@section('module','')
<ul class="page-breadcrumb">
	<li>
		<i class="fa fa-home"></i>
		<a href="#">@lang('general.dasboard')</a>
		<i class="fa fa-angle-right"></i>
	</li>
	<li>
		<a href="#">@yield('title')</a>
	</li>
</ul>
<div class="page-toolbar">
	<div class="btn-group pull-right">
		
		
	</div>
</div>

