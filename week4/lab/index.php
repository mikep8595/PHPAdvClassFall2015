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
            //Creates new instances of the classes.
            $fHandler = new FileHandler();
            $util = new Util();
            
            //grab directory name
            $folder = './uploads';
             
            $file= filter_input(INPUT_GET, 'delete'); // brings in the email..
            
            //checks if it is a directory
            if(is_dir('./uploads')){
                $directory = scandir('./uploads'); //scan the directory and open the create a array of all the files inside.
            }
            else{
                mkdir('./uploads'); // if not make the directory
                header('Location: index.php'); // return to the index
            }
            if(isset($file)) //if $file is set...
            {
                if ( $util->isGetRequest() ) // if a get request is gotten. 
                {
                    //attempt to delete the file.
                    $deleted = unlink($folder.DIRECTORY_SEPARATOR.$file);
                    if ($deleted === true)
                    {
                        $message = "Message Deleted";                    
                    }
                    else
                    {
                       $message = "File not deleted";                   
                    }
                }
            }
           
            
        ?>
        <?php include './templates/messages.html.php';?>
        <?php include './templates/nav-bar.php';?>
        <?php include './templates/file-list-form.php'; ?>
    </body>
</html>
