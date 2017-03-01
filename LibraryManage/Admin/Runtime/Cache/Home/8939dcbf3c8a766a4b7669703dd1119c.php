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
    
    
    <form class="ContentBlock fr" action="/think/LibraryManage/index.php/Home/Book/handleAddBook" enctype="multipart/form-data" method="post">
        <table class="twoCols">
            <tr>
                <td>书名：</td>
                <td><input name="bookName" type="text" required/></td>
            </tr>
            <tr>
                <td>作者：</td>
                <td><input name="author" type="text" required/></td>
            </tr>
            <tr>
                <td>出版社：</td>
                <td><input name="publisher" type="text" required/></td>
            </tr>
            <tr>
                <td>类别：</td>
                <td>
                    <select id="selection" name="category" required>
                        <option value="0">请选择</option>
                        <?php if(is_array($cateList)): foreach($cateList as $key=>$cate): ?><option value="<?php echo ($cate["category"]); ?>"><?php echo ($cate["category"]); ?></option><?php endforeach; endif; ?>
                    </select>
                    <span id="cue"></span>
                </td>
            </tr>
            <tr>
                <td>总数：</td>
                <td><input name="sum" type="text" required/><span id="cue1"></span></td>
            </tr>
            <tr>
                <td>余数：</td>
                <td><input name="surplus" type="text" required/><span id="cue2"></span></td>
            </tr>
            <tr>
                <td>是否展示：</td>
                <td>
                    <select name="isShow">
                        <option value="0">否</option>
                        <option value="1">是</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>图片：</td>
                <td><input name="img" type="file" required/></td>
            </tr>
            <tr>
                <td colspan="2" display="text-align: center;"><input id="submit" type="submit" value="添加"/></td>
            </tr>
        </table>
        <div class="options">
            <a href="/think/LibraryManage/index.php/Home/Book/bookList">书籍列表</a>
        </div>
    </form>

</div>



<script type="text/javascript" src="/think/LibraryManage/Public/scripts/index.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#submit").click(function(){
                if ( $("#selection option:selected").val()=='0' ) {
                    $("form").submit(function(e){
                        e.preventDefault();
                    });
                    $("#cue").html("请选择！");
                    $("#cue").css("color", "#f00");
                } else {
                    $("#cue").html("");
                }
                var re = new RegExp("^[1-9]+[0-9]*$");
                if ( $("input[name='sum']").val() && !re.test($("input[name='sum']").val()) ){
                    $("form").submit(function(e){
                        e.preventDefault();
                    });
                    $("#cue1").html("请填写数字！");
                    $("#cue1").css("color", "#f00");
                } else {
                    $("#cue1").html("");
                }
                if ( $("input[name='surplus']").val() && !re.test($("input[name='surplus']").val()) ){
                    $("form").submit(function(e){
                        e.preventDefault();
                    });
                    $("#cue2").html("请填写数字！");
                    $("#cue2").css("color", "#f00");
                } else {
                    $("#cue2").html("");
                }
            });
        });
    </script>

</body>
</html>