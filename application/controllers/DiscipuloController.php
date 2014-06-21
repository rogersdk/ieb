<?php
class DiscipuloController extends Zend_Controller_Action{

	public function init(){
		if(!Zend_Auth::getInstance()->hasIdentity()){
			$this->_redirect('/login/logar');
		}
	}

	public function indexAction(){

	}
}