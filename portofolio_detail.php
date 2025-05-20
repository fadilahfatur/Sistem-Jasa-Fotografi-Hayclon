<?php
session_start();
include('includes/config.php');
include('includes/format_rupiah.php');
error_reporting(0);

$id = intval($_GET['id']);
$sql_portofolio = "SELECT * FROM portofolio WHERE id_portofolio='$id'";
$query_portofolio = mysqli_query($koneksidb, $sql_portofolio);
?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <!-- Bagian head - termasuk meta, title, dan link CSS -->
</head>

<body>
    <!-- Bagian body - termasuk header, slider, dan detail portofolio -->
    <?php
    if (mysqli_num_rows($query_portofolio) > 0) {
        while ($result = mysqli_fetch_array($query_portofolio)) {
            // Menampilkan slider dengan foto-foto dari entri portofolio
            // Code for slider goes here
    ?>
            <!--Listing-detail-->
            <section class="listing-detail">
                <div class="container">
                    <!-- Menampilkan detail portofolio (yang sudah ada) -->
                    <div class="listing_detail_head row">
                        <div class="col-md-9">
                            <h3><?php echo htmlentities($result['nama_portofolio']); ?></h3>
                        </div>
                        <div class="col-md-3"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="main_features">
                                <!-- ... (kode yang lain) -->
                            </div>
                        </div>
                        <!--Sidebar-->
                        <div class="container">
                            <div class="widget_heading"></div>
                            <div class="row">
                                <?php
                                $folder_foto = ''; // Folder akan diubah sesuai dengan kategori
                                $kategori = $result['kategori'];

                                // Tentukan folder foto berdasarkan kategori portofolio
                                if ($kategori == 'SINGLE SHOOT') {
                                    $folder_foto = 'admin/single_shoot';
                                } elseif ($kategori == 'WEDDING') {
                                    $folder_foto = 'admin/wedding';
                                } elseif ($kategori == 'PREWEDDING') {
                                    $folder_foto = 'admin/prewedding';
                                }

                                // Ambil daftar file dari folder
                                $files = glob($folder_foto . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE);

                                $count = 0;
                                foreach ($files as $image) {
                                    if ($count % 3 == 0) {
                                        echo '</div><div class="row">';
                                    }
                                ?>
                                    <div class="col-md-4 mb-5">
                                        <img src="<?php echo $image; ?>" alt="Foto_Portofolio" class="img-fluid img-thumbnail" style="width: 90%;">
                                    </div>
                                <?php
                                    $count++;
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <!--/Sidebar-->
                </div>

                <div class="space-30"></div>
                <div class="divider"></div>
                </div>
            </section>
            <!--/Listing-detail-->
    <?php
        }
    }
    ?>
    <!-- Bagian lain dari halaman yang tidak berubah juga tetap di sini -->

    <!-- Script JS yang tetap tidak berubah -->
</body>

</html>