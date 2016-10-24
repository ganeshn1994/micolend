<?php
session_start();
$user = $_SESSION['userID'];
$first_name = $_SESSION['first_name'];
$page_title = 'bookedFlight';

//create error array for any errors that might occur
//$errors = array();

if($_SERVER['REQUEST_METHOD'] == 'POST') {

	require('mysqli_connect.php');

	// Check if user is logged in:
	if ($_SESSION['loginStatus'] != 1) {
		//$errors[] = 'Please log in to book a flight or book as a guest.';
		echo 'Please log in to book a flight or book as a guest.';
	} else {
	//Insert info into database if there are no errors
		header ("refresh:5; url = index.php");
		echo "You have succesfully booked your flight. Thank you, $first_name";
		$q = "INSERT INTO `bookedFlights` (`Flight ID`, `UserID`) VALUES (". $_POST['bookingid'] .", " . $user . ")";
		$r = @mysqli_query ($dbc, $q);
		mysqli_close($dbc);



	}
}

else {
	//$errors[] = 'Invalid nagivation. Please book a flight to access this page.';
	echo 'Invalid nagivation. Please book a flight to access this page.';
}

?>
