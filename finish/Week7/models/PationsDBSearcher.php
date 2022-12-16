<?php

include_once __DIR__ . '/PationDB.php'; 

// We extend the pations class so we can take advantage of work done earlier
class PationDBSearcher extends PationDB
{

    // Allows user to search for either pation, division or both
    // INPUT: pation and/or division to search for
    function searchPations ($fname, $lname, $married) 
    {
        // We set up all the necessary variables here 
        // to ensure they are scoped for the entire function
        $results = array();             // tables of query results
        $binds = array();               // bind array for query parameters
        $pationTable = $this->getDatabaseRef();   // Alias for database PDO

        // Create base SQL statement that we can append
        // specific restrictions to
        $sqlQuery =  "SELECT * FROM  pations   ";
        $isFirstClause = true;
        // If pation is set, append pation query and bind parameter
        if ($fname != "") {
            if ($isFirstClause)
            {
                $sqlQuery .=  " WHERE ";
                $isFirstClause = false;
            }
            else
            {
                $sqlQuery .= " AND ";
            }
            $sqlQuery .= "  pationFirstName LIKE :fname";
            $binds['fname'] = '%'.$fname.'%';
        }
    
        // If division is set, append pation query and bind parameter
        if ($lname != "") {
            if ($isFirstClause)
            {
                $sqlQuery .=  " WHERE ";
                $isFirstClause = false;
            }
            else
            {
                $sqlQuery .= " AND ";
            }
            $sqlQuery .= "  pationLastName LIKE :lname";
            $binds['lname'] = '%'.$lname.'%';
        }
    
        if ($married != "") {
            if ($isFirstClause)
            {
                $sqlQuery .=  " WHERE ";
                $isFirstClause = false;
            }
            else
            {
                $sqlQuery .= " AND ";
            }
            $sqlQuery .= "  pationMarried = :married";
            $binds['married'] = $married;
        }

        // Create query object
        $stmt = $pationTable->prepare($sqlQuery);

        // Perform query
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) 
        {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        // Return query rows (if any)
        return $results;
    } // end search pations
}

?>