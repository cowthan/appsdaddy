<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="{{ URL::asset('/') }}/assets/towers/img/favicon.html">

    <title>铁塔发电统计平台</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ URL::asset('/') }}/assets/towers/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ URL::asset('/') }}/assets/towers/css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="{{ URL::asset('/') }}/assets/towers/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="{{ URL::asset('/') }}/assets/towers/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
    <link rel="stylesheet" href="{{ URL::asset('/') }}/assets/towers/css/owl.carousel.css" type="text/css">
    <!-- Custom styles for this template -->
    <link href="{{ URL::asset('/') }}/assets/towers/css/style.css" rel="stylesheet">
    <link href="{{ URL::asset('/') }}/assets/towers/css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="{{ URL::asset('/') }}/assets/towers/js/html5shiv.js"></script>
      <script src="{{ URL::asset('/') }}/assets/towers/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <section id="container" class="">
      <!--header start-->
      <header class="header white-bg">
            <div class="sidebar-toggle-box">
                <div data-original-title="Toggle Navigation" data-placement="right" class="icon-reorder tooltips"></div>
            </div>
            <!--logo start-->
            <a href="#" class="logo">AlphaGo<span>智能统计平台</span></a>
            <!--logo end-->
            
            <div class="top-nav ">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <li>
                        <input type="text" class="form-control search" placeholder="Search">
                    </li>
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="{{ URL::asset('/') }}/assets/towers/img/avatar1_small.jpg">
                            <span class="username">Jhon Doue</span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li><a href="#"><i class=" icon-suitcase"></i>Profile</a></li>
                            <li><a href="#"><i class="icon-cog"></i> Settings</a></li>
                            <li><a href="#"><i class="icon-bell-alt"></i> Notification</a></li>
                            <li><a href="login.html"><i class="icon-key"></i> Log Out</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!--search & user info end-->
            </div>
        </header>
      <!--header end-->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu">
                  <li class="active">
                      <a class="" href="index.html?sid={{$sid}}">
                          <i class="icon-dashboard"></i>
                          <span>综合管理</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a class="" href="task_mgmr.html?sid={{$sid}}">
                          <i class="icon-tasks"></i>
                          <span>任务管理</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a class="" href="user_mgmr.html?sid={{$sid}}">
                          <i class="icon-cogs"></i>
                          <span>用户管理</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a class="" href="admin_mgmr.html?sid={{$sid}}">
                          <i class="icon-book"></i>
                          <span>管理员管理</span>
                      </a>
                  </li>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <!--state overview start-->
              <div class="row state-overview">
                  <div class="col-lg-3 col-sm-6">
                      <section class="panel">
                          <div class="symbol terques">
                              <i class="icon-user"></i>
                          </div>
                          <div class="value">
                              <h1>{{$userCount}}</h1>
                              <p>用户数</p>
                          </div>
                      </section>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                      <section class="panel">
                          <div class="symbol red">
                              <i class="icon-tags"></i>
                          </div>
                          <div class="value">
                              <h1>{{$adminCount}}</h1>
                              <p>管理员数</p>
                          </div>
                      </section>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                      <section class="panel">
                          <div class="symbol yellow">
                              <i class="icon-shopping-cart"></i>
                          </div>
                          <div class="value">
                              <h1>{{$taskCount}}</h1>
                              <p>任务数</p>
                          </div>
                      </section>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                      <section class="panel">
                          <div class="symbol blue">
                              <i class="icon-bar-chart"></i>
                          </div>
                          <div class="value">
                              <h1>{{$todayTaskCount}}</h1>
                              <p>新增任务</p>
                          </div>
                      </section>
                  </div>
              </div>
              <!--state overview end-->


          </section>
      </section>
      <!--main content end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="{{ URL::asset('/') }}/assets/towers/js/jquery.js"></script>
    <script src="{{ URL::asset('/') }}/assets/towers/js/jquery-1.8.3.min.js"></script>
    <script src="{{ URL::asset('/') }}/assets/towers/js/bootstrap.min.js"></script>
    <script src="{{ URL::asset('/') }}/assets/towers/js/jquery.scrollTo.min.js"></script>
    <script src="{{ URL::asset('/') }}/assets/towers/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="{{ URL::asset('/') }}/assets/towers/js/jquery.sparkline.js" type="text/javascript"></script>
    <script src="{{ URL::asset('/') }}/assets/towers/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
    <script src="{{ URL::asset('/') }}/assets/towers/js/owl.carousel.js" ></script>
    <script src="{{ URL::asset('/') }}/assets/towers/js/jquery.customSelect.min.js" ></script>

    <!--common script for all pages-->
    <script src="{{ URL::asset('/') }}/assets/towers/js/common-scripts.js"></script>

    <!--script for this page-->
    <script src="{{ URL::asset('/') }}/assets/towers/js/sparkline-chart.js"></script>
    <script src="{{ URL::asset('/') }}/assets/towers/js/easy-pie-chart.js"></script>

  <script>

      //owl carousel

      $(document).ready(function() {
          $("#owl-demo").owlCarousel({
              navigation : true,
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : true

          });
      });

      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>

  </body>
</html>
