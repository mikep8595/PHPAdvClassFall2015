
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
        <a class="navbar-brand" href="#">Contacts</a>
      </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
              <li><a href="./index.php">Table</a></li>
              <li><a href="./add-address.php">Add</a></li>
          </ul>
      </div>
    </div>
</nav>
<?php
include './views/success-alert.php';
?>
<div class="container" width="50%" style="padding-bottom: 15px;">
    <h1>Add Address</h1>
    <form action="#" method="post"> 
        <div class="form-group <?php echo $fullnamegroup_success; ?>" id="fullnameform">
            <label for="fullname">Name</label>
            <input name="fullname" value="<?php echo $fullname; ?>" type="text" class="form-control" id="fullname" placeholder="Jane Doe" aria-describedby="fullnameStatus"/>
            <?php $fullname_success ?>
        </div>
        <div class="form-group <?php echo $emailgroup_success; ?>">
            <label for="email">Email address</label>
            <input name="email" value="<?php echo $email; ?>" type="email" class="form-control" id="email" placeholder="placeholder@email.com" />
        </div>
        <div class="form-group <?php echo $addressline1group_success; ?>">
            <label for="addressline1">Address</label>
            <input name="addressline1" value="<?php echo $addressline1; ?>" type="text" class="form-control" id="addressline1" placeholder="50 Green St." />
        </div>
        <div class="form-group <?php echo $citygroup_success; ?>">
            <label for="city">City</label>
            <input name="city" value="<?php echo $city; ?>" type="text" class="form-control" id="city" placeholder="Greenville" />
        </div>
        <div class="form-group <?php echo $stategroup_success; ?>">
            <label for="state">State</label>
            <input name="state" value="<?php echo $state; ?>" type="text" class="form-control" id="state" placeholder="RI" maxlength="2"/>
        </div>
        <div class="form-group <?php echo $zipgroup_success; ?>">
            <label for="zip">Zip</label>
            <input name="zip" value="<?php echo $zip; ?>" type="text" class="form-control" id="zip" placeholder="02889" maxlength="5"/>
        </div>
        <div class="form-group <?php echo $birthdaygroup_success; ?>">
            <label for="date">Birthday</label>
            <input name="birthday" value="<?php echo $birthday; ?>" type="date" class="form-control" id="date" placeholder="Date" />
        </div>
        <input type="submit" value="submit" class="btn btn-primary" />              
    </form>
</div>
