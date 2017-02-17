<?php
	// Reference :
	// http://codereview.stackexchange.com/questions/75641/dijkstras-algorithm-in-php
	// https://en.wikipedia.org/wiki/Dijkstra%27s_algorithm
	// http://www.stoimen.com/blog/2012/10/08/computer-algorithms-shortest-path-in-a-graph/
	// https://www.github.com/fisharebest/algorithm/

	require ("sql/login-proj.php");
	$origin = mysqli_real_escape_string($connect, $_POST['ori']);
	$destinate = mysqli_real_escape_string($connect, $_POST['dest']);

	$check_r = "SELECT DISTINCT origin FROM route_list UNION SELECT DISTINCT destination FROM route_list";
	$x_check = mysqli_query($connect, $check_r);
	$count = mysqli_num_rows($x_check);
	$arr = array();

	//Build array
	for ($i=0; $i<$count; $i++) {
		for ($j=0; $j<$count; $j++) {
			$arr[$i][$j] = 0;
		}
	}

	//Fetch data terminal
	while ($row = mysqli_fetch_assoc($x_check)) {
		$terminals[] = $row['origin'];
	}

	//fetch destinasi dan origin
	$check_r2 = "SELECT * FROM route_list";
	$x_check2 = mysqli_query($connect, $check_r2);
	$countx = mysqli_num_rows($x_check2);

	//fetch ke array
	while ($row = mysqli_fetch_assoc($x_check2)) {
		$ori = array_search($row['origin'], $terminals);
		$dest = array_search($row['destination'], $terminals);

		$arr[$ori][$dest] = 1;
		$arr[$dest][$ori] = 1;
	}
	
	//prints
	print_r($arr);
	//print_r($ori);
	//print_r($dest);
	print_r($terminals);

	/*$check_r = "SELECT * FROM route_list";
	$x_check2 = mysqli_query($connect, $check_r);

	while ($rowx = mysqli_fetch_assoc($x_check2)) {
		$_distFrom[] = $rowx['origin'];
		$_distTo[] = $rowx['destination'];
	}
	print_r($_distFrom);
	print_r($_distTo);
	print_r($arr);*/
?>

