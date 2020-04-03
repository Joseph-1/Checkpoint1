<?php
require_once ('../connec.php');
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
                <form method="POST" action="">
                    <label for="name">
                        <input id="name" name="name" type="text">
                    </label>
                    <label for="payment">
                        <input id="payment" name="payment" type="number">
                    </label>
                    <input type="submit" value="ADD BRIBE">
                </form>
            </div>

            <div class="page rightpage">
                <!-- TODO : Display bribes and total payment -->
                <table>
                    <thead>
                    <tr>
                        <th >Payment</th>
                        <th >Name</th>
                    </tr>
                    </thead>
                    <tbody>
                            <?php

                            $pdo = new PDO(DSN,USER,PASS);
                            $query= 'SELECT * FROM bribe';
                            $req = $pdo->prepare($query);
                            $req->execute();
                            $allBribe= $req->fetchAll();
                            $totalBribe=0;
                                foreach ($allBribe as $key => $value){
                                    echo "<tr>";
                                    echo "<td>" . $value['payment'] . "</td>";
                                    echo "<th>" . $value['name'] . "</th>";
                                    echo "</tr>";
                                    $totalBribe+= $value['payment'];
                                }
                            ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td><?php echo $totalBribe?></td>
                        <th>Total</th>
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
