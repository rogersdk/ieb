<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap{

	protected function _initAutoload(){
		$autoloader = Zend_Loader_Autoloader::getInstance()->registerNamespace('Crud_');
		return $autoloader;
	}

	protected function _initErrorDisplay(){
		$frontController = Zend_Controller_Front::getInstance();
		$frontController->throwExceptions(true);
	}
}

