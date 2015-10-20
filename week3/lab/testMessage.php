<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>Messages<small class="text-primary">Success</small></h1>
        <div class="text-primary">
            <blockquote>
        <?php
            include'./models/IMessage.php';
            include'./models/Message.php';
            
            $message = new Message();
            
            $message->addMessage('test', 'yay');
            
            var_dump($message->getAllMessages());
            echo '<br />';
            var_dump($message instanceof IMessage);
            echo '<br />';
            var_dump($message->removeMessage('test'));
            echo '<br />';
            var_dump($message->getAllMessages());

            

            
            
                    
            //if (isset($test = $message->getAllMessages('test'))) {
               // foreach ($msg as $test){
               //     echo $msg;
              //  }
                
            //}
        ?>
            </blockquote>
        </div>
    </body>
</html>
