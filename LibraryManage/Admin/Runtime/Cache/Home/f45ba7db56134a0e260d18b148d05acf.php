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
    
    <div class="showList">
        <?php if($orderList): ?><table>
                <tr>
                    <th width="100px">编号</th>
                    <th width="100px">书名</th>
                    <th width="100px">借书日期</th>
                    <th width="100px">时长</th>
                    <th width="100px">数目</th>
                    <th width="100px">状态</th>
                </tr>
                <?php if(is_array($orderList)): foreach($orderList as $key=>$order): ?><tr>
                        <td><?php echo ($order["id"]); ?></td>
                        <td><?php echo ($order["bookname"]); ?></td>
                        <td><?php echo ($order["borrowdate"]); ?></td>
                        <td><?php echo ($order["maintaintime"]); ?>个月</td>
                        <td><?php echo ($order["booknum"]); ?></td>
                        <td><?php echo ($order["status"]); ?></td>
                    </tr><?php endforeach; endif; ?>
                <?php if($flag): ?><tr><td colspan="6"><?php echo ($show); ?></td></tr><?php endif; ?>
            </table>
        <?php else: ?>
            <div class="zero">未有相关的预约记录</div><?php endif; ?>
    </div>

    <div class="userAction">
        <a href="/think/LibraryManage/index.php/Home/Home/home">查看用户信息</a>
        <a href="/think/LibraryManage/index.php/Home/Home/checkBook">去查看书籍</a>
        <!--<a href="/think/LibraryManage/index.php/Home/Home/orderBook">去预约</a>-->
        <a href="/think/LibraryManage/index.php/Home/Home/checkBorrow">查看所借书籍</a>
        <a href="/think/LibraryManage/index.php/Home/Home/checkOrder">查看预约</a>
    </div>
    
    
</body>
</html>