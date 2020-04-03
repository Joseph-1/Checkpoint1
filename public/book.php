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
//var_dump($total);
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
                <?php
                //verification si le form a déjà été soumis
                if(isset($_POST['added'])) {
                    //verification du form
                    if ((!empty($_POST['name'])) and (!empty($_POST['payment']))) {
                        // verif paiement supérieur à 0
                        if ($_POST['payment'] <= 0) {
                            echo "<h2>Il y a une erreur dans ce montant, corrigez-le avant de valider!</h2>";
                        } // si tout est ok
                        else {
                            // requete d'envoi
                            $query = "INSERT INTO bribe (name,payment) VALUES (:name,:payment)";
                            $name = trim($_POST['name']);
                            $payment = trim($_POST['payment']);

                            $statement = $pdo->prepare($query);
                            $statement->bindValue(":name", $name, PDO::PARAM_STR);
                            $statement->bindValue(":payment", $payment, PDO::PARAM_STR);
                            $statement->execute();

                            header("location: book.php");
                        }
                    } else {
                        echo "<h2>Aucun champ ne doit être vide</h2>";
                    }
                }
                ?>
                <form method="post">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name">
                    <label for="payment">Payment</label>
                    <input type="number" id="payment" name="payment">
                    <input type="submit" name="added" value="Pay!">
                </form>
            </div>

            <div class="page rightpage">
                <!-- TODO : Display bribes and total paiement -->
                <table>
                    <thead>
                    <th colspan="2">S</th>

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
