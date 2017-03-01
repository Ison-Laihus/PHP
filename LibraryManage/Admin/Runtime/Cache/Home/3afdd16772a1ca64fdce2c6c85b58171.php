<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>图书管理系统</title>
    <link rel="stylesheet" type="text/css" href="/think/LibraryManage/Public/styles/reset.css"/>
    <link rel="stylesheet" type="text/css" href="/think/LibraryManage/Public/styles/index.css"/>
    
    <link rel="stylesheet" type="text/css" href="/think/LibraryManage/Public/styles/table.css"/>

    <script type="text/javascript" src="/think/LibraryManage/Public/scripts/jquery.js"></script>
</head>
<body>

    <div class="HeaderBlock">
        <div class="title">图书管理系统<a class="logout" href="/think/LibraryManage/index.php/Home/Login/logout">退出</a></div>
    </div>

<div class="middle">
    
        <ul class="MenuBlock block fl">
            <li class="item"><a class="itemTitle" href="/think/LibraryManage/index.php/Home/Index/index">管理员信息</a></li>
            <li class="item"><a class="itemTitle" href="/think/LibraryManage/index.php/Home/User/userList">会员信息</a></li>
            <li class="item"><a class="itemTitle" href="/think/LibraryManage/index.php/Home/Book/bookList">书籍信息</a></li>
            <li class="item"><a class="itemTitle" href="/think/LibraryManage/index.php/Home/Borrow/borrowList">借还管理</a></li>
            <li class="item"><a class="itemTitle" href="/think/LibraryManage/index.php/Home/Order/orderList">预约管理</a></li>
            <!--<li class="item"><a class="itemTitle" href="/think/LibraryManage/index.php/Home/User/blackList">黑名单</a></li>-->
        </ul>
    
    
    <form class="ContentBlock fr" action="/think/LibraryManage/index.php/Home/User/handleAddUser" method="post">
        <table class="twoCols">
            <tr>
                <td>用户名：</td>
                <td><input class="userName" name="name" type="text" required/></td>
            </tr>
            <tr>
                <td>密码：</td>
                <td><input class="userPwd" name="pwd" type="password" required/></td>
            </tr>
            <tr>
                <td>确认：</td>
                <td><input class="userPwdSure" name="sure" type="password" required/><span id="cue"></span></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="添加"/></td>
            </tr>
        </table>
        <div class="options">
            <a href="/think/LibraryManage/index.php/Home/User/userList">用户列表</a>
        </div>
    </form>

</div>



<script type="text/javascript" src="/think/LibraryManage/Public/scripts/index.js"></script>

</body>
</html>