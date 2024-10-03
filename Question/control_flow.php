<?php
    ob_start();
    include "variables.php";
    ob_end_clean();

    for ($i = 0; $i <= 4; $i++) {
        echo "<h3>Orang ". ($i+1) ."</h3><br>";
        $umur = $persons[$i]->getUmur();

        if ($umur['tahun'] >= 18) {
            echo "You're an adult.";
        } else {
            echo "You're a minor.";
        }
    }
?>