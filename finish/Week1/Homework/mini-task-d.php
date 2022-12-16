
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        
    </head>
    <body>
		<h1>SE 266 - Mini Task D</h1>
       

        
            
            <?php
                // Creating an Array
                $doctor = 
                [
                    "name: " => "Jim",
                    "last name: " => "William",
                    "age: " => 35,
                    "career: " => "Surgeon"

                ];
                
                // Testing my array
                var_dump($doctor);
            
            ?>
    
        <ul>
                <!-- Looping Throug array and setting them --> 
                <?php foreach ($doctor as $key => $info) :?>
                    <li><strong><?= $key; ?></strong><?= $info; ?></li>
                <?php endforeach; ?>
  
        </ul>
       

    </body>
</html>
