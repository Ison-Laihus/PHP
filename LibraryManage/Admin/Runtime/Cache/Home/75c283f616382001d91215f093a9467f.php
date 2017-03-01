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
        <?php if($bookList): ?><table class="multi" border="1" cellspacing="0" cellpadding="0">
                <tr>
                    <th>编号</th>
                    <th width="100px">图片</th>
                    <th>书名</th>
                    <th>作者</th>
                    <th>出版社</th>
                    <th>出版日期</th>
                    <th>类别</th>
                    <th>总数</th>
                    <th>剩余</th>
                    <th>是否展示</th>
                    <th>操作</th>
                </tr>
                <?php if(is_array($bookList)): foreach($bookList as $key=>$book): ?><tr>
                        <td><?php echo ($book["id"]); ?></td>
                        <td width="100px;" height="100px;"><img width="100%" src="/think/LibraryManage/Public/images/<?php echo ($book["img"]); ?>" alt=""/></td>
                        <td><?php echo ($book["bookname"]); ?></td>
                        <td><?php echo ($book["author"]); ?></td>
                        <td><?php echo ($book["publisher"]); ?></td>
                        <td><?php echo ($book["publishtime"]); ?></td>
                        <td><?php echo ($book["category"]); ?></td>
                        <td><?php echo ($book["sum"]); ?></td>
                        <td><?php echo ($book["surplus"]); ?></td>
                        <td><?php if($book["isshow"] == '1'): ?>是<?php else: ?>否<?php endif; ?></td>
                        <td>
                            <a href="javascript:void(0);" onclick="alertBox(this);">修改</a>
                            <a href="javascript:void(0);" onclick="deleteBook(this);">删除</a>
                        </td>
                    </tr><?php endforeach; endif; ?>
                <?php if($flag): ?><tr><td colspan="11"><?php echo ($show); ?></td></tr><?php endif; ?>
            </table>
        <?php else: ?>
            <div class="zero">尚未有书籍</div><?php endif; ?>
        <div class="options">
            <a href="/think/LibraryManage/index.php/Home/Book/addBook">添加书籍</a>
        </div>
    </div>

</div>

    <div class="curtain"></div>
    <form class="alertBox" action="/think/LibraryManage/index.php/Home/Book/updateBook" method="post">
        <table>
            <tr>
                <td>书名</td>
                <td><input name="bookName" type="text" required/></td>
            </tr>
            <tr>
                <td>作者</td>
                <td><input name="author" type="text" required/></td>
            </tr>
            <tr>
                <td>出版社</td>
                <td><input name="publisher" type="text" required/></td>
            </tr>
            <tr>
                <td>出版时间</td>
                <td><input name="publishTime" type="date" required/></td>
            </tr>
            <tr>
                <td>类别</td>
                <td>
                    <select name="category">
                        <?php if(is_array($cates)): foreach($cates as $key=>$cate): ?><option value="<?php echo ($cate["category"]); ?>"><?php echo ($cate["category"]); ?></option><?php endforeach; endif; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>总数</td>
                <td><input name="sum" type="text" required/></td>
            </tr>
            <tr>
                <td>剩余数量</td>
                <td><input name="surplus" type="text" required/></td>
            </tr>
            <tr>
                <td>是否展示</td>
                <td>
                    <select name="isShow">
                        <option value="0">否</option>
                        <option value="1">是</option>
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
        });

        function alertBox(e){
            $(".curtain").show();
            $(".alertBox").show(1000);
            var tds = $(e).parent().parent().find("td");
            $("input[name='id']").val(tds.eq(0).html());
            $(".alertBox input[name='bookName']").val(tds.eq(2).html());
            $(".alertBox input[name='author']").val(tds.eq(3).html());
            $(".alertBox input[name='publisher']").val(tds.eq(4).html());
            $(".alertBox input[name='publishTime']").val(tds.eq(5).html());
            $(".alertBox input[name='category']").val(tds.eq(6).html());
            $(".alertBox input[name='sum']").val(tds.eq(7).html());
            $(".alertBox input[name='surplus']").val(tds.eq(8).html());
            var k = 0;
            if ( tds.eq(9).html()=='是' ) {
                k = 1;
            }
            console.log(k);
            $(".alertBox select[name='isShow']").val(k);
        }

        function deleteBook(e){
            var tds = $(e).parent().parent().find("td");
            var id = tds.eq(0).html();
            window.location.href = "/think/LibraryManage/index.php/Home/Book/deleteBook/id/"+id;
        }
    </script>

</body>
</html>