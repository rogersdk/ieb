<?php
class Zend_View_Helper_FlashMessages extends Zend_View_Helper_Abstract
{
    public function flashMessages(){
        $messages = Zend_Controller_Action_HelperBroker::getStaticHelper('FlashMessenger')->getMessages();
        
        $output = '';
        if (!empty($messages)) {	
        	$alertClassMessage = $this->setAlertClass($messages);
        	
        	$output = '<div class="col-md-3 pull-right alert '.$alertClassMessage.'">';
            foreach ($messages as $message) {
				$output .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
            	$output .= current($message);
            }
            $output .= '</div>';
        }
        
        return $output;
    }
    
    public function setAlertClass($messages){
    	$key = array_keys($messages[0]);
    	switch($key[0]){
    		case 'success':
    			return 'alert-success';
    		case 'warning':
    			return 'alert-warning';
    		case 'info':
    			return 'alert-info';
    		case 'danger':
    			return 'alert-danger';
    		default:
    			return '';
    	}
    }
    
}