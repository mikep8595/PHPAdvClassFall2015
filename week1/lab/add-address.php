<!DOCTYPE html>
<!-- continue to work on error checking and working with error booleans -->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <?php 
            include './views/head-links.php';
        ?>
    </head>
    <body>
        <?php   
        include './views/messages.html.php';
        include_once './functions/dbconnect.php'; 
        include_once './functions/until.php'; 
            // put your code here
            
            $fullname = filter_input(INPUT_POST, 'fullname');
            $email = filter_input(INPUT_POST, 'email');
            $addressline1 = filter_input(INPUT_POST, 'addressline1');
            $city = filter_input(INPUT_POST, 'city');
            $state = filter_input(INPUT_POST, 'state');
            $zip = filter_input(INPUT_POST, 'zip');
            $birthday = filter_input(INPUT_POST, 'birthday');
            
        $regex = "/^[a-z ,.'-]+$/i";
        $emailregex = "/\A[^@]+@([^@\.]+\.)+[^@\.]+\z/";
        $addressline1regex = "\d{1,5}\s\w.\s(\b\w*\b\s){1,2}\w*\ ";       
        $ERRmessage = '';
        
        $errors = array (
            'group-success' => 'has-success has-feedback',
            'fullname-success' => '<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span> \n <span id="fullnameStatus" class="sr-only">(success)</span>',
            'group-error' => 'has-error has-feedback'
            
        );
        /* Defines in-tag variabes to change success status */
        
        
        
        if ( isPostRequest() ) {   
            try{
            
            if ($fullname !== '')
            {
                if (is_string($fullname))
                {
                    if (preg_match($regex, $fullname))
                    {                        
                       
                    }
                    else
                    {
                    
                    $ERRmessage .= 'Name is not in valid format <br>';
                    }
                }
                else
                {
                
                $ERRmessage .= 'Name is not in valid format <br>';
                }
            }
            else
            {
            
                $ERRmessage .= 'Name is not filled in <br>';
            }
            
            if ($email !== '' )
            {
                if (is_string($email))
                {
                    if (preg_match($emailregex, $email))
                    {
                       
                    }
                    else
                    {
                        
                        $ERRmessage .= 'Email is not in valid format <br>';
                    }
                }
                else
                {
                
                $ERRmessage .= 'Email is not in valid format <br>';
                }
            }
            else
            {
            
                $ERRmessage .= 'Email is not filled in <br>';
            } 
            
            if ($addressline1 !== '' )
            { 
                if (is_string($addressline1))
                {
                    $erroraddress = false;              
                }
                else
                {
                    $erroraddress = true;
                    $ERRmessage .= 'Address is not in valid format. <br>';
                }
            }
            else
            {
                $erroraddress = true;
                $ERRmessage .= 'Address is not filled in. <br>';

            }
            
            if ($city !== '' )
            {
                if (is_string($city))
                {                                     
                    $errorcity = false;                   
                }
                else
                {
                    $errorcity = true;
                    $ERRmessage .= 'City is not in valid format <br>';
                }
            }
            else
            {
                $errorcity = true;
                $ERRmessage .= 'City is not filled in <br>';
            } 
            
            if ($state !== '' )
            {
                if (is_string($state))
                {   
                    $state = strtoupper($state);
                    
                    $errorstate = false; 
                    
                }
                else
                {
                    $errorstate = true;
                    $ERRmessage .= 'State is not in valid format <br>';
                }
            }
            else
            {
                $errorstate = true;
                $ERRmessage .= 'State is not in valid format <br>';
            }
            
            if ($zip !== '' )
            {
                if (is_string($zip))
                {                  
                    
                    $errorzip = false;                   
                }
                else
                {
                    $ERRmessage .= 'Zip code is not in valid format <br>';
                    $errorzip = true;
                }
            }
            else
            {
                $errorzip = true;
                $ERRmessage .= 'Zip code is filled in <br>';
            }
                                    
            if ($birthday !== '' && $birthday !== 'mm/dd/yy')
            {
                if (is_string($birthday))
                {   
                    if ($birthday !== 'mm/dd/yy') {
                        $time = strtotime($birthday);
                        $datestringpost = date('Y-m-d',$time);
                    
                        $errorbirth = false;
                    }
                    else {
                        $ERRmessage .= 'Birthday is not in valid format <br>';
                    }
                    
                }
                else
                {
                    $errorbirth = true;
                    $ERRmessage .= 'Birthday is not in valid format <br>';
                }
            }
            else
            {
                $errorbirth = true;
                $ERRmessage .= 'Birthday is not filled in. <br>';
            }
            
            if ($ERRmessage === '')
            {
                if ( addAddress($fullname, $email, $addressline1, $city, $state, $zip, $datestringpost) === true)
                {
                    $alert = true;
                                       
                    
                }
                else 
                {   
                    throw new Exception('Database Error Found!');    
                    
                }                
            }
            else
            {
                throw new Exception('Submit Errors Found!');  
                
            }
        }      
        catch (Exception $e) {
            $alert = false;
            $errorMessage = $ERRmessage;  
        }
    }
        else
        {
            $fullname = '';
            $email = '';
            $addressline1 = '';
            $city = '';
            $state = '';
            $zip = '';
            $birthday = '';
            $alert ='';
            
        }
        
        include './views/add-features.php';
        ?> 
        
        <!-- 
        
        <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
        <span id="fullnameStatus" class="sr-only">(success)</span>
        has-success has-feedback
        -->
        
    </body>
</html>
