<?php if (isset($alert) && $alert === true) : ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Success!</strong> File entered correctly!
    </div>
<?php endif; ?>

<?php if (isset($alert) && $alert === false) : ?>
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Warning!</strong> Errors found. Data not entered.
    </div> 
<?php endif; ?>


