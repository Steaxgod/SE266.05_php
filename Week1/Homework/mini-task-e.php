
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
                   "Title: " => "Complete Assignment",

                   "Due: " => "11/01/2022",

                   "Assigned to: " => "Farid",

                   "Completed: " => false
                ];
                
                var_dump($task);
            
            ?>
    
       
            <ul>
                <!-- Looping Throug array and setting them --> 
                <?php foreach ($task as $key => $tasks) :?>
                    <li><strong><?= $key; ?></strong><?= $tasks; ?></li>
                <?php endforeach; ?>
  
            </ul>

    </body>
</html>
