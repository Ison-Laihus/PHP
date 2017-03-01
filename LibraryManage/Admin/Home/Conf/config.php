<?php
return array(
	//'配置项'=>'配置值'
    'DB_TYPE' => 'mysql',
    'DB_HOST' => 'localhost',
    'DB_NAME' => 'lyk',
    'DB_USER' => 'root',
    'DB_PWD' => 'root',
    'DB_PORT' => 3306,
    'DB_CHARSET' => 'utf8',
    'DB_DEBUG' => true,
    'DB_PREFIX' => 'lm_',
//    'TMPL_ACTION_ERROR'=>'Common/error',  //错误提示模板
//    'TMPL_ACTION_SUCCESS'=>'Common/tip',  //成功提示模板
    'limitRow'=>5,
    "dayOfMonth" => array(
        0=>array(
            1=>31,
            2=>28,
            3=>31,
            4=>30,
            5=>31,
            6=>30,
            7=>31,
            8=>31,
            9=>30,
            10=>31,
            11=>30,
            12=>31
        ),
        1=>array(
            1=>31,
            2=>29,
            3=>31,
            4=>30,
            5=>31,
            6=>30,
            7=>31,
            8=>31,
            9=>30,
            10=>31,
            11=>30,
            12=>31
        ),
    ),
);