<?php
		include ("djak.php");
		require ("sql/login-proj.php");
		$origin = mysqli_real_escape_string($connect, $_REQUEST['ori']);
		$destinate = mysqli_real_escape_string($connect, $_REQUEST['dest']);
		$date = mysqli_real_escape_string($connect, $_REQUEST['date']);
		$time = mysqli_real_escape_string($connect, $_REQUEST['time']);

		if ($origin == $destinate) {
			header ("Location: index.php?menu=reservasi&err=s");
		}

		$check_r = "SELECT DISTINCT origin FROM route_lists UNION SELECT DISTINCT destination FROM route_lists";
		$x_check = mysqli_query($connect, $check_r);
		$count = mysqli_num_rows($x_check);
		$_distArr = array();

		//Build matrix of null
		for ($i=0; $i<$count; $i++) {
			for ($j=0; $j<$count; $j++) {
				$_distArr[$i][$j] = NULL;
			}
		}

		//Fetch data of terminal
		while ($row = mysqli_fetch_assoc($x_check)) {
			$terminals[] = $row['origin'];
			if ($row['origin'] == $origin) {
				$get_dx_ori = array_search($row['origin'], $terminals);
			} else if ($row['origin'] == $destinate) {
				$get_dx_dest = array_search($row['origin'], $terminals);
			}
		}

		//Fetch destination and origin
		$check_r2 = "SELECT * FROM route_lists";
		$x_check2 = mysqli_query($connect, $check_r2);
		$countx = mysqli_num_rows($x_check2);

		//Assign to matrix
		while ($row = mysqli_fetch_assoc($x_check2)) {
			$ori = array_search($row['origin'], $terminals);
			$dest = array_search($row['destination'], $terminals);

			$_distArr[$ori][$dest] = 1;
			$_distArr[$dest][$ori] = 1;
		}

		define('I',1000);
		$dijkstra = new Dijkstra($_distArr, I, $count);

		$fromClass = $get_dx_ori; 
		$toClass = $get_dx_dest; 

		$dijkstra->findShortestPath($fromClass, $toClass);
		$rtt = $dijkstra -> getResults((int)$toClass);
		if ($rtt != "No Route") {
			$i = 0;
			$count = 0;
			$temp = "";
			$new = "";
			while ($i < strlen($rtt)+1) {
				if (isset($rtt[$i]) && $rtt[$i] != "-") {
					$temp = $rtt[$i];
				} else {
					$new .= str_replace(intval($temp), $terminals[intval($temp)], intval($temp));
					$new .= '-';
					$count++;
				}
				$i++;
			}
			$new = rtrim($new, "-");
		} else {
			$new = "No Route";
		}

		$occup = "SELECT psg_name FROM ticket_orders WHERE psg_ori='$origin' AND psg_dest='$destinate' AND psg_date='$date' AND psg_time='$time'";
		$xoccup = mysqli_query($connect, $occup);
		$pscount = mysqli_num_rows($xoccup);

		$remain = "SELECT schedule_seat FROM boarding_schedule WHERE schedule_origin='$origin' AND schedule_destination='$destinate' AND schedule_date='$date' AND schedule_depart='$time'";
		$xcute = mysqli_query($connect, $remain);
		if ($seat_left = mysqli_fetch_assoc($xcute)) {
			$st = $seat_left['schedule_seat'];
			$seat_count = $st-$pscount;
		};
?>

