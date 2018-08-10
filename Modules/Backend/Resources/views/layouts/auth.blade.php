<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>#Login</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #1 for " name="description" />
        <meta content="" name="author" />
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{Module::asset('backend:default/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{Module::asset('backend:default/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{Module::asset('backend:default/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{Module::asset('backend:default/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{Module::asset('backend:default/global/plugins/select2/select2.css" rel="stylesheet')}}" type="text/css" />
        <link href="{{Module::asset('backend:default/global/plugins/select2/select2-bootstrap.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{Module::asset('backend:default/global/css/components.css')}}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{Module::asset('backend:default/global/css/plugins.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{Module::asset('backend:default/pages/css/login.min.css')}}" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class=" login">
        <!-- BEGIN LOGO -->
        <div class="logo">
           <a href="#">
                <img src="{{Module::asset('backend:default/layouts/layout/img/logo-big.png')}}" alt="" /> </a>
        </div>
       <!-- BEGIN LOGIN -->
        <div class="content">
            @yield('content')
        </div>
        <div class="copyright"> 2017 © Metronic. Admin Dashboard Template. </div>
        <!--[if lt IE 9]>
		<script src="{{Module::asset('backend:default/global/plugins/respond.min.js')}}"></script>
		<script src="{{Module::asset('backend:default/global/plugins/excanvas.min.js')}}"></script> 
		<script src="{{Module::asset('backend:default/global/plugins/ie8.fix.min.js')}}"></script> 
		<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="{{Module::asset('backend:default/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
        <script src="{{Module::asset('backend:default/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{Module::asset('backend:default/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
        <script src="{{Module::asset('backend:default/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
        <script src="{{Module::asset('backend:default/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="{{Module::asset('backend:default/global/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
        <script src="{{Module::asset('backend:default/global/plugins/jquery-validation/js/additional-methods.min.js')}}" type="text/javascript"></script>
        <script src="{{Module::asset('backend:default/global/plugins/select2/select2.js')}}" type="text/javascript"></script>
        <script src="{{Module::asset('backend:default/admin/pages/scripts/login.js')}}" type="text/javascript"></script>
        <script>
            $(document).ready(function()
            {
                $('#clickmewow').click(function()
                {
                    $('#radio1003').attr('checked', 'checked');
                });
            })
        </script>
</body>
</html>