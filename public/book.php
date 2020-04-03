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

<?php include 'header.php';
        require_once 'connec.php'; ?>

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
                <table>
                    <thead><th>S</th></thead>

                    <tbody> <?php
                    $total = 0;
                    $query = "SELECT name, payment FROM bribe ORDER BY name ASC";
                    $statement = $pdo->query($query);
                    $bribe = $statement->fetchAll(PDO::FETCH_ASSOC);


                        foreach($bribe as $array) {
                            echo "<tr>";
                            foreach($array as $name => $payment){
                                    $total += $payment;
                                    echo "<td>". $payment ."</td><td>";
                            }
                            echo "</tr>";
                        }
                        ?>

                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Total : </th>
                        <?php echo "<td>" . $total . "</td>"; ?>
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
