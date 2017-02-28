<?php 
	if (isset($_POST['cek'])) {
		$oid = mysqli_real_escape_string($connect, $_POST['oid']);
		$sql = "SELECT * FROM ticket_orders WHERE psg_code='$oid' ORDER BY psg_ph ASC";
		$xsql = mysqli_query($connect, $sql);

		if (mysqli_num_rows($xsql) > 0) {
			$row = mysqli_fetch_assoc($xsql); ?>
			<!-- INI TOLONG BENERIN, GET DATA PENUMPANG DARI DATABASE. AKU KENA REMED KALKULUS, BESOK, DAN BARU DIUMUMIN SEKARANG -.- -->
			<!-- <div class="box">
				<div class="box-head">
					DETAIL PESANAN
					<div class="head-sub">
						
					</div>
				</div>

				<div class="box-body">
					<div class="detail-cnt">
						<div class="detail-head">
							Nama Penumpang 1 (Pemesan)
						</div>
						<div class="detail-body">
							<?php echo $row['psg_name']; ?>
						</div>
					</div>
					<?php 
						if (mysqli_num_rows($xsql) > 1) {
							$count = mysqli_num_rows($xsql);
							for ($i=0; $i<$count; $i++) {

							}
						}
					?>
				</div>
			</div> -->
		<?php } else {
			header("Location: index.php?menu=cek&err=1");
		}
	} else { ?>
		<div class="box">
			<div class="box-head">
				CEK PESANAN
				<div class="head-sub">
					Masukkan kode booking Anda
				</div>
			</div>
			<?php if (isset($_GET['err'])) { ?>
				<div>
					<br />
					<center style="color: red; font-family: 'Mako', sans-serif; font-size: 15px;">Maaf, pesanan dengan kode tersebut tidak tersedia</center>
					<br />
				</div>
			<?php } ?>
			<div class="box-body">
				<form method="POST">
					<div class="form-head">
						Kode Booking
					</div>
					<div class="form-option">
						<input class="detail-body" name="oid"/>
					</div>
					<button class="check_av" type="submit" name="cek">Cek Pesanan</button>
				</form>
			</div>
		</div>
	<?php }
?>