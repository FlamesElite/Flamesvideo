<?php
    session_start();
    error_reporting(0);

	if($_POST) {
		$user = $_POST['userid'];
		$comment = $_POST['comment_text'];
		$video = $_POST['videoid'];
		
		$reply = False;

		include("db_credentials.php");
		
		$reply_id = 0;
		if ($reply === TRUE) {
			// ...
		}
		
		$date_now=gmdate("Y-m-d H:i:s");
		
		$latest_id = 0;			
		$query_latest_comment = "SELECT * FROM Comments ORDER BY comment_id DESC LIMIT 1";
		$result = $conn->query($query_latest_comment);
		if ($result->num_rows === 1) {
			while($row = $result->fetch_assoc()) {
				$latest_id = $row['comment_id'];
			}
		}
		
		$query_insert_comment = "INSERT INTO Comments (comment_id, commentor_id, video, comment_text, 
			upvotes, downvotes, reply_to, comment_date) VALUES (".($latest_id+1).", $user, $video, '$comment',
			0, 0, $reply_id, '$date_now')";

		if ($conn->query($query_insert_comment) === TRUE) {
			//echo "Comment successfully uploaded.";
		} else {
			//echo "Error uploading Comment: ";
		}
		
		echo "<script>window.location.replace('watch_video.php?id=".$video."');</script>";
	}
?>