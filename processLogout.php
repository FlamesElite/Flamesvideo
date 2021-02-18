<?php
	session_start();

	// unset and destroy
	unset($_SESSION);
	session_destroy();

	// then redirect to home page
	echo "<script>window.location.replace('index.php');</script>";
?>
