<?php
	// Reference :
	// http://codereview.stackexchange.com/questions/75641/dijkstras-algorithm-in-php
	// https://en.wikipedia.org/wiki/Dijkstra%27s_algorithm
	// http://www.stoimen.com/blog/2012/10/08/computer-algorithms-shortest-path-in-a-graph/
	// https://www.github.com/fisharebest/algorithm/
	include ("djak.php");
	require ("sql/login-proj.php");
	$origin = mysqli_real_escape_string($connect, $_REQUEST['ori']);
	$destinate = mysqli_real_escape_string($connect, $_REQUEST['dest']);

	$check_r = "SELECT DISTINCT origin FROM route_list UNION SELECT DISTINCT destination FROM route_list";
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

	echo "<br />".$get_dx_ori." to ".$get_dx_dest."<br />";

	//Fetch destination and origin
	$check_r2 = "SELECT * FROM route_list";
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

	echo '<pre>';
	echo "\n\n the shortest route from class  ".$origin." to ".$destinate." is  :\n"; 
	$rtt = $dijkstra -> getResults((int)$toClass);
	$i = 0;
	$temp = "";
	$new = "";
	while ($i < strlen($rtt)+1) {
		if (isset($rtt[$i]) && $rtt[$i] != "-") {
			$temp = $rtt[$i];
		} else {
			$new .= str_replace(intval($temp), $terminals[intval($temp)], intval($temp));
			$new .= '-';
		}
		$i++;
	}
	$new = rtrim($new, "-");
	echo $new;
	echo "<br />return complete";
	echo '</pre>'; 
?>

