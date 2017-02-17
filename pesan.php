<form method="REQUEST" action="d4.php">
	<div class="form-head">
		Asal
	</div>
	<div class="form-option">
		<select class="form-select" name="ori" placeholder="Select One" required>
			<option value="" disabled selected hidden>Select One</option>
			<?php 
				$ori_query = "SELECT * FROM route_list";
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
		<select class="form-select" name="dest" placeholder="Select One" required>
			<option value="" disabled selected hidden>Select One</option>
			<?php 
				$ori_query = "SELECT * FROM route_list";
				$ori_execute = mysqli_query($connect, $ori_query);
				while ($row = mysqli_fetch_assoc($ori_execute)) { ?>
					<option value="<?php echo $row['destination']; ?>"><?php echo $row['destination']; ?></option>
				<?php }
			?>
		</select>
	</div>
	<button class="check_av" type="submit" name="check_r">Periksa Ketersediaan</button>
</form>