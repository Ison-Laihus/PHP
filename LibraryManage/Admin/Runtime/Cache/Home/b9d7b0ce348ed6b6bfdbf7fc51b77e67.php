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
        <?php if($userList): ?><table class="multi" border="1" cellpadding="0" cellspacing="0">
                <tr>
                    <th>编号</th>
                    <th>用户名</th>
                    <th>信用度</th>
                    <th>是否借书</th>
                    <th>借书数目</th>
                    <th>操作</th>
                </tr>
                <?php if(is_array($userList)): foreach($userList as $key=>$user): ?><tr>
                        <td><?php echo ($user["id"]); ?></td>
                        <td><?php echo ($user["name"]); ?></td>
                        <td><?php echo ($user["credit"]); ?></td>
                        <td><?php if($user["isborrow"] == '1'): ?>是<?php else: ?>否<?php endif; ?></td>
                        <td><?php echo ($user["booknum"]); ?></td>
                        <td>
                            <a href="javascript:void(0)" onclick="alertBox(this);">edit</a>
                            <a href="javascript:void(0)" onclick="deleteUser(this);">delete</a>
                        </td>
                    </tr><?php endforeach; endif; ?>
                <?php if($flag): ?><tr><td colspan="6"><?php echo ($show); ?></td></tr><?php endif; ?>
            </table>
        <?php else: ?>
            <div class="zero">尚未有用户</div><?php endif; ?>
        <div class="options">
            <a href="/think/LibraryManage/index.php/Home/User/addUser">添加用户</a>
        </div>
    </div>

</div>

    <div class="curtain"></div>
    <form class="alertBox" action="/think/LibraryManage/index.php/Home/User/updateUser" method="post">
        <table>
            <tr>
                <td>用户名</td>
                <td><input name="name" type="text" required/></td>
            </tr>
            <tr>
                <td>密码</td>
                <td><input name="pwd" type="password" required/></td>
            </tr>
            <tr>
                <td>密码确认</td>
                <td><input name="confirm" type="password" required/></td>
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
        });

        function alertBox(e){
            $(".curtain").show();
            $(".alertBox").show(1000);
            var tds = $(e).parent().parent().find("td");
            var id = tds.eq(0).html();
            $("input[name='id']").val(id);
            $(".alertBox input[name='name']").val(tds.eq(1).html());
        }

        function deleteUser(e){
            var tds = $(e).parent().parent().find("td");
            var id = tds.eq(0).html();
            var sure = confirm("您确定要删除该用户么？");
            if ( sure ) {
                window.location.href = "/think/LibraryManage/index.php/Home/User/deleteUser/id/"+id;
            }
        }
    </script>

</body>
</html>