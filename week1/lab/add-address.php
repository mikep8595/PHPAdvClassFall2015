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
        $errorname = true;
        $erroremail = true;
        $erroraddress = true;
        $errorcity = true;
        $errorstate = true;
        $errorzip = true;
        $errorbirth = true;
        $errormessage = '';
        
        $errors = array (
            'group-success' => 'has-success has-feedback',
            'fullname-success' => '<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span> \n <span id="fullnameStatus" class="sr-only">(success)</span>',
            'group-error' => 'has-error has-feedback'
            
        );
        /* Defines in-tag variabes to change success status */
        $fullnamegroup_success = '';
        $fullname_success = '';
        $emailgroup_success = '';
        $email_success = '';
        $addressline1group_success = '';
        $addressline1_success = '';
        $citygroup_success = '';
        $city_success = '';         
        $stategroup_success = '';
        $state_success = '';
        $zipgroup_success = '';
        $zip_success = '';
        $birthdaygroup_success = '';
        $birthday_success = '';
        
        if ( isPostRequest() ) {                    
            
            if (isset($fullname) )
            {
                if (is_string($fullname))
                {
                    if (preg_match($regex, $fullname))
                    { 
                       $fullnamegroup_success = $errors['group-success'];
                       
                       $errorname = false;
                    }
                    else
                    {$fullnamegroup_success = $errors['group-error'];
                    $errorname = true;
                    }
                }
                else
                {$fullnamegroup_success = $errors['group-error'];
                $errorname = true;
                }
            }
            else
            {$fullnamegroup_success = $errors['group-error'];
            $errorname = true;
            
            }
            
            if (isset($email) )
            {
                if (is_string($email))
                {
                    if (preg_match($emailregex, $email))
                    {
                       $emailgroup_success = $errors['group-success'];
                       
                       $erroremail = false;
                    }
                    else
                    {$emailgroup_success = $errors['group-error'];
                    $erroremail = true;
                    }
                }
                else
                {$emailgroup_success = $errors['group-error'];
                $erroremail = true;
                }
            }
            else
            {$emailgroup_success = $errors['group-error'];
            $erroremail = true;
            } 
            
            if (isset($addressline1) )
            { 
                if (is_string($addressline1))
                {
                  //if (preg_match($addressline1regex, $addressline1))
                   // {
                       $addressline1group_success = $errors['group-success'];
                       
                       $erroraddress = false;
                    //}
                   // else
                    //{$addressline1group_success = $errors['group-error'];
                    //$error = true;
                    //}
                }
                else
                {$addressline1group_success = $errors['group-error'];
                $erroraddress = true;
                }
            }
            else
            {$addressline1group_success = $errors['group-error'];
            $erroraddress = true;
            }
            
            if (isset($city) )
            {
                if (is_string($city))
                {                  
                    $citygroup_success = $errors['group-success'];
                    $errorcity = false;                   
                }
                else
                {$citygroup_success = $errors['group-error'];
                $errorcity = true;
                }
            }
            else
            {$citygroup_success = $errors['group-error'];
            $errorcity = true;
            } 
            
            if (isset($state) )
            {
                if (is_string($state))
                {   
                    $state = strtoupper($state);
                    $stategroup_success = $errors['group-success'];
                    $errorstate = false;                   
                }
                else
                {$stategroup_success = $errors['group-error'];
                $errorstate = true;
                }
            }
            else
            {$stategroup_success = $errors['group-error'];
            $errorstate = true;
            }
            
            if (isset($zip) )
            {
                if (is_string($zip))
                {                  
                    $zipgroup_success = $errors['group-success'];
                    $errorzip = false;                   
                }
                else
                {
                    $zipgroup_success = $errors['group-error'];
                    $errorzip = true;
                }
            }
            else
            {$zipgroup_success = $errors['group-error'];
            $errorzip = true;
            }
            
            if (isset($city) )
            {
                if (is_string($city))
                {                  
                    $citygroup_success = $errors['group-success'];
                    $errorzip = false;                   
                }
                else
                {$citygroup_success = $errors['group-error'];
                $errorzip = true;
                }
            }
            else
            {$citygroup_success = $errors['group-error'];
            $errorzip = true;
            }
            
            if (isset($birthday) )
            {
                if (is_string($birthday))
                {   
                    $time = strtotime($birthday);
                    $datestringpost = date('Y-m-d',$time);
                    $birthdaygroup_success = $errors['group-success'];
                    $errorbirth = false;                   
                }
                else
                {$birthdaygroup_success = $errors['group-error'];
                $errorbirth = true;
                
                }
            }
            else
            {$birthdaygroup_success = $errors['group-error'];
            $errorbirth = true;
            
            }
            
            if ($errorname === false && $erroremail === false && $erroraddress === false && $errorcity === false && $errorstate === false && $errorzip === false && $errorbirth === false)
            {
                if ( addAddress($fullname, $email, $addressline1, $city, $state, $zip, $datestringpost) === true)
                {
                    $alert = true;
                                       
                    
                }
                else 
                {   
                    $alert = false; 
                    $fullname = $errormessage;
                    $email = '';
                    $addressline1 = '';
                    $city = '';
                    $state = '';
                    $zip = '';
                    $birthday = '';
                    
                }                
            }
            else
            {
                //$fullname = addAddress($fullname, $email, $addressline1, $city, $state, $zip, $birthday);
                
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
