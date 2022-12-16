<?php
    
     include_once __DIR__ . '/viewControler.php';

    
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <style type="text/css">
        a:link {text-decoration: none;}
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <title>Patients</title>
</head>
<body>
    



    <div class="container">
        
    <div class="col-sm-12">
        <h1>Patients</h1>
    
    
  <a href="updatePation.php?action=Add">Add Patient</a>
    <table class="table table-striped">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Birth Date</th>
                    <th>Maried</hp>
                </tr>
            </thead>
            <tbody>
        
            <?php foreach ($pationListing as $row): ?>
                <tr>
                    <td>
                        <form action="viewpations.php" method="post">
                            <input type="hidden" name="pationId" value="<?= $row['id']; ?>" />
                            <button class="btn glyphicon glyphicon-trash" type="submit"></button>
                            
                            <?php echo $row['pationFirstName']; ?>
              
                        </form>   
                    </td>
                    <td><?php echo $row['pationLastName']; ?> </td>
                    <td><?php echo $row['pationBirthDate']; ?> </td>
                    <td><?php echo $row['pationMarried']; ?> </td>
                
                    <td><a href="updatePation.php?action=Update&pationId=<?= $row['id'] ?>">Update</a></td> 
                    
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        
        <br />
        
    </div>
    </div>
</body>
</html>