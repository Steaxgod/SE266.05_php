<?php
    include_once __DIR__ . "/controllers/header.php";

    include_once __DIR__ . "/controllers/functions.php";
    include_once __DIR__ . "/models/games.php";

    if (!isUserLoggedIn()) 
    { 
        header ("Location: login.php");
    } 

    
   
    $title = "";
    $platform = "";
    $genre = "";

    if (isPostRequest()) 
    {
        $title = filter_input(INPUT_POST, 'title');
        $platform = filter_input(INPUT_POST, 'platform');
        $genre = filter_input(INPUT_POST, 'genre');
 

        

    }
    $test = new Schools("models\dbconfig.ini");
    $school = $test->getSelectedSchools($title, $platform, $genre);

    include_once __DIR__ . "/controllers/header.php";
?>

    <h2>Search Schools</h2>
    <form method="post" action="gamesearch.php">
        <div class="rowContainer">
            <div class="col1">School Name:</div>
            <div class="col2"><input type="text" name="title" value="<?php echo $title; ?>"></div> 
        </div>
        <div class="rowContainer">
            <div class="col1">City:</div>
            <div class="col2"><input type="text" name="platform" value="<?php echo $platform; ?>"></div> 
        </div>
        <div class="rowContainer">
            <div class="col1">State:</div>
            <div class="col2"><input type="text" name="genre" value="<?php echo $genre; ?>"></div> 
        </div>
            <div class="rowContainer">
            <div class="col1">&nbsp;</div>
            <div class="col2"><input type="submit" name="search" value="Search" class="btn btn-warning"></div> 
        </div>
    </form>
            <table class='table table-striped'>
                <thead>

                    <tr>
                        <th>Title</th>
                        <th>Genres</th>
                        <th>Company</th>
                        <th>Platform</th>
                        <th>Rel</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($school as $row):?>
                        <tr>
                            <td><?= $row['Title'] ?></td>
                            <td><?= $row['Genres'] ?></td>
                            <td><?= $row['Company'] ?></td>
                            <td><?= $row['Platform'] ?></td>
                            <td><?= $row['Rel'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

    <?php

        

    ?>


    <?php
        
        include_once __DIR__ . "/controllers/footer.php";
    ?>