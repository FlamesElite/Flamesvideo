<?php
	session_start();
?>

<!-- index, initial landing page -->
<!-- saved from url=(0036)https://vidsurf.glitch.me/index.html -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Vidbit - Display yourself</title>
    <link rel="stylesheet" href="css/index.css?ts=<?=time()?>">
	<link rel="stylesheet" href="css/header.css?ts=<?=time()?>">
	<link rel="stylesheet" href="css/sidebar.css?ts=<?=time()?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="images/jquery.min.js.download"></script>
  </head>
  <body>
	<?php
		include("header.php");
		include("sidebar.php");
		
		if ($_SESSION['userId'] == null) {
			header("location: index.php");
		}
		
		include("db_credentials.php");
		
		$userId = $_SESSION['userId'];
		
		$get_all_videos = "SELECT * FROM Videos WHERE uploader=".$userId."";
		$result = $conn->query($get_all_videos);
		$total_videos = $result->num_rows;

		$video_ids = array();
		$video_names = array();
		$views = array();

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				array_push($video_ids, $row['video_id']);
				array_push($video_names, $row['video_name']);
				array_push($views, $row['views']);
			}		
		}
	?>

    <main>
      <section class="featured-section">
        <div class="header_index">
          <h1>
            Video manager
          </h1>
        </div>
        <div class="content">
          <div class="video-card" style="width: 100%;">
			<table style="width: 100%;">

			<?php
			//YES: Delete the selected video
			if (isset($_GET['delete_yes'])) {
				$delete_video = "DELETE FROM Videos WHERE video_id=".$_GET['delete_yes'];
				$result = $conn->query($delete_video);
			}
			if (isset($_GET['delete_no'])) {
				header("location: video_manager.php");
			}
			//...
			if (isset($_GET['view']) || isset($_GET['edit']) || isset($_GET['delete'])) {				
				if (isset($_GET['view'])) {
					echo ("VIEW: ".$_GET['view']);
				}
				if (isset($_GET['edit'])) {
					echo ("EDIT: ".$_GET['edit']);
				}
				if (isset($_GET['delete'])) {
					$get_featured_video = "SELECT * FROM Videos WHERE video_id=".$_GET['delete']."";
					$result = $conn->query($get_featured_video);
					if ($result->num_rows === 1) {
						while($row = $result->fetch_assoc()) {
							$the_video_name = $row['video_name'];
						}
					}
					echo '<tr>';
						echo '<td style="width: 15%; padding: 5px;">';
							echo '<div class="thumbnail">';
								echo '<input class="thumbnail" type="image" src="images/image8-2-1024x576.png" style="height: 75px;" />';
							echo '</div>';
						echo '</td>';
						echo '<td style="width: 85%; padding: 5px;">';
							echo '<div>Are you sure you want to delete '.$the_video_name.' forever?</div>';
							echo '<form method="GET" action='.htmlspecialchars($_SERVER["PHP_SELF"]).'>';
								echo '<button name="delete_yes" value='.$_GET['delete'].' type="submit">Yes</button>';
								echo '<button name="delete_no" value='.$_GET['delete'].' type="submit">No</button>';
							echo '</form>';
						echo '</td>';
					echo '</tr>';
				}
			}
			else {
				for ($i = ($total_videos-1); $i >= 0; $i--) {
					echo '<tr>';
						echo '<td style="width: 15%; padding: 5px;">';
							echo '<div class="thumbnail">';
							  echo '<input class="thumbnail" type="image" src="images/image8-2-1024x576.png" style="height: 75px;" />';
							echo '</div>';
						echo '</td>';
						echo '<td style="width: 55%; padding: 5px;">';
							echo '<div>'.$video_names[$i].'</div>';
							echo '<form method="GET" action='.htmlspecialchars($_SERVER["PHP_SELF"]).'>';
								echo '<button name="view" value='.$video_ids[$i].' type="submit">View</button>';
								echo '<button name="edit" value='.$video_ids[$i].' type="submit">Edit</button>';
								echo '<button name="delete" value='.$video_ids[$i].' type="submit">Delete</button>';
							echo '</form>';
						echo '</td>';
						echo '<td style="width: 15%; padding: 5px;">';
							echo $views[$i].' views';
						echo '</td>	';
						echo '<td style="width: 15%; padding: 5px;">';
							echo 'Rating <br />';
							echo '*****';
					echo '</td>';
					echo '</tr>';
				}
			}
			
			?>

			</table>
          </div>
        </div>

      </section>
    </main>
	
	<!-- sample php code -->
	<?php 

	?>
	
    <aside class="ads">
      
    </aside>
    <footer>
      
    </footer>

</body></html>
