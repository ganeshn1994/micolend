<?php
session_start();
$user = $_SESSION['username'];
?>
<style>
.echo {
	color: white;
	font-family: Verdana, sans-serif !important;
	font-size: 30px;
	text-align:center;
	margin-top:5%;
}
</style>

<title>Account Home</title>
<link rel="stylesheet" type="text/css" href="w3.css">
<link rel="stylesheet" type="text/css" href="background.css">

<body>

<div class="content">
<header><?php include 'header.php'?></header>

<?php
    if ($_SESSION['loginStatus'] = 1) {
            	echo "<div class=\"echo\"> Welcome $user! </div>";
            	}
            	else {
            		echo "Please log in.";
            	}
?>

<button onclick="location.href = 'logout.php';" id="destroySession">Log Out</button>
<footer><?php include 'footer.php'?></footer>
</div>
</body>
