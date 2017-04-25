<?php

// +----------------------------------------------------------------------
// | Yaf 引导程序
// +----------------------------------------------------------------------
// | Copyright (c) 2015-2016 http://www.widuu.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: widuu 
// +----------------------------------------------------------------------
// | Time  : 2015/2/4
// +----------------------------------------------------------------------


class Bootstrap extends Yaf\Bootstrap_Abstract{

	/**
     * include Initialization common function
     * @author widuu <admin@widuu.com>
	 */

	public function _initCommon(){
		$commonFile = APP_PATH."/common/function.php";
		//加载公共函数库
		if(file_exists($commonFile)){
			require_once $commonFile;
		}
		//加载语言包
		$langFile   = APP_PATH."/lang/zh_cn.php";
		if(file_exists($langFile)){
			Lang(include $langFile);
		}
	}

	/**
     * Initialization the configure
     * @author widuu <admin@widuu.com>
	 */

	public function _initConfig(){
		//注册配置文件
		 $config = Yaf\Application::app()->getConfig();
         Yaf\Registry::set("config", $config);
         //开启缓存
         if($config->application->cache->open){
         	Register::_set('cache',Cache::getInstance());
         }
	}

	/**
     * Initialization the routes
     * @author widuu <admin@widuu.com>
	 */

	public function _initRoute(Yaf\Dispatcher $dispatcher) {
		//注册路由
        $router = Yaf\Dispatcher::getInstance()->getRouter();
        $router->addConfig(Yaf\Registry::get("config")->routes);
        //自定义路由测试
        $router->addRoute('myroute',new Router());
    }

	/**
     * Initialization the local class
     * @author widuu <admin@widuu.com>
	 */

    public function _initLoader(){
    	//注册本地类库
    	Yaf\Loader::getInstance()->registerLocalNamespace(array("Db"));
    }
}