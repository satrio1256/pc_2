<?php 
	if (empty($_GET['oid']) && empty($_GET['h'])) {
		header ('Location: index.php?menu=reservasi');
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
								<input class="detail-body" min="1" value="1" name="psg_name">
							</div>
							<div class="detail-cnt">
								<div class="detail-head">
									Nomor Telepon Penumpang
								</div>
								<input class="detail-body" pattern="" name="psg_ph">
							</div>
							<div class="detail-cnt">
								<div class="detail-head">
									Email
								</div>
								<input class="detail-body" min="1" value="1" name="psg_mail">
							</div>
							<br />
						<?php }
					?>
					<button class="check_av" type="submit" name="buy">Pesan Tiket</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>