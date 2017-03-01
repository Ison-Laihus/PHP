<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>英语单词测试</title>
    <link rel="stylesheet" type="text/css" href="/think/Public/vt/test.css"/>
</head>
<body>
<!-- 页面头部 -->
<div class="head">
    <div class="menu">菜单
        <ul class="menulist">
            <a href="/think/vt.php/Home/Index/test?a=1">添加单词</a>
            <a href="/think/vt.php/Home/Index/test?a=2">测试生词</a>
            <a href="/think/vt.php/Home/Index/test?a=3">测试错题</a>
            <a href="/think/vt.php/Home/Index/test?a=4">生词本</a>
            <a href="/think/vt.php/Home/Index/test?a=5">错题集</a>
            <a href="/think/vt.php/Home/Index/test?a=6">我的测试成绩</a>
        </ul>
    </div>
    Welcome To lyk Lab
    <a href="/think/vt.php/Home/Index/test?a=<?php echo ($change>3 ? 2 : $change); ?>" class="change"><?php echo ($word); ?></a>
</div>

<!-- 表单--开始 -->
<form class="testarea" action="/think/vt.php/Home/Index/test?med=<?php echo ($med); ?>&a=<?php echo ($a); ?>" method="post">
    <h3>
        <?php if(($med == 'test') AND ($a == 2)): ?>生词测试
        <?php elseif(($med == 'test') AND ($a == 3)): ?>错题测试
        <?php elseif($med == 'add'): ?>添加单词
        <?php elseif($change == 4): ?>生词列表
        <?php elseif($change == 5): ?>错词列表
        <?php elseif($change == 6): ?>测试成绩<?php endif; ?>
    </h3>
    <?php if($change == 1): if(empty($$untest)): ?><div class="redirect">
                您的<?php if($a == 2): ?>生词本<?php elseif($a == 3): ?>错题本<?php endif; ?>中已经没有单词了，您有以下选择
                <a class="operations" href="/think/vt.php/Home/Index/test?a=1">添加单词</a>
               <?php if($a == 2): ?><a class="operations" href="/think/vt.php/Home/Index/test?a=3">测试错题</a>
               <?php elseif($a == 3): ?>
                   <a class="operations" href="/think/vt.php/Home/Index/test?a=2">测试生题</a><?php endif; ?>
               <a class="operations" href="/think/vt.php/Home/Index/test?a=6">查看成绩列表</a>
            </div>
        <?php else: ?>
            <?php if(is_array($$untest)): foreach($$untest as $i=>$v): $group = explode('-', $v); ?>
                <div class="box">
                    <div class="zh"><?php echo ($group[1]); ?></div>
                    <input type="text" name="en<?php echo ($i); ?>" class="en" <?php if(empty($judge)): ?>placeholder="请填入对应的英文"<?php else: ?>value="<?php echo ($answer[$i]); ?>"<?php endif; ?> />
                    <div class="tips" style="display: <?php echo ($dis); ?>; background-color: <?php if(empty($$judge[$i])): ?>#f00<?php else: ?>#0f0<?php endif; ?>;">
                        <?php if(empty($$judge[$i])): ?>抱歉，您回答错误，还要加油哦！----- 正确的英文单词：<?php echo ($group[0]); ?>
                        <?php else: ?>
                            恭喜您回答正确<?php endif; ?>
                    </div>
                </div><?php endforeach; endif; ?>
            <input class="submit" type="submit" value="<?php if(empty($$judge)): ?>下一测<?php else: ?>提交<?php endif; ?>"/><?php endif; ?>
    <?php elseif($change == 2): ?>
        <div class="selector" style="display: <?php echo ($a_dis); ?>">
            <label for="#addnum">填写单词的数量：</label>
            <select id="addnum" name="addnum">
                <option selected="selected">1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
            <input type="button" id="get" value="确认"/>
        </div>
        <div class="addbox" style="display: <?php echo ($a_dis); ?>">
            <input type="text" name="adden0" placeholder="请输入英文单词"/>
            <input type="text" name="addzh0" placeholder="请输入单词示意"/>
        </div>
        <input style="display: <?php echo ($a_dis); ?>" class="addsubmit" type="submit" value="添加"/>
        <div class="addbox"  style="display: <?php echo ($a_dis2); ?>">添加成功！
            <a class="operations" href="/think/vt.php/Home/Index/test?a=1">继续添加</a>
            <a class="operations" href="/think/vt.php/Home/Index/test?a=2">去测试</a>
        </div>
    <?php elseif($change == 4): ?>
        <?php if(empty($$untest)): ?><div class="newwords">您的生词本中无生词，您有以下选择
                <a class="operations" href="/think/vt.php/Home/Index/test?a=1">添加生词</a>
                <a class="operations" href="/think/vt.php/Home/Index/test?a=5">查看错词列表</a>
                <a class="operations" href="/think/vt.php/Home/Index/test?a=3">测试错题</a>
                <a class="operations" href="/think/vt.php/Home/Index/test?a=6">查看成绩列表</a>
            </div>
        <?php else: ?>
            <?php if(is_array($$untest)): foreach($$untest as $i=>$un): $group = explode('-', $un); ?>
                <div class="newwords">
                    <h3>编号：<?php echo ($i+1); ?></h3>
                    <div class="newen">英文：<?php echo ($group[0]); ?></div>
                    <div class="newzh">释义：<?php echo ($group[1]); ?></div>
                </div><?php endforeach; endif; endif; ?>
    <?php elseif($change == 5): ?>
        <?php if(empty($wrong)): ?><div class="redirect">您的错题本中无错词，您有以下选择
                <a class="operations" href="/think/vt.php/Home/Index/test?a=2">测试生词</a>
                <a class="operations" href="/think/vt.php/Home/Index/test?a=4">查看生词列表</a>
                <a class="operations" href="/think/vt.php/Home/Index/test?a=6">查看成绩列表</a>
            </div>
        <?php else: ?>
            <?php if(is_array($wrong)): foreach($wrong as $key=>$w): $group = explode('-', $w); ?>
                <div class="wrongwords">
                    <h3>编号：<?php echo ($i+1); ?></h3>
                    <div class="newen">英文：<?php echo ($group[0]); ?></div>
                    <div class="newzh">释义：<?php echo ($group[1]); ?></div>
                </div><?php endforeach; endif; endif; ?>
    <?php elseif($change == 6): ?>
        <?php if(($right != NULL) OR ($worng != NULL)): ?><div class="record">一共做了<?php echo ($k+$j); ?>道题,其中，做对了<?php echo ($j); ?>道题，做错了<?php echo ($k); ?>道题</div>
            <div class="left">
                <h4>正题</h4>
                <?php if(empty($right)): ?><div class="waring">无</div>
                    <?php else: ?>
                    <?php if(is_array($right)): foreach($right as $key=>$r): $group = explode('-', $r); ?>
                        <div class="rwords"><?php echo ($group[0]); ?> ---------- <?php echo ($group[1]); ?></div><?php endforeach; endif; endif; ?>
            </div>
            <div class="right">
                <h4>错题</h4>
                <?php if(empty($wrong)): ?><div class="waring">无</div>
                    <?php else: ?>
                    <?php if(is_array($wrong)): foreach($wrong as $key=>$w): $group = explode('-', $w); ?>
                        <div class="wwords"><?php echo ($group[0]); ?> ---------- <?php echo ($group[1]); ?></div><?php endforeach; endif; endif; ?>
            </div>
        <?php else: ?>
            <div class="redirect">
                您还没有成绩，快去测试吧！
                <a class="operations" href=/think/vt.php/Home/Index/test?a=2">去测试</a>
            </div><?php endif; endif; ?>
</form>
<!-- 表单--结束 -->
<script type="text/javascript" src="/think/Public/vt/test.js"></script>
</body>
</html>