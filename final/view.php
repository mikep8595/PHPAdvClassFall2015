<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
        <?php include'./templates/head-links.php'; ?>
        <style>
            .meme {
                width: 300px; 
                border: 1px solid silver;
                padding: 0.5em;
                text-align: center;
                margin: 0.5em;
                vertical-align: middle;
            }



        </style>
    </head>
    <body>
        <?php
        require_once './autoload.php';
        $util = new Util();
        $dbc = new DB($util->getDBConfig());
        $db = $dbc->getDB();
        $photoHandler = new AddPhoto();

        $login = new Login();

        $email= filter_input(INPUT_POST, 'email'); // brings in the email..
        $password= filter_input(INPUT_POST, 'password');// and the password off the post request.
        $logout= filter_input(INPUT_GET, 'logout');
        $delete= filter_input(INPUT_GET, 'delete');
        $filename= filter_input(INPUT_GET, 'filename');
    
        if($logout == 'Logout'){
            session_destroy();
            header('Location: view.php');
        }
        
        if($delete === 'Delete'){
            $message = $photoHandler->delete($filename, $_SESSION['user_id']);
        }
        
        $files = array();
        $directory = '.' . DIRECTORY_SEPARATOR . 'uploads';
        $dir = new DirectoryIterator($directory);
        foreach ($dir as $fileInfo) {
            if ($fileInfo->isFile()) {
                $files[$fileInfo->getMTime()] = $fileInfo->getPathname();
            }
        }

        krsort($files);
        ?>
        <?php include './templates/nav-bar.php'; ?>
        <?php include './templates/login-widget.html.php'; ?>       
        <?php include './templates/messages.html.php';?>
        
        <?php foreach ($files as $key => $path):?> 
            <div class="meme"> 
                <img src="<?php echo $path; ?>" /> <br />
                <?php echo date("l F j, Y, g:i a", $key); ?>
                <!-- Place this tag where you want the share button to render. -->
                <div class="g-plus" data-action="share" data-href="<?php echo $path; ?>"></div> 
                <form action="#" method="GET" >
                    <input hidden="true" type="text" name="filename" value="<?php
                        $pieces = explode("\\", $path); 
                        echo $pieces[2];          
                        ?>" 
                    />
                    <input type="submit" name="delete" value="Delete" />
                </form>               
            </div>
        <?php endforeach; ?>

        <!-- Place this tag in your head or just before your close body tag. -->
        <script src="https://apis.google.com/js/platform.js" async defer></script>

    </body>
</html>