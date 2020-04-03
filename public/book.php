<?php 
    require_once "../src/connec.php";
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
                <?php
                if(isset($_POST["adding"])){
                    if($_POST["name"]<> '' && $_POST["payment"]!=''){
                        $requete = "INSERT INTO bribe VALUES(NULL, :name, :payment)";
                        $statement = $pdo->prepare($requete);

                        $statement->bindValue(":name", $_POST["name"], PDO::PARAM_STR);
                        $statement->bindValue(":payment", $_POST["payment"], PDO::PARAM_INT);

                        if($statement->execute()){
                            echo "<br>" . "Thanks you =)";
                        }else{
                            echo "ERROR !!!";
                        }
                    }
                }
                ?>
                <form action="Book.php" method="post">
                    <div>
                         <label for="name">Name :</label>
                         <input type="text" id="name" name="name">
                    </div>
                     <div>
                            <label for="payment">Payment:</label>
                            <input type="int" id="payment" name="payment">
                    </div>
                    <div class="button">
                            <button type="submit" name="adding">Payed!</button>
                    </div>
                </form>
            </div>

            <div class="page rightpage">
                <!-- TODO : Display bribes and total paiement -->
                <?php
                    $query = "select * from bribe order by name";
                    $showBribes = $pdo->prepare($query);
                    $showBribes->execute();
                    $result=$showBribes->fetchAll();
                ?>
                <table>
                    <thead>
                        <th>Name</th>
                        <th>Payment</th>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($result as $key){
                                 echo "<tr>";
                                 echo "<td>" . $key["name"] . "</td>";
                                 echo "<td>" . $key["payment"] . "</td>";
                                 echo "</tr>";
                            }
                        ?>
                    </tbody>
                            
                    <tfoot>
                        <?php
                           echo " a faire";
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
