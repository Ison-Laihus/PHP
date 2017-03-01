<?php
namespace Home\Controller;

use Think\Controller;
use Think\Page;

class IndexController extends BaseController
{
    // 管理员信息
    public function index()
    {
        $ret = $this->admin->getAdminMsg();
        $this->assign("adminMsg", $ret[0]);
        $this->display();
    }

    // 添加管理员
    public function addAdmin()
    {
        $this->display();
    }

    // 添加管理员处理函数
    public function handleAddAdmin()
    {
        $arr = $_POST;
        $arr['pwd'] = md5($arr['pwd']);
        $isSuccess = $this->admin->filter("strip_tags")->add($arr);
        if ( $isSuccess ) {
            $msg = "用户添加成功!";
        } else {
            $msg = "用户添加失败!";
        }
        $this->assign("msg", $msg);
        $this->assign("urls", $this->adminUrls);
        $this->display("Base/tip");
    }

    // 所有管理员用户列表，可以进行相关操作
    public function delAdmin()
    {
        $count = $this->admin->count();
        $page = new Page($count, 5);
        $show = $page->show();
        if ( $show=="<div>    </div>" ) {
            $flag = false;
        } else {
            $flag = true;
        }
        $this->assign("flag", $flag);
        $allAdmins = $this->admin->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign("show", $show);
        $this->assign("allAdmins", $allAdmins);
        $this->display();
    }

    // 更新管理员信息操作
    public function updateAdmin()
    {
        $arr = $_POST;
        $this->admin->authority = $arr['authority'];
        $isSuccess = $this->admin->where("id=".$arr['id'])->save();
        if ( $isSuccess ) {
            $msg = "用户信息更新成功!";
        } else {
            $msg = "用户信息更新失败!";
        }
        $this->assign("msg", $msg);
        $this->assign("urls", $this->adminUrls);
        $this->display("Base/tip");
    }

    // 删除管理员操作
    public function deleteAdmin()
    {
        $id = $_GET['id'];
        $isSuccess = $this->admin->where("id=".$id)->delete();
        if ( $isSuccess ) {
            $msg = "管理员信息删除成功!";
        } else {
            $msg = "管理员信息删除失败!";
        }
        $this->assign("msg", $msg);
        $this->assign("urls", $this->adminUrls);
        $this->display("Base/tip");
    }

}