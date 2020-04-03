<?php
require_once ('../connec.php');
$pdo = new PDO(DSN,USER,PASS);
$error=[];

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
    <div class="nav_alpha">
        <nav class="alpha">
            <?php include_once('./form/alphabet.php');?>
        </nav>
    </div>

    <section class="desktop">
        <img src="image/whisky.png" alt="a whisky glass" class="whisky"/>
        <img src="image/empty_whisky.png" alt="an empty whisky glass" class="empty-whisky"/>

        <div class="pages">
            <div class="page leftpage">
                Add a bribe
                <!-- TODO : Form -->
                <?php
                    require_once ('./form/form_add.php')
                ?>
                <form method="POST" action="">
                    <label for="name">Name</label>
                        <input id="name" name="name" type="text">

                    <label for="payment">Payment</label>
                        <input id="payment" name="payment" type="number">

                    <input type="submit" value="ADD BRIBE" class="submit">
                </form>
            </div>

            <div class="page rightpage">
                <!-- TODO : Display bribes and total payment -->
                <?php require_once ('./form/display_bribe.php') ?>
            </div>
        </div>
        <img src="image/inkpen.png" alt="an ink pen" class="inkpen"/>
    </section>
</main>
</body>
</html>
