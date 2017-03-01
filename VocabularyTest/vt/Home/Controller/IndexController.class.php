<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $this -> display();
    }

    public function test()
    {

        /** 实例化模型层，进行数据操作 **/
//        $im = new \Home\Model\IndexModel('user', 'obtp_', 'DB_CONFIG');

        /**
         * 接收表单信息
         */

        // 接收a信息，判断到底是进行单词测试还是单词添加，默认是测试生词
        $a = isset($_REQUEST['a']) ? $_REQUEST['a'] : 2;
        if ( $a==1) {
            $change = 2;
        } else if ( $a==2 || $a==3 ) {
            $change = 1;
        } elseif ( $a==4 ) {
            $change = 4;
        } elseif ( $a==5 ) {
            $change = 5;
        } elseif ( $a==6 ) {
            $change = 6;
        }
        if ( $change == 1 ) {
            $word = 'Add Words';
            $med = 'test';
        } else if ( $change == 2 ) {
            $word = 'Go To Test';
            $med = 'add';
        } elseif ( $change==4 || $change==5 || $change==6 ) {
            $med = 'out';
            $word = 'Go To Test';
        }

        $med = (isset($_REQUEST['med'])&&$_REQUEST['med']!='') ? $_REQUEST['med'] : $med;

        // 设置全局数组变量
        $untest = array();
        $answer = array();
        $dupli = array();
        $judge = array();
        $wrong = array();
        $right = array();


        /**
         * $med = 'test'
         * 即进行单词测试的逻辑
         */

        if ( $med=='test' ) {

            $fi = ( $a==3 ) ? '__PUBLIC__/vt/wrong.txt' : '__PUBLIC__/vt/untest.txt';
            if ( !$untest && file_exists($fi) ) {
                $file = file($fi);
                foreach($file as &$line) $untest[] = $line;
                $len1 = count($untest);
                if ( $len1>5 ) {
                    for ( $i=5; $i<$len1; $i++ ) {
                        $dupli[] = $untest[$i];
                    }
                    $untest = array_slice($untest, 0, 5);
                }
            }

            // 接收用户填写的英文 & 去掉从(生词本|错题本)中提取出来的单词
            if ( isset($_REQUEST['med']) && $_REQUEST['med']!='' ) {
                $length = count($untest);
                for ( $i=0; $i<$length; $i++ ) {
                    $answer[$i] = $_REQUEST['en'.$i];
                    $zhen = explode('-', $untest[$i]);
                    $judge[] = ($answer[$i] == $zhen[0]) ? true : false;
                }
                // 去掉从(生词本|错题本)中提取出来的单词
                $fp = fopen($fi, 'w');
                if ( $dupli ) {
                    foreach ( $dupli as $v ) {
                        fwrite($fp, $v);
                    }
                } else {
                    fwrite($fp, '');
                }
                fclose($fp);
                // 将回答正确的单词添加到right.txt文件中,回答错误的单词添加到wrong.txt文件中
                $fpr = fopen('__PUBLIC__/vt/right.txt', 'a');
                $fpw = fopen('__PUBLIC__/vt/wrong.txt', 'a');
                for ( $i=0; $i<$length; $i++ ) {
                    if( $judge[$i] ) {
                        fwrite($fpr, $untest[$i]);
                    } else {
                        fwrite($fpw, $untest[$i]);
                    }
                }
                fclose($fpr);
                fclose($fpw);
                // 将$med的值设为空，当再次测试的时候隐藏tips区域
                $med = '';
            }

        }

        /**
         * $med = 'add'
         * 即进行添加单词的逻辑
         */

        else if ( $med == 'add' ) {

//            $change = 2;

            if ( isset($_REQUEST['med']) ) {
                $fp = fopen('__PUBLIC__/vt/untest.txt', 'a');// 如果存在untext.txt这个文件则会打开，否则会先创建一个
                $num = $_REQUEST['addnum'];
                for ( $i=0; $i<$num; $i++ ) {
                    $zh = $_REQUEST['addzh'.$i];
                    $en = $_REQUEST['adden'.$i];
                    if ( $zh && $en ) {
                        $w = $en.'-'.$zh."\n";
                        fwrite($fp, $w);
                    }
                }
                fclose($fp);
            }
        }

        //----------------------------------------//

        if ( isset($_REQUEST['med']) && $_REQUEST['med']!='' ) {
            $dis = 'block';
            $a_dis = 'none';
            $a_dis2 = 'block';
        } else {
            $dis = 'none';
            $a_dis = 'block';
            $a_dis2 = 'none';
        }

        /**
         * $change = 4
         * 生词表
         */
        if ( $change==4 ) {
            $fi = '__PUBLIC__/vt/untest.txt';
            if ( !$untest && file_exists($fi) ) {
                $file = file($fi);
                foreach($file as &$line) $untest[] = $line;
            }
        }


        /**
         * $change = 5
         * 错词表
         */
        if ( $change==5 ) {
            $fi = '__PUBLIC__/vt/wrong.txt';
            if ( !$wrong && file_exists($fi) ) {
                $file = file($fi);
                foreach($file as &$line) $wrong[] = $line;
            }
        }

        /**
         * $change = 6
         * 成绩列表
         */

        if ( $change==6 ) {
            $fpr = '__PUBLIC__/vt/right.txt';
            $fpw = '__PUBLIC__/vt/wrong.txt';
            $filer = file($fpr);
            $filew = file($fpw);
            foreach( $filer as &$line ) $right[] = $line;
            foreach( $filew as &$line ) $wrong[] = $line;
            $numr = count($right);
            $numw = count($wrong);
        }

        /**
         * 集体将PHP变量assign到模板中
         */
        $this->assign('a', $a);
        $this->assign('med', $med);
        $this->assign('change', $change);
        $this->assign('untest', $untest);
        $this->assign('dis', $dis);
        $this->assign('judge', $judge);
        $this->assign('wrong', $wrong);
        $this->assign('right', $right);
        $this->assign('answer', $answer);
        $this->assign('a_dis', $a_dis);
        $this->assign('a_dis2', $a_dis2);
        $this->assign('j', $numr);
        $this->assign('k', $numw);
        $this->assign('word', $word);




        $this->display();
    }
}