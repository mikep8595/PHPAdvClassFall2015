<!DOCTYPE html>
<!--
    Contains the HTML for the nav bar used in all the pages 
-->

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
        <a class="navbar-brand" href="#">Meme Generator</a>
      </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a href="./index.php">Upload</a></li>
            <li><a href="./view.php">View File</a></li> 
            <?php if (!array_key_exists('user_id', $_SESSION)):?>                      
                <li><a href="./signup.php">Signup</a></li>                         
            <?php endif; ?>
          </ul>
      </div>
    </div>

</nav>