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
            //create a new instance of classes.
            $upload = new FileHandler();
            $util = new Util();
            
            //Grabs file directory
            $folder = './uploads';
            
            //$upfile= filter_input(INPUT_POST, 'upfile');
            
            //if an image has been posted
            if( $util->isPostRequest() )
            {
                //add it.
               include './templates/upload.php';
            }
            
        ?>
        <!-- include page elements.-->
        <?php include './templates/messages.html.php'; ?>
        <?php include './templates/nav-bar.php';?>
        <?php include './templates/add-file-form.php';?>
    </body>
</html>
