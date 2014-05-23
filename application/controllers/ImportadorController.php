<?php

class ImportadorController extends Zend_Controller_Action{

	public function init(){
		$this->_modeloPessoa = new Application_Model_Pessoa();
		$this->_modeloClasse = new Application_Model_Classe();
		$this->_modeloMatricula = new Application_Model_Matricula();

		$this->view->controllerName = $this->getRequest()->getControllerName();
		$this->view->moduleName = $this->getRequest()->getModuleName();
		$this->view->actionName = $this->getRequest()->getActionName();

		$this->view->classes = $this->_modeloClasse->fetchAll()->toArray();

		$this->initView();
	}

	public function indexAction(){
			
	}

	public function uploadAction(){
		$this->_helper->layout()->disableLayout();
   		$this->_helper->viewRenderer->setNoRender(true);

   		$upload = new Zend_File_Transfer();
   		$upload->addValidator('Extension',false,'csv');

   		if($upload->isValid()){

   		}else{
   			$this->_helper->flashMessenger->addMessage(array('danger'=>"Formato de Arquivo Inválido! Apenas '.csv'"));
			$this->_helper->_redirector('index');
   		}

   		
	}

}