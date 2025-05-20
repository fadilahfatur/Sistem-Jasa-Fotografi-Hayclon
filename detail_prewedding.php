<!-- ... -->
<?php
// Hubungkan ke file konfigurasi database atau buat koneksi database di sini
include('includes/config.php');

// Selanjutnya, pastikan variabel $koneksidb sudah terdefinisi dengan koneksi database yang benar.
// Misalnya:
// $koneksidb = mysqli_connect("localhost", "username", "password", "nama_database");

// Kemudian, lanjutkan dengan menggunakan $koneksidb di query Anda seperti yang telah dijelaskan sebelumnya.

// Path menuju folder foto prewedding

$folder_foto = 'admin/prewedding';
$files = glob($folder_foto . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE);

// Membuat dua array terpisah untuk foto landscape dan portrait
$landscape_images = [];
$portrait_images = [];

// Memisahkan foto berdasarkan orientasinya
foreach ($files as $image) {
    list($width, $height, $type, $attr) = getimagesize($image);
    if ($width > $height) {
        $landscape_images[] = $image; // Foto landscape
    } else {
        $portrait_images[] = $image; // Foto portrait
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#3e454c">
    <title><?php echo $pagedesc; ?></title>
    <link rel="shortcut icon" href="img/IMG-20231013-WA0009.jpg">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <link rel="stylesheet" href="css/bootstrap-select.css">
    <link rel="stylesheet" href="css/fileinput.min.css">
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="admin/img/IMG-20231013-WA0009.jpg">
</head>

<div class="container">
    <div class="gallery">
        <?php
        // Menampilkan terlebih dahulu foto landscape
        foreach ($landscape_images as $image) {
        ?>
            <div class="gallery-item">
                <img src="<?php echo $image; ?>" alt="Foto Wedding">
            </div>
        <?php
        }

        // Kemudian menampilkan foto portrait
        foreach ($portrait_images as $image) {
        ?>
            <div class="gallery-item">
                <img src="<?php echo $image; ?>" alt="Foto Wedding">
            </div>
        <?php
        }
        ?>
    </div>
</div>

<style>
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .gallery {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 20px;
    }

    .gallery-item {
        flex: 0 0 calc(33.33% - 20px);
    }

    .gallery-item img {
        width: 100%;
        height: auto;
    }
</style>