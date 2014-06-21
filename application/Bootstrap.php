<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

	protected function _initAutoload()
	{
		$autoloader = Zend_Loader_Autoloader::getInstance()->registerNamespace('Crud_');
		return $autoloader;
	}

	protected function _initSessionNamespaces()
	{
		Zend_Session::start();
	}
	
	protected function _initRegisterPlugins()
	{
	//	$this->bootstrap('FrontController')->getResource('FrontController')->registerPlugin(new MyLib_Controllers_Plugin_Auth());
	}
	
	
	protected function _initErrorDisplay(){
		$frontController = Zend_Controller_Front::getInstance();
		$frontController->throwExceptions(true);
	}


	protected function _initViewHelpers(){
		// Nome do Arquivo
		$filename = realpath(APPLICATION_PATH . '/configs/navigation.xml');
		// Carregamento de Configuração
		$config = new Zend_Config_Xml($filename);

		// Registrar Camada de Visualização
		$this->registerPluginResource('view');
		// Inicialização da Camada
		$view = $this->bootstrap('view')->getResource('view');

		// Captura do Auxiliar de Navegação
		$navigation = $view->navigation();
		$navigation->menu()->setUlClass('nav navbar-nav');
		// Incluir Conteúdo
		$navigation->addPages($config);
	}

}

