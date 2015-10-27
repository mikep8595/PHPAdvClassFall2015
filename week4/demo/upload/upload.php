<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">        
    </head>
     <body>
<?php

/*
 * make sure php_fileinfo.dll extension is enable in php.ini --- Located in Apache -- Not good for default php servers, must be secure
 */

try {
    
    // Undefined | Multiple Files | $_FILES Corruption Attack
    // If this request falls under any of them, treat it invalid.
    if ( !isset($_FILES['upfile']['error']) || is_array($_FILES['upfile']['error']) ) {       
        throw new RuntimeException('Invalid parameters.');
    }

    // Check $_FILES['upfile']['error'] value.
    switch ($_FILES['upfile']['error']) {
        case UPLOAD_ERR_OK: //continues
            break;
        case UPLOAD_ERR_NO_FILE: // if not file
            throw new RuntimeException('No file sent.');
        case UPLOAD_ERR_INI_SIZE: // if their is a size issue (over 2 mb)
        case UPLOAD_ERR_FORM_SIZE:
            throw new RuntimeException('Exceeded filesize limit.');
        default:
            throw new RuntimeException('Unknown errors.');
    }
     
    // You should also check filesize here. 
    if ($_FILES['upfile']['size'] > 1000000) { //makes sure that file does not exceed certain size.
        throw new RuntimeException('Exceeded filesize limit.'); // throws exception.
    }

    // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
    // Check MIME Type by yourself. -- MIME type is the file extension.
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $validExts = array(
                    'jpg' => 'image/jpeg',
                    'png' => 'image/png',
                    'gif' => 'image/gif'
                );    
    //when php access a file, is puts it in a temp folder, so to make sure it isnt harmfull.
    $ext = array_search( $finfo->file($_FILES['upfile']['tmp_name']), $validExts, true );
    // checks that the file type is actually valid...
    
    if ( false === $ext ) { //.. and if not it throws an excemption.
        throw new RuntimeException('Invalid file format.');
    }

    // You should name it uniquely.
    // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
    // On this example, obtain safe unique name from its binary data.
    
    $fileName =  sha1_file($_FILES['upfile']['tmp_name']); // will use a sha1 file, hashing the temp name for the file. 
    $location = sprintf('./uploads/%s.%s', $fileName, $ext); // sprintf function send the file to uploads %s means string and is where filename and ext is placed.
    
    if(!is_dir('./uploads')){
        mkdir('./uploads');
    }
    
    if ( !move_uploaded_file( $_FILES['upfile']['tmp_name'], $location) ) { //this will move the temp file to a location of your choice
        throw new RuntimeException('Failed to move uploaded file.'); // if not it throws and exceptions
    }

    echo 'File is uploaded successfully.'; // or its runs succesfully.

} catch (RuntimeException $e) {

    echo $e->getMessage();

}
?>
  </body>
</html>