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
    
    
    <form class="ContentBlock fr" action="/think/LibraryManage/index.php/Home/Borrow/handleAddBorrow" method="post">
        <table class="twoCols">
            <tr>
                <td>借书者：</td>
                <td><input name="user" type="text" required/></td>
            </tr>
            <tr>
                <td>书名：</td>
                <td><input name="bookName" type="text" required/></td>
            </tr>
            <tr>
                <td>数目：</td>
                <td><input name="bookNum" type="text" required/><span id="cue"></span></td>
            </tr>
            <tr>
                <td>借书日期：</td>
                <td><input name="borrowDate" type="date" required/></td>
            </tr>
            <tr>
                <td>还书日期：</td>
                <td><input name="returnDate" type="date" required/></td>
            </tr>
            <tr>
                <td colspan="2" display="text-align: center;"><input id="submit" type="submit" value="添加"/></td>
            </tr>
        </table>
        <div class="options">
            <a href="/think/LibraryManage/index.php/Home/Borrow/borrowList">借书记录</a>
            <a href="/think/LibraryManage/index.php/Home/Borrow/returnWarn">还书提醒</a>
        </div>
    </form>

</div>



<script type="text/javascript" src="/think/LibraryManage/Public/scripts/index.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            var re = new RegExp("^[1-9]+[0-9]*$");
            console.log("regex:"+re.test("1234"));
            $(".ContentBlock").submit(function(e){
                var re = new RegExp("^[1-9]+[0-9]*$");
                console.log($("input[name='bookNum']").val());
                console.log("regex:"+re.test($("input[name='bookNum']").val()));
                if ( $("input[name='bookNum']").val() && !re.test($("input[name='bookNum']").val()) ){
                    e.preventDefault();
                    $("#cue").html("请填写数字！");
                    $("#cue").css("color", "#f00");
                } else {
                    $("#cue").html("");
                }
            });
        });
    </script>

</body>
</html>