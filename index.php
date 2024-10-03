<?php
    $greeting = 'Hello World';
    $today = mktime(date("d")+1);
    // $tomorrow  = mktime(0, 0, 0, date("m")  , date("d")+1, date("Y"));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Hi Bigboss!</title>
</head>
<body>
    
    <?php
        //Write out Hello World!
        echo '<p>Hello, World!</p>';

        // Output information on the PHP evironment
        // Sebaiknya jangan di tampilkan
        // phpinfo();

        echo $greeting;
        
        echo $today;

        // echo $tomorrow;

    ?>

</body>
</html>