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

<?php include 'header.php';
require "../connec.php";

//requete pour l'affichage
$query = "SELECT * FROM bribe ORDER BY name";
$statement = $pdo->query($query);
$list = $statement->fetchAll(PDO::FETCH_ASSOC);

// requete pour le total
$query = "SELECT sum(payment) FROM bribe";
$statement = $pdo->query($query);
$total = $statement->fetch();;
// je debug
var_dump($total);
?>

<main class="container">

    <section class="desktop">
        <div class="glasses">
            <img src="image/whisky.png" alt="a whisky glass" class="whisky"/>
            <img src="image/empty_whisky.png" alt="an empty whisky glass" class="empty-whisky"/>
        </div>

        <div class="pages">
            <div class="page leftpage">
                Add a bribe
                <!-- TODO : Form -->
            </div>

            <div class="page rightpage">
                <!-- TODO : Display bribes and total paiement -->
                <table>
                    <thead>
                    <th>S</th>
                    </thead>
                    <tbody>
                    <?php
                    //affichage de la liste
                    foreach ($list as $value){
                        echo "<tr><td>". $value['name']. "</td><td>". $value['payment']. "</td></tr>";
                    }
                    ?>
                    </tbody>
                    <tfoot>
                    <th>Total:</th>

                    <?php
                    //affichage du total
                        echo "<td>".$total[0]."</td>";
                    ?>
                    </tfoot>


                </table>
            </div>
        </div>
        <img src="image/inkpen.png" alt="an ink pen" class="inkpen"/>
    </section>
</main>
</body>
</html>
