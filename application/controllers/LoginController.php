<?php
class LoginController extends Zend_Controller_Action{



	public function init(){
		/* Initialize action controller here */
		$this->_helper->layout->setLayout('layout_login');
	}

	public function indexAction(){
		// action body
		if(Zend_Auth::getInstance()->hasIdentity()){
			$this->_redirect('');
		}
	}

	/*
	 CREATE TABLE `adm_usuario` (
		id    int(11) NOT NULL AUTO_INCREMENT,
		nome  varchar(255) NOT NULL,
		email  varchar(255) NOT NULL,
		login varchar(255) NOT NULL,
		senha  varchar(255) NOT NULL,
		PRIMARY KEY (id)
		);
		*/
	
	public function deslogarAction()
	{
		$this->_helper->viewRenderer->setNoRender(true);
		$this->_helper->layout()->disableLayout();
		
		if(Zend_Auth::getInstance()->hasIdentity()){
			Zend_Auth::getInstance()->clearIdentity();
		}
		
		$this->redirect('login/logar');
	}
	
	public function logarAction(){
		if($this->getRequest()->isPost()){
				
			if(Zend_Auth::getInstance()->hasIdentity()){
				$this->_redirect(array('controller'=>'login','action'=>'logar'));
			}else{
				$usuario = $this->getRequest()->getParam('usuario');
				$senha = $this->getRequest()->getParam('senha');

				$dbAdapter = Zend_Db_Table::getDefaultAdapter();
				$adapter = new Zend_Auth_Adapter_DbTable($dbAdapter);

				$adapter->setTableName('adm_usuario')
				->setIdentityColumn('login')
				->setCredentialColumn('senha')
				->setIdentity($usuario)
				->setCredential($senha)
				->setCredentialTreatment('MD5(?)');;

				$auth = Zend_Auth::getInstance();
				$result = $auth->authenticate($adapter);

				if ($result->isValid()) {
					$storage = $auth->getStorage();
					$storage->write($adapter->getResultRowObject(null,'senha'));
					$this->_redirect('login');
				}else{
					$this->redirect('/login/logar');
				}

			}
		}else{
			if(Zend_Auth::getInstance()->hasIdentity()){
				$this->redirect('');
			}
		}
	}


}
