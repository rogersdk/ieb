<?php
class Application_Model_Pessoa extends Zend_Db_Table_Abstract{
	protected $_name = 'adm_pessoa';
	
	protected $_dependentTables = array('Application_Model_Classe');
/*	
	protected $_referenceMap = array(
	 	'Classes' =>	array(
	 		'columns'	=>	'id',
	 		'refTableClass'	=>	'Application_Model_Classe',
	 		'refColumns'	=>	'nome'
	 	),
	 );
	 */
}