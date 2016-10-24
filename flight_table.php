<?php
session_start();
$user = $_SESSION['username'];

require ('mysqli_connect.php'); // Connect to the db.
?>

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

button {
	padding: 1% 5% !important;
}

.popup {
	background: rgba(204, 204, 204, 0.9); 
}

</style>

<head>
<title>Flights</title>
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

<!-- wrapper created box to display table information in -->
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
// Make the query:
$sql = "SELECT * FROM flights";
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
<div style="text-align:center">
<form id="userForm" method="post">
<input type="hidden" name="bookingid">
<button type="submit" id ="bookedFlight" formaction="bookedFlight.php"> Book Flight</button>
<button type="button" id="bookGuest">Book As Guest</button>
</form>

<!-- close div for buttons -->
</div>
<!-- close content div -->
</div>
<footer><?php include 'footer.php'?></footer>

<!--redirect bookFlight button to flight bookedFlight.php. puts flight info into database -->
<script type="text/javascript">
    document.getElementById("bookedFlight").onclick = function () {
        document.location = "http://www.lyndoncis.com/CIS3120SP16/tdl01030/Project/bookedFlight.php";
            };
</script>

<!-- redirect bookGuest button to guestBooking.php -->
<script type="text/javascript">
    document.getElementById("bookGuest").onclick = function () {
        $('#guestDiag').dialog();
            };
</script>

<!-- pop-up window for when user chooses to book as a guest. inserts flight info into database -->
<div class="popup" id="guestDiag">
<fieldset>
<div class="w3-container w3-blue">
<h2>Guest Booking</h2>
</div>       
<form id="guestForm" class="w3-container" method="post" action="guestBooking.php">
	<input type="hidden" name="bookingid">
    <label>Please Enter Your Email</label><br>
    <input class="w3-input" type="text" name="guestemail" placeholder="example@mail.com"><br>
	<span class="error"> <?php echo $emailErr;?></span>
   	<button type="submit" name="btnGuestSubmit" value="btnGuestSubmit">Submit</button>
   	</form>
    </fieldset>
</div>
</body>
</html>
