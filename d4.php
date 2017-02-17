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

	//Build array
	for ($i=0; $i<$count; $i++) {
		for ($j=0; $j<$count; $j++) {
			$_distArr[$i][$j] = 0;
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

		$_distArr[$ori][$dest] = 1;
		$_distArr[$dest][$ori] = 1;
	}
	define('I',1000);
	$dijkstra = new Dijkstra($_distArr, I, $count);
	$fromClass = $origin; 
	$toClass = $destinate; 

	$dijkstra->findShortestPath($fromClass, $toClass);

	//prints
	print_r($_distArr);
	//print_r($ori);
	//print_r($dest);
	print_r($terminals);

	echo '<pre>'; 
	//echo "the map looks like:\n\n"; 
	//echo $dijkstra -> printMap($ourMap); 
	echo "\n\n the shortest route from class  ".$fromClass." to ".$toClass." is  :\n"; 
	echo $dijkstra -> getResults((int)$toClass);
	echo '</pre>'; 


?>

