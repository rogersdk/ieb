<?php
class ClasseController extends Zend_Controller_Action{


	public function init(){
		$this->_modelo = new Application_Model_Classe();
		$this->_modeloPessoa = new Application_Model_Pessoa();
		$this->_modeloPessoaHasClasse = new Application_Model_PessoaHasClasse();

		/**
		 * Setting up view variables
		 **/
		$this->view->tituloModelo = 'Classe';
		$this->view->controllerName = $this->getRequest()->getControllerName();
		$this->view->moduleName = $this->getRequest()->getModuleName();
		$this->view->actionName = $this->getRequest()->getActionName();
		$this->view->professores = $this->_modeloPessoa->fetchAll()->toArray();

		$this->initView();
	}

	public function indexAction(){
		$this->view->lista = $this->_modelo->fetchAll()->toArray();
	}

	public function adicionarAction($dados = array()){
		if($this->getRequest()->isPost()){
			$valoresFiltrados = $this->filterParamValues($this->getRequest()->getParams());

			$professores = $valoresFiltrados['professor'];
			unset($valoresFiltrados['professor']);

			$this->_modelo->insert($valoresFiltrados);
			$lastInsertId = $this->_modelo->getAdapter()->lastInsertId();
			if($lastInsertId){
				foreach($professores as $p){
					$pessoaHasClasseDados = array(
						'pessoaId'	=>	$p,
						'classeID'	=>	$lastInsertId,
						'data'		=>	date('Y-m-d')
					);
					$this->_modeloPessoaHasClasse->insert($pessoaHasClasseDados);
				}
			}
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

				$professores = $valoresFiltrados['professor'];
				unset($valoresFiltrados['professor']);

				$retornoEditar = $this->_modelo->update($valoresFiltrados,"id = $id");

				$this->_modeloPessoaHasClasse->delete("classeId = $id");

				foreach($professores as $p){
					if($p > 0){
						$pessoaHasClasseDados = array(
						'pessoaId'	=>	$p,
						'classeId'	=>	$id,
						'data'		=>	Zend_Date::DATE_FULL
						);
							
						$this->_modeloPessoaHasClasse->insert($pessoaHasClasseDados);
					}		
				}

				$this->_helper->flashMessenger->addMessage(array('info'=>'Atualizado com Sucesso!'));
				$this->_helper->_redirector('index');
			}elseif($this->getRequest()->isGet()){
				$this->view->row = $this->_modelo->find($id)->current();

				$select = $this->_modeloPessoa->select()
				->setIntegrityCheck(false)
				->from(array('p'=>'adm_pessoa'),array('id','nome'))
				->join(array('pc'=>'adm_pessoa_has_classe'), 'p.id = pc.pessoaId',array('pessoaId','classeId'))
				->where("pc.classeId = $id");

				$todosProfessores = $this->_modeloPessoa->fetchAll($select)->toArray();
				$retorno = array();

				if($todosProfessores){
					foreach($this->_modeloPessoa->fetchAll($select)->toArray() as $r){
						$retorno[$r['id']] = $r['nome'];
					}
				}
				$this->view->professoresAtuais = $retorno;


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
