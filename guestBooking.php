<?php
session_start();
//guestemail comes from guestForm in flight_table.php
$email = $_POST['guestemail'];
$page_title = 'guestBooking';

if($_SERVER['REQUEST_METHOD'] == 'POST') {

	require('mysqli_connect.php');

	// Check for an email address:
	if (empty($_POST['guestemail'])) {
		echo 'You forgot to enter your email address.';
		header ("refresh:3; url = flight_table.php");
	} else {
		//Insert info into database if there are no errors
		header ("refresh:5; url =index.php");
		echo 'Succesful. Please check your email for more info.';
		//hard code 0 for UserID into database for guests
		$q = "INSERT INTO `bookedFlights` (`Flight ID`, `UserID`, `Email`) VALUES ('" . $_POST['bookingid'] . "', 0,'" . $email . "')";
		$r = @mysqli_query ($dbc, $q);
		//selected statement for UID column. will be used for confirmation number
		$s = "SELECT `UID` FROM `bookedFlights` WHERE `Flight ID`='" . $_POST['bookingid'] . "' AND `Email`='" . $email ."'";
		$t = mysqli_query ($dbc, $s);
		if ($t) {	// true if worked, false otherwise
	while ($row = mysqli_fetch_array($t, MYSQLI_ASSOC)) {
		//store UID column from bookedFlights into variable
		$con_num =  $row['UID'];
		$_SESSION['confirm'] = $con_num;
	}
	//close connection
		mysqli_close($dbc);

		//create message to send to guest
		$msg = "Thank you for booking your flight.Your confirmation number is: $con_num \n Next time you visit our website, you can view flights you have booked or cancel them as well. We suggest making an account for future booking needs.\n Thanks";
		$msg = wordwrap($msg,70);

		//send email out
		mail($email, "Flight confirmation", $msg);
			}
		}
}
else {
	echo 'Invalid nagivation. Please book a flight to access this page.';
}

?>
