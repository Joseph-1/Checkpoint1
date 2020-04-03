<?php
    function sumBribes(){
    $result=$showBribes->fetchAll();
    echo array_sum($result);
    }
?>