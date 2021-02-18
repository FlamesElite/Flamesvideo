<!-- login page -->
<!-- based off: https://vidsurf.glitch.me/index.html -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>sql code</title>
  </head>
  <body>
	<?php
	    //die ("You don't have access to the requested page.");
		include("db_credentials.php");

	// sql to create table
	$users_table = "CREATE TABLE Users (
		user_id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		username VARCHAR(30) NOT NULL,
		password VARCHAR(300) NOT NULL,
		email VARCHAR(70),
		join_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		country VARCHAR(30),
		website VARCHAR(100),
		avatar VARCHAR(100)
	)";
	
	$videos_table = "CREATE TABLE Videos (
		video_id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		video_name VARCHAR(100) NOT NULL,
		video_description VARCHAR(5000) NOT NULL,
		video_tags VARCHAR(5000),
		views INT(10),
		file_name VARCHAR(100) NOT NULL,
		video_extension VARCHAR(8) NOT NULL,
		video_file VARCHAR(300) NOT NULL,
		date_uploaded TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		uploader INT(8) UNSIGNED,
		category VARCHAR(30),
		thumbnail VARCHAR(100),
		FOREIGN KEY (uploader) REFERENCES Users(user_id)
	)";

	$channels_table = "CREATE TABLE Channels (
		channel_id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		featured_video INT(8) UNSIGNED,
		background_image VARCHAR(150),
		bg_col_r INT(3) UNSIGNED,
		bg_col_g INT(3) UNSIGNED,
		bg_col_b INT(3) UNSIGNED,
		bg_col_a INT(3) UNSIGNED,
		text_col_r INT(3) UNSIGNED,
		text_col_g INT(3) UNSIGNED,
		text_col_b INT(3) UNSIGNED,
		FOREIGN KEY (featured_video) REFERENCES Videos(video_id)
	)";

	$subscriptions_table = "CREATE TABLE Subscriptions (
		subscription_id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		subscriber_id INT(8) UNSIGNED,
		subscribed_to_id INT(8) UNSIGNED,
		subscription_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		FOREIGN KEY (subscriber_id) REFERENCES Users(user_id),
		FOREIGN KEY (subscribed_to_id) REFERENCES Users(user_id)
	)";

	$comments_table = "CREATE TABLE Comments (
		comment_id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		commentor_id INT(8) UNSIGNED,
		video INT(8) UNSIGNED,
		comment_text VARCHAR(1000),
		upvotes INT(8),
		downvotes INT(8),
		reply_to INT(10) UNSIGNED, 	
		comment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		FOREIGN KEY (commentor_id) REFERENCES Users(user_id),
		FOREIGN KEY (video) REFERENCES Videos(video_id)
	)";
	
	$ratings_table = "CREATE TABLE Ratings (
		rating_id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		rater_id INT(8) UNSIGNED,
		video INT(8) UNSIGNED,
		rating INT(1),
		comment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		FOREIGN KEY (rater_id) REFERENCES Users(user_id),
		FOREIGN KEY (video) REFERENCES Videos(video_id)
	)";
	
	if ($conn->query($users_table) === TRUE) {
		echo "Table Users created successfully.<br />";
	} else {
		echo "Error creating table: " . $conn->error . "<br />";
	}

	if ($conn->query($videos_table) === TRUE) {
		echo "Table Videos created successfully.<br />";
	} else {
		echo "Error creating table: " . $conn->error . "<br />";
	}
	
	if ($conn->query($channels_table) === TRUE) {
		echo "Table Channels created successfully.<br />";
	} else {
		echo "Error creating table: " . $conn->error . "<br />";
	}

	if ($conn->query($subscriptions_table) === TRUE) {
		echo "Table Subscriptions created successfully.<br />";
	} else {
		echo "Error creating table: " . $conn->error . "<br />";
	}
	if ($conn->query($comments_table) === TRUE) {
		echo "Table Comments created successfully.<br />";
	} else {
		echo "Error creating table: " . $conn->error . "<br />";
	}
	if ($conn->query($ratings_table) === TRUE) {
		echo "Table Ratings created successfully.<br />";
	} else {
		echo "Error creating table: " . $conn->error . "<br />";
	}
	//more tables go down here as needed...

	$conn->close();
	?>
</html>