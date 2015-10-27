<!DOCTYPE html>
<?php require_once './autoload.php'; ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <?php include './templates/head-links.php';?>
        
    </head>
    <body>
        <?php
            $fHandler = new FileHandler();
            $util = new Util();
            
            $folder = './uploads';
                    
            
                    
            if(is_dir('./uploads')){
                $directory = scandir('./uploads');
            }
            else{
                mkdir('./uploads');
                header('Location: index.php');
            }
            
            if ($util->isGetRequest())
            {
                
                
            }
           
            
        ?>
        <?php include './templates/nav-bar.php';?>
        <?php include './templates/file-list-form.php'; ?>
    </body>
</html>
