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
    </head>
    <body>
        <?php
        
            if (isset($_SESSION['user_id'])){
                
            }
            else{
                header('Location: ./index.php');
                exit();
            }
     
            $util = new Util();
            if ( $util->isPostRequest() ) {
                if (!isset ($_SESSION['user_id'])){
                    header('Location: ./index.php');
                    exit();
                }
            }
        ?>
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
                      <li><a href="./admin.php">Admin</a></li>                                                                      
                  </ul>
              </div>
            </div>

        </nav>
        
        <form action="#" method="post">
            <input type="submit" value="Loggout" class="btn btn-primary" />
            
        </form>
    </body>
</html>
