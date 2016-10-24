<?php # Script 9.5 - register.php #2
	// This script performs an INSERT query to add a record to the users table.
	session_start();
	$page_title = 'Log In';

	// Check for form submission:
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		require ('mysqli_connect.php'); // Connect to the db.

		$errors = array(); // Initialize an error array.


		if (empty($_POST['email'])) {
			$errors[] = 'You forgot to enter your email.';
		} else {
			$email = mysqli_real_escape_string($dbc, trim($_POST['email']));
		}


		if (empty($_POST['pass'])) {
			$errors[] = 'You forgot to enter your password.';
		} else {
			$password = mysqli_real_escape_string($dbc, trim($_POST['pass']));
		}


		if (empty($errors)) {

			$q = "SELECT * FROM users where email = '$email' AND pass = SHA1('$password')";
			$r = @mysqli_query ($dbc, $q); // Run the query.
			// Count the number of returned rows:
			$num = mysqli_num_rows($r);

			if ($num > 0) {
				$_SESSION['loginStatus'] = 1;
				//statement grabs users first name and id from database
				$user = mysqli_fetch_assoc (mysqli_query($dbc, "SELECT user_id, first_name FROM users where email = '$email'"));
				//assign userID to session variable
				$_SESSION['userID'] = $user['user_id'];
				//assigns first name to session variable
				$_SESSION['username'] = $user['first_name'];
				header("Location:welcomepage.php");
				echo 'Success! Redirecting...';
				exit();

			} else { // If it did not run OK.
				// Public message:
				header ("refresh:5; url = account.php"); 
				echo "The information you entered in didn't match our records. You will be redirected to the login page.";
			} // End of if ($r) IF.

			mysqli_close($dbc); // Close the database connection.
	   	    //quit the script:
			exit();

		}
	}

		mysqli_close($dbc); // Close the database connection.


	function test_input($data) {
	   $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}
?>
