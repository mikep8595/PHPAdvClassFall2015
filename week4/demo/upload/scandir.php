<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        
        //DIRECTORY_SEPARATOR 
        
        $folder = './uploads';
        $directory = scandir('./uploads');
        
        //var_dump($directory);
        
        
        
        
        ?>
        
        
        <?php foreach( $directory as $file) : ?>
            <?php if (is_file($folder.DIRECTORY_SEPARATOR.$file)) : ?>
        <h1><?php echo $file; ?></h1>
                <img src="./uploads/<?php echo $file;?>" />
            <?php endif; ?>
        <?php endforeach; ?>
        
    </body>
</html>
