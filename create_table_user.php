<?php # create table user - made by deb
// create user table

$page_title = 'create table user';

// Page header:
echo '<h1>Create Table User</h1>';

require ('mysqli_connect.php'); // Connect to the db.
		
// Make the query:
$query = " create table accounts (
	user_id mediumint unsigned not null auto_increment,
	user_name varchar(25) not null,
	email varchar(50) not null,
	pass char(40) not null,
	registration_date datetime not null,
	PRIMARY KEY(user_id)
	) ";

//Run the query
$result = mysqli_query($dbc, $query);
if ($result)   		// true if worked, false otherwise
	echo "<h2> Table Users Created </h2>";
else {
	echo "<h2>Error - Table not created</h2>";
	echo "<p>" . mysqli_error($dbc) . "<br>Query: " . $query . "</p>";	
}
		
mysqli_close($dbc); // Close the database connection.
?>