<?php
/**
 * Created by PhpStorm.
 * User: lyk
 * Date: 2017/2/5 0005
 * Time: 14:47
 */

namespace Home\Controller;

class BorrowController extends BaseController
{
    // 借书信息列表
    public function borrowList()
    {
        $count = $this->borrow->where("type=0")->count();
        $firstPage = $this->page($count, C("limitRow"));
        $borrowList = $this->borrow->where("type=0")->limit($firstPage.','.C("limitRow"))->select();
        $this->assign("borrowList", $borrowList);
        $this->display();
    }

    // 添加借书记录
    public function addBorrow()
    {
        $this->display();
    }

    // 借书记录添加处理
    public function handleAddBorrow()
    {
        $arr = $_POST;
        $arr['type'] = 0;
        $arr['isRecord'] = 0;
        $isAdd = $this->borrow->filter("strip_tags")->add($arr);
        $res = $this->user->where("name='".$arr['user']."'")->select();
        $isUpdate = $this->user->addBorrowBook($arr['user'], $res[0]['booknum'], $arr['bookNum']);
        if ( $isAdd && $isUpdate ) {
            $msg = "出借成功！";
        } else {
            $msg = "出借失败！";
        }
        $this->assign("msg", $msg);
        $this->assign("urls", $this->borrowUrls);
        $this->display("Base/tip");
    }

    // 还书提醒
    public function returnWarn()
    {
        $time = date("Y-m-d", time());
        $count = $this->borrow->where("type=0")->count();
        $firstPage = $this->page($count, C("limitRow"));
        $returnWarn = $this->borrow->where("returnDate<='".$time."' AND type=0")->limit($firstPage.','.C("limitRow"))->select();
        $this->assign("returnWarn", $returnWarn);
        $this->display();
    }

    // 还书处理
    public function returnBack()
    {
        $id = $_GET['id'];
        $time = date("Y-m-d", time());
        $res = $this->borrow->where("id=".$id)->select();
        $ret = $this->user->where("name='".$res[0]['user']."'")->select();
        $isUpdate = $this->user->deleteBorrowBook($res[0]['user'], $ret[0]['booknum'], $res[0]['booknum']);
        $this->borrow->type = $this->cmpDate($res[0]['returndate'], $time);
        $isDel = $this->borrow->where("id=".$id)->save();
        if ( $isUpdate && $isDel ) {
            $msg = '还书成功！';
        } else {
            $msg = '还书失败！';
        }
        $this->assign("msg", $msg);
        $this->assign("urls", $this->borrowUrls);
        $this->display("Base/tip");
    }
}