<?php
/**
 * Created by PhpStorm.
 * User: lyk
 * Date: 2017/1/20 0020
 * Time: 21:46
 */

namespace Home\Controller;

use Think\Upload;

class BookController extends BaseController
{
    // 书籍列表
    public function bookList()
    {
        $count = $this->book->count();
        $firstPage = $this->page($count, 3);
        $bookList = $this->book->limit($firstPage.',3')->select();
        $this->assign("bookList", $bookList);
        $this->assign("cates", $this->cateList);
        $this->display();
    }

    // 添加书籍
    public function addBook()
    {
        $this->assign("cateList", $this->cateList);
        $this->display();
    }

    // 添加书籍处理
    public function handleAddBook()
    {
        $arr = $_POST;
        $arr['publishTime'] = date("Y-m-d", time());
        $this->assign("urls", $this->bookUrls);
        // 文件处理
        $maxSize = 2097152;
        $path = './Public/images/';
        $allowExt=array("jpg", "jpeg", "png", "gif");
        if ( $_FILES['img']['size']>$maxSize ) {
            $msg = "文件太大！";
            $this->assign("msg", $msg);
            $this->display();
            exit;
        }
        $ext = $this->getExt($_FILES['img']['name']);
        if ( !in_array($ext, $allowExt) ) {
            $msg = "非法文件类型！";
            $this->assign("msg", $msg);
            $this->display();
            exit;
        }
        $filename = $this->getUniName().".".$ext;
        $arr['img'] = $filename;
        $destination = $path."/".$filename;
        if ( !move_uploaded_file($_FILES['img']['tmp_name'], $destination) ) {
            $msg = "文件移动失败！";
            $this->assign("msg", $msg);
            $this->display();
            exit;
        }
        $isSuccess = $this->book->filter("strip_tags")->add($arr);
        if ( $isSuccess ) {
            $msg = "添加成功!";
        } else {
            $msg = "添加失败!";
        }
        $this->assign("msg", $msg);
        $this->display("Base/tip");
    }

    // 获取文件后缀
    function getExt($filename) {
        return strtolower( end(explode('.', $filename)) );
    }

    // 生成文件名
    function getUniName() {
        return md5( uniqid(microtime(true), true) );
    }

    // 更新书籍处理
    public function updateBook()
    {
        $arr = $_POST;
        $this->book->bookName = $arr['bookName'];
        $this->book->author = $arr['author'];
        $this->book->publisher = $arr['publisher'];
        $this->book->publishTime = $arr['publishTime'];
        $this->book->category = $arr['category'];
        $this->book->sum = $arr['sum'];
        $this->book->surplus = $arr['surplus'];
        $this->book->isShow = $arr['isShow'];
        $isSuccess = $this->book->where("id=".$arr['id'])->save();
        if ( $isSuccess ) {
            $msg = "书籍信息更新成功!";
        } else {
            $msg = "书籍信息更新失败!";
        }
        $this->assign("msg", $msg);
        $this->assign("urls", $this->bookUrls);
        $this->display("Base/tip");
    }

    // 删除书籍
    public function deleteBook()
    {
        $id = $_GET['id'];
        $bookMsg = $this->book->where("id=".$id)->select();
        $file = './Public/images/'.$bookMsg[0]['img'];
        if ( file_exists($file) ) {
            unlink( $file );
        }
        $isSuccess = $this->book->where("id=".$id)->delete();
        if ( $isSuccess ) {
            $msg = "书籍信息删除成功!";
        } else {
            $msg = "书籍信息删除失败!";
        }
        $this->assign("msg", $msg);
        $this->assign("urls", $this->bookUrls);
        $this->display("Base/tip");
    }

}