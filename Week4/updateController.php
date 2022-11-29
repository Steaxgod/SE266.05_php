<?php
 
  // This code runs everything the page loads
  include_once __DIR__ . '/pationDB.php';
  
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
   
  // If it is a GET, we are coming from view.php
  // let's figure out if we're doing update or add
  if (isset($_GET['action'])) 
  {
      $action = filter_input(INPUT_GET, 'action');
      $id = filter_input(INPUT_GET, 'pationId', );
      if ($action == "Update") 
      {
          $row = $pationDatabase->getPation($id);
          $fnParam = $row['pationFirstName'];
          $lnParam = $row['pationLastName'];
          $bdParam = $row['pationMarried'];
          $mdParam = $row['pationBirthDate'];
      } 
      //else it is Add and the user will enter pation & dvision
      else 
      {
          $pationName = "";
          $division = "";
      }
  } // end if GET

  // If it is a POST, we are coming from updatepation.php
  // we need to determine action, then return to view.php
  elseif (isset($_POST['action'])) 
  {
      $action = filter_input(INPUT_POST, 'action');
      $id = filter_input(INPUT_POST, 'pationId');

      $fnParam = filter_input(INPUT_POST, 'fnParam');

      $lnParam = filter_input(INPUT_POST, 'lnParam');  

      $bdParam = filter_input(INPUT_POST, 'bdParam');
     
      $mdParam = filter_input(INPUT_POST, 'mdParam');
      
      
    

      if ($action == "Add") 
      {
          $result = $pationDatabase->addPation ($fnParam, $lnParam, $bdParam, $mdParam);
      } 
      elseif ($action == "Update") 
      {
          $result = $pationDatabase->updatePation ($id, $fnParam, $lnParam, $bdParam, $mdParam);
      }

      // Redirect to pation listing on view.php
      header('Location: viewpations.php');
  } // end if POST

  // If it is neither POST nor GET, we go to view.php
  // This page should not be loaded directly
  else
  {
    header('Location: viewpations.php');  
  }
      
?>