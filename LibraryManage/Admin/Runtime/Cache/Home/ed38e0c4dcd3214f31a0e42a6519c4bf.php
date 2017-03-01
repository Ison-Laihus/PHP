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
        <?php if($blackList): ?><table class="multi" border="1" cellpadding="0" cellspacing="0">
                <tr>
                    <th>编号</th>
                    <th>用户名</th>
                    <th>信用度</th>
                    <th>操作</th>
                </tr>
                <?php if(is_array($blackList)): foreach($blackList as $key=>$user): ?><tr>
                        <td><?php echo ($user["id"]); ?></td>
                        <td><?php echo ($user["name"]); ?></td>
                        <td><?php echo ($user["credit"]); ?></td>
                        <td>
                            <a href="javascript:void(0);" onclick="getDetail(this)">detail</a>
                        </td>
                    </tr><?php endforeach; endif; ?>
                <?php if($flag): ?><tr><td colspan="4"><?php echo ($show); ?></td></tr><?php endif; ?>
            </table>
        <?php else: ?>
            <div class="zero">尚未有失信用户</div><?php endif; ?>
    </div>

</div>

    <div class="curtain"></div>
    <div class="alertBox">
        <div class="text"></div>
        <input id="cancel2" type="button" value="隐藏"/>
    </div>



<script type="text/javascript" src="/think/LibraryManage/Public/scripts/index.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#cancel2").click(function(){
                $(".curtain").hide(1000);
                $(".alertBox").hide();
            });
        });

        function getDetail(e){
            $(".curtain").show();
            $(".alertBox").show(1000);
            var tds = $(e).parent().parent().find("td");
            var id = tds.eq(0).html();
            $.post(
                "/think/LibraryManage/index.php/Home/User/blackHistory",
                {"id":id},
                function(data){
                    console.log(data);
                    $(".text").html(data);
                }
            );
        }
    </script>

</body>
</html>