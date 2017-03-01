<?php
/**
 * Created by PhpStorm.
 * User: lyk
 * Date: 2017/1/21 0021
 * Time: 14:19
 */

namespace Home\Controller;

class LoginController extends BaseController
{
    // 登陆页面
    public function login()
    {
        $this->display();
    }

    // 登陆处理
    public function doLogin()
    {
        $arr = $_POST;
        setcookie('type', '', time()-1);
        if ( $arr['object'] ) {
            setcookie('type', 1, time()+1*3600);
            $table = $this->admin;
        } else {
            setcookie('type', 2, time()+1*3600);
            $table = $this->user;
        }
        $ret = $table->checkLogin($arr['user'], md5($arr['pass']));
        if ( $ret ) {
            $_SESSION['username'] = $ret[0]['name'];
            $_SESSION['user_id'] = $ret[0]['id'];
            if ( $ret[0]['authority'] ) {
                $_SESSION['authority'] = $ret[0]['authority'];
            }
            $this->success("登陆成功！", $arr['object']=='1'?U("Index/index"):U("Home/home"), 3);
        } else {
            setcookie('type', '', time()-1);
            $this->error("登陆失败", U("Login/login"), 3);
        }
    }

    // 注销
    public function logout()
    {
        $_SESSION = array();
        if ( isset($_COOKIE[session_name()]) ) {
            setcookie(session_name(), "", time()-1);
        }
        if ( isset($_COOKIE['type']) ) {
            setcookie('type', '', time()-1);
        }
        session_destroy();
        $this->success("退出成功", U("Login/login"), 3);
    }
}