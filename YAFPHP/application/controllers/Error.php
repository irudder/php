<?php

// +----------------------------------------------------------------------
// | Yaf 错误提示
// +----------------------------------------------------------------------
// | Copyright (c) 2015-2016 http://www.widuu.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: widuu <admin@widuu.com>
// +----------------------------------------------------------------------
// | Time  : 2015/2/4
// +----------------------------------------------------------------------

class ErrorController extends Yaf\Controller_Abstract{
	
	/**
	 * 错误异常提示
	 * @author <admin@widuu.com>
	 */
	
	public function errorAction($exception){
		$this->getView()->assign("file", $exception->getFile());
      	$this->getView()->assign("line", $exception->getLine());
		$this->getView()->assign("code", $exception->getCode());
      	$this->getView()->assign("message", $exception->getMessage());
	}
}