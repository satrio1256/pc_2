<?php 
	require ("d4.php");
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
		<div class="box-ticket">
			<div class="ticket-top">
				<div class="ticket-name">
					<h3></h3>
				</div>
				<div class="ticket-transits">
					<?php if ($count > 2) {
						echo $count;
					} else {
						$count = 0;
						echo $count;
					} ?>
				</div>
			</div>
			<div class="ticket-bottom">
				<div class="ticket-routes">
					<?php echo $new; ?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>