<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form method="post" style="border:solid black 2px; padding: 3px; width: 700px;">
        
        <div>
            <h1 style="color: red; text-align: center; font-size: 90px; font-family: fantasy; ">BMI Calculator</h1>
            <div>
                <label>First Name:</label>
                <input type="text" name="fname" required/>
            </div>
            <hr>
            <div>    
                <label>Last Name:</label>
                <input type="text" name="lname" required/>
            </div>
            <hr>
            <div>    
                <label>Married:</label>
                Yes<input type="radio" name="married" value="yes" required/>
                No<input type="radio" name="married" value="no" required/>
            </div>
            <hr>
            <div>   
                <label>Birth Date:</label>
                <input type="date" name="bd" required/>
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
                <input type="number" name="lb" required placeholder="0"/>
            </div>
            <hr>
            <div>   
                <input type="submit" value="submit" name="sbmt" style="width:55px; height: 25px; text-align: center;">
            </div> 
        </div>
    </form>

</body>
</html>