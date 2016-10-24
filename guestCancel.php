<?php
session_start();
//variables come from guestCancel form in cancel.php
$email = $_POST['guestemail'];
$confirm = $_POST['confirm'];
$page_title = 'guestCancel';

if($_SERVER['REQUEST_METHOD'] == 'POST') {

	require('mysqli_connect.php');

	// Check if user is logged in:
	if (empty($_POST['guestemail'])) {
		echo 'You forgot to enter your email address.';
		header ("refresh:3; url =cancel.php");
	} else {
		//header goes before $q
		$q = "DELETE FROM `bookedFlights` WHERE `Email`='$email' AND `UID`='$confirm'";
		$r = @mysqli_query ($dbc, $q);
		//close connection
		mysqli_close($dbc);
	}
}
else {
	echo "Invalid Navigation. Cancel a flight to access this page.";
}
?>
