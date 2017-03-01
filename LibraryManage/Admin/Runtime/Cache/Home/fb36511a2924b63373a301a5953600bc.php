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
            <li class="item"><a class="itemTitle" href="/think/LibraryManage/index.php/Home/User/blackList">黑名单</a></li>
        </ul>
    
    
    <form class="ContentBlock fr" action="/think/LibraryManage/index.php/Home/Index/handleAddAdmin" method="post">
        <table class="twoCols">
            <tr>
                <td>用户名：</td>
                <td><input class="adminName" name="name" type="text" required/></td>
            </tr>
            <tr>
                <td>密码：</td>
                <td><input class="adminPwd" name="pwd" type="password" required/></td>
            </tr>
            <tr>
                <td>确认：</td>
                <td><input class="adminPwdSure" name="sure" type="password" required/><span id="cue"></span></td>
            </tr>
            <tr>
                <td>权限：</td>
                <td>
                    <select name="authority" class="adminOption">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="添加"/></td>
            </tr>
        </table>
        <div class="options">
            <?php if($_SESSION['authority']== 1): ?><a href="/think/LibraryManage/index.php/Home/Index/index">查看自身信息</a>
                <a href="/think/LibraryManage/index.php/Home/Index/delAdmin">删除管理员</a>
            <?php elseif($_SESSION['authority']== 2): ?>
                <a href="/think/LibraryManage/index.php/Home/Index/index">查看自身信息</a><?php endif; ?>
        </div>
    </form>

</div>



<script type="text/javascript" src="/think/LibraryManage/Public/scripts/index.js"></script>

    <script type="text/javascript">
        // 添加管理员时进行密码的确认
        $(document).ready(function(){
            $(".adminPwdSure").blur(function(){
                $("#cue").html("");
                if ($(".adminPwdSure").val()!=$(".adminPwd").val() ) {
                    $("#cue").html("密码确认错误");
                    $("#cue").css("color", "#f00");
                }
            });
        });
    </script>

</body>
</html>