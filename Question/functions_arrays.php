<?php
    ob_start(); 
    include "variables.php";
    ob_end_clean();

    function greet($name) {
        return "Hello, {$name}";
    }

    for ($i = 0; $i <= 4; $i++) {
        echo "<h3>Orang ". ($i+1) ."</h3><br>";
        $name = $persons[$i]->getName();
        echo greet($name) . "<br>";
    }

?>