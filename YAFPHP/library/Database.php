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

/**
 * 单态模式实例化数据库
 */

class DataBase{

	static private $instance = array();
	static private $_instance = NULL;

	/**
	 * 单态获取数据对象
	 * @access public
	 * @param  config 配置信息
	 */

	static public function getInstance($config){
		//检测配置文件是否为空
		if(empty($config)) Error(Lang('_NO_DB_CONFIG_'),1002);
		//生成唯一连接标识
		$key = md5(implode($config,':'));
		if(!isset(self::$instance[$key])){
			//判断配置类型是否存在
			if(empty($config['type'])) Error(Lang('_NO_DB_TYPE_'),1002);
			// 查找是否存在
			$class  = "Db_".ucfirst($config['type']);
			// 实例化
			if(class_exists($class)){
				 self::$instance[$key]   =   new $class($config);
			}else{
				Error(Lang('_NO_DB_DRIVER_'),1003);
			}
		}
		self::$_instance = self::$instance[$key];
		//注册database服务
		Register::_set('db',self::$_instance);
		//返回实例
		return self::$instance[$key];
	}

}