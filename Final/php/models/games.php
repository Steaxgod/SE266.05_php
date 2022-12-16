<?php

//*****************************************************
//
// This class provides a wrapper for the database 
// All methods work on the games table

class Games
{

    // This data field represents the database
    private $gameData;
 
    // Maximum number of records to insert into database for testing
    const MAX_INSERT_ROWS = 1000;
    
    //*****************************************************
    // Users class constructor:
    // Instantiates a PDO object based on given URL and
    // uses that to initialize the data field $userData
    //
    // INPUT: URL of database configuration file
    // Throws exception if database access fails
    // ** This constructor is very generic and can be used to 
    // ** access your course database for any assignment
    // ** The methods need to be changed to hit the correct table(s)
    public function __construct($configfile) 
    {
        // Parse config file, throw exception if it fails
        if ($ini = parse_ini_file($configfile))
        {
            // Create PHP Database Object
            $gamePDO = new PDO( "mysql:host=" . $ini['servername'] . 
                                ";port=" . $ini['port'] . 
                                ";dbname=" . $ini['dbname'], 
                                $ini['username'], 
                                $ini['password']);

            // Don't emulate (pre-compile) prepare statements
            $gamePDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            // Throw exceptions if there is a database error
            $gamePDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //Set our database to be the newly created PDO
            $this->gameData = $gamePDO;
        }
        else
        {
            // Things didn't go well, throw exception!
            throw new Exception( "<h2>Creation of database object failed!</h2>", 0, null );
        }

    } // end constructor


    //*****************************************************
    // Load games into database table "games" from a CSV file
    // INPUT: Name of CSV file to load games from
    //       Field order: game Name, City, State Abbreviation
    // RETURNS: True if file opened and games inserted into table
    //               False otherwise
    public function insertGamesFromFile($fileName) 
    {
        $insertSucessful = false;           // file records are not added at this point
        $gameTable = $this->gameData;   // Alias for database PDO
        $gameCounter = 0;                 // Counter for rows read from file
       
        // We only proceed if the file exists
        if (file_exists($fileName))
        {   
            // Clear current records in table so there are no duplicates
            $this->deleteAllGames();

            // Open file 
            $gameFileRef = fopen($fileName, 'rb');

            $csvAsArray = array_map('str_getcsv', file($fileName));
            $keys = array_shift($csvAsArray);
            // Combine the keys so that the records can be accessed via key
            foreach ($csvAsArray as $i=>$row) {
                $csvAsArray[$i] = array_combine($keys, $row);
            }
            foreach ($csvAsArray as $i=>$row)
            {
                // Convert any special character in the fields into HTML characters
                $Title = str_replace("'", "''", htmlspecialchars($row[$keys[0]]));
                $Genres = str_replace("'", "''", htmlspecialchars($row[$keys[1]]));
                $Company = str_replace("'", "''", htmlspecialchars($row[$keys[2]]));
                $Platform = str_replace("'", "''", htmlspecialchars($row[$keys[3]]));
                $Rel = str_replace("'", "''", htmlspecialchars($row[$keys[4]]));

                $gameToInsert = "('" . $Title . "' , '" . $Genres . "' , '" . $Company. "', '" . $Platform . "' , '" . $Rel . "' )";
                
                // This adds the first MAX_INSERT_ROWS rows into the database.
                if ($gameCounter++ < self::MAX_INSERT_ROWS != 0) 
                {
                    // Add the game to the database
                    $insertSucessful = $gameTable->query("INSERT INTO games (Title, Genres,Company,Platform,Rel) VALUES ". $gameToInsert);
                }
            }
            // All done, for security reasons, close and delete the CSV file
           fclose($gameFileRef);
           unlink($fileName);
        }
        return $insertSucessful;
      } // end insertgames from File 

      // CODE HELPED FROM RYAN PLANTE.
   
 // Database access & modify methods are listed below. 
// General structure of each method is:
//  1) Set up variable for database and query results
//  2) Set up SQL statement (with parameters, if needed)
//  3) Bind any parameters to values
//  4) Execute statement and check for returned rows
//  5) Return results if needed.

    //*****************************************************
    // Delete all teams from table
    // RETURNS: True if delete is successful, false otherwise
    public function deleteAllGames() 
    {
            $deleteSucessful = false;           // Team not updated at this point
            $gameTable = $this->gameData;   // Alias for database PDO

            // Preparing SQL query    
            $stmt = $gameTable->query("DELETE FROM games;");

            // Execute query and check to see if rows were returned 
            // If so, the games were successfully deleted      
            $deleteSucessful = ($stmt->execute() && $stmt->rowCount() > 0);

            // Return status to client           
            return $deleteSucessful;
    }
   
    //*****************************************************
    // Get a count of games int he database
    // RETURNS: how many games were uploaded were uploaded to DB
   public function getGameCount() 
   {
        $gameTable = $this->gameData;   // Alias for database PDO

        // Build SQL query, notice we alias the count result so we can access it
        $stmt = $gameTable->query("SELECT COUNT(*) AS gameCount FROM games");

        // Grab the results into an associative array
        $results = $stmt->fetch(PDO::FETCH_ASSOC);   
        
        // return the count of games in DB
        return $results['gameCount'];
   } // end getgameCount


     //*****************************************************
    // Allows user to search for either a game name, city, state or any combination
    // INPUT: game name, host city and state to search for
    // RETURNS: table of records of games matching the criteria
   public function getSelectedGames($title, $genres,$platform,$rel) 
   {
       $results = array();                  // Empty results table 
       $binds = array();                    // Empty bind array
       $isFirstClause = true;               // Next WHERE clause is first
       $gameTable = $this->gameData;   // Alias for database PDO

       // Here is the base SQL statement to select all games
       $sql = "SELECT id,title,genres,company,platform,rel FROM games ";

        // Now we check for any parameters and build the WHERE clause filters
        // First, game name:
        if (isset($title)) 
        {
            if ($isFirstClause)
            {
                $sql .= " WHERE ";
                $isFirstClause = false;
            }
            else
            {
                $sql .= " AND ";
            }
            $sql .= " title LIKE :title";
            $binds['title'] = '%'.$title.'%';
        }
      
        // Next, city name:
        if (isset($genres)) 
        {
            if ($isFirstClause)
            {
                $sql .= " WHERE ";
                $isFirstClause = false;
            }
            else
            {
                $sql .= " AND ";
            }
            $sql .= "  genres LIKE :genres";
           $binds['genres'] = '%'.$genres.'%';
       }


        // Finally, state:
        if (isset($platform)) 
        {
            if ($isFirstClause)
            {
                $sql .= " WHERE ";
                $isFirstClause = false;
            }
            else
            {
                $sql .= " AND ";
            }
           $sql .= "  platform LIKE :platform";
           $binds['platform'] = '%'.$platform.'%';
       }

       // Finally, state:
       if (isset($rel)) 
       {
           if ($isFirstClause)
           {
               $sql .= " WHERE ";
               $isFirstClause = false;
           }
           else
           {
               $sql .= " AND ";
           }
          $sql .= "  rel LIKE :rel";
          $binds['rel'] = '%'.$rel.'%';
      }

       // Let's sort whatever records come back
       $sql .= " ORDER BY Title";
       
       // Prepare the SQL statement object
       $stmt = $gameTable->prepare($sql);
      
       // Execute the query and fetch the results into a 
       // table of associative arrays
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // Return the results
        return $results;
   }    // end getSelected games

} // end games class