<?php
	require ("sql/login-proj.php");
	if (empty($_GET['oid']) && empty($_GET['h'])) {
		header ('Location: index.php?menu=reservasi');
	}

	if (isset($_POST['cnt'])) {
		$h = $_GET['h'];
		$i = 0;
		while ($i<$h) {
			$psg_name = mysqli_real_escape_string($connect, $_POST['psg_name'][$i]);
			$psg_ph = mysqli_real_escape_string($connect, $_POST['psg_ph'][$i]);
			$psg_mail = mysqli_real_escape_string($connect, $_POST['psg_mail'][$i]);
			$oid = $_GET['oid'];

			$psg_ord = "UPDATE ticket_orders SET psg_name='$psg_name', psg_ph='$psg_ph', psg_mail='$psg_mail' WHERE psg_oid='$oid' AND psg_name='' LIMIT 1";
			$x_ord = mysqli_query($connect, $psg_ord);
			$i++;
		}

		if (!$x_ord) {
			echo("Error description: " . mysqli_error($connect));
		} else {
			header ("Location: payment.php?oid=$oid");
		}
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
				DATA PENUMPANG
				<div class="head-sub">
					<br />
				</div>
			</div>
			<div class="box-body">
				<form method="POST">
					<?php 
						for ($i=0; $i<$_GET['h']; $i++) { ?>
							<div class="d-head">
								Penumpang ke-<?php echo $i+1 ?>
							</div>
							<hr />
							<div class="detail-cnt">
								<div class="detail-head">
									Nama Penumpang
								</div>
								<input class="detail-body" name="psg_name[<?php echo $i; ?>]">
							</div>
							<div class="detail-cnt">
								<div class="detail-head">
									Nomor Telepon Penumpang
								</div>
								<input class="detail-body" pattern="[0-9]{3,}" name="psg_ph[<?php echo $i; ?>]">
							</div>
							<div class="detail-cnt">
								<div class="detail-head">
									Email
								</div>
								<input class="detail-body" type="email" name="psg_mail[<?php echo $i; ?>]">
							</div>
							<br />
						<?php }
					?>
					<button class="check_av" type="submit" name="cnt">Lanjutkan ke Pembayaran</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>