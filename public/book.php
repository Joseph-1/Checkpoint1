<?php
require ('connec.php');
$requete = "SELECT * FROM bribe";
$statement = $pdo->query($requete);
$brides = $statement->fetchAll();



?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/book.css">
    <title>Checkpoint PHP 1</title>
</head>
<body>

<?php include 'header.php'; ?>

<main>

    <section class="desktop">
        <div class="glass">
            <img src="image/whisky.png" alt="a whisky glass" class="whisky"/>
            <img src="image/empty_whisky.png" alt="an empty whisky glass" class="empty-whisky"/>  <!-- vide -->
        </div>


        
        <div class="pages">
            <div class="page leftpage">
                <h2>Add a bribe</h2>
                <?php
                
                if(isset($_POST['cotise'])) {
                    if(isset($_POST['name'] , $_POST['number'])) {
                        if($_POST['name'] == null && $_POST['number'] == null) {
                            echo 'Il y a des erreurs';
                        } elseif ($_POST['number'] <= 0) {
                            echo'Où est mon fric';
                        }else{
                            $rajout = 'INSERT INTO bribe VALUES(NULL, :name, :payment)';
                            $prepare_rajout = $pdo->prepare($rajout);

                            $prepare_rajout->bindValue(":name", $_POST['name'], PDO::PARAM_STR);
                            $prepare_rajout->bindValue(":payment",$_POST['number'], PDO::PARAM_INT  );

                            if($prepare_rajout->execute()) {
                                header('location:?page=bribe');
                            } else {
                                echo'erreur formulaire';
                            }
                        }

                        
                    }
                
                }
                ?>
<!-- ########### Form ############ -->
                <form method="post">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name">
                    </div>
                    <div class="form-group">
                        <label for="number">Payment</label>
                        <input type="number" class="form-control" name="number" id="number">
                    </div>
                    <button type="submit" name="cotise" value="cotise" class="btn btn-primary">Submit</button>
                </form>
            </div>
<!-- ######### Table ########### -->
            <div class="page rightpage">
                <table>
                    <thead>
                        <tr class="tr_head">
                            <th colspan="2">S</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="tr_body">
                        <?php
                            foreach($brides as $bride)
                            {
                                echo "<td>" . $bride['name'] . "</td>";
                                echo "<td>" . $bride['payment'] . "€ </td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>Total</td>
                        <?php
                            $requete = "SELECT SUM(payment) FROM bribe";
                            $total = $pdo->query($requete);
                            $totals = $total->fetch();
                        ?>
                            <td><?= $totals[0] ?>€</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="b_inkpen">
            <img src="image/inkpen.png" alt="an ink pen" class="inkpen"/>
        </div>
    </section>
</main>
</body>
</html>


