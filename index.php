<?php
	require('sql/login-proj.php');
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
	</div>
</body>
</html>