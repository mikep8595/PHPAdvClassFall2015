<?php
/**
 * Class that contains the resources for making any changes to the database
 *
 * @author Mike
 */
require_once './autoload.php';

//TODO: Add more error checking capabilites to the dataCheck function
//ex. Proper syntax, etc.
class CorpsResoruce implements IRestModel{
    
    
    private $db;

    function __construct() {
        //sets connection to the databse
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
        //Setups up the insert for SQL for post function as well as binding JSON data provided by the data array to the statement
        $stmt = $this->db->prepare("INSERT INTO corps SET corp = :corp, incorp_dt = :incorp_dt, email = :email, owner = :owner, phone = :phone, location = :location");
        $binds = array(
            ":corp" => $data['corp'],
            ":incorp_dt" => $data['incorp_dt'],
            ":email" => $data['email'],
            ":owner" => $data['owner'],
            ":phone" => $data['phone'],
            ":location" => $data['location']
        );
        
        //Check used to see if all the necessary forms have been filled.
        if($this->dataCheck($data) === true){
            if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
                return 'Corporation Added';
                // Displays message on succesfull addition...
            } else {
                throw new Exception('Corporation could not be added');
                //.. and throws an exception for faliure.
            }
        }
    }
       
    public function get($id) {
       //Creates statement used to get specific entry from the datbase based on an id given via endpoint
        $stmt = $this->db->prepare("SELECT * FROM corps where id = :id");
        $binds = array(":id" => $id);
        
        
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            //if successfull it will fetch the info generated..
        } else {
            throw new InvalidArgumentException('Corporation ID ' . $id . ' was not found');
            //or throws and exception
        }
        
        return $results;
                
    }
    
    public function getAll() {
        //Very similar statment to get(), except this function requires no parameters and returns all entries in the db.
        $stmt = $this->db->prepare("SELECT * FROM corps");
                
        $results = array();      
        if ($stmt->execute() && $stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        return $results;
    }
    
    public function put($id, $data)
    {
        //Put function uses a stament written to update a pre-existing db entry.
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
        //once more checking that all neccesary form objects are filled.
        if($this->dataCheck($data) === true){
            if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
                return 'Corporation Updated';
            } else {
                throw new Exception('Corporation could not be updated');
            }
        }
        
    }
    
    public function delete($id) {
        //Delete uses a statment written to delete from the db where the id matches the one located in the endpoint.
        $stmt = $this->db->prepare("DELETE FROM corps WHERE id = :id");
        $binds = array(":id" => $id);

        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            return 'Corporation Deleted';
        } else {
            throw new InvalidArgumentException('Corporation ID ' . $id . ' was not found');
        }
    }
    
    public function dataCheck($data) {
        //The dataCheck function uses the JSON data to make sure that all form objects were properly filled out.
        $errors = array();
        
        if ($data['corp'] === '' ){
            $errors[] = 'No Corporation Name ';
        }
        if ($data['incorp_dt'] === '' ){
            $errors[] = 'No Incorporation Date ';
        }
        if ($data['email'] === '' ){
            $errors[] = 'No Email ';
        }
        if ($data['owner'] === '' ){
            $errors[] = 'No Owner ';
        }
        if ($data['phone'] === '' ){
            $errors[] = 'No Phone ';
        }
        if ($data['location'] === '' ){
            $errors[] = 'No Location';
        }
        if (count($errors) > 0)
        {
            throw new Exception('Form not fully filled');
        }
        else{
            return true;
        }
        
    }
}
