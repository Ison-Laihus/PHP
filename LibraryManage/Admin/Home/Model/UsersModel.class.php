<?php
/**
 * Created by PhpStorm.
 * User: lyk
 * Date: 2017/1/20 0020
 * Time: 15:29
 */

namespace Home\Model;

use Think\Model;

class UsersModel extends Model
{
    // 获取所有的用户信息
    public function getAllUsers()
    {
        $users = $this->field("id,name,credit,isBorrow,bookNum")->select();
        return $users;
    }

    // 登陆时判断用户名和密码
    public function checkLogin($user, $pass)
    {
        $isFind = $this->where("name='$user' AND pwd='$pass' AND credit>0")->select();
        return $isFind;
    }

    // 获取自身的信息
    public function getSelfMsg()
    {
        $myMsg = $this->where("name='".$_SESSION['username']."'")->select();
        return $myMsg;
    }

    // 更新用户的借书信息(是否借书 & 借书数目) ---- 增加借书数目
    public function addBorrowBook($user, $oldNum, $addNum)
    {
        if ( $oldNum=='0' ) {
            $this->isBorrow = 1;
        }
        $this->bookNum = $oldNum + $addNum;
        $isUpdate = $this->where("name='".$user."'")->save();
        return $isUpdate;
    }

    // 更新用户的借书信息(是否借书 & 借书数目) ---- 减少借书数目
    public function deleteBorrowBook($user, $oldNum, $returnNum)
    {
        if ( $oldNum==$returnNum ) {
            $this->isBorrow = 0;
        }
        $this->bookNum = $oldNum-$returnNum;
        $isUpdate = $this->where("name='".$user."'")->save();
        return $isUpdate;
    }

}