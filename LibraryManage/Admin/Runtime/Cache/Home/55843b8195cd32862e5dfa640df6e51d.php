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
    
    
    <div class="ContentBlock fr">
        <table class="twoCols">
            <?php if(is_array($adminMsg)): foreach($adminMsg as $key=>$vo): ?><tr>
                    <td><?php echo ($key); ?></td>
                    <td><?php echo ($vo); ?></td>
                </tr><?php endforeach; endif; ?>
        </table>
        <div class="options">
            <?php if($_SESSION['authority']== 1): ?><a href="/think/LibraryManage/index.php/Home/Index/addAdmin">添加管理员</a>
                <a href="/think/LibraryManage/index.php/Home/Index/delAdmin">删除管理员</a>
            <?php elseif($_SESSION['authority']== 2): ?>
                <a href="/think/LibraryManage/index.php/Home/Index/delAdmin">查看所有管理员</a><?php endif; ?>
        </div>
    </div>

</div>



<script type="text/javascript" src="/think/LibraryManage/Public/scripts/index.js"></script>

</body>
</html>