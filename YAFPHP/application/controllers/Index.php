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

class IndexController extends Yaf\Controller_Abstract{
	
	public function indexAction(){
		$this->_view->title = "YAF测试首页";
		$model = new UserModel();
		if(empty(cache('data'))){
			$data = $model->where('status=1')->select();
			cache('data',$data);
		}	
		dump(cache('data'));
	}

	public function showAction(){
		$uid = $this->getRequest();
		dump($uid);
		Yaf\Dispatcher::getInstance()->disableView();
	}
}