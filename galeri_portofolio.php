<!--Galeri Portofolio-->
<section class="section-padding gray-bg">
    <div class="container">
        <h2>Galeri Foto</h2>
        <div class="gallery">
            <?php
            $galleryPath = "galeri_portofolio"; // Ganti dengan direktori galeri yang sesuai
            $images = glob($galleryPath . '/*.jpg'); // Mendapatkan daftar gambar dalam direktori

            foreach ($images as $image) {
                echo '<img src="' . $image . '" alt="' . basename($image) . '">';
            }
            ?>
        </div>
    </div>
</section>
<!-- /Galeri Foto -->