<?php
if ($_POST) {
    $checkEN=strtolower($_POST['name']);
    if(!empty($_POST)&& ($checkEN =! "eliott ness")) {
        if (!empty($_POST['name']) && !empty($_POST['payment']) && $_POST['payment'] > 0) {
            $query_send_bribe = 'INSERT INTO bribe SET name=:name, payment=:payment';
            $add_bribe = $pdo->prepare($query_send_bribe);

            $add_bribe->bindValue(':name', $_POST['name'], PDO::PARAM_STR);
            $add_bribe->bindValue(':payment', $_POST['payment'], PDO::PARAM_INT);

            $add_bribe->execute();

        } else {
            if (empty($_POST['name']) && empty($_POST['payment'])) {
                $error = ["No value are insert"];
            } elseif (empty($_POST['name'])) {
                $error = ["Name is empty"];
            } elseif (empty($_POST['payment'])) {
                $error = ["Payment is empty"];
            } elseif ($_POST['payment'] < 0) {
                $error["Payment value is negative"];
            }

            echo "<p>" . $error[0] . "</p>";
        }
    }else{
        echo "<p>This man is untouchable</p>";
    }
}