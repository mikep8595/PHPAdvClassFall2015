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
        // put your code here
        ?>
        <?php include './templates/index-form.php';?>
        <?php include './templates/nav-bar.php';?>
        
        Verb/HTTP Method:<br />
        <select name="verb">
            <option value="GET">GET</option>
            <option value="POST">POST</option>
            <option value="PUT">PUT</option>
            <option value="DELETE">DELETE</option>
        </select>
    </body>
</html>
