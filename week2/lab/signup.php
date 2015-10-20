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
       
            $email= filter_input(INPUT_POST, 'email');
            $password = filter_input(INPUT_POST, 'password');
            
            
            $util = new Util();
            $validtor = new Validator();
            $signup = new Signup();
            
            $errors = array();
            
            if ( $util->isPostRequest() ) {
             
                if ( !$validtor->emailIsValid($email) ) {
                    $errors[] = 'Email is not valid';
                }
                if ( $signup->emailChk($email)){
                    $errors[] = 'Email is already in use';
                }
                if ( !$validtor->passIsValid($password) ) {
                    $errors[] = 'Password is not valid';
                }
                
                
                if ( count($errors) <= 0) {
                
                    if ( $signup->save($email,$password) ) {
                        $message = 'Signup complete';
                    } else {
                        $message = 'Signup failed';
                    }
                }
                
                
            }
            
            
            
            
        ?>
        
        <?php include './templates/errors.html.php'; ?>
        <?php include './templates/messages.html.php'; ?>
        <?php include './templates/nav-bar.php'; ?>
        
        <h1>Signup Form</h1>
        
        <?php include './templates/login-form.html.php'; ?>
        
    </body>
</html>
