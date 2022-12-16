<?php
 
 // This code runs everything the page loads
    include_once __DIR__ . '/php/controllers/updateController.php';
    
 
?>
   

<html lang="en">
<head>
 <title><?= $action ?> NFL Pation</title>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
   
<div class="container">
 <p></p>
 <form class="form-horizontal" action="updatePation.php" method="post">
   
 <div class="panel panel-primary">
<div class="panel-heading"><h4><?= $action; ?> Pation</h4></div>
<p></p>
   <div class="form-group">
     <label class="control-label col-sm-2" for="pation name">Titles:</label>
     <div class="col-sm-10">
       <input type="text" class="form-control" id="titles" placeholder="Enter pation name" name="titles" value="<?= $titles; ?>">
     </div>
   </div>

   <div class="form-group">
     <label class="control-label col-sm-2" for="pwd">Genres:</label>
     <div class="col-sm-10">          
       <input type="text" class="form-control" id="genres" placeholder="Enter division" name="genres" value="<?= $genres; ?>">
     </div>
   </div>
   
   <div class="form-group">
     <label class="control-label col-sm-2" for="pwd">Company:</label>
     <div class="col-sm-10">          
       <input type="date" class="form-control" id="company" placeholder="Enter division" name="company" value="<?= $company; ?>">
     </div>
   </div>

   <div class="form-group">
     <label class="control-label col-sm-2" for="pwd">Platform:</label>
     <div class="col-sm-10">          
       <input type="checkbox" class="form-control" id="platform" placeholder="Enter division" name="platform" value="<?= $platform; ?>">
     </div>
   </div>

   <div class="form-group">
     <label class="control-label col-sm-2" for="pwd">Release:</label>
     <div class="col-sm-10">          
       <input type="checkbox" class="form-control" id="rel" placeholder="Enter division" name="rel" value="<?= $rel; ?>">
     </div>
   </div>

   <div class="form-group">        
     <div class="col-sm-offset-2 col-sm-10">
       <button type="submit" class="btn btn-default"><?php echo $action; ?> Pation</button>
     </div>
   </div>
</div>
   <p></p>
   <div class="panel panel-warning">
   <div class="panel-heading"><strong>This is for testing and verification:</strong></div>    
       Action: <input type="text" name="action" value="<?= $action; ?>">
       Pation ID: <input type="text" name="pationId" value="<?= $id; ?>">
     </div>

 </form>
 
 <div class="col-sm-offset-2 col-sm-10"><a href="./gamesearch.php">View Pations</a></div>
</div>
</div>

</body>
</html>