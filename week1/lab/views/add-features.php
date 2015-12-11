
<?php             
    include './views/nav-bar.php';
?>
<?php
include './views/success-alert.php';
?>
<div class="container" width="50%" style="padding-bottom: 15px;">
    <h1>Add Address</h1>
    <form action="#" method="post"> 
        <div class="form-group" id="fullnameform">
            <label for="fullname">Name</label>
            <input name="fullname" value="<?php echo $fullname; ?>" type="text" class="form-control" id="fullname" placeholder="Jane Doe" aria-describedby="fullnameStatus"/>
            <?php $fullname_success ?>
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input name="email" value="<?php echo $email; ?>" type="email" class="form-control" id="email" placeholder="placeholder@email.com" />
        </div>
        <div class="form-group">
            <label for="addressline1">Address</label>
            <input name="addressline1" value="<?php echo $addressline1; ?>" type="text" class="form-control" id="addressline1" placeholder="50 Green St." />
        </div>
        <div class="form-group">
            <label for="city">City</label>
            <input name="city" value="<?php echo $city; ?>" type="text" class="form-control" id="city" placeholder="Greenville" />
        </div>
        <div class="form-group">
            <label for="state">State</label>
            <input name="state" value="<?php echo $state; ?>" type="text" class="form-control" id="state" placeholder="RI" maxlength="2"/>
        </div>
        <div class="form-group">
            <label for="zip">Zip</label>
            <input name="zip" value="<?php echo $zip; ?>" type="text" class="form-control" id="zip" placeholder="02889" maxlength="5"/>
        </div>
        <div class="form-group">
            <label for="date">Birthday</label>
            <input name="birthday" value="<?php echo $birthday; ?>" type="date" class="form-control" id="date" placeholder="Date" />
        </div>
        <input type="submit" value="submit" class="btn btn-primary" />              
    </form>
</div>
