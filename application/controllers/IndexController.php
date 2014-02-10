<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        $teste = new Application_Model_Pessoa();
    	var_dump($teste->fetchAll()->toArray());
    }


}

