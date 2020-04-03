<?php
require_once '../connec.php';
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
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th  id="name" scope="col">Name</th>
                        <th  id="payment" scope="col">Payment</th>
                    </tr>
                    </thead>
                <?php
                    $table = 'SELECT * FROM bride ORDER BY name';
                    $showTable = $pdo->query($table)->fetchAll();
                ?>
                    <tbody>
                    <?php
                        $total = 0;
                        if(!empty($showTable)){
                            foreach ($showTable as $key => $value){
                                echo'<tr>';
                                echo '<td>' .$value['name'] .'</td>';
                                echo '<td>' .$value['payment'] .'</td>';
                                echo '</tr>';
                                $total = $total + $value['payment'];
                            }
                        }else{
                            echo '<tr>';
                            echo '<td colspan="2">No payment</td>';
                            echo '</tr>';
                        }
                    ?>
                    </tbody>
                        <th scope="row">Totals</th>
                    <?php
                        echo '<td>' .$total .'</td>';
                    ?>
                    <tfoot>

                    </tfoot>
                </table>
            </div>
        </div>
        <img src="image/inkpen.png" alt="an ink pen" class="inkpen"/>
    </section>
</main>
</body>
</html>
