<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/format_rupiah.php');

if (strlen($_SESSION['ulogin']) == 0) {
	header('location:index.php');
} else {
	$tglnow   = date('Y-m-d');
	$tglmulai = strtotime($tglnow);
	$jmlhari  = 86400 * 1;
	$tglplus  = $tglmulai + $jmlhari;
	$now = date("Y-m-d", $tglplus);

	if (isset($_POST['submit'])) {
		$fromdate = $_POST['fromdate'];
		$tglnow   = date('Y-m-d');
		$id = $_POST['id'];
		$jam = $_POST['jam'];
		$cat = $_POST['catatan'];
		$email = $_SESSION['ulogin'];
		$stt = "Menunggu Pembayaran";
		$trx = date('dmYHis');

		$sql 	= "INSERT INTO transaksi (id_trx,email,id_paket,tgl_trx,stt_trx,tgl_take,jam_take,catatan)
			   VALUES('$trx','$email','$id','$tglnow','$stt','$fromdate','$jam','$cat')";
		$query 	= mysqli_query($koneksidb, $sql);
		if ($query) {
			echo " <script> alert ('Successful Transaction.'); </script> ";
			echo "<script type='text/javascript'> document.location = 'riwayatsewa.php'; </script>";
		} else {
			echo " <script> alert ('Ooops, something went wrong. Please try again.'); </script> ";
			echo "<script type='text/javascript'> document.location = 'booking.php?id=$id'; </script>";
		}
	}
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
		<?php include('includes/header.php'); ?>
		<!--Page Header-->
		<!-- /Header -->

		<?php
		$id = $_GET['id'];
		$useremail = $_SESSION['login'];
		$sql1 = "SELECT * FROM paket WHERE id_paket='$id'";
		$query1 = mysqli_query($koneksidb, $sql1);
		$result = mysqli_fetch_array($query1);
		?>
		<script type="text/javascript">
			function valid() {
				if (document.sewa.todate.value < document.sewa.fromdate.value) {
					alert("Tanggal selesai harus lebih besar dari tanggal mulai sewa!");
					return false;
				}
				if (document.sewa.fromdate.value < document.sewa.now.value) {
					alert("Tanggal sewa minimal H-1!");
					return false;
				}

				return true;
			}
		</script>

		<section class="user_profile inner_pages">
			<div class="container">
				<div class="col-md-6 col-sm-8">
					<div class="product-listing-img"><img src="admin/gallery/<?php echo htmlentities($result['foto_paket']); ?>" class="img-responsive" alt="Image" /> </a> </div>
					<div class="product-listing-content">
						<h5><?php echo htmlentities($result['nama_paket']); ?></a></h5>
						<p class="list-price"><?php echo htmlentities(format_rupiah($result['harga'])); ?> / Packs</p>
					</div>
				</div>

				<div class="user_profile_info">
					<div class="col-md-8 col-sm-10">
						<form method="post" name="sewa" onSubmit="return valid();">
							<input type="hidden" class="form-control" name="id" value="<?php echo $id; ?>" required>
							<input type="hidden" class="form-control" name="email" value="<?php echo $id; ?>" required>
							<div class="form-group">
								<label>Date of Photoshoot</label>
								<input type="date" class="form-control" name="fromdate" placeholder="From Date(dd/mm/yyyy)" required>
								<input type="hidden" name="now" class="form-control" value="<?php echo $now; ?>">
							</div>
							<div class="form-group">
								<label>Jam</label><br />
								<select class="form-control" name="jam" required>
									<option value="" selected>== Select hours ==</option>
									<option value="07:00">07:00</option>
									<option value="08:00">08:00</option>
									<option value="09:00">09:00</option>
									<option value="10:00">10:00</option>
									<option value="11:00">11:00</option>
									<option value="12:00">12:00</option>
									<option value="13:00">13:00</option>
									<option value="14:00">14:00</option>
									<option value="15:00">15:00</option>
									<option value="16:00">16:00</option>
									<option value="17:00">17:00</option>
									<option value="18:00">18:00</option>
									<option value="19:00">19:00</option>
								</select>
							</div>
							<div class="form-group">
								<label>Catatan</label>
								<textarea class="form-control" name="catatan" placeholder="" required></textarea>
							</div>
							<br />
							<div class="form-group">
								<input type="submit" name="submit" value="Submit" class="btn btn-block">
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>
		<!--/my-vehicles-->
		<?php include('includes/footer.php'); ?>

		<!-- Scripts -->
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/interface.js"></script>
		<!--Switcher-->
		<script src="assets/switcher/js/switcher.js"></script>
		<!--bootstrap-slider-JS-->
		<script src="assets/js/bootstrap-slider.min.js"></script>
		<!--Slider-JS-->
		<script src="assets/js/slick.min.js"></script>
		<script src="assets/js/owl.carousel.min.js"></script>
	</body>

	</html>
<?php } ?>