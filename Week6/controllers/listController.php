<?php

    // Load helper functions (which also starts the session) then check if user is logged in
    include_once __DIR__ . '/functions.php'; 
    if (!isUserLoggedIn())
    {
        header ('Location: login.php');
    }

    // include pation search class
    include_once __DIR__ . '/../models/PationsDBSearcher.php';

    // Set up configuration file and create database
    $configFile = __DIR__ . '/../models/dbconfig.ini';
    try 
    {
        $pationDatabase = new PationDBSearcher($configFile);
    } 
    catch ( Exception $error ) 
    {
        echo "<h2>" . $error->getMessage() . "</h2>";
    }   
    // If POST, delete the requested pation before listing all pations
    $pationListing = [];

    // If POST & SEARCH, only fetch the specified pations       
    if (isset($_POST["Search"]))
    {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $married = 0;
        if (isset($_POST[`married`]))
        {
            $married = 1;
        }
        $pationListing = $pationDatabase->searchPations($fname, $lname, $married);
    }
    // If POST & DELETE, delete the requested pation before fetching all pations       
    elseif (isset($_POST["deletePation"]))
    {
        $id = filter_input(INPUT_POST, 'pationId');
        $pationDatabase->deletePation($id);
        $pationListing = $pationDatabase->getPations();
    }

    // Else just fetch all pations
    else
    {
        $pationListing = $pationDatabase->getPations();
    }


    // This is a quick sorting hack that does not use
    // either the page form or a database query.
    // It sorts based on the associative array keys.
    $fname  = array_column($pationListing, 'pationFirstName');
    $lname = array_column($pationListing, 'pationLastName');

    array_multisort($lname, SORT_ASC, $fname, SORT_ASC, $pationListing);

// Preliminaries are done, load HTML page header
 //   include_once __DIR__ . "/header.php";

?>