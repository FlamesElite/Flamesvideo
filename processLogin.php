<?php
    session_start();
?>


<!-- This file processes the login Form (from loginPage.php), and then does an action --> 

<?php
	include("salt.php");
	error_reporting(0);

	$_SESSION['userName'] = $_POST['userName'];
	$_SESSION['userPass'] = $_POST['userPass'];

	// holder variables we will use for the processing
	$userName = $_POST['userName'];
	$userPass = $_POST['userPass'];

	// LOGIN CASES
	// Check that the user has already signed up before, then:
	// if the user enters the incorrect password, make him try again.
	// if he enters the correct password, redirect him to the Home page
	// if the user enters a non existing user, tell him to sign-up or enter the correct user name (NEED TO DO THIS)

	//connect to mysql using mysqli
	include("db_credentials.php");
	
	$query_user_logging_in = "SELECT * FROM Users WHERE username='$userName'";
	$result = $conn->query($query_user_logging_in);

	if ($result->num_rows === 1) {
		while($row = $result->fetch_assoc()) {
			// IMPORTANT! Set userId!
			//$_SESSION['userId'] = $row["user_id"];

			if (crypt($userPass, '$2y$07$'.$salt.'$') == $row["password"]) { //see if password is correct...
				$correctPassword = true;
				$_SESSION['userId'] = $row["user_id"]; // <- set the user's id into a session variable also
				successful_login();
			}
			else {
				//wrong pass, therefore credentials aren't valid
				invalid_login();
			}
		}
	} 
	else {
		//no users found, therefore credentials aren't valid
		invalid_login();
	}

	function invalid_login() {	
		echo "<h4> The password is incorrect. </h4>";
		echo "<h4> Enter password again. </h4>";

		// FIX error
		unset($_SESSION);
		session_destroy();
	}
	function successful_login() {
		// redirect back to home page
		echo "<script>window.location.replace('index.php');</script>";
	}
	
?>
