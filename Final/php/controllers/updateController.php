<?php
 
  // This code runs everything the page loads
  include_once __DIR__ . '/../models/GameDB.php';
  include_once __DIR__ . '/functions.php'; 
    if (!isUserLoggedIn())
    {
        header ('Location: login.php');
    }

  // Set up configuration file and create database
  $configFile = __DIR__ . '/dbconfig.ini';
  try 
  {
      $pationDatabase = new GameDB($configFile);
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
      $id = filter_input(INPUT_GET, 'pationId' );
      if ($action == "Update") 
      {
          $row = $pationDatabase->getPation($id);
          $title = $row['title'];
          $genres = $row['genres'];
          $company = $row['company'];
          $platform = $row['platform'];
          $rel = $row['rel']
      } 
      //else it is Add and the user will enter pation & dvision
      else 
      {
        $title = '';
        $genres = '';
        $company = '';
        $platform = '';
        $rel = (new DateTime('now'))->format("yyyy)");
      }
  } // end if GET

  // If it is a POST, we are coming from updatepation.php
  // we need to determine action, then return to view.php
  elseif (isset($_POST['action'])) 
  {
      $action = filter_input(INPUT_POST, 'action');
      $id = filter_input(INPUT_POST, 'id');

      $title = filter_input(INPUT_POST, 'title');

      $genres = filter_input(INPUT_POST, 'genres');  

      $company = filter_input(INPUT_POST, 'company');
     
      $platform = filter_input(INPUT_POST, 'platform');

      $rel = filter_input(INPUT_POST, 'rel');
    

      if ($action == "Add") 
      {
          $result = $pationDatabase->addpation ($title, $genres, $company, $platform,$rel);
      } 
      elseif ($action == "Update") 
      {
          $result = $pationDatabase->updatepation ($id,$title, $genres, $company, $platform,$rel);
      }

      // Redirect to pation listing on view.php
      header('Location: gamesearch.php');
  } // end if POST

  // If it is neither POST nor GET, we go to view.php
  // This page should not be loaded directly
  else
  {
    header('Location: gamesearch.php');  
  }
      
?>