<?php
/**
 * Created by PhpStorm.
 * User: lyk
 * Date: 2017/1/20 0020
 * Time: 21:23
 */

namespace Home\Model;

use Think\Model;

class BooksModel extends Model
{
    public function getAllBook()
    {
        $count = $this->count();
        $page = new \Think\Page($count, 10);
        $show = $page->show();
        $res = $this->limit($page->firstRow.','.$page->listRows)->select();
        return $res;
    }
}