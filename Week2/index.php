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
 
        // Holders                  // Держатели информации
        $fname = "";                // Имя
        $lname = "";                // Фамилия
        $married = "";              // Брак
        $bd = "";                   // Дата Рождения
        $feet = "";                 // Фиты ( Длинна )
        $inch = "";                 // Инчи ( Длинна )
        $weight = "";               // Паунты ( Вес )

        $feedback = "";             // Для Ошибок

       
        // Isset --> Нужен для верификации. Если кнопка "Submit" была нажата, то вся дальнейшие действия появляются.
        // ... Без нажатия кнопки "Submit" этих действий не существует, а значит код запущен быть не может
        // ... $_POST --> Имя моего <form> проверяет его наличие
        // ... [` Имя моей кнопки "Submit" `]
        if (isset($_POST['addNumbers'])) 
        {
            
            // Creating Validation
            
            // First Name
            $fname = filter_input(INPUT_POST,"fname");
            if ($fname == "")
            {
                $feedback .=  "<p style='color:red;' > First Name Field Empty* </p>";
                            
            }
            else
            {
                $feedback .= "<p> $fname </p>";
            }
           
            // Last Name
            $lname = filter_input(INPUT_POST,"lname");
            if ($lname == "")
            {
                $feedback .=  "<p style='color:red;' > Last Name Field Empty*</p>";
                
            }
            else
            {
                $feedback .= "<p> $lname </p>";
            }
                
            // Married
            $married = filter_input(INPUT_POST,"married",FILTER_VALIDATE_BOOLEAN);
            if ($married == true)
            {
                $feedback .= "<p> Yes, Married </p>";
            }
            else 
            {
                $feedback .= "<p style='color:red;' > No, Happy  </p>";
            }
       
            // Birth Date
            function age ($bdate) {
                $date = new DateTime($bdate);
                $now = new DateTime();
                $interval = $now->diff($date);
                return $interval->y;
            }
             
             function isDate($dt) {
                $date_arr  = explode('-', $dob);
                return checkdate($date_arr[1], $date_arr[2], $date_arr[0]);
            }
             
             
            // Height
        
                // Feet
                $feet = filter_input(INPUT_POST, 'ft', FILTER_VALIDATE_FLOAT);
                if ($feet < 0 || $feet > 9 )
                {
                    $feedback .=  "<p style='color:red;' > Feet should be possitive and less than 9* | ";
                                
                }
                else
                {
                    $feedback .= "<p> Feet: $feet ";
                }

                // Inch
                $inch = filter_input(INPUT_POST, 'inc', FILTER_VALIDATE_FLOAT);
                if ($inch < 0 || $inch > 12 )
                {
                    $feedback .=  " | style='color:red;' > Inch should be possitive and less than 12* </p>";
                                
                }
                else
                {
                    $feedback .= "Inch: $inch  </p>";
                }
                
                // Weight

                $weight = filter_input(INPUT_POST, 'lb', FILTER_VALIDATE_FLOAT);
                if ($weight < 0 || $weight > 400 )
                {
                    $feedback .=  "<p style='color:red;' > Pounds should be possitive and less than 400* </p>";
                                
                }
                else
                {
                    $feedback .= "Pounds: $weight  </p>";
                }

                        // INFO 
                                // kg = pounds / 2.20462
                                // ft = 12 inches
                                // 1 inch = 2.54 cm = 0.0254 m
                                // So, if I am 6" 1' and I weigh 180 pounds, my BMI is calculated as follows:

                                // Height: 6" 1'  = 6 * 12 + 1 = 73 inches = 73 * 0.0254 = 1.8542 m
                                // Weight: 180 pounds = 180 / 2.20462 = 81.64 kg
                                // BMI: 81.64 / (1.8542 * 1.8542) = 23.7


        } 

        echo $feedback;

    ?>
    
    <form method="POST" action="index.php" style="border:solid black 2px; padding: 3px; width: 700px;">
        
        <div>
            <h1 style="color: red; text-align: center; font-size: 90px; font-family: fantasy; ">BMI Calculator</h1>
            <div>
                <label>First Name:</label>
                <input type="text" name="fname" />
            </div>
            <hr>
            <div>    
                <label>Last Name:</label>
                <input type="text" name="lname" />
            </div>
            <hr>
            <div>    
                <label>Married:</label>
                Yes<input type="radio" name="married" value="yes" />
                No<input type="radio" name="married" value="no" />
            </div>
            <hr>
            <div>   
                <label>Birth Date:</label>
                <input type="date" name="bd" controldate/>
            </div> 
            <hr>
            <div>
                <label>Height:</label>
                Feet:<input type="number" name="ft" required placeholder="0"/>
                Inches:<input type="number" name="inc" required placeholder="0"/>
            </div>
            <hr>
            <div>
                <label>Weight (pounds)::</label>
                <input type="number" name="lb" required  placeholder="0"/>
            </div>
            <hr>
            <div>   
                <input type="submit" value="submit" name="addNumbers" style="width:55px; height: 25px; text-align: center;">
            </div> 
        </div>
    </form>



</body>
</html>