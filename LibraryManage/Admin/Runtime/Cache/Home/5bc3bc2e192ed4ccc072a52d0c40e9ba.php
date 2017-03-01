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
    
    <form class="searchBox" action="/think/LibraryManage/index.php/Home/Home/searchBook" method="post">
        <a class="onSearch" href="javascript:void(0);" value="0" onclick="changeMtd(this);">书名</a>
        <a href="javascript:void(0);" value="1" onclick="changeMtd(this);">作者</a><br/>
        <input type="hidden" name="mode" value="0"/>
        <input class="searchText" type="text" name="searchText" required/>
        <input class="searchBtn" type="submit" value="搜索"/>
    </form>
    <div class="showList">
        <?php if($showList): ?><table>
                <tr>
                    <th width="100px">书籍图片</th>
                    <th width="100px">书名</th>
                    <th width="100px">作者</th>
                    <th width="100px">库存</th>
                    <th width="100px">操作</th>
                </tr>
                <?php if(is_array($showList)): foreach($showList as $key=>$s): ?><tr>
                        <td width="100px" height="100px"><img width="100%" src="/think/LibraryManage/Public/images/<?php echo ($s["img"]); ?>" alt="book picture"></td>
                        <td><?php echo ($s["bookname"]); ?></td>
                        <td><?php echo ($s["author"]); ?></td>
                        <td><?php echo ($s["surplus"]); ?></td>
                        <td><a href="/think/LibraryManage/index.php/Home/Home/orderBook/bookId/<?php echo ($s["id"]); ?>">预约</a></td>
                    </tr><?php endforeach; endif; ?>
                <?php if($flag): ?><tr><td colspan="5"><?php echo ($show); ?></td></tr><?php endif; ?>
            </table>
        <?php else: ?>
            <div class="zero">未有展示的书籍</div><?php endif; ?>
    </div>

    <div class="userAction">
        <a href="/think/LibraryManage/index.php/Home/Home/home">查看用户信息</a>
        <a href="/think/LibraryManage/index.php/Home/Home/checkBook">去查看书籍</a>
        <!--<a href="/think/LibraryManage/index.php/Home/Home/orderBook">去预约</a>-->
        <a href="/think/LibraryManage/index.php/Home/Home/checkBorrow">查看所借书籍</a>
        <a href="/think/LibraryManage/index.php/Home/Home/checkOrder">查看预约</a>
    </div>
    
    
    <script type="text/javascript">
        function changeMtd(e) {
            $(e).siblings().removeClass("onSearch");
            $(e).addClass("onSearch");
            if ( $(e).html()=="作者" ) {
                $("input[type='hidden']").attr("value", '1');
            } else {
                $("input[type='hidden']").attr("value", '0');
            }
        }
    </script>

</body>
</html>