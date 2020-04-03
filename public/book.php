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


if (!empty($_POST['name']) && !empty($_POST['payment'])) {
    $insertQuery = 'INSERT INTO bribe (name, payment) VALUES (:name, :payment)';
    $addPayment = $paymentList->prepare($insertQuery);

    $addPayment->bindValue(":name", $_POST['name']);
    $addPayment->bindValue(":payment", $_POST['payment']);
    $addPayment->execute();
}

?>

<main class="container">

    <section class="desktop">
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
            </div>

            <div class="pageRightpage">
                <!-- TODO : Display bribes and total paiement -->
                <table>
                    <thead>
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
