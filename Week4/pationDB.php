<?php
include_once "Pation.php";
//*****************************************************
//
// This class provides a wrapper for the database 
// All methods work on the pations table

class PationDB
{
    // This data field represents the database
    private $pationData;

    //*****************************************************
    // pations class constructor:
    // Instantiates a PDO object based on given URL and
    // uses that to initialize the data field $pationData
    //
    // INPUT: URL of database configuration file
    // Throws exception if database access fails
    // ** This constructor is very generic and can be used to 
    // ** access your course database for any assignment
    // ** The methods need to be changed to hit the correct table(s)
    public function __construct($configFile) 
    {
        // Parse config file, throw exception if it fails
        if ($ini = parse_ini_file($configFile))
        {
            // Create PHP Database Object
            $connectionString = "mysql:host=" . $ini['servername'] . 
            ";port=" . $ini['port'] . 
            ";dbname=" . $ini['dbname'];

            $pationPDO = new PDO( $connectionString, 
                                $ini['username'], 
                                $ini['password']);

            // Don't emulate (pre-compile) prepare statements
            $pationPDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            // Throw exceptions if there is a database error
            $pationPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //Set our database to be the newly created PDO
            $this->pationData = $pationPDO;
        }
        else
        {
            // Things didn't go well, throw exception!
            throw new Exception( "<h2>Creation of database object failed!</h2>", 0, null );
        }

    } // end constructor

// Database access & modify methods are listed below. 
// General structure of each method is:
//  1) Set up variable for database and query results
//  2) Set up SQL statement (with parameters, if needed)
//  3) Bind any parameters to values
//  4) Execute statement and check for returned rows
//  5) Return results if needed.

    //*****************************************************
    // Get listing of all pations
    // INPUT: None
    // RETURNS: Array with each entry representing a row in the table
    //          If no records in table, array is empty
    public function getpations() 
    {
        $results = [];                  // Array to hold results
        $pationTable = $this->pationData;   // Alias for database PDO

        // Preparing SQL query
        $stmt = $pationTable->prepare("SELECT * FROM pations ORDER BY pationname"); 
        
        // Execute query and check to see if rows were returned
        if ( $stmt->execute() && $stmt->rowCount() > 0 ) 
        {
            // if successful, grab all rows
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);                 
        }         

        // Return results to client
        return $results;
    }

    //*****************************************************
    // Add a pation to database
    // INPUT: pation and divison to add
    // RETURNS: True if add is successful, false otherwise
    public function addpation($pation, $division) 
    {
        $addSucessful = false;         // pation not added at this point
        $pationTable = $this->pationData;   // Alias for database PDO

        // Preparing SQL query with parameters for pation and division
        $stmt = $pationTable->prepare("INSERT INTO pations SET pationName = :pationParam, division = :divisionParam");

        // Bind query parameters to method parameter values
        $boundParams = array(
            ":pationParam" => $pation,
            ":divisionParam" => $division
        );       
        
         // Execute query and check to see if rows were returned 
         // If so, the pation was successfully added
        $addSucessful = ($stmt->execute($boundParams) && $stmt->rowCount() > 0);
        
         // Return status to client
         return $addSucessful;
    }
   
    //*****************************************************
     //*****************************************************
    // Add a pation to database
    //   Uses alternative style to bind query parameters.
    // INPUT: pation and divison to add
    // RETURNS: True if add is successful, false otherwise
    public function addpation2($pation, $division) 
    {
        $addSucessful = false;         // pation not added at this point
        $pationTable = $this->pationData;   // Alias for database PDO

        // Preparing SQL query with parameters for pation and division
        $stmt = $pationTable->prepare("INSERT INTO pations SET pationName = :pationParam, division = :divisionParam");

        // Bind query parameters to method parameter values
        $stmt->bindValue(':pationParam', $pation);
        $stmt->bindValue(':divisionParam', $division);
       
        // Execute query and check to see if rows were returned 
        // If so, the pation was successfully added
         $addSucessful = ($stmt->execute() && $stmt->rowCount() > 0);
        
         // Return status to client
         return $addSucessful;
    }

    //*****************************************************
    // Update specified pation with a new name and division
    // INPUT: id of pation to update
    //        new value for pation name
    //        new value for division
    // RETURNS: True if update is successful, false otherwise
    public function updatepation ($id, $pation, $division) 
    {
        $updateSucessful = false;        // pation not updated at this point
        $pationTable = $this->pationData;   // Alias for database PDO

        // Preparing SQL query with parameters for pation and division
        //    id is used to ensure we update correct record
        $stmt = $pationTable->prepare("UPDATE pations SET pationName = :pationParam, division = :divisionParam WHERE id=:idParam");
        
         // Bind query parameters to method parameter values
        $stmt->bindValue(':idParam', $id);
        $stmt->bindValue(':pationParam', $pation);
        $stmt->bindValue(':divisionParam', $division);

        // Execute query and check to see if rows were returned 
        // If so, the pation was successfully updated      
        $updateSucessful = ($stmt->execute() && $stmt->rowCount() > 0);

          // Return status to client
          return $updateSucessful;
    }

    //*****************************************************
    // Delete specified pation from table
    // INPUT: id of pation to delete
    // RETURNS: True if update is successful, false otherwise
    public function deletepation ($id) 
    {
        $deleteSucessful = false;       // pation not updated at this point
        $pationTable = $this->pationData;   // Alias for database PDO

        // Preparing SQL query 
        //    id is used to ensure we delete correct record
        $stmt = $pationTable->prepare("DELETE FROM pations WHERE id=:idParam");
        
         // Bind query parameter to method parameter value
        $stmt->bindValue(':idParam', $id);
            
        // Execute query and check to see if rows were returned 
        // If so, the pation was successfully deleted      
        $deleteSucessful = ($stmt->execute() && $stmt->rowCount() > 0);

        // Return status to client           
        return $deleteSucessful;
    }
 
    //*****************************************************
    // Get one pation and place it into an associative array
    public function getpation ($id) 
    {
        $results = [];                  // Array to hold results
        $pationTable = $this->pationData;   // Alias for database PDO

        // Preparing SQL query 
        //    id is used to ensure we delete correct record
        $stmt = $pationTable->prepare("SELECT id, pationName, division FROM pations WHERE id=:idParam");

         // Bind query parameter to method parameter value
         $stmt->bindValue(':idParam', $id);
       
         // Execute query and check to see if rows were returned 
         if ( $stmt->execute() && $stmt->rowCount() > 0 ) 
         {
            // if successful, grab the first row returned
            $results = $stmt->fetch();                       
        }

        // Return results to client
        return $results;
    }

    public function getDatabaseRef()
    {
        return $this->pationData;
    }

    // Destructor to clean up any memory allocation
   public function __destruct() 
   {
       // Mark the PDO for deletion
       $this->pationData = null;

        // If we had a datafield that was a fileReference
        // we should ensure the file is closed
   }

 
} // end class pations
?>