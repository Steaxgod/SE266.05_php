<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <!-- Creating Heading -->
    <h1>Mini-Task G: Fizz Buzz</h1>

    <?php

    // Creating Functions
    function fizzBuzz($num) 
    {

        // Creating If/Elseif/else statement for check for the remainders
        // If num /2 or /3 = 0 ramainder then print Fizz Buzz and return value
        // If num /2 = 0 ramainder then print Fizz and return value
        // If num /3 = 0 ramainder then print Buzz and return value
        // Just return value and print it
        if($num % 2 == 0  && $num % 3 == 0)
        {
            return 'Fizz Buzz';
        }
        elseif($num % 2 == 0)
        {
            return 'Fizz';
        }
        elseif ($num % 3 == 0) {
            return "Buzz";
        }
        else
        {
            return $num;
        }
    }

    // Looping throug all numbers between 1 - 100
    for ($num = 1; $num < 100; $num++)
    {
        echo fizzBuzz($num) . '<br>';
    }
    ?>

</body>
</html>