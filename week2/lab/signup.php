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
        <nav class="navbar navbar-default">
            <div class="container-fluid">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Contacts</a>
              </div>
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                      <li><a href="./index.php">Login</a></li>
                      <li><a href="./signup.php">Signup</a></li>
                      <?php 
                        if (isset($_SESSION['user_id']) )
                        {
                            echo '<li><a href="./admin.php">admin</a></li>';
                            
                        }
                      ?>
                  </ul>
              </div>
            </div>

        </nav>
        <h1>Signup Form</h1>
        
        <?php include './templates/login-form.html.php'; ?>
        
    </body>
</html>
