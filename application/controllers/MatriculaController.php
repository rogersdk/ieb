<?php
class MatriculaController extends Zend_Controller_Action{

	public function init(){
		$this->_modelo = new Application_Model_Matricula();
		$this->_modeloPessoa = new Application_Model_Pessoa();
		$this->_modeloClasse = new Application_Model_Classe();

		$this->view->tituloModelo = 'Matricula';

		$this->view->controllerName = $this->getRequest()->getControllerName();
		$this->view->moduleName = $this->getRequest()->getModuleName();
		$this->view->actionName = $this->getRequest()->getActionName();

		$this->view->classes = $this->_modeloClasse->fetchAll()->toArray();

		$this->initView();
	}

	public function indexAction(){
		$this->view->lista = $this->_modelo->fetchAll()->toArray();
		$select = $this->_modelo->select()
		->setIntegrityCheck(false)
		->from(array('mat'=>'adm_matricula'))
		->join(array('clas'=>'adm_classe'),'clas.id = mat.classeId',array('clas.nome as classe'))
		->join(array('pes'=>'adm_pessoa'),'pes.id = mat.pessoaId',array('pes.nome as aluno'));
		$this->view->lista = $this->_modelo->fetchAll($select)->toArray();
	}

	public function novaAction(){
		$id = $this->getRequest()->getParam('id');

		if($id > 0){
			$this->view->aluno = $this->_modeloPessoa->find($id)->current();
		}

		if($this->getRequest()->isPost()){
			$valoresFiltrados = $this->filterParamValues($this->getRequest()->getParams());
			unset($valoresFiltrados['aluno']);

			if( $this->_modelo->find($valoresFiltrados['pessoaId'],$valoresFiltrados['classeId'])->current()== null ){
				$this->_modelo->insert($valoresFiltrados);

				$this->_helper->flashMessenger->addMessage(array('success'=>'Adicionado com Sucesso!'));
				$this->_helper->_redirector('index');
			}else{
				$this->_helper->flashMessenger->addMessage(array('warning'=>'Usuário já matriculado nesta classe!'));
				$this->_helper->_redirector('index');
			}
		}
	}

	public function adicionarAction(){
		$this->view->alunos = $this->_modeloPessoa->fetchAll()->toArray();
		if($this->getRequest()->isPost()){
			$valoresFiltrados = $this->filterParamValues($this->getRequest()->getParams());

			if($this->_modelo->insert($valoresFiltrados)){
				$this->_helper->flashMessenger->addMessage(array('success'=>'Matricula efetuada com sucesso!'));
			}else{
				$this->_helper->flashMessenger->addMessage(array('warning'=>'Erro ao efetuar Matricula!'));
			}
			
			
			$this->_helper->_redirector('index');
		}
	}
	
	public function removerAction(){
		$this->_helper->layout()->disableLayout(); 
		$this->_helper->viewRenderer->setNoRender(true);
		
		$pessoaId = $this->getRequest()->getParam('pessoaId');
		$classeId = $this->getRequest()->getParam('classeId');
		
		
		
	}

	public function filterParamValues($data = array()){
		unset($data['module']);
		unset($data['controller']);
		unset($data['action']);
		return $data;
	}
}