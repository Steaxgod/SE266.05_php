<?php 

    include_once __DIR__ . "/models/schools.php";
    include_once __DIR__ . "/controllers/functions.php";


    if (!isUserLoggedIn()) 
    { 
        header ("Location: login.php");
    } 


    $configfile = __DIR__ . "/models/dbconfig.ini";
    try 
    {
        $schoolDatabase = new Schools($configfile);
    } 
    catch ( Exception $error ) 
    {
        echo "<h2>" . $error->getMessage() . "</h2>";
    } 
     if (isset ($_FILES['fileToUpload'])) 
     {
        $schoolDatabase->deleteAllSchools();
         if ($schoolDatabase->insertSchoolsFromFile($_FILES['fileToUpload']['tmp_name']))
         {
             header('Location: schsearch.php');
         }
         else
         {
             echo('Error uploading files! Try again');
         }
     }
 
     include_once __DIR__ . "/controllers/header.php"; 

?>  
    <h2>Upload File</h2>
    <p>
        Please specify a file to upload and then be patient as the upload may take a while to process.
    </p>

    <form action="schupl.php" method="post" enctype="multipart/form-data">

        <input type="file" name="fileToUpload">
        <input type="submit" value="Upload">

    </form>    

<?php
    include_once __DIR__ . "/controllers/footer.php";
?>