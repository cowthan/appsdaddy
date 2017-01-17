<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="{{ URL::asset('/') }}/assets/towersimg/favicon.html">

    <title>登录</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ URL::asset('/') }}/assets/towers/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ URL::asset('/') }}/assets/towers/css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="{{ URL::asset('/') }}/assets/towers/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{ URL::asset('/') }}/assets/towers/css/style.css" rel="stylesheet">
    <link href="{{ URL::asset('/') }}/assets/towers/css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="{{ URL::asset('/') }}/assets/towers/js/html5shiv.js"></script>
    <script src="{{ URL::asset('/') }}/assets/towers/js/respond.min.js"></script>
    <![endif]-->
</head>

  <body class="login-body">

    <div class="container">

      <form class="form-signin" action="index.html">
        <h2 class="form-signin-heading">AlphaGo智能统计平台--管理员登录</h2>
        <div class="login-wrap">
            <input type="text" id="in_username" name="username" class="form-control" placeholder="用户名" autofocus value="jack-daddy" />
            <input type="password" id="in_password" name="password" class="form-control" placeholder="密码"value="99990529138" />
            <input id="btnSignIn" class="btn btn-lg btn-login btn-block" type="button" value="登录"/>

        </div>

      </form>

    </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="{{ URL::asset('/') }}/assets/towers/js/jquery.js"></script>
    <script src="{{ URL::asset('/') }}/assets/towers/js/bootstrap.min.js"></script>
    <script src="{{ URL::asset('/') }}/assets/towers/js/jquery.scrollTo.min.js"></script>
    <script src="{{ URL::asset('/') }}/assets/towers/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script type="text/javascript" src="{{ URL::asset('/') }}/assets/towers/assets/data-tables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="{{ URL::asset('/') }}/assets/towers/assets/data-tables/DT_bootstrap.js"></script>

    <script src="{{ URL::asset('/') }}/assets/towers/layer/layer.js"></script>
    <script src="{{ URL::asset('/') }}/assets/towers/layer/extend/layer.ext.js"></script>

    <script>

        var signin_username = null;
        var signin_password = null;

        $(document).ready(function(){

            signin_username = $("#in_username");
            signin_password = $("#in_password");

            $("#btnSignIn").click(function(){
				
                $.get('loginAdmin', {
                    "username": signin_username.val(),
                    "password" : signin_password.val()
                }, function(data, status) {
                    var res = data; //JSON.parse(data);
					alert("dd");
                    if(status === "success"){
                        if(res.code == '0'){
                            layer.msg("成功了！");
                            // layer.msg(allPrpos(res.result));
                            window.location.href="index.html?sid=" + res.result.sid;
                        }else{
                            layer.msg("登录失败：" + res.msg);
                            //fillPhotos(res.result);
                        }
                    }else{
                        layer.alert("失败--" + res.msg);
                    }
                });

                return false;
            });

        });

    </script>

  </body>
</html>
