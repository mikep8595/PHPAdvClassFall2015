<?php

/**
 * Description of FlashMessage
 *
 * @author Frank
 */
class FlashMessage extends Message{
    public function __construct() {
        if ( !isset( $_SESSION['flashmessage']) ){
            $this->setFlashMessages();
        }      
        $this->message = $_SESSION['flashmessages'];
    }
    
    public function addMessage($key, $msg) {
        parent::addMessage($key, $msg);
        $this->setFlashMessages();
    }
    
    
    public function removeMessage($key) {
        parent::removeMessage($key);
        $this->setFlashMessages();
    }
    
    public function getAllMessages(){
        $messages = $_SESSION['flashmessages'];
        $this->removeAllMessages();
        return $messages;
    }
    
    public function removeAllMessages() {
         parent::removeAllMessages($key);
        $this->setFlashMessages();
    }
    
    private function setFlashMessages(){
         $_SESSION['flashmessages'] = $this->messages;
        
    }
    
     
}
