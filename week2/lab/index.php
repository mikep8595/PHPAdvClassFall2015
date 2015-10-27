<?php require_once './autoload.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <?php 
            require './templates/head-links.php';
        ?>
    </head>
    <body>
        <?php
            // Loads new instances of classes
            $util = new Util();
            $dbc = new DB($util->getDBConfig());
            $db = $dbc->getDB();
            
            $login = new Login();
            
            $email= filter_input(INPUT_POST, 'email'); // brings in the email..
            $password= filter_input(INPUT_POST, 'password');// and the password off the post request.
            
            if ( $util->isPostRequest() ) {
                $user_id = $login->loginChk($email, $password); // sets the user__id to the database information returned.
                      
                if (isset($user_id)) { // if the user_id is set..
                    $_SESSION['user_id'] = $user_id;//.. put the id into a variable in the session..
                    $message = 'Login successful'; //.. create a $message which will display in the header..
                    header('Location: admin.php'); // and go to the admin page.
                  
                    exit();
                }
                else{
                    $message = 'Login failed'; // OR display a failiure mail.
                    
                }
            }
        ?>
        <!-- Loads page elements -->
        <?php include './templates/errors.html.php'; ?>
        <?php include './templates/messages.html.php'; ?>
        <?php include './templates/nav-bar.php'; ?>
        
        <h1>Login Form</h1>
        
        <?php include './templates/login-form.html.php'; ?>
        
    </body>
</html>
