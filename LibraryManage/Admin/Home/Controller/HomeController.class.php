<?php
/**
 * Created by PhpStorm.
 * User: lyk
 * Date: 2017/1/20 0020
 * Time: 21:45
 */

namespace Home\Controller;

class HomeController extends BaseController
{

    // 用户个人信息主页
    public function home()
    {
        $myMsg = $this->user->getSelfMsg();
        $this->assign("userMsg", $myMsg[0]);
        $this->display();
    }

    // 查看书籍
    public function checkBook()
    {
        $total = $this->book->where("isShow=1")->count();
        $firstPage = $this->page($total, C("limitRow"));
        $showList = $this->book->field("id,bookName,author,surplus,img")->where("isShow=1")->limit($firstPage.','.C("limitRow"))->select();
        $this->assign("showList", $showList);
        $this->display();
    }

    // 对书籍搜索进行处理
    public function searchBook()
    {
        $arr = $_POST;
        if ( $arr['mode']=='0' ) {
            $obj = "bookName";
        } else {
            $obj = "author";
        }
        $where[$obj] = array('like', "%".$arr['searchText']."%");
        $total = $this->book->where($where)->count();
        $firstPage = $this->page($total, C("limitRow"));
        $searchList = $this->book->where($where)->limit($firstPage.','.C("limitRow"))->select();
        $this->assign("searchList", $searchList);
        $this->display();
    }

    // 预约书籍
    public function orderBook()
    {
        $id = $_GET['bookId'];
        $book = D("Books");
        $orderBook = $book->where("id=".$id)->select();
        $this->assign("orderBook", $orderBook[0]);
        $this->display();
    }

    // 续约处理
    public function contactOrder()
    {
        $id = $_POST['id'];
        $returnDate = $_POST['date'];
        $dateArr = explode("-", $returnDate);
        if ( $dateArr[1]=='12' ) {
            $dateArr[1] = 0;
            $dateArr[0] += 1;
        }
        $dateArr[1] += 1;
        $dateArr[2] += 0;
        $dateArr[2] = $this->adjustDay($dateArr[0], $dateArr[1], $dateArr[2]);
        if ( $dateArr[1]<10 ) {
            $dateArr[1] = '0'.$dateArr[1];
        }
        if ( $dateArr[2]<10 ) {
            $dateArr[2] = '0'.$dateArr[2];
        }
        $this->borrow->returnDate = $dateArr[0]."-".$dateArr[1]."-".$dateArr[2];
        $isUpdate = $this->borrow->where("id=".$id)->save();
        if ( $isUpdate ) {
            echo 1;
        } else {
            echo 0;
        }
    }

    // 添加预约处理
    public function addOrder()
    {
        $arr = $_POST;
        $arr['type'] = 1;
        $arr['user'] = $_SESSION['username'];
        $time = date("Y-m-d", time());
        if ( $time>$arr['borrowDate'] ) {
            $msg = "借书日期在前，不能成功!";
            $this->assign("msg", $msg);
            $this->display("tip");
            exit;
        }
        $isAdd = $this->order->filter("strip_tags")->add($arr);
        if ( $isAdd ) {
            $msg = "预约成功!";
        } else {
            $msg = "预约失败!";
        }
        $this->assign("msg", $msg);
        $this->display("tip");
    }

    // 查看所借书籍
    public function checkBorrow()
    {
        $total = $this->order->where("type=1 AND user='".$_SESSION['username']."'")->count();
        $firstPage = $this->page($total, C("limitRow"));
        $borrowList = $this->borrow->where("user='".$_SESSION['username']."'")->limit($firstPage.','.C("limitRow"))->select();
        $date = date("Y-m-d");
        for ( $i=0; $i<count($borrowList); $i++ ) {
            if ( $borrowList[$i]['returnDate']<=$date ) {
                $borrowList[$i]['status'] = '借期中';
            } else {
                $borrowList[$i]['status'] = '未还';
            }
        }
        $this->assign("borrowList", $borrowList);
        $this->display();
    }

    // 查看预约
    public function checkOrder()
    {
        $total = $this->order->where("type>0 AND user='".$_SESSION['username']."'")->count();
        $firstPage = $this->page($total, C("limitRow"));
        $orderList = $this->order->where("type>0 AND user='".$_SESSION['username']."'")->limit($firstPage.','.C("limitRow"))->select();
        for ( $i=0; $i<count($orderList); $i++ ) {
            if ( $orderList[$i]['type']==0 ) {
                $orderList[$i]['status'] = '<font color="grey">被驳回</font>';
            } elseif ( $orderList[$i]['type']==1 ) {
                $orderList[$i]['status'] = '<font color="green">预约中</font>';
            } elseif ( $orderList[$i]['type']==2 ) {
                $orderList[$i]['status'] = '<font color="red">作废</font>';
            }
        }
        $this->assign("orderList", $orderList);
        $this->display();
    }
}