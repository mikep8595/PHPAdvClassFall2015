<?php

/**
 * Description of Message
 *
 * @author Frank
 */
class Message implements IMessage {
    
    protected $messages = array();
    
    public function addMessage($key, $msg){
        
        $this->messages [$key] = $msg;

    }
    
     public function removeMessage($key){
         unset($this->messages[$key]);
     }
    
    public function getAllMessages(){
        return $this->messages;
    }
    
    public function removeAllMessages() {
        $this->messages = array();
    }
}
