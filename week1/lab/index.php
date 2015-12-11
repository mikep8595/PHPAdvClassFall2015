<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <!-- Latest compiled and minified CSS -->
        <?php 
            require './views/head-links.php';
        ?>
    </head>
    <body>
        <?php 
            
            require_once './functions/dbconnect.php'; 
            require_once './functions/until.php'; 
            include './views/view-address.php';
            $results = getAllAddresses();
            include './views/nav-bar.php';
        ?>
        
        <div class="container" width="50%">
        <h1>Addresses</h1>
        <div id="viewtable">
            
            <table class="table table-bordered" width="75%" >
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th> 
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Zip Code</th>
                    <th>Birthday</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $row): ?>
                    <tr>
                        <td><?php echo $row['address_id']; ?></td>
                        <td><?php echo $row['fullname']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['addressline1']; ?></td> 
                        <td><?php echo $row['city']; ?></td>   
                        <td><?php echo $row['state']; ?></td> 
                        <td><?php echo $row['zip']; ?></td>  
                        <td><?php 
                                    $time = strtotime($row['birthday']); 
                                    $table_date = date('Y-m-d',$time);
                                    echo $table_date;
                                    
                            ?></td>       
                    </tr>
                <?php endforeach; ?>
            </tbody>
            </table>
        
        </div>
        <a class="btn btn-primary" href="./add-address.php" role="button">Add contact</a>
        </div>
    </body>
</html>
