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
        <h1>Messages<small class="text-warning">Flash</small></h1>
        
        <div class="text-warning">
            <blockquote>
        <?php
            include './models/IMessage.php';
            include'./models/Message.php';
            include './models/FlashMessage.php';
        
            $flashMessage = new FlashMessage();
            
            $messages = $flashMessage-getAllMessage();
            
            print_r($messages);
        ?>
                </blockquote>
        </div>
    </body>
</html>
