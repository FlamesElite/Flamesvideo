<!DOCTYPE html>
<!-- Header -->
<?php
    session_start();
    include("header.php");
    include("db_credentials.php");
?>

<style>
.ft_bx_sct:last-of-type{
    margin: 0;
}
</style>

<!-- Start of main -->
<main class="ho_l">
    <div class="ho_box">
        <div class="ho_box_h">
            <img class="ho_box_ico" src="images/bwn.png" width="20" height="20" alt="Videos Being Watched Now">
            <span class="ho_box_ti">Random videos</span>
        </div>
        <div class="ho_box_c">
            <div class="bwn_bg_th" style="width: 613px; display: block; margin: 0;">
                
            <?php
                //fisrt, get number of videos
                $get_num_videos = "SELECT * FROM Videos";
                $result = $conn->query($get_num_videos);
                
                $num_videos = $result->num_rows;
                
                //holds 4 random unique video ids for videos to display under random videos
                $random_ids = array();
                
                //if at least 4 videos to display...
                if ($num_videos >= 4) {
                    for ($i = 0; $i < 4; $i++) { // for loop that runs 4 times
                        $assigned = False; //tells whether or not a value was recently added to list of random video ids (to show user)
                        while ($assigned == False) {
                            $next_rand = mt_rand(1, $num_videos);
                            
                            $get_rand_video = "SELECT * FROM Videos WHERE video_id='.$next_rand.'";
                            $result2 = $conn->query($get_rand_video);
                            $video_found = $result2->num_rows;

                            if (!in_array($next_rand, $random_ids) && $video_found == 1) { //push randomly generated value only if it was not already chosen
                                array_push($random_ids, $next_rand);
                                $assigned = True;
                            }
                            //stay in loop until a unique value gets added to list of random video ids
                        }
                    }
                }

                $sql = "SELECT * FROM Videos WHERE video_id=".$random_ids[0]." OR video_id=".$random_ids[1]." OR video_id=".$random_ids[2]." OR video_id=".$random_ids[3]."";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        
                        $get_uploader_name = "SELECT * FROM Users WHERE user_id=".$row["uploader"]."";

                        $result2 = $conn->query($get_uploader_name);
                        
                        while($row2 = $result2->fetch_assoc()) {
                            $uploader_name = $row2["username"];
                        }
                        
                        echo "
                        <div class='ft_bx_sct '>
                            <div class='th'>
                                <div class='th_t'>0:00</div>
                                <a href='/watch_video.php?id={$row["video_id"]}'>
                                    <img class='vid_th' src='/images/thumbnails/{$row["thumbnail"]}' width='127' height='80'>
                                </a>
                            </div>
                            <div class='sm_info'>
                                <a href='/watch_video.php?id={$row["video_id"]}' class='sm2 line2'>{$row["video_name"]}</a>
                                <div class='views sm'>1 week ago<br>
                                    {$row["views"]} views
                                </div>
                                <div class='chn_lnk sm'><a href='channel.php?user=".$row["uploader"]."'>".$uploader_name."</a></div>
                                 
                            </div>
                        </div>
                        ";

                    }
                }

            ?>

            </div>
        </div>
    </div>
    <div class="ho_box">
        <div class="ho_box_h" style="background-color: #D2E3FB">
            <img class="ho_box_ico" src="images/ft.png" width="20" height="20" alt="Featured Videos">
            <span class="ho_box_ti">New Videos</span>
        </div>
        <div class="ho_box_c">
            <div class="ft_bx" style="width: 613px; display: block; margin: 0;">

            <?php

                $sql = "SELECT * FROM Videos ORDER BY video_id DESC LIMIT 4";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        
                        $get_uploader_name = "SELECT * FROM Users WHERE user_id=".$row["uploader"]."";

                        $result2 = $conn->query($get_uploader_name);
                        
                        while($row2 = $result2->fetch_assoc()) {
                            $uploader_name = $row2["username"];
                        }
                        
                        echo "
                        <div class='ft_bx_sct '>
                            <div class='th'>
                                <div class='th_t'>0:00</div>
                                <a href='/watch_video.php?id={$row["video_id"]}'>
                                    <img class='vid_th' src='/images/thumbnails/{$row["thumbnail"]}' width='127' height='80'>
                                </a>
                            </div>
                            <div class='sm_info'>
                                <a href='/watch_video.php?id={$row["video_id"]}' class='sm2 line2'>{$row["video_name"]}</a>
                                <div class='views sm'>1 week ago<br>
                                    {$row["views"]} views
                                </div>
                                <div class='chn_lnk sm'><a href='channel.php?user=".$row["uploader"]."'>".$uploader_name."</a></div>
                                     
                            </div>
                        </div>
                        ";

                    }
                } else {
                    echo "0 results";
                }

            $conn->close();

            ?>

         
                    </div>
                </div>
                 
                    <img src="./VidBit - Display Yourself._files/0s.png" class="s"><img src="./VidBit - Display Yourself._files/0s.png" class="s"><img src="./VidBit - Display Yourself._files/0s.png" class="s"><img src="./VidBit - Display Yourself._files/0s.png" class="s"><img src="./VidBit - Display Yourself._files/0s.png" class="s">
                </div>
            </div>
        </div>
    </div>
</main>
<div class="ho_r">
    <div class="ho_r_cu">
        <div class="ho_r_cu2">
            <?php
                if ($_SESSION['userName'] != null) {
                    echo '<p>Welcome to the website! This website is currently on beta, please except some bugs and glitches.</p>';
                }
                else {
                    echo '<a href="login.php">Sign In</a> or <a href="signup.php">Sign Up</a> now!';
                }
            ?>
        </div>
    </div>
    <div class="ho_r_new">
        <div class="ho_r_new_h">
            What's New
        </div>
       
        <a href="index.php">We're in alpha</a><br>
        After development, we're happy to announce that we're finally in alpha!
    </div>
</div>

<div style="clear:both"></div>

<div class="m_div">
    <?php
        include("footer.php");
    ?>
</div>

</body>
</html>