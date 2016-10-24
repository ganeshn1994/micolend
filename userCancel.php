<?php
session_start();

$page_title = 'bookedFlight';
$userid = $_SESSION['userID'];
$bookingid = $_POST['bookingid'];
if($_SERVER['REQUEST_METHOD'] == 'POST') {

	require('mysqli_connect.php');
	
	// Check if user is logged in:
	if (empty($_SESSION['username'])) {
		$errors[] = 'Please log in to book a flight or book as a guest.';
		//Delete info in database if there are no errors
	} else {
		$q = "DELETE FROM `bookedFlights` WHERE `Flight ID`='$bookingid' AND `UserID`='$userid'";
		$r = @mysqli_query($dbc, $q);
		print_r($q);
		print_r($dbc);
		mysqli_close($dbc);
		echo "canceled";
	}
}

?>