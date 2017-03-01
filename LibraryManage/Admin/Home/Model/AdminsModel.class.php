<?php
/**
 * Created by PhpStorm.
 * User: lyk
 * Date: 2017/1/20 0020
 * Time: 21:19
 */

namespace Home\Model;

use Think\Model;

class AdminsModel extends Model
{
    public function getAdminMsg()
    {
        $msg = $this->where("name='".$_SESSION['username']."'")->select();
        return $msg;
    }

    public function checkLogin($user, $pass)
    {
        $isFind = $this->where("name='$user' AND pwd='$pass'")->select();
        return $isFind;
    }

    public function getAllAdmin()
    {
        $msg = $this->select();
        return $msg;
    }

}