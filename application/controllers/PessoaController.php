<?php
class PessoaController extends Zend_Controller_Action {
	
	public function init(){
		$this->_modelo = new Application_Model_Pessoa();
		
		/**
		 * Setting up view variables
		 **/
		$this->view->tituloModelo = 'Pessoa';
		$this->view->controllerName = $this->getRequest()->getControllerName();
		$this->view->moduleName = $this->getRequest()->getModuleName();
		$this->view->actionName = $this->getRequest()->getActionName();

		$this->initView();
	}

	public function indexAction(){
		$this->view->lista = $this->_modelo->fetchAll()->toArray();
	}

	public function adicionarAction($dados = array()){
		if($this->getRequest()->isPost()){
			$valoresFiltrados = $this->filterParamValues($this->getRequest()->getParams());
			$this->_modelo->insert($valoresFiltrados);
			$this->_helper->flashMessenger->addMessage(array('success'=>'Adicionado com Sucesso!'));
			$this->_helper->_redirector('index');
		}else{
			return false;
		}
	}

	public function editarAction(){
		$id = $this->getRequest()->getParam('id');
		if($id > 0){
			if($this->getRequest()->isPost()){
				$valoresFiltrados = $this->filterParamValues($this->getRequest()->getParams());
				$this->_modelo->update($valoresFiltrados,"id = $id");
				$this->_helper->flashMessenger->addMessage(array('info'=>'Atualizado com Sucesso!'));
				$this->_helper->_redirector('index');
			}elseif($this->getRequest()->isGet()){
				$this->view->row = $this->_modelo->find($id)->current();
			}
		}
	}

	public function removerAction(){
		$id = $this->getRequest()->getParam('id');
		if($id > 0){
			$this->_modelo->delete("id = $id");	
			$this->_helper->flashMessenger->addMessage(array('warning'=>'Removido com Sucesso!'));
			$this->_helper->_redirector('index');
		}
	}

	public function filterParamValues($data = array()){
		unset($data['module']);
		unset($data['controller']);
		unset($data['action']);
		return $data;
	}
	
}