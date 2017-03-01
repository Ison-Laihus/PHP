<?php
namespace Home\Model;

use Think\Model;
class IndexModel extends Model
{

    protected $path = __PUBLIC__;
    protected $len = 0;
    protected $dupli = array();

    public function getWords($filename)
    {
        $filename = self::$path.'/vt/'.$filename;
        $file = file($filename);
        foreach($file as &$line) $untest[] = $line;
        $length = count($untest);
        if ( $length>5 ) {
            for ( $i=5; $i<$length; $i++ ) {
                $dupli[] = $untest[$i];
            }
            self::$dupli = $dupli;
            $untest = array_slice($untest, 0, 5);
            $length = 5;
        }
        self::$len = $length;
        return $untest;
    }

    public function checkAnswer($arr)
    {
        for ( $i=0; $i<self::$len; $i++ ) {
            $answer[$i] = $_REQUEST['en'.$i];
            $zhen = explode('-', $arr[$i]);
            $judge[] = ($answer[$i] == $zhen[0]) ? true : false;
        }
        return judge;
    }

    public function deleteGetedWords($fi)
    {
        $fp = fopen($fi, 'w');
        if ( self::$dupli ) {
            foreach ( self::$dupli as $v ) {
                fwrite($fp, $v);
            }
        } else {
            fwrite($fp, '');
        }
        fclose($fp);
    }

    public function saveWords($judge, $untest)
    {
        $fpr = fopen(self::$path.'/vt/right.txt', 'a');
        $fpw = fopen(self::$path.'/vt/wrong.txt', 'a');
        for ( $i=0; $i<self::$len; $i++ ) {
            if( $judge[$i] ) {
                fwrite($fpr, $untest[$i]);
            } else {
                fwrite($fpw, $untest[$i]);
            }
        }
        fclose($fpr);
        fclose($fpw);
    }
}