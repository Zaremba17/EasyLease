<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	$mysqli = new \mysqli("localhost","ben","badpassword","eecs448");
	if ($mysqli->connect_errno) {
		printf("{}");
		exit();
	}
	
	$numBedrooms = $_GET["numBedrooms"];
	$numBathrooms = $_GET["numBathrooms"];
	$rent = $_GET["rent"];

	//TODO if some of these are null, don't select with WHERE

	$query = "SELECT listingID, Address, City, State, Zip, numBedrooms, numBathrooms, Rent ".
		"FROM Listings WHERE numBedrooms >= $numBedrooms AND numBathrooms >= $numBathrooms ".
		"AND Rent <= $rent";
	
	$json = array("rows"=>[]);

	if ($result = $mysqli->query($query)) {
		while ($row = $result->fetch_assoc()) {
			$json["rows"][] = $row;
		}
	}

	printf(json_encode($json))
?>
