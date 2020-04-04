<?php 
require('connec.php');
$name = $_POST['name'];
$payment=$_POST['payment'];
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
<div class="alpha">
    <?php
$letters = range('A','Z');?>
<ul>
<?php foreach($letters as $letter){?>

<?php echo '<li><a href="?letter='.$letter.'">'.$letter.'</a> </li>';}?> 
<?php echo "   ";   ?>
</ul>
</div>
<main class="container">

    <section class="desktop">
        <img src="image/whisky.png" alt="a whisky glass" class="whisky"/>
        <img src="image/empty_whisky.png" alt="an empty whisky glass" class="empty-whisky"/>

        
        <div class="pages">
            <div class="page leftpage">
                Add a bribe
                <br>
              
                <!-- TODO : Form -->
                <?php   if($name == 'Eliott Ness')
                        {
                        echo "This man is untouchable";
                        }
                        elseif($name != NULL && $payment>0) 
                        {$query = "INSERT INTO bride (bride_name, payment) VALUES (:bride_name, :payment)";
                            $statement = $pdo->prepare($query);
                            $statement->bindValue(':bride_name',$name, \PDO::PARAM_STR);
                            $statement->bindValue(':payment', $payment, \PDO::PARAM_INT);
                                
                            $statement->execute();
                            echo "You're welcome !!";
                        }
                        elseif( $payment<0)
                        {
                            echo "The payment can't and couldn't be negative";
                        }
                        else
                        {
                            echo "You should complet the form !!!";
                        }
                        ?>
                
                <form action="" method="post" class="form-example">
                    <div class="form-example">
                        <label for="name">Name 
                        <input type="text" name="name" id="name" size="30">
                        </label>
                    </div>
                    <div class="form-example">
                        <label for="payment">Payment 
                        <input type="number" name="payment" id="payment" size="30" >
                        </label>
                    </div>
                    <div class="form-example">
                        <input type="submit" value="Pay !">
                    </div>
                </form>
                <?php $name= $_POST["name"];
                    $payment=$_POST['payment'];?>
            </div>

            <div class="page rightpage">
                <!-- TODO : Display bribes and total paiement -->
                <?php if($_GET['letter']<>'')
                    {   $query="SELECT * FROM bride WHERE bride_name LIKE '$_GET[letter]%'";
                        $statement= $pdo->query($query);
                        $brides=$statement->fetchAll(); ?>                       
                    <table class="alphabet">
                        <thead>
                            <tr>
                            <th colspan="2"><?php echo "$_GET[letter]"; ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($brides as $bride)
                            {?>
                            <tr>
                            <td><?php echo " $bride[bride_name]";?></td>
                            <td><?php echo " $bride[payment]€";?></td>
                            </tr>
                            <?php }?>
                        </tbody>
                        <tfoot>
                            <tr>
                            <td>Total</td>
                            <?php $query = "SELECT SUM(payment) FROM bride WHERE bride_name LIKE '$_GET[letter]%';";
                                  $statement = $pdo->query($query);
                                  $sum= $statement->fetch();
                            ?>
                            <td><?php echo "$sum[0]€";?></td>
                            </tr>
                           
                        </tfoot>
                    </table>
                    <?php } ?>    
                    <?php    if($_GET['letter']==NULL){
                        $query = "SELECT * FROM bride ORDER BY bride_name ASC";
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
                        <td><?php echo " $bride[bride_name]";?></td>
                        <td><?php echo " $bride[payment]€";?></td>
                        </tr>
                        <?php }?>
                    </tbody>
                    <tfoot>
                        <tr>
                        <td>Total</td>
                        <?php $query = "SELECT SUM(payment) FROM bride";
                                $statement = $pdo->query($query);
                                $sum= $statement->fetch();
                        ?>
                        <td><?php echo "$sum[0]€";?></td>
                        </tr>
                       
                    </tfoot>
                </table>                                     
            
                        <?php } ?>            
            </div>
        </div>
        
        <div  class="pen"><img src="image/inkpen.png" alt="an ink pen" class="inkpen" /></div>
        
    </section>
</main>
</body>
</html>
