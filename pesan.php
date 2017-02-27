<div class="box">
	<div class="box-head">
		BELI TIKET
		<div class="head-sub">
			Masukkan asal dan tujuan Anda
		</div>
	</div>
	<?php if (isset($_GET['err'])) { ?>
		<div>
			<br />
			<center style="color: red; font-family: 'Mako', sans-serif; font-size: 15px;">Maaf, kota asal dan tujuan tidak boleh sama</center>
			<br />
		</div>
	<?php } ?>
	<div class="box-body">
		<form method="REQUEST" action="fdroute.php">
			<div class="form-head">
				Asal
			</div>
			<div class="form-option">
				<select class="form-select" name="ori" placeholder="Select One" required>
					<option value="" disabled selected hidden>Pilih salah satu</option>
					<?php 
						$ori_query = "SELECT DISTINCT origin FROM route_lists UNION SELECT DISTINCT destination FROM route_lists";
						$ori_execute = mysqli_query($connect, $ori_query);
						while ($row = mysqli_fetch_assoc($ori_execute)) { ?>
							<option value="<?php echo $row['origin']; ?>"><?php echo $row['origin']; ?></option>
						<?php }
					?>
				</select>	
			</div>
			<div class="form-head">
				Tujuan
			</div>
			<div class="form-option">
				<select class="form-select" name="dest" placeholder="Pilih salah satu" required>
					<option value="" disabled selected hidden>Pilih salah satu</option>
					<?php 
						$ori_query = "SELECT DISTINCT origin FROM route_lists UNION SELECT DISTINCT destination FROM route_lists";
						$ori_execute = mysqli_query($connect, $ori_query);
						while ($row = mysqli_fetch_assoc($ori_execute)) { ?>
							<option value="<?php echo $row['origin']; ?>"><?php echo $row['origin']; ?></option>
						<?php }
					?>
				</select>
			</div>
			<div class="form-head">
				Tanggal Keberangkatan
			</div>
			<div class="form-option">
				<div class="detail-cnt">
					<input class="detail-body" type="date" name="date"/>
				</div>
			</div>
			<div class="form-head">
				Waktu Keberangkatan
			</div>
			<div class="form-option">
				<div class="detail-cnt">
					<select class="form-select" name="time" placeholder="Pilih salah satu" required>
						<option value="" disabled selected hidden>Pilih salah satu</option>
						<option value="08.00">08.00</option>
						<option value="10.00">10.00</option>
						<option value="12.00">12.00</option>
						<option value="14.00">14.00</option>
						<option value="16.00">16.00</option>
						<option value="18.00">18.00</option>
					</select>
				</div>
			</div>
			<button class="check_av" type="submit" name="check_r">Periksa Ketersediaan</button>
		</form>
	</div>
</div>