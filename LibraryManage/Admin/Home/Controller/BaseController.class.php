<?php
/**
 * Created by PhpStorm.
 * User: lyk
 * Date: 2017/1/21 0021
 * Time: 14:16
 */

namespace Home\Controller;

use Think\Controller;
use Think\Page;

class BaseController extends Controller
{

    protected $admin;
    protected $user;
    protected $book;
    protected $borrow;
    protected $cateList;
    protected $order;
    protected $adminUrls;
    protected $bookUrls;
    protected $borrowUrls;
    protected $orderUrls;
    protected $userUrls;

    // 初始化
    protected function _initialize()
    {
        // 实例化各个数据表Model
        $this->admin = D("Admins");
        $this->user = D("Users");
        $this->book = D("Books");
        $this->borrow = D("Borrow");
        $this->order = D("Order");
        $cate = D("Cate");
        $this->cateList = $cate->select();
        // 设置urls
        // 管理员
        $this->adminUrls = array(
            0=>array(
                'url'=>__MODULE__.'/Index/index',
                'text'=>'查看自身信息'
            )
        );
        if ( $_SESSION['authority']==1 ) {
            $this->adminUrls[1] = array(
                'url'=>__MODULE__.'/Index/addAdmin',
                'text'=>'添加管理员'
            );
            $this->adminUrls[2] = array(
                'url'=>__MODULE__.'/Index/delAdmin',
                'text'=>'删除管理员'
            );
        } else if ( $_SESSION['authority']==2 ) {
            $this->adminUrls[1] = array(
                'url'=>__MODULE__.'/Index/delAdmin',
                'text'=>'查看其他管理员'
            );
        }
        // 书籍
        $this->bookUrls = array(
            0=>array(
                'url'=>__MODULE__.'/Book/bookList',
                'text'=>'查看书籍列表'
            ),
            1=>array(
                'url'=>__MODULE__.'/Book/addBook',
                'text'=>'添加书籍'
            ),
        );
        // 借书
        $this->borrowUrls = array(
            0=>array(
                'url'=>__MODULE__.'/Borrow/borrowList',
                'text'=>'查看借书记录'
            ),
            1=>array(
                'url'=>__MODULE__.'/Borrow/addBorrow',
                'text'=>'添加借书记录'
            ),
            2=>array(
                'url'=>__MODULE__.'/Borrow/returnWarn',
                'text'=>'查看还书提醒'
            ),
        );
        // 预约
        $this->orderUrls = array(
            0=>array(
                'url'=>__MODULE__.'/Order/orderList',
                'text'=>'查看预约列表'
            ),
            1=>array(
                'url'=>__MODULE__.'/Order/borrowWarn',
                'text'=>'查看今日借书预约'
            ),
        );
        // 用户
        $this->userUrls = $urls = array(
            0=>array(
                'url'=>__MODULE__.'/User/userList',
                'text'=>'查看用户信息列表'
            ),
            1=>array(
                'url'=>__MODULE__.'/User/addUser',
                'text'=>'添加用户'
            ),
        );
        // 检查是否登陆过而且没有过期
        $this->checkLogin();
        // 检查是否有过期的预约，将其处理掉
        $this->checkExpireOrder();
    }

    // 检查是否登陆
    protected function checkLogin()
    {
        // CONTROLLER_NAME --- 控制器名称   ACTION_NAME --- 方法名
        // C 方法 --- 获取conf文件夹中配置文件中的变量，先检查局部的配置文件，再检查全局的配置文件
        // session 方法中 参数首部添加一个'?'是为了让函数检查session
        if ( $_COOKIE['type'] && $_COOKIE['type']==1 && $_SESSION['user_id'] && CONTROLLER_NAME=='Login' && ACTION_NAME=='login') {
            $this->redirect('Index/index');
        } elseif ( $_COOKIE['type'] && $_COOKIE['type']==2 && $_SESSION['user_id'] && CONTROLLER_NAME=='Login' && ACTION_NAME=='login') {
            $this->redirect('Home/home');
        } elseif ( ( !$_COOKIE['type'] || !$_SESSION['user_id']) && CONTROLLER_NAME!='Login') {
            setcookie('type', 3, time()+3600);
            $this->redirect('Login/login');
        }
    }

    //数据分页
    protected function page($total, $size){
        $Page = new Page($total,$size);
        if ( $Page->show()=="<div>    </div>" ) {
            $flag = false;
        } else {
            $flag = true;
        }
        $this->assign("flag", $flag);
        $Page->setConfig('first','首页');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('last','尾页');
        $Page->setConfig('theme','<p>%NOW_PAGE%/%TOTAL_PAGE%页（每页'.$Page->listRows.'条/共%TOTAL_ROW%条） | %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%</p>');
        $this->assign('show',$Page->show());
        return $Page->firstRow;
    }

    // 调整了月份之后，根据月份相应地调整日
    protected function adjustDay($year, $month, $day)
    {
        $dayOfMonth = C("dayOfMonth");
        $i = $this->judgeYear($year);
        if ( $day>$dayOfMonth[$i][$month] ) {
            $day = $dayOfMonth[$i][$month];
        }
        return $day;
    }

    // 判断该年份为闰年还是平年，并返回配置中的数组下标
    protected function judgeYear($year)
    {
        $i = 0;
        if ( ($year%4==0&&$year%100!=0)||($year%400==0) ) {
            $i = 1;
        }
        return $i;
    }

    // 日期比较 规定 $date1要在$date2之前
    protected function cmpDate($date1, $date2)
    {
        if ( $date1==$date2 ) {
            return 1;
        }
        $dateArr1 = explode("-", $date1);
        $dateArr2 = explode("-", $date2);
        $dateArr1[0] = $dateArr1[0] + 0;
        $dateArr1[1] = $dateArr1[1] + 0;
        $dateArr1[2] = $dateArr1[2] + 0;
        $dateArr2[0] = $dateArr2[0] + 0;
        $dateArr2[1] = $dateArr2[1] + 0;
        $dateArr2[2] = $dateArr2[2] + 0;
        $i = $this->judgeYear($dateArr1[0]);
        $j = $this->judgeYear($dateArr2[0]);
        $dayOfYear = C("dayOfYear");
        if ( $dateArr1[0]==$dateArr2[0] ) {// 年份相同
            if ( $dateArr1[1]==$dateArr2[1] ) {// 月份相同
                if ( $dateArr2[2]-$dateArr1[2]==1 ) {// 一天内
                    return 2;
                } elseif ( $dateArr2[2]-$dateArr1[2]<=7 ) {// 超过一天，但在七天内
                    return 3;
                } else {// 超过七天，但在一月之内
                    return 4;
                }
            } elseif ( $dateArr2[1]-$dateArr1[1]==1 ) {// 相隔一个月份
                $days = ($dayOfYear[$i][$dateArr1[1]]-$dateArr1[2]) + $dateArr2[2];
                if ( $days==1 ) {// 相隔一天
                    return 2;
                } elseif ( $days<=7 ) { // 相隔一周之内
                    return 3;
                } elseif ( $days<=$dayOfYear[$j][$dateArr2[1]] ) {// 相隔一月之内
                    return 4;
                } else {// 相隔超过一月
                    return 5;
                }
            }
        } else {
            if ( $dateArr2[0]-$dateArr1[0]==1 ) {// 年份相邻
                $months = 12-$dateArr1[1] + $dateArr2[1];
                if ( $months==1 ) {// 月份相差一个月
                    $days = ($dayOfYear[$i][$dateArr1[1]]-$dateArr1[2]) + $dateArr2[2];
                    if ( $days==1 ) {// 相隔一天
                        return 2;
                    } elseif ( $days<=7 ) { // 相隔一周之内
                        return 3;
                    } elseif ( $days<=$dayOfYear[$j][$dateArr2[1]] ) {// 相隔一月之内
                        return 4;
                    } else {// 相隔超过一月
                        return 5;
                    }
                } else {// 月份相差超过一个月
                    return 5;
                }
            } else {// 年份相邻
                return 5;
            }
        }
    }

    // 检查过期的预约，并将其作废 ----- 在_initialize()函数中调用，实时监控
    protected function checkExpireOrder()
    {
        $time = date("Y-m-d", time());
        $expireOrders = $this->order->where("borrowDate < '".$time."'")->select();
        $records = 0;
        for ( $i=0; $i<count($expireOrders); $i++ ) {
            $this->order->type = 2;
            $this->order->where("id=".$expireOrders[$i]['id'])->save();
        }
    }

    // 根据用户的失信记录来扣信用度
    public function updateUserRecords($user)
    {
        $records = 0;
        $orderRecords = $this->order->where("type=2 AND isRecord=0")->select();
        $num = count($orderRecords);
        for ( $i=0; $i<$num; $i++ ) {
            $this->order->isRecord = 1;
            $this->order->where("id=".$orderRecords[$i]['id'])->save();
        }
        $records += 5*$num;
        $borrowRecords = $this->borrow->where("type>1 AND isRecord=0")->select();
        $num = count($borrowRecords);
        for ( $i=0; $i<$num; $i++ ) {
            $this->borrow->isRecord = 1;
            switch($borrowRecords[$i]['type']) {
                case '2':
                    $records += 5;
                    break;
                case '3':
                    $records += 10;
                    break;
                case '4':
                    $records += 50;
                    break;
                case '5':
                    $records += 100;
                    break;
            }
            $this->borrow->where("id=".$borrowRecords[$i]['id'])->save();
        }
        $userMsg = $this->user->where("name='".$user."'")->select();
        $credit = $userMsg[0]['credit'];
        $credit = $credit - $records;
        $this->user->credit = $credit;
        $this->user->where("id=".$userMsg[0]['id'])->save();
    }
}