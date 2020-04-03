<?php

// Connection to database with PDO
require_once ('../config/connec.php');
$pdo = new PDO(DSN, USER, PASS);

// Getting data from DB
$query = "SELECT * FROM bribe ORDER BY name ASC";
$statement = $pdo->query($query);

// Fetching DB data in an array
$bribes = $statement->fetchAll(PDO::FETCH_ASSOC);

// Sum of all payments
$totalPmnt = 0;
foreach ($bribes as $bribe) {
    $totalPmnt += $bribe['payment'];
}

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
                <div class="bribe-table">
                    <table>
                        <tr>
                            <th>Name</th>
                            <th>Payment</th>
                        </tr>
                        <?php
                        // Loop to display names and payments in the table
                        foreach ($bribes as $bribe) {
                            echo '<tr>';
                            echo '<td>' . $bribe['name'] . '</td>';
                            echo '<td>' . $bribe['payment'] . '</td>';
                            echo '</tr>';
                        }
                        ?>
                        <tfoot>
                            <tr>
                                <th class="total-pmnt">Total payments</th>
                                <!-- Displaying the sum of all payments -->
                                <td class="total-pmnt"><?= $totalPmnt; ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <img src="image/inkpen.png" alt="an ink pen" class="inkpen"/>
    </section>
</main>
</body>
</html>
