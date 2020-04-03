
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
                <?php
                if(isset($_POST['add'])){
                    if($_POST['name']!='' && $_POST['payment']!=''){
                        $requete = 'INSERT INTO bribe VALUES(NULL, :name, :payment)';
                        $statement = $pdo->prepare($requete);
                        $statement->bindValue(":name", $_POST['name'], PDO::PARAM_STR);
                        $statement->bindValue(":payment", $_POST['payment'], PDO::PARAM_INT);
                        $statement->execute();
                    }
                }
                ?>
            </div>

            <div class="page rightpage">
                <?php
                // Affichage
                $requete = "SELECT name, payment FROM bribe ORDER BY name";
                $bribe = $pdo->prepare($requete);
                $bribe->execute();
                $result = $bribe->fetchAll();
                echo "<table><tr><th>Name</th><th>Payment</th></tr>";
                    foreach ($result as $key => $value) {
                        echo "<tr>";
                        echo "<td>".$value['name']. "</td>";
                        echo"<td>". $value['payment']. "</td>";
                        echo "</tr>";
                    }
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
