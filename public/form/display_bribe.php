<table>
    <thead>
    <tr>
        <th >Name</th>
        <th >Payment</th>
    </tr>
    </thead>
    <tbody>
    <?php


    $query= 'SELECT * FROM bribe';
    $req = $pdo->prepare($query);
    $req->execute();
    $allBribe= $req->fetchAll();
    $totalBribe=0;
    foreach ($allBribe as $key => $value){
        echo "<tr>";
        echo "<th>" . $value['name'] . "</th>";
        echo "<td>" . $value['payment'] . "</td>";
        echo "</tr>";
        $totalBribe+= $value['payment'];
    }
    ?>
    </tbody>
    <tfoot>
    <tr>
        <th>Total</th>
        <td><?php echo $totalBribe?></td>
    </tr>
    </tfoot>
</table>