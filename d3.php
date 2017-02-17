<?php
	require ("sql/login-proj.php");
	if (isset($_POST['check_r'])) {
		$origin = mysqli_real_escape_string($connect, $_POST['ori']);
		$destinate = mysqli_real_escape_string($connect, $_POST['dest']);
		
		function find_route ($ori, $dest, $connect) {
			$route_ori = array();
			$route_dest = array();
			$route_eor = array();
			$otp = 0;
			$get_all = "SELECT * FROM route_list";
			$get_all_exec = mysqli_query($connect, $get_all);
			$count = mysqli_num_rows($get_all_exec);
			$j = 0;
			// echo $count;
			while ($row = mysqli_fetch_assoc($get_all_exec)) {
				$route_ori[] = $row['origin'];
				$route_dest[] = $row['destination']; 
				$route_eor[] = $row['eor'];
				$j++;
			}
			/* print_r($route_ori);
			print_r($route_dest);
			print_r($route_eor);
			echo ('ccy'); */
			$j = 0;
			while ($j < $count) {
				if ($route_ori[$j] == $ori) {
					$k = 0;
					while ($k < $count) {
						if (($route_dest[$j] == $route_ori[$k]) && ($route_dest[$k] == $dest)) {
							echo "<br />".$route_ori[$j]." -> ".$route_dest[$j]." (jalur transit 1) ".$route_ori[$k]." -> ".$route_dest[$k];
							break;
						} else {
							find_route($route_ori, $route_dest, $connect);
						}
						$k++;
					}
				}
			$j++;
			/* echo $route_dest[$j].'+';
			echo $route_ori[$j].'+'; */
			/*if (($route_ori[$j] != "") && (($route_dest[$j] != ""))) {
				$tes++;
			}
			$j++;*/
			}
			//echo "<br/>". + $tes / 2;
		}
		}
		
		$check_r = "SELECT * FROM route_list WHERE origin='$origin' AND destination='$destinate'";
		$check_exec = mysqli_query($connect, $check_r);
		if (mysqli_num_rows($check_exec) == 0) {
			echo 'Check another route';
			find_route($origin, $destinate, $connect);
		} else {
			echo 'Found';
		}
?>