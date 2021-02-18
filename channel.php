<title>Vidbit Display Yourself</title>
<html>
<head>
    <title><?php echo $title; ?></title>
</head>
<body>

 <!-- end header -->

<!-- begin footer -->
</body>
</html>
<?php
    $title = "Vidbit Display Yourself";                   // (1) Set the title
    include "header.php";                 // (2) Include the header
?>

<!-- begin page content -->
<div class="pr_box_left" style='display: inline-block; width: 360px;'>
    <div class="pr_box_hd highlight_hd">
        <div class="box_hd_l" style="width: 200px">
            <div style="position:width:210px;line-height:24px;font-size:15px">
                                                                                 </div>
        </div>
        <div class="box_hd_r" style="position: absolute; top: 50%; right: 7px">
            <div class="vcenter">
                <a href="javascript:void(0)" class="sub" onclick="alert('You must be logged in to subscribe!')">Subscribe</a>
            </div>
        </div>
    </div>
    <div class="pr_box_in highlight_in">
        <div class="high_hd">
            <div class="high_av">
                <div style="padding:2px;border:1px solid gray;background-color:white">
                    <a href="/web/20160714204944/http://www.vidbit.co/user/VidBit"><img class="avatar" style="border: 1px double #999" src="images/avatar_.jpg" alt="VidBit" width="96" height="96"></a>                        
                </div>
                <br />
            </div>
            <div class="high_info">
                <div class="info_user">

                    <?php
                        include("db_credentials.php");
	                    error_reporting(0);
                    
                        $userId = $_GET['user'];

                        $get_user_info = "SELECT * FROM Users WHERE user_id=".$userId;
            			$result = $conn->query($get_user_info);
            
            			if ($result->num_rows === 1) {
            				while($row = $result->fetch_assoc()) {
            					$username = $row['username'];
            					$channel_email = $row['email'];
            					$join_date = $row['join_date'];
            					$avatar = $row['avatar'];
            					$country = $row['country'];
            					$website = $row['website'];
            					$age = $row['age'];
            					$occupation = $row['occupation'];
            					$school = $row['school'];
            					$hobbies = $row['hobbies'];
            				}
            			}
            			else {
            				die ("<p style='padding: 10px;'>This user does not exist.<p>");
            			}
            			
            			$get_channel = "SELECT * FROM Channels WHERE channel_id='$userId'";
            			$result = $conn->query($get_channel);		
            
            			if ($result->num_rows === 1) {
            				while($row = $result->fetch_assoc()) {
            					$channel_description = $row['channel_description'];
            					$featured_video = $row['featured_video'];
            					$background_image = $row['background_image'];
            				}
            			}
            			
                        echo ($username);
                    ?>

                </div>
            </div>
        </div>
        <div class="high_pro">
            Age: <strong>
            <?php 
                if ($age != "")
                    echo ($age);
                else
                    echo ("Not specified");
            ?> 
            </strong>
        </div>
                        
        <div class="high_dscr">
            <?php 
                if ($channel_description != "")
                    echo ($channel_description);
                else
                    echo ("No description");
            ?>
        </div>
        <div class="high_pro">
            Country: 
            <strong>
            <?php 
                if ($country != "")
                    echo ($country);
                else
                    echo ("Not specified");
            ?>
            </strong>
        </div>
        <div class="high_pro">
            Occupation:
            <strong>
            <?php 
                if ($occupation != "")
                    echo ($occupation);
                else
                    echo ("Not specified");
            ?>
            </strong>
        </div>
        <div class="high_pro">
            School:
            <strong>
            <?php 
                if ($school != "")
                    echo ($school);
                else
                    echo ("Not specified");
            ?>
            </strong>
        </div>
        <div class="high_pro">
            Hobbies: 
            <strong>
            <?php 
                if ($hobbies != "")
                    echo ($hobbies);
                else
                    echo ("Not specified");
            ?>
            </strong>
        </div>
        <div class="high_pro">
            Website: <strong>
            <?php 
                if ($website != "")
                    echo ('<a href="$website">'.$website.'</a>');
                else
                    echo ("Not specified");
            ?>
            </strong>
        </div>
    </div>
</div>

<div class="pr_box_right" style='display: inline-block;'>
	<div style="padding: 1rem;">
	<?php
		if ($featured_video != "" && $featured_video != 0) {
			$get_featured_video = "SELECT * FROM Videos WHERE video_id=$featured_video";
			$result = $conn->query($get_featured_video);

			if ($result->num_rows === 1) {
				while($row = $result->fetch_assoc()) {
				    echo ("Koalas sleep in trees.");
					$featured_video_id = $row['video_id'];
					$featured_video_name = $row['video_name'];
					$featured_video_file = $row['video_file'];
					//assigned to update the view count on the video...
					$curr_view_count = $row['views'];
				}
			}
			echo "<video class='vid' src='videos/uploaded/".$featured_video_name."' controls width='100%' height='auto' style='width: 640px;'></video>";
			
    		echo "<br />";
    		
    		echo "<div style='font-weight: bold; font-size: 18px;'><a href='watch_video.php?id=1' 
    			class='feat_video_link'>featured video</a></div>";			
		}
		else {
			echo "<img src='images/no_featured_video.png' style='width: 640px;'>";
		}
		
		/*
		$lifetime_views = 0;
		$get_all_videos = "SELECT * FROM Videos WHERE uploader=".$userId." AND deleted=0";
		$result = $conn->query($get_all_videos);
		$total_videos = $result->num_rows;

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$lifetime_views += $row['views'];
			}
		}
		*/
		
		echo '<br />';
			$get_user_videos = "SELECT * FROM Videos WHERE uploader='$userId' ORDER BY video_id DESC";
			$result = $conn->query($get_user_videos);
			
			$total_videos = $result->num_rows;
		
			echo '<div class="bold_name">All Videos ('.$total_videos.')</div>';
				
				echo '<div class="videos_container" style="width: 640px; overflow-x: scroll;">';
					echo '<table><tr>';	

					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							echo '
							<td class="all_videos" style="width:120px;"><div class="a_video">
							  <form method="GET" action="watch_video.php?id='.$row["video_id"].'">
								<div class="thumbnail">';
							if ($row["thumbnail"] != '') {
								echo '<a href="watch_video.php?id='.$row["video_id"].'">
								<img src="images/thumbnails/'.$row["thumbnail"].'" 
								style="width: 120px; height: 67.5px;"/>
								</a>';
							}
							else {
								echo '<a href="watch_video.php?id='.$row["video_id"].'">
								<img src="images/image8-2-1024x576.png"
								style="width: 120px; height: 67.5px;"/>
								</a>';
							}
								  
								echo '</div>
								<br>
							  </form>
							  <h3 class="h">
								<a href="watch_video.php?id='.$row["video_id"].'" class="video_link">'.$row["video_name"].'</a>
							  </h3>
							</div></td>
							';
						}
					}

					echo '</tr></table>';
				echo '</div>';
	?>
	</div>
</div>
<!-- end page content -->

<?php
    include "footer.php";                 // (3) Include the footer
?>
