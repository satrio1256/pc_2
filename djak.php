<?php
	require ("sql/login-proj.php");
	$origin = mysqli_real_escape_string($connect, $_REQUEST['ori']);
	$destinate = mysqli_real_escape_string($connect, $_REQUEST['dest']);
	$check_r = "SELECT * FROM route_list";
	$x_check = mysqli_query($connect, $check_r);
	$_distArr = array();
	$row = mysqli_fetch_assoc($x_check);
	$itt = 0;
	
	while($row = mysqli_fetch_assoc($x_check)){
		$_distArr[$row['origin']][$row['destination']] = $row['dist'];
	};

	// Reference :
	// http://codereview.stackexchange.com/questions/75641/dijkstras-algorithm-in-php
	// https://en.wikipedia.org/wiki/Dijkstra%27s_algorithm
	// http://www.stoimen.com/blog/2012/10/08/computer-algorithms-shortest-path-in-a-graph/

	print_r($_distArr);

	//the start and the end 
	$a = $_REQUEST['ori'];
	$b = $_REQUEST['dest'];
	//initialize the array for storing
	$S = array();//the nearest path with its parent and weight
	$Q = array();//the left nodes without the nearest path
	foreach(array_keys($_distArr) as $val) $Q[$val] = 99999;
	$Q[$a] = 0;
	//start calculating
	while(!empty($Q)){
	    $min = array_search(min($Q), $Q);//the most min weight
	    if($min == $b) break;
	    foreach($_distArr[$min] as $key=>$val) {
	    	if(!empty($Q[$key]) && $Q[$min] + $val < $Q[$key]) {
	        	$Q[$key] = $Q[$min] + $val;
	        	$S[$key] = array($min, $Q[$key]);
	    	}
		}
	    unset($Q[$min]);
	}
	//list the path
	$path = array();
	$pos = $b;
	while($pos != $a){
	    $path[] = $pos;
	    $pos = $S[$pos][0];
	}
	$path[] = $a;
	$path = array_reverse($path);
	//print result
	echo "<img src='http://www.you4be.com/dijkstra_algorithm.png'>";
	echo "<br />From $a to $b";
	echo "<br />The length is ".$S[$b][1];
	echo "<br />Path is ".implode('->', $path);
?>
