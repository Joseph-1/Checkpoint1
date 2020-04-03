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

<?php include 'header.php'; ?>

<main class="container">

    <section class="desktop">
        <div class="glass">
        <img src="image/whisky.png" alt="a whisky glass" class="whisky"/>
        <img id="empty" src="image/empty_whisky.png" alt="an empty whisky glass" class="empty-whisky"/>
        </div>
        <div class="pages">
            <div class="page leftpage">
                Add a bribe
                <!-- TODO : Form -->
            </div>

            <div class="page rightpage">
                <!-- TODO : Display bribes and total paiement -->
            <table>
                <thead><th>S</th></thead>
                <?php

                require_once ('connec.php');
?>

                <tbody> <?php
                $valeur = 0;
                $query = "SELECT name, payment FROM bride ORDER BY name ASC";
                $statement = $pdo->query($query);
                $checkpoint1 = $statement->fetchAll(PDO::FETCH_ASSOC);


                foreach($checkpoint1 as $key) {
                    echo "<tr>";
                    foreach($tab as $key => $value) {
                        $valeur += $value;
                        echo "<td>". $value . "</td><td>";
                    }
                    echo "</tr>";
                }

                ?>
                <tfoot>
                <tr>
                    <th>Total :</th>
                    <?php echo "<td>" . $valeur . "</td>td>;" ?>
                </tr>
                </tfoot>

            </table>
            </div>
        </div>
        <div id="pen">
        <img src="image/inkpen.png" alt="an ink pen" class="inkpen"/>
        </div>
    </section>
</main>
</body>
</html>
