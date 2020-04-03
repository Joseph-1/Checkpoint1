<?php
$arrAlphabet=['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];

foreach ($arrAlphabet as $key) {
    echo "<a href='?letter=$key'><p>" . strtoupper($key) . "</p></a>";


}