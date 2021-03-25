<!DOCTYPE html>
<html class="" lang="en">
<head>
    <meta charset="utf-8">
    <title>qdPM Custom Reports</title>
    <link rel="shortcut icon" type="text/css" href="image/favicon.ico">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">    
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href={{asset("css/bootstrap.css")}} rel="stylesheet">
    <link href={{asset("css/style.css")}} rel="stylesheet">
    <link href={{asset("css/font-awesome.css")}} rel="stylesheet">
    <link href={{asset("css/font-icomoon.css")}} rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <!-- gantt chart -->
    <link rel="stylesheet" href={{asset("css/dhtmlxgantt.css")}} type="text/css" media="screen" title="no title" charset="utf-8">
    <script src={{asset("dhtmlxgantt.js")}} type="text/javascript" charset="utf-8"></script>
    <script src={{asset("ext/dhtmlxgantt_tooltip.js")}} type="text/javascript" charset="utf-8"></script>
    <!-- gantt chart end -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="plugins/jQuery/jquery-3.1.1.min.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>
    <link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/plug-ins/3cfcc339e89/integration/bootstrap/3/dataTables.bootstrap.css">
  <script src={{asset("js/highcharts.js")}}></script>
    <script src={{asset("module/exporting.js")}}></script>
</head>
<body class="hold-transition sidebar-mini">
<!-- header navbar -->
  <header class="main-header">


  <style type="text/css">
    .main-header{
      background-color: #222222;
      position: fixed;
      width: 100%;
    }
  </style>
  <!-- <style type="text/css">
    .main-header{
      position: fixed;
      width: 100%;
    }
    .sidebar-mini .uwatere {
      width: 15%;
    }
  </style> -->
     <span class="logo-xs navbar-brand">qdPM Immobi SP</span>
    <nav class="navbar navbar-fixed">
      <a href="#" class="fa fa-angle-left fa-1x" style="color:#fff;" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
    </style>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
              <li class="user">
          <a href={{url('profile')}} class="test" style="color:#fff;">
            {{ session()->get('users')->name }}
            </a>
          </li>
          <li class="user">
            <a href="{{url(env('QDPM_LOGOFF'))}}" class="test" style="color:#fff;">
              Log Out
            </a>
          </li>
          <style type="text/css">
            .user .test:hover{
              background-color: #696969;
            }
          </style>
        </ul>
      </div>
    </nav>
  </header>
<!-- navbar sidebar -->
  <aside class="test1" style="background-color:#3d3e40;overflow:hidden;">

  <style type="text/css">
    .test1{
       float: left;
      height: 2000px;
      position: fixed;
      z-index: :-99;
    }
  </style>
  <br>
  <br>
  <br>
    <section class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header"></li>
        <li class="active treeview">
          <a href="#" style="color:#fff;background-color:#5d5f62;border:none;" class="active">
            <i class="fa fa-home fa-1x"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="background-color:#3d3e40">
            <li><a href={{url('projectSummary')}} style="color:#fff;"><i class=""></i>Project Summary</a></li>
            <li><a href={{url('picSummary')}} style="color:#fff;"><i class=""></i>PIC Summary</a></li>
            <li><a href={{url('picDuration')}} style="color:#fff;"><i class=""></i>PIC Idle Time</a></li>
            <li><a target="_blank" href={{url('gantt-Chart')}} style="color:#fff;"><i class=""></i>Gantt Chart</a></li>
            <li><a href="{{ url(env('QDPM_URL'))}}" style="color: #fff;"><i class=""></i>Back to Main Dashboard</a></li>
          </ul>
        </li>
    </section>
  </aside>
<div class="content-wrapper" style="background-color:#fff;">

   <section class="content-header">
     <!-- <h1>Dashboard</h1> -->
        <div class="col-md-12">
          @yield('content')
          @yield('profile')
        </div>
  </section>
</div>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
   <div class="tab-content">
     <!-- Home tab content -->
     <div class="tab-pane" id="control-sidebar-home-tab"></div>
</aside>
    <div class="control-sidebar-bg"></div>
  </div>
</body>
</html>
<!-- Script -->
<script src={{asset("js/jquery-3.0.0.min.js")}}></script>
<script src={{asset("js/bootstrap.min.js")}}></script>
<div class="iub-content" hidden="true">@yield('content')</div>
<script src={{asset("js/sugar/sugar.min.js")}}></script>
<script type="text/javascript"> 

 $(document).ready(function()
 {
     // MAKE SURE YOUR SELECTOR MATCHES SOMETHING IN YOUR HTML!!!
     $('a').each(function() {
         $(this).qtip({
            content: {
                text: function(event, api) {
                    $.ajax({
                        url: api.elements.target.attr('href') // Use href attribute as URL
                    })
                    .then(function(content) {
                        // Set the tooltip content upon successful retrieval
                        api.set('content.text', content);
                    }, function(xhr, status, error) {
                        // Upon failure... set the tooltip content to error
                        api.set('content.text', status + ': ' + error);
                    });
        
                    return 'Loading...'; // Set some initial text
                }
            },
            position: {
                viewport: $(window)
            },
            style: 'qtip-wiki'
         });
     });
 });  
</script>
