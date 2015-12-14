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
        <?php include'./templates/head-links.php'; ?>
    </head>
    <body>
        <?php
        
        require_once './autoload.php'; 
        
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
                header('Location: index.php'); // and go to the admin page.

                exit();
            }
            else{
                $message = 'Login failed'; // OR display a failiure mail.

            }
        }
        
        ?>
        <?php include './templates/nav-bar.php'; ?>
        <?php include './templates/login-form.html.php'; ?>
    </body>
</html>
