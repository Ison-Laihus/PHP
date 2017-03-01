<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>图书管理系统</title>
    <link rel="stylesheet" type="text/css" href="/think/LibraryManage/Public/styles/reset.css"/>
    <link rel="stylesheet" type="text/css" href="/think/LibraryManage/Public/styles/index.css"/>
    
    <link rel="stylesheet" type="text/css" href="/think/LibraryManage/Public/styles/table.css"/>
    <link rel="stylesheet" type="text/css" href="/think/LibraryManage/Public/styles/extra.css"/>

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
        <table class="multi" border="1" cellpadding="0" cellspacing="0">
            <tr>
                <th width="10%">ID</th>
                <th width="10%">管理员名称</th>
                <th width="10%">管理员权限</th>
                <?php if($_SESSION['authority']== 1): ?><th width="10%">操作</th><?php endif; ?>
            </tr>
            <?php if(is_array($allAdmins)): foreach($allAdmins as $key=>$vo): ?><tr display="text-align: center;">
                    <td><?php echo ($vo["id"]); ?></td>
                    <td><?php echo ($vo["name"]); ?></td>
                    <td><?php echo ($vo["authority"]); ?></td>
                    <?php if($_SESSION['authority']== 1): ?><td>
                            <a href="javascript:void(0)" onclick="alertBox(this);">edit</a>
                            <a href="javascript:void(0)" onclick="deleteAdmin(this);">delete</a>
                        </td><?php endif; ?>
                </tr><?php endforeach; endif; ?>
            <?php if($flag): ?><tr><td colspan="4"><?php echo ($show); ?></td></tr><?php endif; ?>
        </table>
        <div class="options">
            <?php if($_SESSION['authority']== 1): ?><a href="/think/LibraryManage/index.php/Home/Index/addAdmin">添加管理员</a>
                <a href="/think/LibraryManage/index.php/Home/Index/index">查看自身信息</a>
            <?php elseif($_SESSION['authority']== 2): ?>
                <a href="/think/LibraryManage/index.php/Home/Index/index">查看自身信息</a><?php endif; ?>
        </div>
    </div>

</div>

    <div class="curtain"></div>
    <form class="alertBox" action="/think/LibraryManage/index.php/Home/Index/updateAdmin" method="post">
        <table>
            <tr>
                <td>用户名</td>
                <td><input name="name" type="text" required/></td>
            </tr>
            <tr>
                <td>权限</td>
                <td>
                    <select name="authority">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </td>
            </tr>
        </table>
        <input type="hidden" name="id"/>
        <input id="submit" type="submit" value="提交"/>
        <input id="cancel" type="button" value="取消"/>
    </form>



<script type="text/javascript" src="/think/LibraryManage/Public/scripts/index.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#cancel").click(function(){
                $(".curtain").hide(1000);
                $(".alertBox").hide();
            });
            $("#submit").click(function(){
                $(".alertBox").submit(function(e){
                    if ( $(".alertBox input[name='pwd']").val() != $(".alertBox input[name='confirm']").val() ) {
                        e.preventDefault();
                        alert("密码确认错误!");
                    }
                });
            });
        });

        function alertBox(e){
            $(".curtain").show();
            $(".alertBox").show(1000);
            var tds = $(e).parent().parent().find("td");
            var id = tds.eq(0).html();
            $("input[name='id']").val(id);
            $(".alertBox input[name='name']").val(tds.eq(1).html());
            $(".alertBox input[name='authority']").val(tds.eq(2).html());
        }

        function deleteAdmin(e){
            var tds = $(e).parent().parent().find("td");
            var id = tds.eq(0).html();
            window.location.href = "/think/LibraryManage/index.php/Home/Index/deleteAdmin/id/"+id;
        }
    </script>

</body>
</html>