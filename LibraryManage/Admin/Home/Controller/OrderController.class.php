<?php
/**
 * Created by PhpStorm.
 * User: lyk
 * Date: 2017/2/2 0002
 * Time: 22:39
 */

namespace Home\Controller;

class OrderController extends BaseController
{
    // 预约列表
    public function orderList()
    {
        $this->getRecord("type=0");
        $this->display();
    }

    // 今日借书提醒
    public function borrowWarn()
    {
        $time = date("Y-m-d", time());
        $this->getRecord("borrowDate = '".$time."' AND type>0");
        $this->display();
    }

    // 同意借书操作
    public function agreeBorrow()
    {
        $id = $_GET['id'];
        // 查出预约的信息
        $order = D("Order");
        $res = $order->where("id=".$id)->select();
        $arr['user'] = $res[0]['user'];
        $arr['bookName'] = $res[0]['bookname'];
        $arr['borrowDate'] = $res[0]['borrowdate'];
        $arr['bookNum'] = $res[0]['booknum'];
        // 借书日期+借书时间 = 还书日期
        $date = explode("-", $res[0]['borrowdate']);
        $date[1] = $date[1]+$res[0]['maintaintime'];
        if ( $date[1] > 12 ) {
            $date[0] = $date[0] + 1;
            $date[1] = $date[1]-12;
        }
        $date[0] = $date[0] + 0;
        $date[2] = $this->adjustDay($date[0], $date[1], $date[2]);
        if ( $date[1]<10 ) {
            $date[1] = '0'.$date[1];
        }
        if ( $date[2]<10 ) {
            $date[1] = $date[1] + 0;
        }
        $date = $date[0]."-".$date[1]."-".$date[2];
        $arr['returnDate'] = $date;
        // 删除预约记录
        $isDel = $order->where("id=".$id)->delete();
        $borrow = D("Borrow");
        // 添加借书记录
        $arr['type'] = 0;
        $isAdd = $borrow->filter("strip_tags")->add($arr);
        // 更新用户信息
        $user = D("Users");
        $userMsg = $user->where("name='".$res[0]['user']."'")->select();
        $isUpdate = $user->addBorrowBook($res[0]['user'], $userMsg[0]['booknum'], $res[0]['booknum']);
        if ( $isDel && $isAdd && $isUpdate ) {
            $msg = "出借成功！";
        } else {
            $msg = "出借失败！";
        }
        $this->assign("msg", $msg);
        $this->assign("urls", $this->orderUrls);
        $this->display("Base/tip");
    }

    // 驳回预约操作
    public function disagreeBorrow()
    {
        $id = $_GET['id'];
        $order = D("Order");
        $order->type=0;
        $isSuccess = $order->where("id=".$id)->save();
        if ( $isSuccess ) {
            $msg = "驳回预约成功！";
        } else {
            $msg = "驳回预约失败！";
        }
        $this->assign("msg", $msg);
        $this->assign("urls", $this->orderUrls);
        $this->display("Base/tip");
    }

    // 记录分页操作
    public function getRecord($req=null)
    {
        $order = M("Order");
        $count = $order->count();
        $firstPage = $this->page($count, C("limitRow"));
        $orderList = $order->where($req)->limit($firstPage.','.C("limitRow"))->select();
        $this->assign("orderList", $orderList);
    }

}