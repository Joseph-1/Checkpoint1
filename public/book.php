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
    require_once 'connec.php'; ?>

<main class="container">

    <section class="desktop">
        <img src="image/whisky.png" alt="a whisky glass" class="whisky"/>
        <img src="image/empty_whisky.png" alt="an empty whisky glass" class="empty-whisky"/>

        <div class="pages">
            <div class="page leftpage">
                Add a bribe
                <form action="" method="post">
                    <div>
                        <label for="name">Name</label>
                        <input type="text" name="name" required>
                    </div>
                    <div>
                        <label for="payment">Payment</label>
                        <input type="number" name="payment" required>
                    </div>
                    <div>
                        <input name="send" type="submit" value="Pay!">
                    </div>
                </form>
                <?php
                    $name = $_POST['name'];
                    $payment = $_POST['payment'];
                    if($_POST['send']<>''){
                        if(!empty($name) && $payment > 0){
                            $query = 'INSERT INTO bribe(name, payment) VALUES (:name, :payment)';
                            $statement = $pdo->prepare($query);
                            $statement->bindValue(':name', $name, \PDO::PARAM_STR);
                            $statement->bindValue(':payment', $payment, \PDO::PARAM_INT);
                            $statement->execute();
                        }
                        else{
                            echo "Please, fill in all fields";}
                    }
                ?>
            </div>

            <div class="page rightpage">
                <table>
                    <thead><th>S</th></thead>

                    <tbody>
                    <?php
                    $total = 0;
                    $query = "SELECT name, payment FROM bribe ORDER BY name ASC";
                    $statement = $pdo->query($query);
                    $bribe = $statement->fetchAll(PDO::FETCH_ASSOC);


                        foreach($bribe as $array) {
                            echo "<tr>";
                            foreach($array as $name => $payment){
                                    $total += $payment;
                                    echo "<td>". $payment ."</td><td>";
                            }
                            echo "</tr>";
                        }
                        ?>

                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Total : </th>
                        <?php echo "<td>" . $total . "</td>"; ?>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <img src="image/inkpen.png" alt="an ink pen" class="inkpen"/>
    </section>
</main>
</body>
</html>