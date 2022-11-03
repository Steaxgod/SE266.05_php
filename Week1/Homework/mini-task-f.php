<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

    <?php

    // Creating Array
    $animals = ['dog', 'cat','rabbit','frog','fish','turtle'];

    // Creating Functions
    function dd($animals )
    {

        echo '<pre>';

        die(var_dump($animals)); 
        
        echo '</pre>';


    }

    dd($animals); // Calling functions


    ?>


</body>
</html>