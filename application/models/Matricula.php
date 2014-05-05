<?php
class Application_Model_Matricula extends Zend_Db_Table_Abstract{
	protected $_name = 'adm_matricula';

	protected $_primary = array('pessoaId', 'classeId');
}