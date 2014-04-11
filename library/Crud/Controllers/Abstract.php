<?php
class Crud_Controllers_Abstract extends Zend_Controller_Action{
	
	
	protected $_modelo = '';
	protected $_rowsPerPage = '';
	
	protected $_mensagens = array(
		'adicionado'	=>	'Infromação Adicionada com Sucesso!',
		'editado'		=>	'Infromação Atualizada com Sucesso!',
		'removido'		=>	'Infromação Removida com Sucesso!'
	);
	
	
	public function indexAction(){
		
	}
	

}

