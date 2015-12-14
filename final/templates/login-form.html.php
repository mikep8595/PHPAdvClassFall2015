<!-- Contains form used for logging in and signing up for the users -->  
<div style="width: 40%; align:center;">
    <form action="#" method="post" class="form-group"> 
        <label for="email">Email:</label>
        <input id="email "class="form-control" type="text" name="email" value="<?php echo $email; ?>" /> <br />
        <label for="password">Password:</label>
        <input id="password" class="form-control" type="password" name="password" value="" /> <br />
        <input type="submit" value="submit" class="btn btn-primary" />
    </form>
</div>
