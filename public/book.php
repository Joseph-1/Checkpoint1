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

<?php

include 'header.php';
include "../connec.php";
$paymentList = new PDO(DSN, USER, PASS);
$query = 'SELECT name, payment from bribe';
$total = 'SELECT SUM(payment) from bribe';

$alphabet = array_merge(range('A', 'Z'));

$error = false;

if (!empty($_POST['name']) && !empty($_POST['payment'])) {

    if ($_POST['name'] != "Eliott Ness"){
        $insertQuery = 'INSERT INTO bribe (name, payment) VALUES (:name, :payment)';
        $addPayment = $paymentList->prepare($insertQuery);

        $addPayment->bindValue(":name", $_POST['name']);
        $addPayment->bindValue(":payment", $_POST['payment']);
        $addPayment->execute();
    }else{
        $error=true;
    }
}

if (!empty($_GET['firstLetter'])) {
    $query = 'SELECT name, payment from bribe WHERE name LIKE' . '\'' . $_GET['firstLetter'] . '%\'';
    $total = 'SELECT SUM(payment) from bribe WHERE name LIKE' . '\'' . $_GET['firstLetter'] . '%\'';
    $title = $_GET['firstLetter'];
} else {
    $title = "Total";
}

?>

<main class="container">

    <section class="desktop">
        <div class="index">
            <form action="book.php" method="get">

                <?php
                foreach ($alphabet as $value) {
                    echo "<input type=\"submit\" name=\"firstLetter\" value=\"$value\">";
                }
                ?>
            </form>
        </div>
        <div class="pages">
            <img src="image/whisky.png" alt="a whisky glass" class="whisky"/>
            <img src="image/empty_whisky.png" alt="an empty whisky glass" class="empty-whisky"/>
            <div class="pageLeftpage">
                Add a bribe
                <!-- TODO : Form -->
                <form action="book.php" method="post">
                    <label for="name">Name</label>
                    <input type="text" name="name" required>
                    <label for="payment">Payment</label>
                    <input type="number" min="1" name="payment" required>
                    <input type="submit" value="Pay !" class="submit">
                </form>
                <?php
                if ($error){
                    echo "<h3>This man is untouchable</h3>";
                }
                ?>
            </div>

            <div class="pageRightpage">
                <!-- TODO : Display bribes and total paiement -->
                <table>
                    <thead>
                    <tr>
                        <?php
                        echo "<div class='title'>$title</div><hr>";
                        ?>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <th>Payment</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($paymentList->query($query) as $value) {
                        echo "<tr><td>$value[name]</td><td>$value[payment]</td></tr>";
                    }
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Total</th>
                        <?php
                        foreach ($paymentList->query($total) as $value) {
                            $totalPayment = $value[0];
                        };
                        echo "<th>$totalPayment</th>";
                        ?>
                    </tr>
                    </tfoot>
                    <tr>
                    </tr>
                </table>
            </div>
            <img src="image/inkpen.png" alt="an ink pen" class="inkpen"/>
        </div>

    </section>
</main>
</body>
</html>
<?php