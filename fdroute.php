<?php 
	require ("d4.php");
	if (isset($_POST['buy'])) {
		$pss = mysqli_real_escape_string($connect, $_POST['pss']);
		$psg_c = mysqli_real_escape_string($connect, $_POST['psg_c']);
		$psg_oid = random_bytes(32);
		for ($i=0; $i<$psg_c; $i++) {
			$save_sql = "INSERT INTO ticket_orders (psg_oid, psg_ori, psg_dest, psg_r)
					VALUES ('$psg_oid', '$origin', '$destinate', '$new')";
			$save_x = mysqli_query($connect, $save_sql);
		};
		header ("Location: psginfo.php?oid=$psg_oid&h=$psg_c");
	}
?>
<html>
<head>
	<title>Layanan Transportasi Air | DimHub</title>
	<link rel="stylesheet" href="stylesheet/main.css">
</head>
<body>
	<div class="home-topbar">
		<div class="top-left">
			<img class="left-img" src="images/logo.png"/>
		</div>
		<div class="top-right">
			<ul>
				<li><a href="#">BELI TIKET</a></li>
				<li><a href="#">CEK PESANAN</a></li>
				<li><a href="#">BANTUAN</a></li>
				<li><a href="#" style="color: #e0774a;">LOGIN</a></li>	
			</ul>
		</div>
	</div>
	<div class="main-container">
		<div class="box">
			<div class="box-head">
				CARI TIKET
				<div class="head-sub">
					<?php if ($new != "No Route") {
						echo "Rute tersedia";
					} else {
						echo "Maaf, rute tidak tersedia";
					} ?>
				</div>
			</div>
			<div class="box-body">
				<form method="POST">
					<div class="detail-cnt">
						<div class="detail-head">
							Asal
						</div>
						<div class="detail-body">
							<?php echo $origin; ?>
						</div>
					</div>
					<div class="detail-cnt">
						<div class="detail-head">
							Tujuan
						</div>
						<div class="detail-body">
							<?php echo $destinate; ?>
						</div>
					</div>
					<div class="detail-cnt">
						<div class="detail-head">
							Transit
						</div>
						<div class="detail-body">
							<?php if ($count > 2) {
								$count -= 2;
								echo $count." kali transit";
							} else {
								$count = "Tanpa Transit";
								echo $count;
							} ?>
						</div>
					</div>
					<div class="detail-cnt">
						<div class="detail-head">
							Rute
						</div>
						<div class="detail-body">
							<?php echo $new ?>
						</div>
					</div>
					<div class="detail-cnt">
						<div class="detail-head">
							Sisa Tempat
						</div>
						<div class="detail-body">
							1 kursi kosong
						</div>
					</div>
					<div class="detail-cnt">
						<div class="detail-head">
							Jumlah Penumpang
						</div>
					<input class="detail-body" type="number" min="1" value="1" name="psg_c">
					</div>
					<button class="check_av" type="submit" name="buy">Pesan Tiket</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>