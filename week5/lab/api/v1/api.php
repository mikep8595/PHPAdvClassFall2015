<?php

require_once './autoload.php';
$restServer = new RestServer();

try {
    /*
    * set 'always_populate_raw_post_data = -1' so you can pass json
    * to your rest server instead of post data  
    *
    */
    
    $resource = $restServer->getResource();
    $verb = $restServer->getVerb();
    $id = $restServer->getId();
    $serverData = $restServer->getServer_data();
    
    
    
    $config = array(
        'DB_DNS' => 'mysql:host=localhost;port=3306;dbname=PHPAdvClassFall2015',
        'DB_USER' => 'root',
        'DB_PASSWORD' => ''
    );
    
    $db = new PDO($config['DB_DNS'], $config['DB_USER'], $config['DB_PASSWORD']);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    
    
    
    
    
    
    
    
    if ( 'corps' === $resource ) {
        $corpsResource = new CorpsResoruce();
        
        if ( 'GET' === $verb ) {
            
            if ( NULL === $id ) {
                
                $restServer->setData( $corpsResource->getAll() );               
            } else {                
                $restServer->setData($corpsResource->get($id));
            }                       
        }
                
        if ( 'POST' === $verb ) {           
            $restServer->setMessage( $corpsResource->post($serverdata) );
            $restServer->setStatus(201);                 
        }        
        
        if ( 'PUT' === $verb ) {          
            if ( NULL === $id ) {
                throw new InvalidArgumentException('Corporation ID ' . $id . ' was not found');
            } else {
                $restServer->setMessage($corpsResource->put($id, $serverdata));
                $restServer->setStatus(201);               
            }           
        }
        
        if ('DELETE' === $verb) {
            if ( NULL === $id ) {
                throw new InvalidArgumentException('Corporation ID ' . $id . ' was not found');
            } else {
                $restServer->setMessage($corpsResource->delete($id));
                $restServer->setStatus(201);              
            }
        }
        
    } else {
        throw new InvalidArgumentException($resource . ' Resource Not Found');
        //$response['errors'] = 'Resource Not Found';
        //$status = 404;
    }
    
    
    


} catch (InvalidArgumentException $e) {
    $restServer->setError($e->getMessage());
    $restServer->setStatus(400);
} catch (Exception $e) {
    $restServer->setError($e->getMessage());
    $restServer->setStatus(500);
}

$restServer->outputResponse();
