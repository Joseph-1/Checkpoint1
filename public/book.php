<?php
//Connection to my BD and inisialisation de l'objet $$pdo
require_once ('../connec.php');
?>

<?php
    //requete sql bribe
    $requete = "SELECT * FROM bribe";
    // je fais appel à ma requete
    $categories = $pdo->query($requete)->fetchAll();

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

            </div>

            <div class="page rightpage">
                <!-- TODO : Display bribes and total paiement -->
	            <?php
	            if(!empty($categories)) {
		            foreach ($categories as $key => $value) {
			            echo "<tr>";
			            echo "<th>" . $value['name'] . "</th>";
			            echo "<td>" . $value['payment'] . "</td>";
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
