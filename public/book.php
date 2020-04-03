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
include 'connect.php';
?>

<main class="container">
    <!-- Alphabetical INDEX element -->
    <?php
    $alphabet = range('A', 'Z');?>
    <div class="index-container">
        <?php foreach($alphabet as $letter) {
            echo '<a href="?letter='. $letter .'"><div class="index-letter">' . $letter . '</div></a>';
        }?>
    </div>

    <section class="desktop">
        <div class="item-container">
            <img src="image/whisky.png" alt="a whisky glass" class="whisky"/>
            <img src="image/empty_whisky.png" alt="an empty whisky glass" class="empty-whisky"/>

            <div class="pages">
                <div class="page leftpage">
                    Add a bribe
                    <!-- TODO : Form -->
                    <?php

                    /**
                     * PAS DE REFACTORISATION DE CODE POUR LE BONUS
                     * Désolé Yavuz ;-) C'est long et moche...
                     */

                    if(isset($_POST) && count(count($_POST) !=0)) {
                    if(isset($_POST['name']) && !empty($_POST['name']) && $_POST['name'] != "Eliott Ness" && isset($_POST['payment']) && $_POST['payment'] > 0 ) {
                    ?>
                    <div class="ok">Your form has been properly sent.</div><?php
                    $addQuery = "INSERT INTO bribe (name, payment) VALUES (:name, :payment)";
                    $statement = $pdo->prepare($addQuery);
                    $statement->bindValue(":name", $_POST['name'], \PDO::PARAM_STR);
                    $statement->bindValue(":payment", $_POST['payment'], \PDO::PARAM_INT);
                    $statement->execute();?>

                    <div class="form-result-display"><?php
                        echo '<p>' . array_keys($_POST['name']) . " ---> " . array_values($_POST['name']) . '</p>';
                        echo '<p>' . array_keys($_POST['payment']) . " ---> " . array_values($_POST['payment']) . '</p>'; ?>
                    </div>

                    <?php
                            header("Location: book.php");

                    } elseif (isset($_POST['name']) && !empty($_POST['name']) && $_POST['name'] == "Eliott Ness") { ?>
                        <div class="fail">This man is untouchable</div><?php
                    } else {
                        ?> <div class="fail">Something is wrong in your datas, please check again.</div><?php
                    }}

                    ?>
                    <form class="mod-form" action="" method="post">
                        <div class="form-item container">
                            <input type="text" id="name" name="name">
                            <input type="number" id="payment" name="payment" min="1" max="1000000">
                        </div>
                        <input class="uk-align-right" type="submit" value="Send">
                    </form>
                </div>

                <div class="page rightpage">
                    <!-- TODO : Display bribes and total paiement -->
                    <?php
                    if(isset($_GET['letter']) && in_array($_GET['letter'], $alphabet)) {
                        $bribesQuery = "SELECT name, payment FROM bribe WHERE name LIKE '". $_GET['letter'] ."%' ORDER BY name ASC";
                        $allBribes = $pdo->query($bribesQuery)->fetchAll(PDO::FETCH_ASSOC);
                        $names = $payments = [];
                        foreach($allBribes as $bribes)
                        {
                            foreach($bribes as $param => $value)
                            {
                                if($param == "name") {
                                    $names[] = $bribes[$param];
                                } else {
                                    $payments[] = (int) $bribes[$param];
                                }
                            }
                        } ?>
                        <p class="letter-title"><?php echo $_GET['letter']; ?></p>
                        <table class="overview-table uk-table uk-table-striped uk-table-hover uk-table-justify uk-table-middle uk-table-responsive">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Payment</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <?php
                                foreach($names as $name) {
                                    echo "<td>$name</td>";
                                }
                                ?>
                            </tr>
                            </thead>
                            <tbody>
                            <tr><?php
                                foreach($payments as $payment) {
                                    echo "<td>$payment</td>";
                                }
                                ?>
                            </tr>
                            <tfoot>
                            <tr><td>
                                    <?php echo array_sum($payments); ?>
                                </td>
                            </tr>
                            </tfoot>
                            </tbody>
                        </table>
                    </div>
                </div><?php
                    } else {
                        $bribesQuery = "SELECT name, payment FROM bribe ORDER BY name ASC";
                        $allBribes = $pdo->query($bribesQuery)->fetchAll(PDO::FETCH_ASSOC);
                        $names = $payments = [];
                        foreach($allBribes as $bribes)
                        {
                            foreach($bribes as $param => $value)
                            {
                                if($param == "name") {
                                    $names[] = $bribes[$param];
                                } else {
                                    $payments[] = (int) $bribes[$param];
                                }
                            }
                        } ?>
                        <table class="overview-table uk-table uk-table-striped uk-table-hover
                uk-table-justify uk-table-middle uk-table-responsive">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Payment</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <?php
                                foreach($names as $name) {
                                    echo "<td>$name</td>";
                                }
                                ?>
                            </tr>
                            </thead>
                            <tbody>
                            <tr><?php
                                foreach($payments as $payment) {
                                    echo "<td>$payment</td>";
                                }
                                ?>
                            </tr>
                            <tfoot>
                            <tr><td>
                                    <?php echo array_sum($payments); ?>
                                </td>
                            </tr>
                            </tfoot>
                            </tbody>
                        </table>
                    </div>
                    </div>
                    <?php } ?>

            <div class="pen-container">
                <img src="image/inkpen.png" alt="an ink pen" class="inkpen"/>
            </div>
        </div>
    </section>
</main>
</body>
</html>