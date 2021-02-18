<html>  
<title>test</title>
<?php>
	$servername = "flamesvideo.com";
	$username = "flamsdud_Flamesvideo";
	$password = "6SUv642XJRW8zd";
	$db = "flamsdud_flamesvideo";
	
	// Create connection
	$conn = new mysqli($localhost, $username, $password, $db);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
?>


</html>