<div style="float: right;">          
    <?php if (array_key_exists('user_id', $_SESSION)):?>
        <?php if ($_SESSION['user_id'] !== NULL):?>
            <form action="#" method="GET">
                <input type="submit" name="logout" class="btn btn-primary" value="Logout"/>                      
            </form>
            <p>UserID = <?php echo $_SESSION['user_id'];?></p>
            <input hidden="true" type="text" name="ID" value="<?php echo $_SESSION['user_id'];?>" />
        <?php endif; ?>
    <?php endif; ?>

    <?php if (!array_key_exists('user_id', $_SESSION)):?>
            <form action="login.php">
                <input type="submit" name="logout" class="btn btn-primary" value="Login"/>                      
            </form>
    <?php endif; ?>
</div>
