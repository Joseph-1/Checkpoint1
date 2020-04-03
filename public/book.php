<?php
//Connection to my BD and inisialisation de l'objet $$pdo
require_once ('../connec.php');
?>

<?php
    //requete sql bribe
    $requeteselect = "SELECT * FROM bribe";
    // je fais appel à ma requete
    $categories = $pdo->query($requeteselect)->fetchAll();

    // debug
    //var_dump($categories);
?>
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
        <img src="image/whisky.png" alt="a whisky glass" class="whisky"/>
        <img src="image/empty_whisky.png" alt="an empty whisky glass" class="empty-whisky"/>

        <div class="pages">
            <div class="page leftpage">
                Add a bribe
                <!-- TODO : Form -->
                <form method="post">
                    <label for="name">Name</label>
                    <input id="name" name="name" type="text">
                    <label for="payment">Payment</label>
                    <input id="payment" name="payment" type="number">
                    <input type="submit" name="pay" value="Pay!" class="submit">
                </form>
	            <?php
	            if (isset($_POST['pay'])){
		            if ($_POST['name']!='' && $_POST['payment']!=''){
			            $requeteinsert = "INSERT INTO bribe VALUES (NULL, :name , :payment)";
			            $statement = $pdo->prepare($requeteinsert);
			            $statement->bindValue(":name", $_POST['name'], PDO::PARAM_STR);
			            $statement->bindValue(":payment", $_POST['payment'], PDO::PARAM_INT);
			            $statement->execute();
			            header("Location: book.php");
		            }
	            }
	            ?>
            </div>


            <div class="page rightpage">
                <!-- TODO : Display bribes and total paiement -->
                <?php
                    $requeteshow = "SELECTE name, payment FROM"
                ?>
	            <?php
	            if(!empty($categories)) {
		            foreach ($categories as $key => $value) {
			            echo "<tr>";
			            echo "<td>" . $value['name']. " " . "</td>";
			            echo "<td>" . $value['payment'] . "</td><hr>";
			            echo "</tr>";
		            }
	            }else{
		            echo "<tr>";
		            echo "<td colspan='5'>Aucune catégorie est disponible</td>";
		            echo "</tr>";
	            }
	            ?>
            </div>
        </div>
        <img src="image/inkpen.png" alt="an ink pen" class="inkpen"/>
    </section>
</main>
</body>
</html>
