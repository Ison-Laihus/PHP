<?php
/**
 * Created by PhpStorm.
 * User: lyk
 * Date: 2017/1/20 0020
 * Time: 15:06
 */

namespace Home\Controller;

use Think\Page;

class UserController extends BaseController
{
    // 用户信息列表
    public function userList()
    {
        $count = $this->user->count();
        $firstPage = $this->page($count, C("limitRow"));
        $userList = $this->user->limit($firstPage.','.C("limitRow"))->select();
        $this->assign("userList", $userList);
        $this->display();
    }

    // 更新用户操作
    public function updateUser()
    {
        $arr = $_POST;
        $this->user->name = $arr['name'];
        $this->user->pwd = md5($arr['pwd']);
        $isSuccess = $this->user->where("id=".$arr['id'])->save();
        if ( $isSuccess ) {
            $msg = "用户信息更新成功!";
        } else {
            $msg = "用户信息更新失败!";
        }
        $this->assign("msg", $msg);
        $this->assign("urls", $this->userUrls);
        $this->display("Base/tip");
    }

    // 删除用户操作
    public function deleteUser()
    {
        $id = $_GET['id'];
        $isSuccess = $this->user->where("id=".$id)->delete();
        if ( $isSuccess ) {
            $msg = "用户信息删除成功!";
        } else {
            $msg = "用户信息删除失败!";
        }
        $this->assign("msg", $msg);
        $this->assign("urls", $this->userUrls);
        $this->display("Base/tip");
    }

    // 添加用户
    public function addUser()
    {
        $this->display();
    }

    // 添加用户处理
    public function handleAddUser()
    {
        $arr = $_POST;
        $arr['pwd'] = md5($arr['pwd']);
        $arr['credit'] = 100;
        $arr['isBorrow'] = 0;
        $arr['bookNum'] = 0;
        $isSuccess = $this->user->filter("strip_tags")->add($arr);
        if ( $isSuccess ) {
            $msg = "用户添加成功!";
        } else {
            $msg = "用户添加失败!";
        }
        $this->assign("msg", $msg);
        $this->assign("urls", $this->userUrls);
        $this->display("Base/tip");
    }

    // 黑名单
    public function blackList()
    {
        $userList = $this->user->field("name")->select();
        for ( $i=0; $i<count($userList); $i++ ) {
            $this->updateUserRecords($userList[$i]['name']);
        }
        $count = $this->user->count();
        $firstPage = $this->page($count, C("limitRow"));
        $blackList = $this->user->where("credit<100")->limit($firstPage.','.C("limitRow"))->select();
        $this->assign("blackList", $blackList);
        $this->display();
    }

    // 黑名单成员的黑历史
    public function blackHistory()
    {
        $id = $_POST['id'];
        $myMsg = $this->user->where("id=".$id)->select();
        $orderHistory = $this->order->field()->where("user='".$myMsg[0]['name']."' AND isRecord=1")->select();
        $msg = "用户 ".$myMsg[0]['name']."<br/>";
        if ( $orderHistory ) {
            $msg .= "<font color='red'>".count($orderHistory)."</font>次没能按预约时间去借书<br/>";
        } else {
            $msg .= "没有预约失信<br/>";
        }
        $borrowHistory = $this->borrow->field()->where("user='".$myMsg[0]['name']."' AND type>1 AND isRecord=1")->select();
        $a = $b = $c = $d = 0;
        for ( $i=0; $i<count($borrowHistory); $i++ ) {
            switch($borrowHistory[$i]['type']) {
                case '2':
                    $a ++;
                    break;
                case '3':
                    $b ++;
                    break;
                case '4':
                    $c ++;
                    break;
                case '5':
                    $d ++;
                    break;
            }
        }
        if ( $borrowHistory ) {
            $msg .= "<font color='red'>".count($borrowHistory)."</font>次没能按借书约定时间去还书<br/>其中<br/>";
            if ( $a ) {
                $msg .= "<font color='red'>".$a."</font>次还书超过约定时间一天内<br/>";
            }
            if ($b) {
                $msg .= "<font color='red'>".$b."</font>次还书超过约定时间一周内<br/>";
            }
            if ($c) {
                $msg .= "<font color='red'>".$c."</font>次还书超过约定时间一月内<br/>";
            }
            if ($d) {
                $msg .= "<font color='red'>".$d."</font>次还书超过约定时间一月<br/>";
            }
        } else {
            $msg .= "没有还书失信<br/>";
        }
        echo $msg;
    }
}

