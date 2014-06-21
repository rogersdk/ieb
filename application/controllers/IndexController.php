<?php

class IndexController extends Zend_Controller_Action{

	public function init(){
		/* Initialize action controller here */
		if(!Zend_Auth::getInstance()->hasIdentity()){
			$this->_redirect('/login/logar');	
		}
	}

	public function indexAction(){
		// action body
	}

	public function listarAction(){
		// action body
	}
	
}