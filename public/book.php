<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/book.css">
    <title>Checkpoint PHP 1</title>
</head>
<body>

<?php
require_once("../connec.php.dist");
include 'header.php';
?>

<main class="container">

    <section class="desktop">
        <img src="image/whisky.png" alt="a whisky glass" class="whisky"/>
        <img src="image/empty_whisky.png" alt="an empty whisky glass" class="empty-whisky"/>

        <div class="pages">
            <div class="page leftpage">
                Add a bribe
                <!-- TODO : Form -->
            </div>

            <div class="page rightpage">
                <?php
                $requete = "SELECT * FROM bride ORDER by name";
                $Bride = $pdo->query($requete)->fetchAll();
                ?>

                <table>
                    <thead>
                         <tr>
                            <th>NAME</th>
                            <th>PAYMENT</th>
                         </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($Bride as $key => $value) {
                            echo "<tr>";
                            echo "<td>" . $value['name'] . "</td>";
                            echo "<td>" . $value['payment'] . "</td>";
                            echo "<tr>";
                        }
                    ?>


            </div>
        </div>
        <img src="image/inkpen.png" alt="an ink pen" class="inkpen"/>
    </section>
</main>
</body>
</html>
