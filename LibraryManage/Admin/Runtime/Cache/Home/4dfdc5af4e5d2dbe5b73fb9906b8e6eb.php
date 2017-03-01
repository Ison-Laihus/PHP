<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="/think/LibraryManage/Public/styles/reset.css"/>
    <link rel="stylesheet" type="text/css" href="/think/LibraryManage/Public/styles/home.css"/>
    <script type="text/javascript" src="/think/LibraryManage/Public/scripts/jquery.js"></script>
</head>
<body>
    <div class="homeHeader">welcome to library<a href="/think/LibraryManage/index.php/Home/Login/logout">退出</a></div>
    
	<div class="tip"><?php echo ($msg); ?></div>

    <div class="userAction">
        <a href="/think/LibraryManage/index.php/Home/Home/home">查看用户信息</a>
        <a href="/think/LibraryManage/index.php/Home/Home/checkBook">去查看书籍</a>
        <!--<a href="/think/LibraryManage/index.php/Home/Home/orderBook">去预约</a>-->
        <a href="/think/LibraryManage/index.php/Home/Home/checkBorrow">查看所借书籍</a>
        <a href="/think/LibraryManage/index.php/Home/Home/checkOrder">查看预约</a>
    </div>
    
    
</body>
</html>