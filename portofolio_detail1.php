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
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title><?php echo $pagedesc; ?></title>
    <!--Bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
    <link href="assets/css/slick.css" rel="stylesheet">
    <link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" id="switcher-css" type="text/css" href="assets/switcher/css/switcher.css" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all" data-default-color="true" />
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple" media="all" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="admin/img/IMG-20231013-WA0009.jpg">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
</head>


<body>

    <!-- Start Switcher -->
    <?php include('includes/colorswitcher.php'); ?>
    <!-- /Switcher -->

    <!--Header-->

    <!-- /Header -->

    <!--Listing-Image-Slider-->
    <?php
    if (mysqli_num_rows($query_portofolio) > 0) {
        while ($result = mysqli_fetch_array($query_portofolio)) {
            // Menampilkan slider dengan foto-foto dari entri portofolio
    ?>
            <section id="listing_img_slider">
                <!--... (kode slider yang ada) -->
            </section>
            <!--/Listing-Image-Slider-->

            <!--Listing-detail-->
            <section class="listing-detail">
                <div class="container">
                    <!-- Menampilkan detail portofolio (yang sudah ada) -->
                    <div class="listing_detail_head row">
                        <div class="col-md-9">
                            <h3><?php echo htmlentities($result['nama_portofolio']); ?></h3>
                        </div>
                        <div class="col-md-3">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="main_features">
                                <!-- ... (kode yang lain) -->
                            </div>
                        </div>
                        <!--Sidebar-->
                        <div class="container">
                            <div class="widget_heading">

                            </div <div class="admin/galery">
                            <div class="row">
                                <?php
                                $folder_foto = 'admin/foto_single'; // Ganti dengan path menuju folder foto Anda
                                $id_kategori = $result['id_SINGLE_SHOOT'];

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