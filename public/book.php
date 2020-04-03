<?php 
require('connec.php');
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
                $query = "SELECT * FROM bride ORDER BY name ASC";
                $statement = $pdo->query($query);
                $brides= $statement->fetchAll();
                ?>
                <table>
                    <thead>
                        <tr>
                        <th>Name</th>
                        <th>Payment</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($brides as $bride)
                        {?>
                        <tr>
                        <td><?php echo " $bride[name]";?></td>
                        <td class="left"><?php echo " $bride[payment]";?></td>
                        </tr>
                        <?php }?>
                    </tbody>
                    <tfoot>
                        <tr>
                        <td></td>
                        <?php $query = "SELECT SUM(payment) FROM bride";
                                $statement = $pdo->query($query);
                                $sum= $statement->fetch();
                        ?>
                        <td><?php echo "$sum[0]";?></td>
                        </tr>
                       
                    </tfoot>
            </div>
        </div>
        
        <div  class="pen"><img src="image/inkpen.png" alt="an ink pen" class="inkpen" /></div>
    </section>
</main>
</body>
</html>
