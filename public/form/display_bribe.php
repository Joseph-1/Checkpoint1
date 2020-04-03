<table>
    <thead>
    <tr>
        <th >Name</th>
        <th >Payment</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $totalBribe = 0;
    if($_GET) {
        foreach ($arrAlphabet as $key) {
            if ($_GET && $_GET['letter'] == $key) {
                $help_search= '"'.$key.'%"';
                $alphaQuery = 'SELECT * FROM bribe WHERE name LIKE'.$help_search;
                $req_alpha = $pdo->prepare($alphaQuery);
                $req_alpha->bindValue(':search', $key);
                $req_alpha->execute();
                $result_alpha = $req_alpha->fetchAll();

                foreach ($result_alpha as $key => $value) {
                    echo "<tr>";
                    echo "<th>" . $value['name'] . "</th>";
                    echo "<td>" . $value['payment'] . "</td>";
                    echo "</tr>";
                    $totalBribe += $value['payment'];
                }
            }
        }
    }else {

        $query = 'SELECT * FROM bribe';
        $req = $pdo->prepare($query);
        $req->execute();
        $allBribe = $req->fetchAll();

        foreach ($allBribe as $key => $value) {
            echo "<tr>";
            echo "<th>" . $value['name'] . "</th>";
            echo "<td>" . $value['payment'] . "</td>";
            echo "</tr>";
            $totalBribe += $value['payment'];
        }
    }

    ?>
    </tbody>
    <tfoot>
    <tr>
        <th>Total</th>
        <td><?php
            if($_GET){echo $totalBribe;}?></td>
    </tr>
    </tfoot>
</table>
