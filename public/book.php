
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
<?php require_once ('../connect.php'); ?>
<?php include 'header.php'; ?>

<main class="container">

    <section class="desktop">
        <div class="yb-glass">
            <img src="image/whisky.png" alt="a whisky glass" class="whisky"/>
            <img src="image/empty_whisky.png" alt="an empty whisky glass" class="empty-whisky"/>
        </div>

        <div class="pages">
            <div class="page leftpage">
                <h3>Add a Bribe</h3>
                <?php
                if(isset($_POST['add'])){
                    if($_POST['name']!='' && $_POST['payment']!=''){
                        if($_POST['payment'] > 0){
                            $requete = 'INSERT INTO bribe VALUES(NULL, :name, :payment)';
                            $statement = $pdo->prepare($requete);
                            $statement->bindValue(":name", $_POST['name'], PDO::PARAM_STR);
                            $statement->bindValue(":payment", $_POST['payment'], PDO::PARAM_INT);
                            $statement->execute();
                            header('location:book.php#list');
                        }
                        else{
                            echo "Error";
                        }
                    }
                }
                ?>

                <form method="post">
                    <div>
                        <input type="text" name="name" placeholder="name">
                    </div>
                    <div>
                        <input type="text" name="payment" placeholder="payment">
                    </div>
                    <div>
                        <button type="submit" name="add" value="add">Pay</button>
                    </div>
                </form>

            </div>

            <div id="list" class="page rightpage">
                <?php
                // Affichage
                $requete = "SELECT name, payment FROM bribe ORDER BY name";
                $bribe = $pdo->prepare($requete);
                $bribe->execute();
                $result = $bribe->fetchAll();
                echo "<table><thead><tr><th>Name</th><th>Payment</th></tr></thead>";
                    foreach ($result as $key => $value) {
                        echo "<tbody>";
                        echo "<tr>";
                        echo "<td>".$value['name']. "</td>";
                        echo"<td>". $value['payment']. "</td>";
                        echo "</tr>";
                        echo "</tbody>";
                    }
                    // Total
                    $requete = "SELECT SUM(payment) AS prix_total FROM bribe;";
                    $bribe = $pdo->prepare($requete);
                    $bribe->execute();
                    $result = $bribe->fetchAll();
                    foreach ($result as $key => $value) {
                        echo "<tbody>";
                        echo "<tr>";
                        echo "<th>Total</th>";
                        echo "<td>".$value['prix_total']. "</td>";
                        echo "</tr>";
                        echo "</tbody>";
                    }
                    echo "</tfoot>";
                    echo "</table>";

                ?>
            </div>
        </div>
        <div>
        <img src="image/inkpen.png" alt="an ink pen" class="inkpen"/>
        </div>
    </section>
</main>
</body>
</html>
