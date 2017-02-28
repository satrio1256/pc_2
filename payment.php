<?php 
	include ("sql/login-proj.php");
	$oid = $_GET['oid'];
	$sql = "SELECT * FROM ticket_orders WHERE psg_oid=$oid";
	$x = mysqli_query($connect, $sql);
	$count = mysqli_num_rows($x);

	if (isset($_POST['check_r'])) {
		$payments = mysqli_real_escape_string($connect, $_POST['payments']);
		if ($payments == 'transfer') {
			$rek = rand(1000, 9999).$count.'145';
		} else {
			$rek = "";
		}
		$code = strtoupper(substr($_GET['oid'], 40, 7));
		
		$cash = "UPDATE ticket_orders SET payment_method='$payments', psg_rekening='$rek', psg_code='$code' WHERE psg_oid='$oid'";
		$xcute = mysqli_query($connect, $cash);

		if (!$xcute) {
			echo("Error description: " . mysqli_error($connect));
		} else {
			header ("Location: thanks.php?oid=$oid");
		}
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
		<div class="box-body">
			<form method="POST">
				<div class="box">
					<div class="box-head">
						PEMBAYARAN
						<div class="head-sub">
							Pilih cara pembayaran Anda
						</div>
					</div>
					<div class="detail-cnt">
						<div class="detail-head">
							Harga Tiket (per Orang)
						</div>
						<div class="detail-body">
							<?php 
								if ($_GET['t'] < 3) {
									$t = 1;
								} else {
									$t = $_GET['t']-2;
								}
								$t *= 10000;
								echo "Rp".$t;
							?>
						</div>
					</div>
					<div class="detail-cnt">
						<div class="detail-head">
							Jumlah Penumpang
						</div>
						<div class="detail-body">
							<?php $h = $_GET['h'];
							echo $h." Orang";
							?>
						</div>
					</div>
					<div class="detail-cnt">
						<div class="detail-head">
							Harga Total
						</div>
						<div class="detail-body">
							<?php
							echo "Rp".$t*$h;
							?>
						</div>
					</div>
					<div class="detail-cnt">
						<div class="detail-head">
							Metode Pembayaran
						</div>
						<input type="radio" name="payments" value="cash">Bayar di Tempat</input><br />
						<input type="radio" name="payments" value="transfer">Transfer</input>
						<button class="check_av" type="submit" name="check_r">Konfirmasi Metode Pembayaran</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>
</html>