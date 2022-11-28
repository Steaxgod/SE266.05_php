<!DOCTYPE html>
<html lang="en">
<head>
<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <style type="text/css">
       .wrapper {
            display: grid;
            grid-template-columns: 180px 400px;
        }

        .measurementWrapper {
            width: 600px;
            display: flex;
            flex-wrap: wrap;
            margin-left: 40px;
        }
        .measurementWrapper > div {
            flex: 1 1 100px;
        }
        .label {
            text-align: right;
            padding-right: 10px;
            margin-bottom: 5px;
            background-color: white;
            color: black;
        }
        label {
           font-weight: bold;
        }
        input[type=text] {width: 120px;}
        .error {color: red;}
    </style>
    
   
    <title>Edit Patient</title>
</head>
<body>
    <div style="text-align:right;">
        <a href="viewPatients.php">View all Patients</a>
    </div>
    <div style="margin-left:50px;">
        <h2> Patient Information</h2>
    </div>
  
    <form action="editPatient.php" method="post">
        
        <input type="hidden" name="action" value="add">
        <input type="hidden" name="patientId" value="">

        <div class="wrapper">
            <div class="label">
                <label>First Name:</label>
            </div>
            <div>
                <input type="text" name="firstName" value="" />
            </div>
            <div class="label">
                <label>Last Name:</label>
            </div>
            <div>
                <input type="text" name="lastName" value="" />
            </div>
            <div class="label">
                    <label>Married:</label>
                </div>
                <div>
                    <input type="radio" name="married" value="1"  >Yes

                        
                    <input type="radio" name="married" value="0"   />No
                    
                </div>
                
                
                <div class="label">
                    <label>Birth Date:</label>
                </div>
                <div>
                    <input type="date" name="birthDate" value="" />
                    
                    
                </div>
                <div>
                    &nbsp;
                </div>
                <div>
                                            <input type="submit" name="addPatient" value="Add Patient Information" />
                                    </div>
            
        </div>
    </form>
    