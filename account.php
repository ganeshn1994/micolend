<?php
session_start();
$page_title = 'account';
// This page prints any errors associated with logging in
// and it creates the entire login page, including the form.

// Include the header:
$page_title = 'Login';

// Print any error messages, if they exist:
if (isset($errors) && !empty($errors)) {
	echo '<h1>Error!</h1>
	<p class="error">The following error(s) occurred:<br />';
	foreach ($errors as $msg) {
		echo " - $msg<br />\n";
	}
	echo '</p><p>Please try again.</p>';
}

if ($_SESSION['loginStatus'] == 1) {
header("Location: welcomepage.php");
}
?>

<style>
section .left {
    width: 50%;
    float: left;
    clear: both;
    display: inline-block;
    margin: auto;
}

fieldset {
    float: left;
    width: 40%;
    color: white;
	margin: 1% 5% !important;
}

 input[type=text] {
	color: black;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

</style>


<title>Account</title>
    <link rel="stylesheet" type="text/css" href="background.css">
    <link rel="stylesheet" type="text/css" href="w3.css">


<body>

<!-- Display the form -->
<div class="content">
<header><?php include 'header.php'?></header>



<section class="left">
<div class="w3-animate-bottom">

    <fieldset>
        <div class="w3-container w3-blue">
        <h2>Sign In</h2>
        </div>
 <!-- start first form -->
<form class="w3-container" method="post" action="signin.php">
    <label>Email</label><br>
    <input class="w3-input" type="text" name="email" placeholder="example@mail.com"><br>
	<span class="error">* <?php echo $emailErr;?></span>
    <label>Password</label><br>
    <input class="w3-input" type="password" name="pass" placeholder="**********"><br>
	<button type="submit" name="btnSignin" value="btnSignin">Sign In</button>
	    </form>
    </fieldset>
<!-- end first form -->

<!--start second form -->
	<fieldset>
        <div class="w3-container w3-blue">
        <h2>Create Account</h2>
        </div>

<form class="w3-container" method="post" action="createaccount.php">
  <label>First Name</label><br>
  <input class="w3-input" type="text" name="firstName" placeholder="First"><br>
  <label>Last Name</label><br>
   <input class="w3-input" type="text" name="lastName" placeholder="Last"><br>
  <label>Email</label><br>
  <input class="w3-input" type="text" name="email" placeholder="example@mail.com"><br>
  <label>Create Password</label><br>
  <input class="w3-input" type="password" name="pass1" placeholder="**********"><br>
  <label>Re-Enter Password</label><br>
  <input class="w3-input" type="password" name="pass2" placeholder="**********"><br>
 <button type="submit" name="btnCreate" value="btnCreate">Create Account</button>
 </form>
</fieldset>
<!-- end second form -->

</div>
</section>
<footer><?php include 'footer.php'?></footer>
</div>
</body>
