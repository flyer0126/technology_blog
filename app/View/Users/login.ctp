<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="个人学习站点登陆页面">
    <meta name="author" content="zhangh">
    <title>后台管理系统登录页面</title>
    <!-- Bootstrap Core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="/css/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><center><small><?php echo $this->Session->flash(); ?></small></center></h3>
                </div>
                <div class="panel-body">
                    <form role="form" name="loginForm" action="/users/login" method="post">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="用户名" name="data[User][username]" type="text" autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="密码" name="data[User][password]" type="password">
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input name="remember" type="checkbox" value="Remember Me">记住我
                                </label>
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            <a href="javascript:;" onclick="document.loginForm.submit();" class="btn btn-lg btn-success btn-block">登 入</a>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="/js/jquery.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="/js/bootstrap.min.js"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="/js/plugins/metisMenu/metisMenu.min.js"></script>
<!-- Custom Theme JavaScript -->
<script src="/js/sb-admin-2.js"></script>
</body>
</html>