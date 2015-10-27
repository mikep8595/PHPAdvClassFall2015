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
        <?php require './templates/head-links.php'; ?> <!-- Used to bring in bootstrap-->
    </head>
    <body>
        <?php
        
     
            $util = new Util();
            if ( $util->isPostRequest() ) { //if the their has been a post request...
                
                if (isset ($_SESSION['user_id'])){ //and there has a user_id set in the session ..
                    session_destroy();// destroy the sesssion because we want to log out.
                    header('Location: ./index.php'); // and bring us back to the login page.
                    exit();
                }
            }
        ?>
        <?php include './templates/nav-bar.php'; ?> <!-- bring in the nav bar -->
        
        <form action="#" method="post"> 
            <input type="submit" value="Loggout" class="btn btn-primary" />
            <!-- and make the loggout button -->
        </form>
    </body>
</html>
