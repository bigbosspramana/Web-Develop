<!DOCTYPE html>
<html>
<head>
    <title>Palindrome Number Segitiga Sama Kaki</title>
</head>
<body>

<h2>Input jumlah baris palindrome</h2>
<form method="post">
    <label for="num">Jumlah Baris:</label>
    <input type="number" id="num" name="num" min="1" required>
    <input type="submit" value="Create">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil input dari pengguna
    $num = intval($_POST["num"]);
    
    // Panggil fungsi untuk membuat segitiga palindrome
    buatPalindromeSegitiga($num);
}

// Fungsi untuk membuat segitiga palindrome
function buatPalindromeSegitiga($n) {
    for ($i = 1; $i <= $n; $i++) {
        // Tampilkan spasi untuk segitiga sama kaki
        for ($j = 1; $j <= $n - $i; $j++) {
            echo "&nbsp;&nbsp;";
        }

        // Cetak angka bagian depan dari palindrome
        for ($j = 1; $j <= $i; $j++) {
            echo $j;
        }

        // Cetak angka bagian belakang dari palindrome
        for ($j = $i - 1; $j >= 1; $j--) {
            echo $j;
        }

        // Pindah ke baris berikutnya
        echo "<br>";
    }
}
?>

</body>
</html>
