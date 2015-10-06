<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        
        $date = filter_input(INPUT_POST, 'dob');
                
        ?>
        
        <form action="#" method="post">            
            Birthday : <input type="date" name="dob" value="<?php echo $date; ?>" />
            <input type="submit" value="submit" />
        </form>
    </body>
</html>
