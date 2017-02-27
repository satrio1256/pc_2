<?php 
	require ("d4.php");
	if (isset($_POST['buy'])) {
		$pss = mysqli_real_escape_string($connect, $_POST['pss']);
		$psg_c = mysqli_real_escape_string($connect, $_POST['psg_c']);
		$token = random_bytes(32);
		$psg_oid = hash('sha256', $token);
		for ($i=0; $i<$psg_c; $i++) {
			$save_sql = "INSERT INTO ticket_orders (psg_oid, psg_ori, psg_dest, psg_r)
					VALUES ('$psg_oid', '$origin', '$destinate', '$new')";
			$save_x = mysqli_query($connect, $save_sql);
		};
		header ("Location: psginfo.php?oid=$psg_oid&h=$psg_c&t=$count");
	}
?>
<html>
<head>
	<title>Layanan Transportasi Air | DimHub</title>
	<link rel="stylesheet" href="stylesheet/main.css">
</head>
<body>
	<?php include ("topbar.php") ?>
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
								$count = 0;
								echo "Tanpa Transit";
							} ?>
						</div>
					</div>
					<div class="detail-cnt">
						<div class="detail-head">
							Tanggal Keberangkatan
						</div>
						<div class="detail-body">
							<input class="detail-body" type="date" name="date" value="<?php echo $_REQUEST['date']; ?>"/>
						</div>
					</div>
					<div class="detail-cnt">
						<div class="detail-head">
							Jam Keberangkatan
						</div>
						<div class="detail-body">
							<?php echo $time; ?>
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
					<?php 
						if ($seat_count < 1) { ?>
							<div>
								<br />
								<center style="color: red; font-family: 'Mako', sans-serif; font-size: 15px;">
								Maaf, kapal dengan rute tersebut sudah penuh.
								</center>
								<br />
							</div>
						<?php } else { ?>
							<div class="detail-cnt">
								<div class="detail-head">
									Sisa Tempat
								</div>
								<div class="detail-body">
									<?php 
										echo $seat_count." kursi tersedia";
									?>
								</div>
							</div>
							<div class="detail-cnt">
								<div class="detail-head">
									Jumlah Penumpang (maksimal 5 orang)
								</div>
							<input class="detail-body" type="number" min="1" max="<?php if ($seat_count > 5) { echo 5;} else { echo $seat_count; } ?>" value="1" name="psg_c">
							</div>
							<button class="check_av" type="submit" name="buy">Pesan Tiket</button>
						<?php }
					?>
				</form>
			</div>
		</div>
	</div>
</body>
</html>