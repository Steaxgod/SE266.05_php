<head>
    <!-- CSS Links -->
    <link rel="stylesheet" type="text/css" href="../css/style.css"> <!--Default CSS-->
</head>

<body>
    
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
            $rel = "";

            if (isPostRequest()) 
            {
                $title = filter_input(INPUT_POST, 'title');
                $platform = filter_input(INPUT_POST, 'platform');
                $genre = filter_input(INPUT_POST, 'genre');
                $rel = filter_input(INPUT_POST, 'rel');
        

                

            }
            $test = new Games("models\dbconfig.ini");
            $games = $test->getSelectedGames($title, $genre,$platform,$rel);

            include_once __DIR__ . "/controllers/header.php";
        ?>
        <div class="bckg">
            <h2>Search Games</h2>
            <form method="post" action="gamesearch.php">
                <div class="rowContainer">
                    <div class="col1">Game Title:</div>
                    <div class="col2"><input type="text" name="title" value="<?php echo $title; ?>"></div> 
                </div>
                <div class="rowContainer">
                    <div class="col1">Game Genre:</div>
                    <div class="col2"><input type="text" name="genre" value="<?php echo $genre; ?>"></div> 
                </div>
                <div class="rowContainer">
                    <div class="col1">Game Platform:</div>
                    <div class="col2"><input type="text" name="platform" value="<?php echo $platform; ?>"></div> 
                </div>
                <div class="rowContainer">
                    <div class="col1">Game Release:</div>
                    <div class="col2"><input type="text" name="rel" value="<?php echo $rel; ?>"></div> 
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

                            <?php foreach ($games as $row):?>
                                <tr>
                                    <td><?= $row['title'] ?></td>
                                    <td><?= $row['genres'] ?></td>
                                    <td><?= $row['company'] ?></td>
                                    <td><?= $row['platform'] ?></td>
                                    <td><?= $row['rel'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

            <?php

                

            ?>


            <?php
                
                include_once __DIR__ . "/controllers/footer.php";
            ?>
    </div>
</body>