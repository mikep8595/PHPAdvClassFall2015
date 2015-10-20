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
                    $message = 'Login successful';
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
        <?php include './templates/nav-bar.php'; ?>
        
        <h1>Login Form</h1>
        
        <?php include './templates/login-form.html.php'; ?>
        
    </body>
</html>
