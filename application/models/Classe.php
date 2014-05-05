<?php
class Application_Model_Classe extends Zend_Db_Table_Abstract{
	protected $_name = 'adm_classe';
	
	 protected $_dependentTables = array('Application_Model_PessoaHasClasse');
	 /*
	 protected $_referenceMap = array(
	 	'Professor' =>	array(
	 		'columns'	=>	'nome',
	 		'refTableClass'	=>	'Application_Model_Pessoa',
	 		'refColumns'	=>	'nome'
	 	),
	 );
	 */
}