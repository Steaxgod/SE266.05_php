
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        
    </head>
    <body>
		<h1>SE 266 - Mini Task D</h1>
       

        
            
            <?php
                // Creating an Array
                
                // Title, Due Date, Assigned To, Completed/Not Completed
                $task = 
                [
                   "title" => "Complete Assignment",

                   "due" => "11/01/2022",

                   "assigned_to" => "Farid",

                   "completed" => false,

                   "today" => True
                   
                ];
                
                // Checking the task (troublesooting)
                var_dump($task);
            
            ?>
    
            <!-- Creating Heading -->
            <h1> Task For The Day </h1>
            
            <ul>

              
                    <!-- Creating List with it's own settings -->

                    <li>
                    
                        <strong>Title: </strong><?= $task["title"]; ?>
                    
                    </li>

                    <li>
                    
                        <strong>Due Date: </strong><?= $task["due"]; ?>
                    
                    </li>

                    <li>
                    
                        <strong>Assigned to: </strong><?= $task["assigned_to"]; ?>
                    
                    </li>

                    <li>
                    
                        <strong>Completed: </strong><?= $task["completed"] ? 'Complete' : 'Incomplete'; ?>
                    
                            <?php


                                // When -- true then it will displays check box
                                if ($task['completed'])
                                {   
                                    echo "&#9989;";
                                } 
                                // When -- true then it will displays cross box
                                else
                                {
                                    echo "&#10062;";
                                }
                            ?>
                   
                    </li>

                    <li>

                    
                        <strong>Today: </strong><?= $task["today"] ? 'Complete' : 'Incomplete'; ?>

                        <?php

                            if ($task['today'])
                            {
                                echo "&#9989;";
                            } 
                            else
                            {
                                echo "&#10062;";
                            }
                        ?>
                    </li>

                
            </ul>
    </body>
</html>
