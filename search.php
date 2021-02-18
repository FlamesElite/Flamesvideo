<?php
    session_start();
?>

<html>
    <title>Vidbit - Display Yourself</title>
    <?php 
    
        include('header.php');
    
        $term = $_GET["video_query"];
		$term_no_spaces = str_replace(" ", "", $term); //remove spaces for additional query
    
    	if ($term == "") {
		    header("location: index.php");
		}

        echo ("<h1>Results for ".$term."</h1>");
    ?>
    
        <div class="content">
			<table>
			<?php
				if ($term == "") {
					header("location: index.php");
				}
				
		        include("db_credentials.php");
				
				$video_query = "SELECT * FROM Videos WHERE video_name LIKE '%$term%'
					OR video_tags LIKE '%$term_no_spaces%'";

				$result = $conn->query($video_query);

				if ($result->num_rows >= 1) {
					while($row = $result->fetch_assoc()) {
						echo
						'<style>
						    .video_cell {
						        padding-left: 15px;
						    }
						</style>';
						echo
						'<tr>
							<td class="video_cell">
							  <div class="video-card">
								<div class="thumbnail">';
								$thumbnail = $row["thumbnail"];
								if ($thumbnail != '') {
									echo '<img src="images/thumbnails/'.$thumbnail.'" style="width: 200px; height: 120px;">';
								}
								else {
									echo '<img src="images/billings.png" style="width: 200px; height: 120px;">';
								}
								
								$uploader_id = $row["uploader"];
								$uploader_name_query = "SELECT * FROM Users WHERE user_id='$uploader_id'";
					                
					            $result2 = $conn->query($uploader_name_query);
					            if ($result2->num_rows >= 1) {
					                while($row2 = $result2->fetch_assoc()) {
					                    $uploader_name = $row2["username"]; 
					                }
					            }
								
								echo '</div>
							</td>
							<td class="video_cell">
								<h3 class="video_title">
								  <a href="watch_video.php?id='.$row["video_id"].'">'.$row["video_name"].'</a>
								</h3>
								<p style="font-size: 14px;">
									uploaded by <a href="channel.php?user='.$row["uploader"].'">'.$uploader_name.'</a>
								 </p>
								<br />
								<br />
								<p class="video_desc">
									'.$row["video_description"].'
								 </p>
							  </div>
							</td>
						</tr>';
					}
				} 
				else {
					echo '<h3>No search results found</h3>';
				}
			?>
			</table>
        </div>
    
    <?php
        /*
        if(!isset($_GET["orderBy" || $_GET["orderBy"] == "views"])) {
            $orderby = "videos";
        }
        else {
            $orderby = "videos";
        }
        */
    ?>
    
    
    <?php 
        include('footer.php');
    ?>
</html>