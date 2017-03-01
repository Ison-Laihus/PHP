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
        <table>
            <tr>
                <th width="100px">编号</th>
                <th width="100px">书名</th>
                <th width="100px">借书日期</th>
                <th width="100px">还书日期</th>
                <th width="100px">数目</th>
                <th width="100px">状态</th>
                <th width="100px">操作</th>
            </tr>
            <?php if(is_array($borrowList)): foreach($borrowList as $key=>$borrow): ?><tr>
                    <td><?php echo ($borrow["id"]); ?></td>
                    <td><?php echo ($borrow["bookname"]); ?></td>
                    <td><?php echo ($borrow["borrowdate"]); ?></td>
                    <td><?php echo ($borrow["returndate"]); ?></td>
                    <td><?php echo ($borrow["booknum"]); ?></td>
                    <td><?php echo ($borrow["status"]); ?></td>
                    <td><a href="javascript:void(0);" onclick="contactOrder(this)">续约</a></td>
                </tr><?php endforeach; endif; ?>
            <?php if($flag): ?><tr><td colspan="7"><?php echo ($show); ?></td></tr><?php endif; ?>
        </table>
    </div>

    <div class="userAction">
        <a href="/think/LibraryManage/index.php/Home/Home/home">查看用户信息</a>
        <a href="/think/LibraryManage/index.php/Home/Home/checkBook">去查看书籍</a>
        <!--<a href="/think/LibraryManage/index.php/Home/Home/orderBook">去预约</a>-->
        <a href="/think/LibraryManage/index.php/Home/Home/checkBorrow">查看所借书籍</a>
        <a href="/think/LibraryManage/index.php/Home/Home/checkOrder">查看预约</a>
    </div>
    
    
    <script type="text/javascript">
        function contactOrder(e) {
            var sib = $(e).parent().siblings();
            var time = parseInt(sib.eq(3).html().split("-")[1])-parseInt(sib.eq(2).html().split("-")[1]);
            if ( time==0 ) {
                alert("您的借期已达到最长时限，不能续约，敬请原谅!");
            } else {
                $.post(
                    "/think/LibraryManage/index.php/Home/Home/contactOrder",
                    {
                        "id":sib.eq(0).html(),
                        "date":sib.eq(3).html()
                    },
                    function(data) {
                        console.log(data);
                        if ( data=="1" ) {
                            alert("已经帮您续借一个月！");
                        } else {
                            alert("续借失败！");
                        }
                        window.location.href = "/think/LibraryManage/index.php/Home/Home/checkBorrow";
                    }
                );
            }
        }
    </script>

</body>
</html>