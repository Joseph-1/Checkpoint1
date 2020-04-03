<table>
    <thead>
    <tr>
        <th >Payment</th>
        <th >Name</th>
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