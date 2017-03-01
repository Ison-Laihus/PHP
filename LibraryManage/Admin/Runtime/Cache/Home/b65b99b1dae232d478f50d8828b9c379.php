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
    
    <form class="addOrder" action="/think/LibraryManage/index.php/Home/Home/addOrder" method="post">
        <img src="/think/LibraryManage/Public/images/<?php echo ($orderBook["img"]); ?>" alt="the picture of order book"/>
        <div class="bookMsg">
            <span>书名：<?php echo ($orderBook["bookname"]); ?></span>
            <span>作者：<?php echo ($orderBook["author"]); ?></span>
            <span>出版社：<?php echo ($orderBook["publisher"]); ?></span>
            <span>库存：<?php echo ($orderBook["surplus"]); ?></span>
        </div>
        <div class="orderCondition">
            <input type="hidden" name="bookName" value="<?php echo ($orderBook["bookname"]); ?>"/>
            <label for="borrowDate">借书日期</label>
            <input type="date" name="borrowDate" required/>
            <label for="maintainTime">借书时长</label>
            <select name="maintainTime">
                <option value="1">一个月</option>
                <option value="2">两个月</option>
                <option value="3">三个月</option>
                <option value="4">四个月</option>
                <option value="5">五个月</option>
                <option value="6">半年</option>
                <option value="7">七个月</option>
                <option value="8">八个月</option>
                <option value="9">九个月</option>
                <option value="10">十个月</option>
                <option value="11">十一个月</option>
                <option value="12">一年</option>
            </select>
            <label for="bookNum">数目</label>
            <input type="text" name="bookNum" required/>
            <input class="add" type="submit" value="预约"/>
        </div>
    </form>

    <div class="userAction">
        <a href="/think/LibraryManage/index.php/Home/Home/home">查看用户信息</a>
        <a href="/think/LibraryManage/index.php/Home/Home/checkBook">去查看书籍</a>
        <!--<a href="/think/LibraryManage/index.php/Home/Home/orderBook">去预约</a>-->
        <a href="/think/LibraryManage/index.php/Home/Home/checkBorrow">查看所借书籍</a>
        <a href="/think/LibraryManage/index.php/Home/Home/checkOrder">查看预约</a>
    </div>
    
    
</body>
</html>