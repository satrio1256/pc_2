<?php 
	require_once("sql/login-proj.php");
	$oid = $_GET['oid'];
	$sql = "SELECT * FROM ticket_orders WHERE psg_oid='$oid'";
	$xsql = mysqli_query($connect, $sql);
	if ($row = mysqli_fetch_assoc($xsql)) { ?>
	<html>
		<head>
			<title>Layanan Transportasi Air | DimHub</title>
			<link rel="stylesheet" href="stylesheet/main.css">
		</head>
		<body>
			<?php include ("topbar.php") ?>
			<div class="main-container">
				<div class="box-body">
					<div class="box">
						<div class="box-head">
							TERIMA KASIH
							<div class="head-sub">
								Silakan lanjutkan proses pembayaran pemesanan tiket Anda.						
							</div>
						</div>
						<div class="detail-cnt">
							<div class="detail-head">
								Nomor Booking
							</div>
							<div class="detail-body" style="border: 0; font-size: 28px;">
								<?php 
									echo strtoupper(substr($_GET['oid'], 40, 7));
								?>
							</div>
						</div>
						<div class="detail-cnt">
							<div class="detail-head">
								Nomor Transfer
							</div>
							<div class="detail-body" style="border: 0; font-size: 28px;">
								<?php 
									echo $row['psg_rekening'];
								?>
							</div>
						</div>
						<div class="detail-cnt">
							<div class="detail-head">
								Biaya yang harus ditransfer
							</div>
							<div class="detail-body" style="border: 0; font-size: 28px;">
								<?php 
									$count = mysqli_num_rows($xsql);
									$uniq = substr($row['psg_rekening'], 4, 3);
									$total = $count*10000+$uniq;
									echo "Rp".$total;
								?>
							</div>
						</div>
						<div class="box-head">
							<div class="head-sub">
								Apabila Anda tidak memiliki handphone Android, Anda dapat mengecek tiket di menu <b>Cek Pesanan</b>
							</div>
						</div>
					</div>
				</div>
			</div>
		</body>
	</html>
	<?php };
?>