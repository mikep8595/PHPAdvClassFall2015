<!DOCTYPE html>

<!-- Contains the form for adding files.-->

<div class="container-fluid" width="75%">
    <form enctype="multipart/form-data" action="add-file.php" method="POST">
        <label for="upfile">Send this file: </label>
        <input name="upfile" type="file" class="" id="upfile"/>   
        <input type="submit" value="Send File" class="btn btn-default"/>
    </form>
</div>
