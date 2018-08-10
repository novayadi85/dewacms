<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>App - @yield('title')</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="dewatasoft" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{Module::asset('backend:global/css/default.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{Module::asset('backend:default/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{Module::asset('backend:default/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{Module::asset('backend:default/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{Module::asset('backend:default/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link href="{{Module::asset('backend:default/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{Module::asset('backend:default/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{Module::asset('backend:default/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{Module::asset('backend:default/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{Module::asset('backend:default/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{Module::asset('backend:default/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{Module::asset('backend:default/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="{{Module::asset('backend:default/global/plugins/jquery-nestable/jquery.nestable.css')}}"/>
		<link rel="stylesheet" type="text/css" href="{{Module::asset('backend:default/global/plugins/jquery-chosen/chosen.css')}}"/>
		<link rel="stylesheet" type="text/css" href="{{Module::asset('backend:default/global/plugins/dropzone-4.3.0/dist/dropzone.css')}}"/>
		<link rel="stylesheet" type="text/css" href="{{Module::asset('backend:plugins/Lightbox/css/lightbox.min.css')}}"/>
        
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{Module::asset('backend:default/global/css/components.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{Module::asset('backend:default/global/css/plugins.min.css')}}" rel="stylesheet" type="text/css" />
		<!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
		<link href="{{Module::asset('backend:default/global/plugins/uniform/css/uniform.default.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{Module::asset('backend:default/layouts/layout/css/layout.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{Module::asset('backend:default/layouts/layout/css/themes/darkblue.min.css')}}" rel="stylesheet" type="text/css" id="style_color" />
        <link href="{{Module::asset('backend:default/layouts/layout/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{Module::asset('backend:default/global/plugins/loading/loading.css')}}" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        <div class="page-wrapper">
            <!-- BEGIN HEADER -->
            <div class="page-header navbar navbar-fixed-top">
                <!-- BEGIN HEADER INNER -->
                <div class="page-header-inner ">
                    <!-- BEGIN LOGO -->
                    <div class="page-logo">
                        <a href="index.html">
                            <img src="{{Module::asset('backend:default/layouts/layout/img/logo.png')}}" alt="logo" class="logo-default" /> </a>
                        <div class="menu-toggler sidebar-toggler">
                            <span></span>
                        </div>
                    </div>
                    <!-- END LOGO -->
                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                        <span></span>
                    </a>
                    <!-- END RESPONSIVE MENU TOGGLER -->
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <!-- BEGIN USER LOGIN DROPDOWN -->
                            <li class="dropdown dropdown-user">
                                <a href="/admin/logout" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <img alt="" class="img-circle" src="{{Module::asset('backend:default/layouts/layout/img/avatar.png')}}" />
                                    <span class="username username-hide-on-mobile"><?php print (Session::get("logged_as")); ?></span>
                                    
                                </a>
                                
                            </li>
                            <!-- END USER LOGIN DROPDOWN -->
                            <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                            <li class="dropdown dropdown-quick-sidebar-toggler">
                                <a href="/admin/logout" class="dropdown-toggle">
                                    <i class="icon-logout"></i>
                                </a>
                            </li>
                            <!-- END QUICK SIDEBAR TOGGLER -->
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END HEADER INNER -->
            </div>
            <!-- END HEADER -->
            <!-- BEGIN HEADER & CONTENT DIVIDER -->
            <div class="clearfix"> </div>
            <!-- END HEADER & CONTENT DIVIDER -->
            <!-- BEGIN CONTAINER -->
            <div class="page-container">
                <!-- BEGIN SIDEBAR -->
                <div class="page-sidebar-wrapper">
                    <!-- BEGIN SIDEBAR -->
                    <div class="page-sidebar navbar-collapse collapse">
                        <!-- BEGIN SIDEBAR MENU -->
                        @include('backend::includes.sidebar')
                        <!-- END SIDEBAR MENU -->
                    </div>
                    <!-- END SIDEBAR -->
                </div>
                <!-- END SIDEBAR -->
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        <!-- BEGIN PAGE HEADER-->
                        <!-- BEGIN PAGE BAR -->
                        <div class="page-bar">
                            @include('backend::includes.breadcrumbs')
                        </div>
                        <!-- END PAGE BAR -->
                        <!-- BEGIN PAGE TITLE-->
                        <h1 class="page-title"><?php //print $title; ?></h1>
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
                        <div class="row">
                            <div class="col-md-12">
                                <!-- note here-->
                                <div class="portlet light portlet-fit portlet-datatable bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-settings font-dark"></i>
                                            <span class="caption-subject font-dark sbold uppercase">@yield('title')</span>
                                        </div>
                                        
                                    </div>
                                    <div class="portlet-body">
                                        <div class="table-container">
                                            @yield('content')
                                        </div>
                                    </div>
                                </div>
                                <!-- End: Demo Datatable 1 -->
                                
                            </div>
                        </div>
                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
                
            </div>
            <!-- END CONTAINER -->
            <!-- BEGIN FOOTER -->
            <div class="page-footer">
                <div class="page-footer-inner"> 2018&copy; Laranova
                  
                </div>
                <div class="scroll-to-top">
                    <i class="icon-arrow-up"></i>
                </div>
            </div>
            <!-- END FOOTER -->
        </div>
        
        <!--[if lt IE 9]>
		<script src="../assets/themes/admin/assets/global/plugins/respond.min.js"></script>
		<script src="../assets/themes/admin/assets/global/plugins/excanvas.min.js"></script> 
		<script src="../assets/themes/admin/assets/global/plugins/ie8.fix.min.js"></script> 
		<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="{{Module::asset('backend:default/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js" type="text/javascript"> </script>
        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-route.js" type="text/javascript"> </script>
        
        
		<script src="{{Module::asset('backend:default/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{Module::asset('backend:default/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
        <script src="{{Module::asset('backend:default/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
        <script src="{{Module::asset('backend:default/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
        <script src="{{Module::asset('backend:default/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="{{Module::asset('backend:default/global/scripts/datatable.js')}}" ng-module="ui.datatable" type="text/javascript"></script>
        <script src="{{Module::asset('backend:default/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
        <script src="{{Module::asset('backend:default/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
        <script src="{{Module::asset('backend:default/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
        <script src="{{Module::asset('backend:default/global/plugins/bootstrap-toastr/toastr.min.js')}}" type="text/javascript"></script>
		<script src="{{Module::asset('backend:default/global/plugins/bootbox/bootbox.min.js')}}" type="text/javascript"></script>
		<script src="{{Module::asset('backend:default/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
		<script src="{{Module::asset('backend:default/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}" type="text/javascript"></script>
		<script src="{{Module::asset('backend:default/global/plugins/angular-datatables/dist/angular-datatables.min.js')}}" type="text/javascript"></script>
		<script src="{{Module::asset('backend:default/global/plugins/jquery-nestable/jquery.nestable.js')}}"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/2.4.0/ui-bootstrap-tpls.min.js"></script>
		
		<script src="{{Module::asset('backend:plugins/Lightbox/js/lightbox.js')}}"></script>
		
		<script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>
		<script src="{{Module::asset('backend:default/global/plugins/dropzone-4.3.0/dist/dropzone.js')}}"></script>		
		<!--
            <script src="https://cdnjs.cloudflare.com/ajax/libs/ng-ckeditor/0.2.1/ng-ckeditor.min.js"></script>
		-->
        <script src="{{Module::asset('backend:default/global/plugins/sortable/sortable.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-chosen-localytics/1.8.0/angular-chosen.min.js"></script>
		<script src="{{Module::asset('backend:default/global/plugins/ng-dropzone/ng-dropzone.js')}}"></script>
		<script src="{{Module::asset('backend:default/global/plugins/ng-file-upload/ng-file-upload-shim.min.js')}}"></script> <!-- for no html5 browsers support -->
        <script src="{{Module::asset('backend:default/global/plugins/ng-file-upload/ng-file-upload.min.js')}}"></script>
        <!-- END PAGE LEVEL PLUGINS -->
		<!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{{Module::asset('backend:default/global/scripts/app.js')}}" type="text/javascript"></script>
       
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

		<!-- END THEME GLOBAL SCRIPTS -->
		
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="{{Module::asset('backend:default/layouts/layout/scripts/layout.min.js')}}" type="text/javascript"></script>
        <script src="{{Module::asset('backend:default/layouts/layout/scripts/demo.min.js')}}" type="text/javascript"></script>
        <script src="{{Module::asset('backend:default/layouts/global/scripts/quick-sidebar.min.js')}}" type="text/javascript"></script>
        <script src="{{Module::asset('backend:default/layouts/global/scripts/quick-nav.min.js')}}" type="text/javascript"></script>
        <script src="{{Module::asset('backend:default/global/plugins/loading/loading.js')}}" type="text/javascript"></script>
        <script src="{{Module::asset('backend:js/Backend.js')}}" type="text/javascript"></script>
        
		<!-- END THEME LAYOUT 
		
		<!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
		@if(isset($js_script))
			@foreach( $js_script as $js )
				<script src="{{$js}}"></script>
			@endforeach
		@endif
		@include('ckfinder::setup')
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>