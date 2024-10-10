<?php
session_start();

if (!isset($_SESSION['books'])) {
    $_SESSION['books'] = [];
}

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
        return "$this->type Title : $this->title, Author : $this->author, Year : $this->publicationYear";
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

if (!isset($_POST['bookType'])) {
    ?>
    <form method="POST">
        <label for="bookType">Pilih Jenis Buku:</label><br>
        <select id="bookType" name="bookType" required>
            <option value="ebook">EBook</option>
            <option value="print">PrintedBook</option>
        </select>
        <button type="submit">Submit</button>
    </form>
    <?php
} else {
    $bookType = $_POST['bookType'];

    if (!isset($_POST['jumlahBuku'])) {
        ?>
        <form method="POST">
            <label for="jumlahBuku">Berapa banyak buku yang ingin Anda input?</label><br>
            <input type="number" id="jumlahBuku" name="jumlahBuku" min="1" max="100" required>
            <input type="hidden" name="bookType" value="<?= $bookType ?>">
            <button type="submit">Submit</button>
        </form>
        <?php
    } else {
        $jumlahBuku = $_POST['jumlahBuku'];
        $currentIndex = isset($_POST['currentIndex']) ? $_POST['currentIndex'] : 1;

        if (isset($_POST['judulBuku'])) {
            $title = $_POST['judulBuku'];
            $author = $_POST['penulisBuku'];
            $publicationYear = $_POST['tahunBuku'];

            if ($bookType == 'ebook') {
                $sizeFile = $_POST['sizeFile'];
                $newBook = new EBook($title, $author, $publicationYear, $bookType, $sizeFile);
                $_SESSION['books'][] = $newBook;
            } elseif ($bookType == 'print') {
                $numPage = $_POST['numPage'];
                $newBook = new PrintedBook($title, $author, $publicationYear, $bookType, $numPage);
                $_SESSION['books'][] = $newBook;
            }
        }

        if ($currentIndex <= $jumlahBuku) {
            ?>
            <form method="POST" id="bookForm">
                <h3>Buku <?= $currentIndex . '/' . $jumlahBuku ?></h3>
                <label for="judulBuku">Judul Buku : </label>
                <input type="text" id="judulBuku" name="judulBuku" maxlength="100" required><br>

                <label for="penulisBuku">Penulis Buku : </label>
                <input type="text" id="penulisBuku" name="penulisBuku" maxlength="100" required><br>

                <label for="tahunBuku">Tahun Buku : </label>
                <input type="number" id="tahunBuku" name="tahunBuku" min="1500" max="2024" required><br>

                <?php if ($bookType == 'ebook') { ?>
                    <label for="sizeFile">Ukuran File (MB) : </label>
                    <input type="number" id="sizeFile" name="sizeFile" min="1" max="100" required><br>
                <?php } else { ?>
                    <label for="numPage">Jumlah Halaman : </label>
                    <input type="number" id="numPage" name="numPage" min="1" required><br>
                <?php } ?>

                <input type="hidden" name="jumlahBuku" value="<?= $jumlahBuku ?>">
                <input type="hidden" name="currentIndex" value="<?= $currentIndex + 1 ?>">
                <input type="hidden" name="bookType" value="<?= $bookType ?>">
                <button type="submit">Simpan Buku</button>
            </form>

            <div id="bookDetails">
                <h2>Detail Buku</h2>
                <?php
                if (!empty($_SESSION['books'])) {
                    foreach ($_SESSION['books'] as $book) {
                        echo '<p>' . $book->getDetails() . '</p>';
                    }
                } else {
                    echo '<p>Tidak ada buku yang diinput.</p>';
                }
                ?>
            </div>
            <?php
        } else {
            echo '<h2>Detail Buku</h2>';
            if (!empty($_SESSION['books'])) {
                foreach ($_SESSION['books'] as $book) {
                    echo '<p>' . $book->getDetails() . '</p>';
                }
            } else {
                echo '<p>Tidak ada buku yang diinput.</p>';
            }
        }
    }
}
?>
