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
        <?php if($searchList): ?><table>
                <tr>
                    <th width="100px">书籍图片</th>
                    <th width="100px">书名</th>
                    <th width="100px">作者</th>
                    <th width="100px">库存</th>
                    <th width="100px">操作</th>
                </tr>
                <?php if(is_array($searchList)): foreach($searchList as $key=>$s): ?><tr>
                        <td width="100px" height="100px"><img width="100%" src="/think/LibraryManage/Public/images/<?php echo ($s["img"]); ?>" alt="book picture"></td>
                        <td><?php echo ($s["bookname"]); ?></td>
                        <td><?php echo ($s["author"]); ?></td>
                        <td><?php echo ($s["surplus"]); ?></td>
                        <td><a href="/think/LibraryManage/index.php/Home/Home/orderBook/bookId/<?php echo ($s["id"]); ?>">预约</a></td>
                    </tr><?php endforeach; endif; ?>
                <?php if($flag): ?><tr><td colspan="5"><?php echo ($show); ?></td></tr><?php endif; ?>
            </table>
        <?php else: ?>
            <div class="zero">未搜索到相关书籍</div><?php endif; ?>
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