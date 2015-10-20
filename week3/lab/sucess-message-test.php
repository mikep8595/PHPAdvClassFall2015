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
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    </head>
    <body>
        <h1>Messages<small class="text-success">Success</small></h1>
        <div class="text-success">
            <blockquote>
        <?php
            include './models/IMessage.php';
            include'./models/Message.php';
            include './models/SucessMessage.php';


            $sucessMessage = new SucessMessage();

            $sucessMessage->addMessage('test', 'yay');

            var_dump($sucessMessage->getAllMessages());
            echo '<br />';
            var_dump($sucessMessage instanceof IMessage);
            echo '<br />';
            var_dump($sucessMessage->removeMessage('test'));
            echo '<br />';
            var_dump($sucessMessage->getAllMessages());
        ?>
        </blockquote>
        </div>
        
    </body>
</html>
