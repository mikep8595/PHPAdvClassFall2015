<?php
/**
 * Description of Login
 *
 * @author GFORTI
 */
class Login {
    private $db;

    function __construct() { //Used to create new databases objects for use in the function.
        
        $util = new Util();
        $dbo = new DB($util->getDBConfig());
        $this->setDb($dbo->getDB());        
    }

    private function getDb() { //Get for the Database
        return $this->db;
    }

    private function setDb($db) { //Sets the Database
        $this->db = $db;
    }
    
    public function loginChk ($email, $password) { // Function to check verify the login information, need paramaters $email and $password
        $stmt = $this->getDb()->prepare("SELECT * FROM users WHERE email = :email");
        
        $binds = array(
            ":email" => $email,            
        );
        
        if ($stmt->execute($binds) && $stmt->rowCount() > 1) {
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $results['password'])){
                
                return $results['user_id'];
            }
        }
        
        return 0;
    }
}
