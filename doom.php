<?php
	require ("sql/login-proj.php");
	if (isset($_POST['check_r'])) {
		$origin = mysqli_real_escape_string($connect, $_POST['ori']);
		$destinate = mysqli_real_escape_string($connect, $_POST['dest']);

		$all_route = array();
		$otp = 0;
		$get_all = "SELECT * FROM route_list";
		$get_all_exec = mysqli_query($connect, $get_all);
		$count = mysqli_num_rows($get_all_exec);

		// echo $count;
		while ($row = mysqli_fetch_assoc($get_all_exec)) {
			$route = array();
			$route['origin'] = $row['origin'];
			$route['dest'] = $row['destination']; 
			$route['eor'] = $row['eor'];
			array_push($all_route, $route);
		}

		
		function find_route ($ori, $dest, $routes) {
			
			//print_r($all_route);
			
			$route_selected = array();
			
			//print_r($route_ori);
			//print_r($route_dest);
			//print_r($route_eor);s
			
			/* echo $route_dest[$j].'+';
			echo $route_ori[$j].'+'; */
			/*if (($route_ori[$j] != "") && (($route_dest[$j] != ""))) {
				$tes++;
			}
			$j++;*/
			//}
			//echo "<br/>". + $tes / 2;
		
		}
		
		$check_r = "SELECT * FROM route_list WHERE origin='$origin' AND destination='$destinate'";
		$check_exec = mysqli_query($connect, $check_r);
		if (mysqli_num_rows($check_exec) == 0) {
			echo 'Check another route';
			find_route($origin, $destinate, $routes);
		} else {
			echo 'Found';
		}
	}
?>