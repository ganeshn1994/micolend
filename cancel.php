<?php
session_start();
$user = $_SESSION['username'];
$userid = $_SESSION['userID'];
require ('mysqli_connect.php'); // Connect to the db.
?>
<!-- work on implementing data-id attribute
jquery pop up for sign in/ jquery UI implementation one
-->

<style>
body {
	margin-bottom: 100px !important;
}

th, tr, td {
	text-align: center;
}

td {
	padding-top: 15px;
	padding-bottom: 15px;
}

.wrapper {
    width: 75%;
    height: auto;
    margin: auto;
    margin-top: 6%;
    border-radius: 15px;
    background-color: #f2f2f2;
    background: rgba(204, 204, 204, 0.9);
    padding: 10px 20px;
    padding-bottom: 50px;

}

tr:hover {
	background:#3399ff;
	color: white;
}

.selected {
    color: white;
}

.button {
margin-left: 44% !important;
}

.popup {
	background: rgba(204, 204, 204, 0.9);
}

.text {
    color: white;
    font-family: Verdana, sans-serif !important;
}

button {
	padding: 1% 5% !important;
}
</style>

<head>
<title>Flights</title>
<!-- <script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script> -->
<link rel="stylesheet" type="text/css" href="background.css"/>
<link rel="stylesheet" type="text/css" href="w3.css"/>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript" src="flightTable.js"></script>
</head>

<body>
<!-- content class comes from background.css -->
<div class="content">
<header><?php include 'header.php'?></header>


<div class="wrapper">
<!--display flight information -->
<table id="flightTable">
<thead>
<tr>
<th>Departure</th>
<th>Arrival</th>
<th>Flight Info</th>
</tr>
</thead>
<tbody>

<?php
// Make the query, join tables together to display flights booked to the user logged in
if ($_SESSION['loginStatus'] == '1' ) {
$sql = "SELECT * FROM flights INNER JOIN bookedFlights ON flights.`Flight ID`=bookedFlights.`Flight ID` WHERE bookedFlights.`UserID` = '$userid'";
//Run the query
$result = mysqli_query($dbc, $sql);
if ($result) {	// true if worked, false otherwise
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		echo '<tr data-id="' . $row['Flight ID'] . '">
		<td>' . $row['Departure Code'] . '<br>' . $row['Departure City'] . '<br>' . $row['Departure State'] .  '</td>
		<td>' . $row['Arrival Code'] . '<br>' . $row['Arrival City'] .'<br>' . $row['Arrival State'] . '</td>
		<td>' . 'Length: ' . $row['Flight Time'] . '<br>' . 'Date: ' . $row['Flight Date'] . '<br>' . 'Flight #: ' . $row['Flight ID'] .'</td>
		</tr>'
		;
	}
	mysqli_free_result ($result); // Free up the resources.
}
}

else { // If no records were returned.

	echo '<p class="error">There is currently no data.</p>';
}
mysqli_close($dbc); // Close the database connection.
?>
</tbody>
</table>
<!-- close wrapper div -->
</div>
<!-- end display flight information -->

<!-- submit class centers button. from background.css. -->
<!-- add an addFlight.php file to insert flights into database
for submit button, check if user is logged in. if not, automatically redirect to login page.
create new button so user can book flight as a guest.-->
<div style="text-align:center">
<form id="userForm" method="post">
<input type="hidden" name="bookingid">
<button type="submit id="userCancel" formaction="userCancel.php">Cancel Flight</button>
</form>
<br><br>
<div class="text">Booked a flight as a Guest?
<br>
<button id="guestCancel">Cancel Here</button></div>
<!-- close div for text align -->
</div>
<!-- close content div -->
</div>
<footer><?php include 'footer.php'?></footer>

<!-- redirect userCancel button to userCancel.php -->
<script type="text/javascript">
    document.getElementById("userCancel").onclick = function () {
    window.location = "userCancel.php";
            };
</script>

<!-- redirect guestCancel button to guestCancel.php -->
<script type="text/javascript">
    document.getElementById("guestCancel").onclick = function () {
        $('#guestDiag').dialog();
            };
</script>

<div class="popup" id="guestDiag">
<fieldset>
<div class="w3-container w3-blue">
<h2>Guest Booking</h2>
</div>
<form id="guestCancel" class="w3-container" method="post" action="guestCancel.php">
	<input type="hidden" name="bookingid">
    <label>Please Enter Your Email</label><br>
    <input class="w3-input" type="text" name="guestemail" placeholder="example@mail.com"><br>
	<span class="error"> <?php echo $emailErr;?></span>
	<label>Please Enter Confirmation Number</label>
	<input class="w3-input" type="text" name="confirm" placeholder="####"><br>
   	<button type="submit" name="btnGuestSubmit" value="btnGuestSubmit">Submit</button>
   	</form>
    </fieldset>
</div>
</body>
</html>
