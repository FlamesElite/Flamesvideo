<?php
	session_start();
?>

<!-- This file processes the Sign Up Form --> 

<?php
	include("salt.php");
	error_reporting(0);

	//connect to mysql using mysqli
	include("db_credentials.php");

	$min_pass_length = /*8*/1;
	
	// start a session when someone Signs up
	// also initialize 2 session variables: username and password
	session_start();
	// STORE SESSION DATA
	$_SESSION['userName'] = $_POST['userName']; 
	$_SESSION['userPass'] = $_POST['userPass'];
	$_SESSION['email'] = $_POST['email'];

	// holder variables we will use through the processing
	$userName = $_POST['userName'];
	$userPass = $_POST['userPass'];
	$email = $_POST['email'];

	// check if the username is taken
	$nameTaken = false;

	$query_existing_users = "SELECT * FROM Users";
	$result = $conn->query($query_existing_users);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			if ($userName == $row["username"]) { //see if user's username matches one already in DB
				$nameTaken == true;
			}
		}
	} else {
		//no preexisting users, so there will be no name conflicts
	}

	// SIGN-UP CASE
	// Username not taken
	if($nameTaken == false)
	{
		$pass_long_enough = false;
		$pass_has_letter = /*false*/true;
		$pass_has_digit  = /*false*/true;
		
		if (strlen($userPass) >= $min_pass_length) {
			$pass_long_enough = true;
		}
		/*
		//make sure pass has >= 1 letter and >= 1 digit
		for ($i = 0; $i < strlen($userPass); $i++) 
		{
			if ($pass_has_letter === false && ctype_alpha($userPass[$i])) 
			{
				$pass_has_letter = true;
			}
			if ($pass_has_digit === false && ctype_digit($userPass[$i])) 
			{
				$pass_has_digit = true;
			}
		}*/

		if ($pass_long_enough === false || $pass_has_letter === false || $pass_has_digit === false) 
		{
			//prompt new user password doesn't meet requirements
			if ($pass_long_enough === false) {
				$_SESSION['signUpErrorMsg'] .= "Password must contain at least ".$min_pass_length." characters.<br />";
				echo "<div>";
				echo "<h4> Password must contain at least ".$min_pass_length." characters.";
				echo "</div>";
			}
			if ($pass_has_letter === false) {
				$_SESSION['signUpErrorMsg'] .= "Password must contain at least 1 letter.<br />";
				echo "<div>";
				echo "<h4> Password must contain at least 1 letter.";
				echo "</div>";
			}
			if ($pass_has_digit === false) {
				$_SESSION['signUpErrorMsg'] .= "Password must contain at least 1 number.<br />";
				echo "<div>";
				echo "<h4> Password must contain at least 1 number.";
				echo "</div>";
			}
			
			//unset this data if failing to register
			unset($_SESSION['userName']);
			unset($_SESSION['userPass']);
			unset($_SESSION['email']);
		}
		else 
		{			
			// encrypt password, then write it into DB:
			//print ("salt: ".$salt."<br />");
			$userPass = crypt($userPass, '$2y$07$'.$salt.'$');
			//print ("encrypted pass: ".$userPass."<br />");
			
			// add the user to DB, default country AND avatar to not specified
			$query_add_user = "INSERT INTO Users (user_id, username, password, email, join_date, country, website, avatar, age, occupation, school, hobbies)
				VALUES (".($result->num_rows+1).", '$userName', '$userPass', '$email', '2020-05-01', '', '', '', '', '', '', '')";
				
			// IMPORTANT! Set userId!
			$_SESSION['userId'] = ($result->num_rows+1);

			if ($conn->query($query_add_user) === TRUE) {
				echo "New record created successfully.";
				echo "<script>window.location.replace('index.php');</script>";
			} else {
				echo "Error: " . $query_add_user . "<br>" . $conn->error;
			}
		}
	}

	// name taken...
	if($nameTaken == true)
	{
		unset($_SESSION);
		session_destroy();

		echo "<div>
			<h4> Username already exists, please log in or sign up with a different username .</h4>
		</div>";
		require("signUpPage.php");
	}

	$conn->close();
?>
