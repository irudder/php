<?php


class IndexController extends Yaf\Controller_Abstract{

	public function indexAction(){
		echo 111;
		$uid = $this->getRequest()->getParam('uid',0);
		dump($uid);
		Yaf\Dispatcher::getInstance()->disableView();
	}

}