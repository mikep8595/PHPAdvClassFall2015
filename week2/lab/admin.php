<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php require_once './autoload.php'; ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <?php require './templates/head-links.php'; ?>
    </head>
    <body>
        <?php
        
     
            $util = new Util();
            if ( $util->isPostRequest() ) {
                
                if (isset ($_SESSION['user_id'])){
                    session_destroy();
                    header('Location: ./index.php');
                    exit();
                }
            }
        ?>
        <?php include './templates/nav-bar.php'; ?>
        
        <form action="#" method="post">
            <input type="submit" value="Loggout" class="btn btn-primary" />
            
        </form>
    </body>
</html>
