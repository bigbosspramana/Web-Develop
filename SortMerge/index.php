<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array Sort Merge</title>
</head>

<body>

<form method="post">
    <h2>Array Sort</h2>
    <h3>Masukkan Element untuk Array 1</h3>
    <!-- Input tersembunyi untuk menunjukkan jumlah elemen Array 1 -->
    <input type="hidden" name="num1" value="10"> 
    <?php for ($i = 0; $i < 10; $i++): ?>
        <!-- Label untuk setiap elemen Array 1 -->
        Element <?php echo ($i + 1); ?> : <input type="number" name="array1[]" required><br>
    <?php endfor; ?>

    <h3>Masukkan Element untuk Array 2</h3>
    <!-- Input tersembunyi untuk menunjukkan jumlah elemen Array 2 -->
    <input type="hidden" name="num2" value="10"> 
    <?php for ($i = 0; $i < 10; $i++): ?>
        <!-- Label untuk setiap elemen Array 2 -->
        Element <?php echo ($i + 1); ?> : <input type="number" name="array2[]" required><br>
    <?php endfor; ?>

    <h3>Jumlah Elemen yang Ingin Diambil dari Setiap Array</h3>
    <!-- Input untuk menentukan jumlah elemen yang diambil dari Array 1 -->
    <label>Ambil dari Array 1: <input type="number" name="takeFromArray1" min="0" max="10" value="2"></label><br>
    <!-- Input untuk menentukan jumlah elemen yang diambil dari Array 2 -->
    <label>Ambil dari Array 2: <input type="number" name="takeFromArray2" min="0" max="10" value="2"></label><br>

    <!-- Tombol untuk mengirimkan elemen-elemen -->
    <input type="submit" name="submitElements" value="Send Arrays">
</form>

<?php

if (isset($_POST['submitElements'])) {
    $array1 = $_POST['array1'];
    $array2 = $_POST['array2'];
    
    $takeFromArray1 = intval($_POST['takeFromArray1']);
    $takeFromArray2 = intval($_POST['takeFromArray2']);
    
    $mergedArray = [];
    $takenFromArray1 = []; 
    $takenFromArray2 = []; 

    if (count($array1) > 0 && $takeFromArray1 > 0) {
        $takenFromArray1 = array_slice($array1, 0, $takeFromArray1);
        $mergedArray = array_merge($mergedArray, $takenFromArray1);
    }
    
    if (count($array2) > 0 && $takeFromArray2 > 0) {
        $takenFromArray2 = array_slice($array2, 0, $takeFromArray2);
        $mergedArray = array_merge($mergedArray, $takenFromArray2);
    }

    // Menampilkan hasil penggabungan array
    echo '<h3>Hasil Penggabungan Array:</h3>';
    echo '<pre>';
    print_r($mergedArray);
    echo '</pre>';

    if (!empty($takenFromArray1)) {
        // Menampilkan angka yang diambil dari Array 1
        echo '<h4>Angka yang diambil dari Array 1: ' . implode(', ', $takenFromArray1) . '</h4>';
    }

    if (!empty($takenFromArray2)) {
        // Menampilkan angka yang diambil dari Array 2
        echo '<h4>Angka yang diambil dari Array 2: ' . implode(', ', $takenFromArray2) . '</h4>';
    }
}
?>


</body>

</html>


