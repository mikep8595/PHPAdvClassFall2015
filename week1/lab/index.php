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
            
            $results = getAllAddresses();
            
        ?>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Contacts</a>
              </div>
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                      <li><a href="./index.php">Table</a></li>
                      <li><a href="./add-address.php">Add</a></li>
                  </ul>
              </div>
            </div>

        </nav>
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
