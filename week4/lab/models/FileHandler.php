<?php

/**
 * Class for handling files and directories.
 *
 * @author Mike
 */
class FileHandler {
    /**
     * A method for uploading files.
     *
     * @return string
     */
    function upload($fileKey){
        try {   
            
            $ext = $this->fileErrs($fileKey);
            
            $fileName =  sha1_file($_FILES[$fileKey]['tmp_name']); // will use a sha1 file, hashing the temp name for the file. 
            $location = sprintf('./uploads/%s.%s', $fileName, $ext); // sprintf function send the file to uploads %s means string and is where filename and ext is placed.

            if(!is_dir('./uploads')){
                mkdir('./uploads');
            }

            if ( !move_uploaded_file( $_FILES[$fileKey]['tmp_name'], $location) ) { //this will move the temp file to a location of your choice
                throw new RuntimeException('Failed to move uploaded file.'); // if not it throws and exceptions
            }

            echo 'File is uploaded successfully.'; // or its runs succesfully.

        } catch (RuntimeException $e) {

            $error = $e->getMessage();
            return $error;
        }
        
    }
    
    function getFileExt ($fileKey){
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $exts = array (
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'pjpeg' => 'image/pjpeg',
            'plain' => 'text/plain',
            'html' => 'text/html',
            'pdf' => 'application/pdf',
            'msword' => 'application/msword',
            'vnd.ms-excel' => 'application/vnd.ms-excel'                              
        );
        
        $fileExt = array_search( $finfo->file($_FILES[$fileKey]['tmp_name']), $exts);
        
        return $fileExt;
    }
    
    public function getFileSize ($fileKey){
        $size = $_FILES[$fileKey]['size'];
        return $size;
    }
             
    private function fileErrs($errFile){
        // Undefined | Multiple Files | $_FILES Corruption Attack
            // If this request falls under any of them, treat it invalid.
            if ( !isset($_FILES[$errFile]['error']) || is_array($_FILES[$errFile]['error']) ) {       
                throw new RuntimeException('Invalid parameters.');
            }

            // Check $_FILES[$errFile]['error'] value.
            switch ($_FILES[$errFile]['error']) {
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
            if ($this->getFileSize($errFile) > 1000000) { //makes sure that file does not exceed certain size.
                throw new RuntimeException('Exceeded filesize limit.'); // throws exception.
            }   
            // DO NOT TRUST $_FILES[$fileKey]['mime'] VALUE !!
            // Check MIME Type by yourself. -- MIME type is the file extension.
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $validExts = array(
                            'jpg' => 'image/jpeg',
                            'png' => 'image/png',
                            'gif' => 'image/gif'
                        );    
            //when php access a file, is puts it in a temp folder, so to make sure it isnt harmfull.
            $ext = array_search( $finfo->file($_FILES[$errFile]['tmp_name']), $validExts, true );
            // checks that the file type is actually valid...

            if ( false === $ext ) { //.. and if not it throws an excemption.
                throw new RuntimeException('Invalid file format.');
            }                   
            // You should name it uniquely.
            // DO NOT USE $_FILES[$fileKey]['name'] WITHOUT ANY VALIDATION !!
            // On this example, obtain safe unique name from its binary data.
            
            return $ext;

    }
}
