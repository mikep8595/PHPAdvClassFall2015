<?php

/**
 * Description of FlashMessage
 *
 * @author Frank
 */
class FlashMessage extends Message{
    public function __construct() {
        if ( !isset( $_SESSION['flashmessage']) ){
            $_SESSION['flashmessage']=array();
        }
        
        $this->message = $_SESSION['flashmessages'];
    }
    
    public function addMessage($key, $msg) {
        parent::addMessage($key, $msg);
        $_SESSION['flashmessages'] [$key] = $msg;
    }
    
    
    public function removeMessage($key) {
        parent::removeMessage($key);
        unset($_SESSION['flashmessages'][$key]);
    }
    
}
