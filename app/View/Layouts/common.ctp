<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="个人学习站点页面">
    <meta name="author" content="zhangh">
    <title>个人学习站点</title>

    <!-- Bootstrap Core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- Timeline CSS -->
    <link href="/css/plugins/timeline.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/css/sb-admin-2.css" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="/css/plugins/morris.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="/css/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- jQuery -->
    <script src="/js/jquery.js"></script>
</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <?php echo $this->element('navbar-top'); ?>
        <?php echo $this->element('navbar-side'); ?>
    <!-- /.navbar-static-side -->
    </nav>

    <!-- /#page-wrapper -->
    <div id="page-wrapper">
        <?php echo $this->fetch('content'); ?>
    </div>

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<!--<script src="/js/jquery.js"></script>-->
<!-- Bootstrap Core JavaScript -->
<script src="/js/bootstrap.min.js"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="/js/plugins/metisMenu/metisMenu.min.js"></script>
<!-- Custom Theme JavaScript -->
<script src="/js/sb-admin-2.js"></script>
<?php echo $this->element('sql_dump'); ?>
</body>
</html>