<?php

/**
 *
 * @author mpetrarca
 */
interface IMessage {
    // add 3 function names
    
    public function addMessage($key, $msg);

    public function removeMessage($key);

    public function getAllMessages();
    
    public function removeAllMessages();
}
