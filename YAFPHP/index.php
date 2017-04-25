<?php

// +----------------------------------------------------------------------
// | YafPHP Develop
// +----------------------------------------------------------------------
// | Copyright (c) 2015-2016 http://www.widuu.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: widuu 
// +----------------------------------------------------------------------
// | Time  : 2015/2/4
// +----------------------------------------------------------------------

//检查是否安装了yaf扩展
if(!extension_loaded("yaf")) die('Not Install Yaf');
//定义文件目录地址
define('APP_PATH',realpath(dirname(__FILE__)));
//实例化Yaf
$app = new Yaf\Application(APP_PATH."/conf/application.ini",ini_get('yaf.environ'));
//加载引导程序Bootstrap.php
$app->bootstrap()->run();