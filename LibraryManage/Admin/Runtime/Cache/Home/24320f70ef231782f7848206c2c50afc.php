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
        <?php if($borrowList): ?><table class="multi" border="1" cellpadding="0" cellspacing="0">
                <tr>
                    <th>编号</th>
                    <th>借书者</th>
                    <th>书名</th>
                    <th>数目</th>
                    <th>借书日期</th>
                    <th>还书日期</th>
                </tr>
                <?php if(is_array($borrowList)): foreach($borrowList as $key=>$borrow): ?><tr>
                        <td><?php echo ($borrow["id"]); ?></td>
                        <td><?php echo ($borrow["user"]); ?></td>
                        <td><?php echo ($borrow["bookname"]); ?></td>
                        <td><?php echo ($borrow["booknum"]); ?></td>
                        <td><?php echo ($borrow["borrowdate"]); ?></td>
                        <td><?php echo ($borrow["returndate"]); ?></td>
                        <!--<td><?php echo ($borrow["id"]); ?></td>-->
                    </tr><?php endforeach; endif; ?>
                <?php if($flag): ?><tr><td colspan="6"><?php echo ($show); ?></td></tr><?php endif; ?>
            </table>
            <?php else: ?>
            <div class="zero">尚未有借书记录</div><?php endif; ?>
        <div class="options">
            <a href="/think/LibraryManage/index.php/Home/Borrow/addBorrow">添加借书记录</a>
            <a href="/think/LibraryManage/index.php/Home/Borrow/returnWarn">还书提醒</a>
        </div>
    </div>

</div>



<script type="text/javascript" src="/think/LibraryManage/Public/scripts/index.js"></script>

</body>
</html>