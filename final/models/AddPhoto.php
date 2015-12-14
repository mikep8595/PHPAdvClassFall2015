<?php

/**
 * Function for adding a photo to a database
 *
 * @author Frank
 */
class AddPhoto {
    private $db;

    function __construct() {
        
        $util = new Util();
        $dbo = new DB($util->getDBConfig());
        $this->setDb($dbo->getDB());        
    }

    private function getDb() {
        return $this->db;
    }

    private function setDb($db) {
        $this->db = $db;
    }
    
    public function add($userID, $filename) {
        
        $stmt = $this->getDb()->prepare("INSERT INTO photos set user_id = :user_id, filename = :filename, created = now()");

        $binds = array(
            ":user_id" => $userID,
            ":filename" => $filename
        );

        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
           return true;
        }
        return false;
        
    }
    
    public function delete($filename, $user_id) {
        $fileEXP = explode('.', $filename);
        $file = $fileEXP[0];
        $fileDir = '.' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $filename;
        
        $stmt = $this->getDb()->prepare("SELECT * FROM photos WHERE filename = :filename");
        
        $binds = array(
            ':filename' => $file
        );
        
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($results['user_id'] === $user_id){
                $del = $this->getDb()->prepare("DELETE FROM photos WHERE filename = :filename and user_id = :user_id");

                $delBinds = array(
                    ":filename" => $file,
                    ":user_id" => $user_id
                );
                
                if ($del->execute($delBinds) && $del->rowCount() === 1){
                    if(unlink($fileDir)){
                        return 'File Deleted Succesfully'; 
                    }
                    else{
                        return 'File not unlinked';
                    }
                }
                else{
                    return 'Error when file deleted'; 
                }
            }
            
            else{
                return 'You do not have permision to delete this file.';
            }
        }
        else {
            return $file;
        }
    }
}
