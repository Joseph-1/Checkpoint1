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
    <section class="alphaIndex">
        <?php
        echo '<a href="book.php">All</a>  //';
            $letter = range('a','z');
            foreach ($letter as $value){
                echo '<a href="?letter=' .$value .'"> ' .strtoupper($value) .'</a>';
            }

        ?>
    </section>
    <section class="desktop">
        <img src="image/whisky.png" alt="a whisky glass" class="whisky"/>
        <img src="image/empty_whisky.png" alt="an empty whisky glass" class="empty-whisky"/>

        <div class="pages">
            <div class="page leftpage">
                Add a bribe
                <!-- TODO : Form -->
                <?php
                if(isset($_POST['addPayment'])){
                    if($_POST['formName'] == 'Eliott Ness'){
                        echo '<div class=error>This man is untouchable</div>';
                    }elseif($_POST['formName'] !='' && $_POST['formPayment'] > 0){
                        $pay = 'INSERT INTO bride VALUES (NULL, :name, :payment)';
                        $statement = $pdo ->prepare($pay);

                        $statement->bindValue(':name', $_POST['formName'], PDO::PARAM_STR);
                        $statement->bindValue(':payment', $_POST['formPayment'], PDO::PARAM_INT);
                        $statement->execute();
                        header('location: ./book.php');
                    }else{
                        echo '<div class=error>Error</div>';
                    }
                }
                ?>
                <form method="post">
                    <div class="form">
                        <label for="formName">Name *</label>
                        <input type="text" required="" class="formInput" name="formName" placeholder="Name">
                    </div>
                    <div class="form">
                        <label for="fromPayment">Payment *</label>
                        <input type="number" required="" class="formInput" name="formPayment" placeholder="Payment">
                    </div>
                    <div align="right">
                        <button type="submit" value="addPayment" name="addPayment" class="btn">Submit the payment</button>
                    </div>
                </form>

            </div>

            <div class="page rightpage">
                <!-- TODO : Display bribes and total paiement -->
                <div class="letter">
                <?php
                if(isset($_GET['letter'])){
                    $getLetter = $_GET['letter'];
                    echo strtoupper($getLetter) .'<hr/>';
                }else{
                    $getLetter ='';
                }

                ?>

                </div>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th  id="tabName" scope="col">Name</th>
                        <th  id="tabPayment" scope="col">Payment</th>
                    </tr>
                    </thead>
                <?php
                    if($getLetter != ''){
                        $table = "SELECT * FROM bride WHERE name LIKE '$getLetter%' ORDER BY name";
                    }else{
                        $table = "SELECT * FROM bride ORDER BY name";
                    }

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
                    <tfoot>
                        <th scope="row">Totals</th>
                        <?php
                        echo '<td>' .$total .'</td>';
                        ?>
                    </tfoot>
                </table>
            </div>
        </div>
        <img src="image/inkpen.png" alt="an ink pen" class="inkpen"/>
    </section>
</main>
</body>
</html>
