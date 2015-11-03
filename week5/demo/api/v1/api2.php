<?php

    include_once './models/RestServer.php';
    
    $restServer = new RestServer();
    
    try{
        
        $restServer->setStatus(500);
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








        if ( 'address' === $resource ) {

            $resourceData = new AddressResource();
            
            if ( 'GET' === $verb ) {

                if ( NULL === $id ) {
                    $stmt = $db->prepare("SELECT * FROM address");

                    if ($stmt->execute() && $stmt->rowCount() > 0) {
                        $restServer->setData($stmt->fetchAll(PDO::FETCH_ASSOC));
                    }
                } else {
                    $stmt = $db->prepare("SELECT * FROM address where address_id = :address_id");
                    $binds = array(":address_id" => $id);

                    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
                         $restServer->setData($stmt->fetch(PDO::FETCH_ASSOC));
                    } else {
                        throw new InvalidArgumentException('Address ID ' . $id . ' was not found');
                    }
                }            

            }

            if ( $resourceData->post($serverData) ) {
                    $restServer->setMessage('Address Added');
                    $restServer->setStatus(201);
                } else {
                    throw new Exception('Address could not be added');
                }

            }


            if ( 'PUT' === $verb ) {

                if ( NULL === $id ) {
                    throw new InvalidArgumentException('Address ID ' . $id . ' was not found');
                }

            }

         else {
            throw new InvalidArgumentException($resource . ' Resource Not Found');
            //$response['errors'] = 'Resource Not Found';
            //$status = 404;
        }
    } 
    catch (InvalidArgumentException $e) {
        $restServer->setError($e->getMessage());
        $restServer->setStatus(400);
    } 
    catch (Exception $ex) {
        $restServer->setError($ex->getMessage()); 
        $restServer->setStatus(500);
    }
   
    
    $restServer->outputResponse();

?>
