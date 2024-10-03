<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

<?php
class Person {
    public $name;
    public $born_day;
    public $gender;
    public $gpa;
    public $isStudent;

    public function __construct($name, $born_day, $gender, $gpa, $isStudent) {
        $this->name = $name;
        $this->born_day = $born_day;
        $this->gender = $gender;
        $this->gpa = $gpa;
        $this->isStudent = $isStudent;
    }

    public function hitungUmur() {
        $lahir = new DateTime($this->born_day);
        $sekarang = new DateTime();
        $selisih = $sekarang->diff($lahir);
        return [
            'tahun' => $selisih->y,
            'bulan' => $selisih->m,
            'hari' => $selisih->d
        ];
    }

    public function getUmur() {
        return $this->hitungUmur();
    }

    public function getName() {
        return $this->name;
    }

    public function checkStudent() {
        if ($this->isStudent == true) {
            return "Mahasiswa Aktif";
        } else {
            return "Bukan Mahasiswa Aktif";
        }
    }

    public function tampilkanPerson() {
        $umur = $this->hitungUmur();
        $statusMahasiswa = $this->checkStudent();
        echo "Nama: {$this->name}<br> Umur: {$umur['tahun']} tahun {$umur['bulan']} bulan {$umur['hari']} hari<br> Gender: {$this->gender}<br> IPK: {$this->gpa}<br> Status: {$statusMahasiswa}<br>";
    }
}

$persons = [
    new Person("Alvin Yuga Pramana", "2005-08-06", "Laki-laki", 3.9, true),
    new Person("Apryadi", "1980-01-15", "Laki-laki", 3.5, true),
    new Person("Fijeeeee", "1985-03-22", "Perempuan", 3.8, false),
    new Person("Your Braiinnnn", "2000-05-10", "Laki-laki", 3.7, true),
    new Person("Your Eyesss", "2010-09-12", "Laki-laki", 3.9, false),
];;

for ($i = 0; $i <= 4; $i++) {
    echo "<h3>Orang ". ($i+1) ."</h3><br>";
    $persons[0+$i]->tampilkanPerson();
}
?>


</body>

</html>