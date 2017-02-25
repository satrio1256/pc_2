<?php
	require('sql/login-proj.php');
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
		<?php 
			if (empty($_GET['menu']) || isset ($_GET['menu']) && $_GET['menu'] == 'home') {
				include ('home.php');
			} else if (isset($_GET['menu'])) {
				if ($_GET['menu'] == 'reservasi') {
					include ('pesan.php');
				}
			}
		?>
	</div>
</body>
</html>