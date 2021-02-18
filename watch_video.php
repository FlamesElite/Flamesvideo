<?php
    session_start();
    include("header.php");
?>

<title>VidBit - Video title</title>

<body>
	<?php
        include("db_credentials.php");

		$videoId = $_GET['id'];
		$get_video = "SELECT * FROM Videos WHERE video_id='$videoId'";
		$result = $conn->query($get_video);
		
		if ($result->num_rows === 1) {
			while($row = $result->fetch_assoc()) {
				$location = $row['file_name'];
				$ext = $row['video_extension'];
				$title = $row['video_name'];
				$desc = $row['video_description'];
				$upload_date = $row['date_uploaded'];
				$uploader_id = $row['uploader'];
				//assigned to update the view count on the video...
				$curr_view_count = $row['views'];
			}
		}
		else {
			die ("video does not exist!");
		}
		
		/*
		$update_view_count = "UPDATE Videos SET Views=".($curr_view_count+1)." WHERE video_id=".$videoId."";
		$update = $conn->query($update_view_count);	
		*/

		$get_uploader = "SELECT * FROM Users WHERE user_id='$uploader_id'";
		$result = $conn->query($get_uploader);
		
		if ($result->num_rows === 1) {
			while($row = $result->fetch_assoc()) {
				$uploader_name = $row['username'];
			}
		}
	?>

<div style="display:none" id="urlLl1">EEABEbf1ix</div>
<link rel="stylesheet" href="#">
<script>jwplayer.key="XL5kwywaGdDecA/TeQULnVV9l6Z7vaekCmFmWA==";</script>
<h1><?php echo ($title); ?></h1>
<main class="wp_l">
    <div id="myElement" class="jwplayer jw-reset jw-state-error jw-skin-seven jw-stretch-uniform jw-flag-user-inactive" tabindex="0" style="width: 688px; height: 387px;">
    <div class="jw-aspect jw-reset"></div>
    <?php 
		echo "<video class='vid' src='videos/uploaded/" . $location . ".mp4' controls width='688px' height='392px' type='video/" . $ext . "' >";				
	?>;
</div>

	    <div class="v_stats">
        <div class="v_stats_l" onmouseleave="removestars();">
         <div class="v_stats_r">
            <strong><?=$curr_view_count?></strong> views        </div>
    </div>
    <div style="clear:both"></div>
    <div class="shares1">
        <ul>
            <li><a href="javascript:void(0)" onclick="sh(1)"><img src="images/f0.png" id="f"> Favorite</a></li>
            <li><a href="javascript:void(0)" onclick="sh(2)"><img src="images/s0.png" id="s"> Share</a></li>
            <li><a href="javascript:void(0)" onclick="sh(3)"><img src="images/p0.png" id="p"> Playlists</a></li>
            <li><a href="javascript:void(0)" onclick="sh(4)"><img src="images/fl0.png" id="fl"> Flag</a></li>
        </ul>
    </div>
    <div id="shares2">
        <div id="favorite">
                            Want to add to Favorites? <strong><a href="https://vidbit.xyz/login.php">Sign In</a> or <a href="https://vidbit.xzy/signup.php">Sign Up</a> now!</strong>
                    </div>
        <div id="share" style="display: block">
            <ul>
                <li><a href="#" target="_blank">Facebook</a></li>
                <li><a href="twitter.com" target="_blank">Twitter</a></li>
                <li><a href="google.com" target="_blank">Google+</a></li>
                <li><a href="linkedin.com" target="_blank">Linkedin</a></li>
            </ul>
        </div>
        <div id="playlists">
                            Want to add it to Playlists? <strong><a href="https://vidbit.xyz/login.php">Sign In</a> or <a href="https://vidbit.xyzsignup.php">Sign Up</a> now!</strong>
                    </div>
        <div id="flag">
                            Want to flag a video? <strong><a href="https://vidbit.xyz/login">Sign In</a> or <a href="https://vidbit.xyz/signup">Sign Up</a> now!</strong>
                    </div>
    </div>
    <div class="video_resps">
        <?php
            if ($_SESSION['userName'] != null) {
                //todo: add colums in the videos table to allow for video responses
                echo '<div class="vi_rsp"><a href="https://vidbit.xyz/upload_video.php">Post a video response</a></div>';
            }
            else {
                echo '<div class="vi_rsp"><a href="https://vidbit.xyz/login.php">Sign In to post a video response</a></div>';
            }
        ?>
        
        <div class="sct_tit" onclick="sh(5)">
            <img src="./VidBit Time Machine - Episode 1 - VidBit_files/sct1.png" class="sctI" id="vrI"> Video Responses <span>(0)</span>
        </div>
        <!--
        <div id="v_rsp_in">
            <center>
                <div class="v_rsp_in_sct">
                    <div class="th">
                        <div class="th_t">0:00</div>
                        <a href="https://web.archive.org/web/20160731182940/http://www.vidbit.co/watch?v=MJNato9oup">
                            <img class="vid_th" src="./VidBit Time Machine - Episode 1 - VidBit_files/MJNato9oup.jpg" width="109" height="67">
                        </a>
                    </div>
                    <br>
                </div>
                <div style="clear:both"></div>
            </center>
        </div>
        -->
    </div>
    <div id="video_cmts">
        <div class="sct_tit" onclick="sh(6)">
         </div>
        <div id="cmt_i">
            <?php
                $get_comments = "SELECT * FROM Comments WHERE video='$videoId' ORDER BY comment_id DESC";
				$result = $conn->query($get_comments);

				if ($result->num_rows >= 0) {
					//fetch the data of the user who made each comment, also				
					
					while($row = $result->fetch_assoc()) {
						$get_commentor_info = "SELECT * FROM Users WHERE user_id=".$row['commentor_id'];
						$result2 = $conn->query($get_commentor_info);
						
						if ($result2->num_rows === 1) {
							while($row2 = $result2->fetch_assoc()) {
								$commentor_name = $row2['username'];
								$avatar = $row2['avatar'];
							}
						}
						
						$comment_date = $row['comment_date'];
						
						$now = date_create()->format('Y-m-d H:i:s');
						
						$date1 = strtotime($comment_date);  
						$date2 = strtotime($now);
						
						$time_difference = abs($date2 - $date1);					
						$long_ago = "";
						
						$years = (int)($time_difference / 60 / 60 / 24 / 365);
						if ($years == 0) {
							$months = (int)($time_difference / 60 / 60 / 24 / 365 * 12);
							if ($months == 0) {
								//convert seconds to weeks...
								$weeks = (int)($time_difference / 60 / 60 / 24 / 7);
								if ($weeks == 0) {
									//convert seconds to days...
									$days = (int)($time_difference / 60 / 60 / 24);
									if ($days == 0) {
										//convert seconds to hours...
										$hours = (int)($time_difference / 60 / 60);
										if ($hours == 0) {
											//convert seconds to hours...
											$minutes = (int)($time_difference / 60);
											if ($minutes == 0) {
												//convert seconds to hours...
												$seconds = $time_difference;
												$long_ago = $seconds." second";
											}
											else
												$long_ago = $minutes." minute";
										}
										else
											$long_ago = $hours." hour";
									}
									else
										$long_ago = $days." day";
								}
								else
									$long_ago = $weeks." week";
							}
							else
								$long_ago = $months." month";
						}
						else
							$long_ago = $years." year";
						
						if ($long_ago != 1) 
							$long_ago = $long_ago."s";
						
						echo '
						    <div class="cmt_sct">
                                <div class="cmt_l">
                                    <div class="cmt_l_i">
                                        <a href="channel.php?user='.$row['commentor_id'].'">'.$commentor_name.'</a><span class="i"> ('.$long_ago.' ago)
                                    </span>
                                    </div>
                                    <div class="cmt_l_c">
                                        '.$row['comment_text'].'
                                    </div>
                                </div>
                                <div class="cmt_r">
                                    <strong id="r_2951" style="color:gray">0</strong>
                                    <img src="images/td0.png" onclick="alert(&#39;Please log in to rate this comment!&#39;)">
                                    <img src="images/tu0.png" onclick="alert(&#39;Please log in to rate this comment!&#39;)">
                                </div>
                            </div>
						';
					}
				}
            ?>
                
                        <div style="clear:both"></div>
                        <div class="pagination">
                <strong>Pages: <span>1</span> </strong>
            </div>
                <div class="wyl_cmt">
                    <h2>Write a comment</h2>
                    <?php
                        if ($_SESSION['userName'] != null) {
                            echo '<form id="submit_comment" action="post_comment.php" method="POST">';
            					echo '<div>';
            						echo '<textarea class="form-control" rows="6" cols="50" id="comment" name="comment_text"></textarea>';
            						echo '<br />';
            						echo '<div style="padding-left: 295px;">';
            							echo '<input type="text" id="userid" name="userid" value="'.$_SESSION["userId"].'" hidden />';
            							echo '<input type="text" id="videoid" name="videoid" value="'.$videoId.'" hidden />';
            							echo '<input type="submit" id="submit" name="submit" value="Comment" />';
            						echo '</div>';
            					echo '</div>';
            				echo '</form>';
                        }
                        else {
                            echo '<a href="https://vidbit.xyz/signup.php">Join VidBit</a> for a free account, or <a href="https://vidbit.xyz/login.php">sign in</a> if you are already a member.';
                        }
                    ?>
                </div>
        </div>
    </div>
</main>
<div class="wp_r">
<a href="#"></a>
        <div class="descr">
        <div class="descr_hd">
            <div class="descr_hd_l">
                <div class="descr_av">
<a href="#"></a>
                <div class="descr_info">
                     <a href="channel.php?user=<?=$uploader_id?>"><?=$uploader_name?></a>
                     <time>
                     <?php 
                        $date=date_create($upload_date);
                        echo date_format($date,"j M Y"); 
                    ?>
                     </time><br>
                     <?=$desc?>
                    <div class="showmore">(<a href="javascript:void(0)" id="sml" onclick="mi()" >more info</a>)</div>
                </div>
                <div class="descr_sub" style="margin-left: 134px;" >
                    <a href="javascript:void(0)" class="sub" onclick="alert(&#39;You must be logged in to subscribe!&#39;)">Subscribe</a>                </div>
            </div>
        </div>
   
            <table>
                <tbody><tr>
                    <td align="right" width="48"><label for="url">URL</label></td>
                    <td><input type="text" value="vidbit.xyz/watch_video.php?id=<?php echo ($videoId); ?>" size="45" id="url" readonly=""></td>
                </tr>
            </tbody></table>
        </div>
    </div>
            <div class="mr_fr">
        <div class="sct_tit" onclick="sh(7)">
         </div>

        <div id="mr_fr_in">
            <!-- single video in more from user... -->
            <div class="mr_fr_sct">
                <div class="mr_fr_sct_l">
                    <div class="th">  t
                        <div class="th_t"></div>
                         </a>
                    </div>
                </div>
                <div class="mr_fr_sct_r">
                     <span class="views sm">22 views</span>
                </div>
            </div>
            <!-- END OF single video in more from user... -->
        </div>
        
    </div>
        <div class="rel">
        <div class="sct_tit" onclick="sh(8)">
         </div>
        
        <div id="re">
            <?php
                //related videos
                $related_videos = "SELECT * FROM Videos ORDER BY views DESC";
                $result = $conn->query($related_videos);
                
                while($row = $result->fetch_assoc()) {
                    
                    $get_uploader_name = "SELECT * FROM Users WHERE user_id=".$row["uploader"]."";

                    $result2 = $conn->query($get_uploader_name);
                        
                    while($row2 = $result2->fetch_assoc()) {
                        $uploader_name = $row2["username"];
                    }
                    
                    echo '
                        <div class="mr_fr_sct">
                            <div class="mr_fr_sct_l">
                                <div class="th">
                                    <div class="th_t">0:00</div>
                                         <img class="vid_th" src="images/thumbnails/'.$row['thumbnail'].'" width="105" height="68">
                                    </a>
                                </div>
                            </div>
                            <div class="mr_fr_sct_r">
                                <a href="watch_video.php?id='.$row['video_id'].'">'.$row['video_name'].'</a><br/>
                                <p style="font-size: 12px;">by <a href="channel.php?user='.$row["uploader"].'">'.$uploader_name.'</a></p><br/>
                                <p style="font-size: 12px;">'.$row['views'].' views</p><br/>
                        </div>
                    </div>
                    ';
                }
            ?>
        </div>
        
    </div>
    </div>
<div style="clear:both"></div>

<?php 
	include("footer.php");				
?>;

</body>
</html>