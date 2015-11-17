<?php
/*
 * REMINDER:
 * For Rest servers, set 'always_populate_raw_post_data = -1' so you can pass json to 
 * your rest server instead of post data.   
 * 
 * TODO:
 * Possibly feature more resources in the future.
 */

require_once './autoload.php';
$restServer = new RestServer();
//Above includes the autoloaders require as well as the first initialization of the rest server class.

try {  
    /*
     * Variables:
     * contains the variables for the resource, verb, id, and server data, all of which are found via function from the
     * rest server class
     */ 
    $resource = $restServer->getResource();
    $verb = $restServer->getVerb();
    $id = $restServer->getId();
    $serverData = $restServer->getServer_data();
       
    //configures the database local.
    $config = array(
        'DB_DNS' => 'mysql:host=localhost;port=3306;dbname=PHPAdvClassFall2015',
        'DB_USER' => 'root',
        'DB_PASSWORD' => ''
    );
    
    //creates database connection.
    $db = new PDO($config['DB_DNS'], $config['DB_USER'], $config['DB_PASSWORD']);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    
    //if corps is the resource, which it always should be.
    if ( 'corps' === $resource ) {
        $corpsResource = new CorpsResoruce();
        //A new instance of the CorpsResource class is made to make used of its database manipulatings functions.
        if ( 'GET' === $verb ) {
            //If the get verb was selected, and the ID is not empty, set the rest servers data witht the db return from the 
            // corpsresource.
            if ( NULL === $id ) {
                
                $restServer->setData( $corpsResource->getAll() );               
            } else {                
                $restServer->setData($corpsResource->get($id));
            }                       
        }
                
        if ( 'POST' === $verb ) {     
            //if the post verb is selected, set the message to the return of the corpresource function.
            $restServer->setMessage( $corpsResource->post($serverData) );
            $restServer->setStatus(201);                 
        }        
        
        if ( 'PUT' === $verb ) {
            //if put is the verb, check the ID. If null, throw an exception looking for a id.
            if ( NULL === $id ) {
                throw new InvalidArgumentException('Corporation ID ' . $id . ' was not found');
            } else {
                //if not, run the put function and set the message to the return.
                $restServer->setMessage($corpsResource->put($id, $serverData));
                $restServer->setStatus(201);               
            }           
        }
        
        if ('DELETE' === $verb) {
            //if the delete verb is selected, check the the id is not null, and if so, throw an exception.
            if ( NULL === $id ) {
                throw new InvalidArgumentException('Corporation ID ' . $id . ' was not found');
            } else {
                // if its all clear, set the message to the delete function return.
                $restServer->setMessage($corpsResource->delete($id));
                $restServer->setStatus(201);              
            }
        }
        
    } else {
        throw new InvalidArgumentException($resource . ' Resource Not Found');
        //Exception for improper resources.
    }
    
    
    

//If exceptions are thrown, these catches will break them down between argument exceptions and regular exceptions
// and set the status appropriatly.
} catch (InvalidArgumentException $e) {
    $restServer->setError($e->getMessage());
    $restServer->setStatus(400);
} catch (Exception $e) {
    $restServer->setError($e->getMessage());
    $restServer->setStatus(500);
}
// Finally, output the response as formated in the rest server.
$restServer->outputResponse();
