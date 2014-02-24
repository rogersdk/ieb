<?php
class Application_Model_PessoaHasClasse extends Zend_Db_Table_Abstract{
	protected $_name = 'adm_pessoa_has_classe';
	
	protected $_referenceMap	= array(
        'Pessoa' => array(
            'columns'           => array('pessoaId'),
            'refTableClass'     => 'Pessoa',
            'refColumns'        => array('pessoaId'),
			'onDelete'          => self::RESTRICT,
            'onUpdate'          => self::CASCADE
        ),
        
        'Classe' => array(
            'columns'           => array('classeId'),
            'refTableClass'     => 'Classe',
            'refColumns'        => array('classeId'),
        	'onDelete'          => self::RESTRICT,
            'onUpdate'          => self::CASCADE
        )
    );
    
    
	
	
}