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
       
            $util = new Util();
            $dbc = new DB($util->getDBConfig());
            $db = $dbc->getDB();
            
            /*
            $stmt = $db->prepare("UPDATE test set dataone = :dataone, datatwo = :datatwo where id = :id");
                
            $binds = array(
                ":id" => $id,
                ":dataone" => $dataone,
                ":datatwo" => $datatwo
            );

            if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
               $result = 'Record updated';
            }*/
            
            $login = new Login();
            
            $email= filter_input(INPUT_POST, 'email');
            $password= filter_input(INPUT_POST, 'password');
            
            if ( $util->isPostRequest() ) {
                $user_id = $login->loginChk($email, $password);
                      
                if (isset($user_id)) {
                    $_SESSION['user_id'] = $user_id;  
                    header('Location: admin.php');
                    exit();
                }
                else{
                    $message = 'Login failed';
                    
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
                    <?php if (isset($_SESSION['user_id']) )  :?>

                         <li><a href="./admin.php">Admin</a></li>

                    <?php endif; ?>
                  </ul>
              </div>
            </div>

        </nav>
        <h1>Login Form</h1>
        
        <?php include './templates/login-form.html.php'; ?>
        
    </body>
</html>
