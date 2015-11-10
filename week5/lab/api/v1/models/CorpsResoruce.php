<?php
/**
 * Description of CorpsResoruce
 *
 * @author Mike
 */
require_once './autoload.php';

class CorpsResoruce implements IRestModel{
    
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
        
    function post($data)
    {
        $stmt = $this->db->prepare("INSERT INTO corps SET corp = :corp, incorp_dt = :incorp_dt, email = :email, owner = :owner, phone = :phone, location = :location");
        $binds = array(
            ":corp" => $data['corp'],
            ":incorp_dt" => $data['incorp_dt'],
            ":email" => $data['email'],
            ":owner" => $data['owner'],
            ":phone" => $data['phone'],
            ":location" => $data['location']
        );

        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            return 'Corporation Added';
        } else {
            throw new Exception('Corporation could not be added');
        }
    }
       
    public function get($id) {
       
        $stmt = $this->db->prepare("SELECT * FROM corps where id = :id");
        $binds = array(":id" => $id);

        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            throw new InvalidArgumentException('Corporation ID ' . $id . ' was not found');
        }
        
        return $results;
                
    }
    
    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM corps");
                
        $results = array();      
        if ($stmt->execute() && $stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        return $results;
    }
    
    public function put($id, $data)
    {
        $stmt = $this->db->prepare("Update corps SET corp = :corp, incorp_dt = :incorp_dt, email = :email, owner = :owner, phone = :phone, location = :location WHERE id = :id");
        $binds = array(
            ":corp" => $data['corp'],
            ":incorp_dt" => $data['incorp_dt'],
            ":email" => $data['email'],
            ":owner" => $data['owner'],
            ":phone" => $data['phone'],
            ":location" => $data['location'],
            ":id" => $id
        );

        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            return 'Corporation Updated';
        } else {
            throw new Exception('Corporation could not be updated');
        }
        
    }
    
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM corps WHERE id = :id");
        $binds = array(":id" => $id);

        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            return 'Corporation Deleted';
        } else {
            throw new InvalidArgumentException('Corporation ID ' . $id . ' was not found');
        }
    }
}
