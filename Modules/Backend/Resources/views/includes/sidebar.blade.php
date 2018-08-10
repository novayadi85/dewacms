<?php 
$modules = Module::all();
foreach($modules as $module){
	/* print "<pre>";
	print_r($module);
	print "</pre>"; */
}
?>
<ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
	
	<!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
	<li class="sidebar-search-wrapper">
		<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
		<!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
		<!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
		<form class="sidebar-search " action="extra_search.html" method="POST">
			<a href="javascript:;" class="remove">
			<i class="icon-close"></i>
			</a>
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Search...">
				<span class="input-group-btn">
				<a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
				</span>
			</div>
		</form>
		<!-- END RESPONSIVE QUICK SEARCH FORM -->
	</li>
	<li class="start <?=(Request::is('admin'))? "active" : "";?>">
		<a href="javascript:;">
		<i class="icon-home"></i>
		<span class="title">Dashboard</span>
		</a>
	</li>
	<li class="item <?=(Request::is('admin/users'))? "active" : "";?>">
		<a href="/admin/users">
		<i class="fa fa-users"></i>
		Users</a>
	</li>
	<li class="item <?=(Request::is('admin/articles'))? "active" : "";?>">
		<a href="/admin/articles">
		<i class="fa fa-newspaper-o"></i>
		<span class="title">Articles</span>
		<!--<span class="arrow"></span>-->
		</a>
		<!--<ul class="sub-menu">
			<li class="item">
				<a href="/admin/articles">
				<i class="icon-bar-blog"></i>
				Post</a>
			</li>
		</ul>-->
	</li>
	<li class="item <?=(Request::is("admin/terms"))? "active" : "";?>">
		<a href="/admin/terms">
		<i class="fa fa-file-text-o"></i>
		Terms</a>
	</li>
	<li class="item <?=(Request::is("admin/product"))? "active" : "";?>">
		<a href="/admin/product">
		<i class="fa fa-cubes"></i>
		<span class="title">Ads</span>
		<!--<span class="arrow"></span>-->
		</a>
		<!--<ul class="sub-menu">
			<li class="item">
				<a href="/admin/product">
				<i class="icon-bar-blog"></i>
				Product</a>
			</li>
		</ul>-->
	</li>
	<li class="item <?=(Request::is("admin/pages"))? "active" : "";?>">
		<a href="/admin/pages">
		<i class="fa fa-sticky-note-o"></i>
		Pages</a>
	</li>

	<li class="item <?=(Request::is("admin/services"))? "active" : "";?>">
		<a href="/admin/services">
		<i class="fa fa-gear"></i>
		Services</a>
	</li>
	
	<li class="item <?=(Request::is("admin/metafields"))? "active" : "";?>">
		<a href="/admin/metafields">
		<i class="fa fa-tasks"></i>
		Metafields</a>
	</li>

	<li class="item <?=(Request::is("admin/menu"))? "active" : "";?>">
		<a href="/admin/menu">
		<i class="fa fa-navicon"></i>
		Navigations</a>
	</li>

	<li class="item <?=(Request::is("admin/configuration"))? "active" : "";?>">
		<a href="/admin/configuration">
		<i class="fa fa-wrench"></i>
		Configuration</a>
	</li>
</ul>