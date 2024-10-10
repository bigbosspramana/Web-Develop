<?php
session_start();

// Inisialisasi array untuk menampung buku di session jika belum ada
if (!isset($_SESSION['books'])) {
    $_SESSION['books'] = []; // Inisialisasi array buku dalam session
}

// Definisi class Book dan turunannya
class Book
{
    public $title;
    public $author;
    public $publicationYear;
    public $type;

    public function __construct($title, $author, $publicationYear, $type)
    {
        $this->title = $title;
        $this->author = $author;
        $this->publicationYear = $publicationYear;
        $this->type = $type;
    }

    public function getDetails()
    {
        return "Judul: $this->title, Penulis: $this->author, Tahun: $this->publicationYear, Tipe: $this->type";
    }
}

class EBook extends Book
{
    public $sizefile;

    public function __construct($title, $author, $publicationYear, $type, $sizefile)
    {
        parent::__construct($title, $author, $publicationYear, $type);
        $this->sizefile = $sizefile;
    }

    public function getDetails()
    {
        return parent::getDetails() . ", Ukuran File: $this->sizefile MB";
    }
}

class PrintedBook extends Book
{
    public $numPage;

    public function __construct($title, $author, $publicationYear, $type, $numPage)
    {
        parent::__construct($title, $author, $publicationYear, $type);
        $this->numPage = $numPage;
    }

    public function getDetails()
    {
        return parent::getDetails() . ", Jumlah Halaman: $this->numPage";
    }
}

// Jika form jumlah buku belum disubmit, tampilkan form jumlah buku
if (!isset($_POST['jumlahBuku'])) {
    ?>

    <form method="POST">
        <label for="jumlahBuku">Berapa banyak buku yang ingin Anda input?</label>
        <input type="number" id="jumlahBuku" name="jumlahBuku" min="1" max="100" required>
        <button type="submit">Lanjutkan</button>
    </form>

    <?php
} else {
    // Form jumlah buku sudah disubmit, cek apakah indeks buku sudah diset
    $jumlahBuku = $_POST['jumlahBuku'];
    $currentIndex = isset($_POST['currentIndex']) ? $_POST['currentIndex'] : 1;

    // Simpan data buku yang sebelumnya sudah di-input
    if (isset($_POST['judulBuku'])) {
        $title = $_POST['judulBuku'];
        $author = $_POST['penulisBuku'];
        $publicationYear = $_POST['tahunBuku'];
        $type = $_POST['type'];

        // Tambahkan buku baru ke session
        if ($type == 'ebook') {
            $sizeFile = $_POST['sizeFile'];
            $newBook = new EBook($title, $author, $publicationYear, $type, $sizeFile);
            $_SESSION['books'][] = $newBook; // Simpan buku ke session
        } elseif ($type == 'print') {
            $numPage = $_POST['numPage'];
            $newBook = new PrintedBook($title, $author, $publicationYear, $type, $numPage);
            $_SESSION['books'][] = $newBook; // Simpan buku ke session
        }
    }

    // Jika masih ada buku yang harus diinput
    if ($currentIndex <= $jumlahBuku) {
    ?>

        <form method="POST" id="bookForm">
            <h3>Buku <?= $currentIndex . '/' . $jumlahBuku ?></h3>
            <label for="judulBuku">Judul Buku:</label>
            <input type="text" id="judulBuku" name="judulBuku" maxlength="100" required><br>

            <label for="penulisBuku">Penulis Buku:</label>
            <input type="text" id="penulisBuku" name="penulisBuku" maxlength="100" required><br>

            <label for="tahunBuku">Tahun Buku:</label>
            <input type="number" id="tahunBuku" name="tahunBuku" min="1500" max="2024" required><br>

            <label for="sizeFile">Ukuran File (MB):</label>
            <input type="number" id="sizeFile" name="sizeFile" min="1" max="100"><br>

            <label for="numPage">Jumlah Halaman:</label>
            <input type="number" id="numPage" name="numPage"><br>

            <label for="type">Jenis Buku:</label>
            <select name="type" required>
                <option value="print">Print</option>
                <option value="ebook">Ebook</option>
            </select><br>

            <!-- Simpan currentIndex dan jumlahBuku -->
            <input type="hidden" name="jumlahBuku" value="<?= $jumlahBuku ?>">
            <input type="hidden" name="currentIndex" value="<?= $currentIndex + 1 ?>">
            <button type="submit">Simpan Buku</button>
        </form>

        <div id="bookDetails">
            <h2>Detail Buku</h2>
            <?php
            // Menampilkan detail buku yang sudah diinput sebelumnya
            if (!empty($_SESSION['books'])) {
                foreach ($_SESSION['books'] as $book) {
                    echo '<p>' . $book->getDetails() . '</p>';
                }
            } else {
                echo '<p>Tidak ada buku yang diinput.</p>'; // Jika tidak ada buku
            }
            ?>
        </div>

    <?php
    } else {
        // Proses jika semua buku sudah diinput
        echo '<h2>Detail Buku</h2>';

        if (!empty($_SESSION['books'])) {
            foreach ($_SESSION['books'] as $book) {
                echo '<p>' . $book->getDetails() . '</p>';
            }
        } else {
            echo '<p>Tidak ada buku yang diinput.</p>'; // Jika tidak ada buku
        }
    }
}
?>
