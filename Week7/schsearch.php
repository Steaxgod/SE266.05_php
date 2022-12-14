<?php
    include_once __DIR__ . "/controllers/header.php";

    include_once __DIR__ . "/controllers/functions.php";
    include_once __DIR__ . "/models/Schools.php";

    if (!isUserLoggedIn()) 
    { 
        header ("Location: login.php");
    } 

    
   
    $schoolName = "";
    $city = "";
    $state = "";

    if (isPostRequest()) 
    {
        $schoolName = filter_input(INPUT_POST, 'schoolName');
        $city = filter_input(INPUT_POST, 'city');
        $state = filter_input(INPUT_POST, 'state');


        

    }
    $test = new Schools("models\dbconfig.ini");
    $school = $test->getSelectedSchools($schoolName, $city, $state);

    include_once __DIR__ . "/controllers/header.php";
?>

    <h2>Search Schools</h2>
    <form method="post" action="schsearch.php">
        <div class="rowContainer">
            <div class="col1">School Name:</div>
            <div class="col2"><input type="text" name="schoolName" value="<?php echo $schoolName; ?>"></div> 
        </div>
        <div class="rowContainer">
            <div class="col1">City:</div>
            <div class="col2"><input type="text" name="city" value="<?php echo $city; ?>"></div> 
        </div>
        <div class="rowContainer">
            <div class="col1">State:</div>
            <div class="col2"><input type="text" name="state" value="<?php echo $state; ?>"></div> 
        </div>
            <div class="rowContainer">
            <div class="col1">&nbsp;</div>
            <div class="col2"><input type="submit" name="search" value="Search" class="btn btn-warning"></div> 
        </div>
    </form>
            <table class='table table-striped'>
                <thead>

                    <tr>
                        <th>School Name</th>
                        <th>City</th>
                        <th>State</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($school as $row):?>
                        <tr>
                            <td><?= $row['schoolName'] ?></td>
                            <td><?= $row['schoolCity'] ?></td>
                            <td><?= $row['schoolState'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

    <?php

        

    ?>


    <?php
        
        include_once __DIR__ . "/controllers/footer.php";
    ?>