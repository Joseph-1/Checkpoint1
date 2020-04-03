<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/book.css">
    <title>Checkpoint PHP 1</title>
</head>
<body>

<?php include 'header.php'; ?>

<main>

    <section class="desktop">
        <div class="glass">
            <img src="image/whisky.png" alt="a whisky glass" class="whisky"/>
            <img src="image/empty_whisky.png" alt="an empty whisky glass" class="empty-whisky"/>  <!-- vide -->
        </div>

        <div class="pages">
            <div class="page leftpage">
                <h2>Add a bribe</h2>
                <form>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name">
                    </div>
                    <div class="form-group">
                        <label for="number">Payment</label>
                        <input type="number" class="form-control" id="number">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <div class="page rightpage">
            <?php
                require ('../connec.php');

                // $requete = "SELECT * FROM bribe";
                // $statement = $pdo->query($requete)->fetchAll();
            ?>
            <table>
                <thead>
                    <tr class="tr_head">
                        <th colspan="2">S</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="tr_body">
                <?php
                    $statement = $db -> query('SELECT bribe.id, bribe.name, bribe.bribe FROM bribe');
                    while($item = $statement -> fetch()) {
                        echo "<td>" . $bride['name'] . "</td>";
                        echo "<td>" . $bride['bribe'] . "€ </td>";
                        echo "</tr>";
                    }
                ?>
                        <td>Sam Burns</td>
                        <td>100€</td>
                    </tr>
                
                    <tr class="tr_body">
                        <td>Samuel Yans</td>
                        <td>52563€</td>
                    </tr>
                     <tr class="tr_body">
                        <td>Simon Pogg</td>
                        <td>52€</td>
                    </tr>
                    <tr class="tr_body">
                        <td>Sophia Maria</td>
                        <td>452€</td>
                    </tr>
                    <tr class="tr_body">
                        <td>Stacie Humberg</td>
                        <td>568€</td>
                    </tr>
                    <tr class="tr_body">
                        <td>Steve Grant</td>
                        <td>1000€</td>
                    </tr>
                    <tr class="tr_body">
                        <td>Steve Porcher</td>
                        <td>7865€</td>
                    </tr>
                    <tr class="tr_body">
                        <td>Sylvester Stallon</td>
                        <td>77897€</td>
                    </tr>
                    <tr class="tr_body">
                        <td>Szen Tren</td>
                        <td>562€</td>
                    </tr>
                    <tr class="tr_body tr-total">
                        <td>Total</td>
                        <td class="tdb">141059€</td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
        <div class="b_inkpen">
            <img src="image/inkpen.png" alt="an ink pen" class="inkpen"/>
        </div>
    </section>
</main>
</body>
</html>


<!-- INSERT INTO bribe (id, name, payment) VALUES (NULL, 'str', 'int'), (NULL, 'str', 'int'); -->