<?php

// Connection to database with PDO
require_once ('../config/connec.php');
$pdo = new PDO(DSN, USER, PASS);

// Adding a bribe into the DB
if (isset($_POST['add']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['name']) && !empty($_POST['payment']) && $_POST['payment'] > 0) {
        // Building insert prepared query
        $query = "INSERT INTO bribe VALUES (NULL, :name, :payment)";
        $statement = $pdo->prepare($query);

        // Securing the values with placeholders
        $statement->bindValue(':name', $_POST['name'], PDO::PARAM_STR);
        $statement->bindValue(':payment', $_POST['payment'], PDO::PARAM_INT);

        // Executing the query
        $statement->execute();
    }
    elseif (empty($_POST['name']) && $_POST['payment'] > 0) {
        $errorMsg = 'Please, write a name';
    }
    elseif (!empty($_POST['name']) && $_POST['payment'] <= 0) {
        $errorMsg = 'Please, enter a positive payment';
    }
    else {
        $errorMsg = 'Please, enter name and payment';
    }
}

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
                <h3>Add a bribe</h3>
                <!-- TODO : Form -->
                <?php
                if (isset($errorMsg)) {
                    echo $errorMsg;
                }
                ?>
                <div class="add-form">
                    <form action="" method="post">
                        <input type="text" class="input" id="payment" name="name" placeholder="Name" required>
                        <input type="number" class="input" id="payment" name="payment" placeholder="Payment" required>
                        <button type="submit" class="button" id="add" name="add">Add</button>
                    </form>
                </div>
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
