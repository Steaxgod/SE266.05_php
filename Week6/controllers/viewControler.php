<?php
    
    include_once __DIR__ . '/../models/pationDB.php';
    include_once __DIR__ . '/../controllers/functions.php';
    
    // Set up configuration file and create database
    $configFile = __DIR__ . '/dbconfig.ini';
    try 
    {
        $pationDatabase = new PationDB($configFile);
    } 
    catch ( Exception $error ) 
    {
        echo "<h2>" . $error->getMessage() . "</h2>";
    }   
    // If POST, delete the requested pation before listing all pations
    if (isPostRequest()) {
        $id = filter_input(INPUT_POST, 'pationId');
        // $id = $_POST['pationId'];
        $pationDatabase->deletePation($id);

    }
    $pationListing = $pationDatabase->getPations();
    