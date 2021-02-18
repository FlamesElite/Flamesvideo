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

<body>
<div class="vid_l">
    <div class="vid_cats">
        <div class="cats_tit">
            Channels
        </div>
        <ul>
            <li><a href="#">Members</a></li>
            <li><a href="#">Comedians</a></li>
            <li><a href="#">Directors</a></li>
            <li><a href="#">Gurus</a></li>
            <li><a href="#">Musicians</a></li>
            <li><a href="#">Politicians</a></li>
            <li><a href="#">Reporters</a></li>
        </ul>
    </div>
    <center>
        <script async="" src="./Videos - VidBit_files/f.txt"></script>
        <ins class="adsbygoogle" style="display:inline-block;width:200px;height:90px;margin:10px 0 0" data-ad-client="ca-pub-8433080377364721" data-ad-slot="7508198092"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </center>
</div>
<!-- Start of main -->
<main class="vid_r">
    <div class="vids_hd">
        <ul>
            <li class="selected">Most Subscribed</li>
            <li style="display:hidden;padding: 0 19px;">Most Subscribed</li>
            <li><a href="https://web.archive.org/web/20160917153650/https://www.vidbit.co/videos?c=0&amp;order=m&amp;time=4"> Most Viewed</a></li>
        </ul>
    </div>
    <div class="s_hide"></div>
    <ul class="cat_nav">
        <div class="cat_l">
            in <strong>All Channels</strong>
        </div>
        <br />
        <style>
            li.right {
                border-right: 1px solid #DCDCDC;
                padding-right: 9px;
                margin-right: 5px;
                display: inline-block;
            }
            li.right_selected {
                border-right: 1px solid #DCDCDC;
                padding-right: 9px;
                margin-right: 5px;
                display: inline-block;
            }
        </style>
        <div class="cat_r">
            <li class="right"><a href="https://web.archive.org/web/20160917153650/https://www.vidbit.co/videos?c=0&amp;order=n&amp;time=1">Today</a></li>
            <li class="right"><a href="https://web.archive.org/web/20160917153650/https://www.vidbit.co/videos?c=0&amp;order=n&amp;time=2">This Week</a></li>
            <li class="right"><a href="https://web.archive.org/web/20160917153650/https://www.vidbit.co/videos?c=0&amp;order=n&amp;time=3">This Month</a></li>
            <li class="right_selected">All Time</li>
        </div>
    </ul>
    <div class="vids">
        <?php
            include("db_credentials.php");
            
            //query for newest channels
            $sql = "SELECT * FROM Users ORDER BY user_id DESC";
            
            //query for most viewed videos
            //$sql = "SELECT * FROM Videos ORDER BY views DESC";
            
            //todo: get # of subscribers on each channel to sort by "most subscribed"
            //todo: get # of views on each channel to sort by "most viewed"
            
            $result = $conn->query($sql);

            $user_ids = array();
            $user_names = array();
            $user_avatars = array();
            $user_videos = array();
            $user_views = array();

            $num_channels = $result->num_rows;
            
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    
                    array_push($user_ids, $row["user_id"]);
                    array_push($user_names, $row["username"]);
                    array_push($user_avatars, $row["avatar"]);

                    $get_num_videos = "SELECT * FROM Videos WHERE uploader=".$row["user_id"]."";
                    $result2 = $conn->query($get_num_videos);
                    
                    array_push($user_videos, $result2->num_rows);
                    
                    while($row2 = $result2->fetch_assoc()) {
                        
                    }
                }
                    
            }
            
            for ($i = 0; $i < $num_channels; $i++) {
                if (($i + 1) % 5 == 0 or ($i + 1) == $num_channels) {
                    $className = "chn_sct  mg0 ";
                }
                else {
                    $className = "chn_sct ";
                }
                
                
                echo '<div class="'.$className.'">
                    <div class="chn_nm"><a href="channel.php?user='.$user_ids[$i].'">'.$user_names[$i].'</a></div>
                    <div class="chn_av">
                        <a href="channel.php?user='.$user_ids[$i].'"><img class="avatar" src="images/avatars/'.$user_avatars[$i].'" width="70" height="70"></a>
                    </div>
                    <div class="chn_inf">
                        '.$user_videos[$i].'<br>
                        Videos<br><br>
                        0<br>
                        Views
                    </div>
                </div>';
            }
        ?>
    </div>
    <div class="cl"></div>

    <div class="vids_pagination">
        <?php
            
        ?>
        <span>1</span> 
        <a href="https://web.archive.org/web/20160917153650/https://www.vidbit.co/videos?c=0&amp;p=2&amp;order=n&amp;time=4">2</a> 
        <a href="https://web.archive.org/web/20160917153650/https://www.vidbit.co/videos?c=0&amp;p=3&amp;order=n&amp;time=4">3</a> 
        <a href="https://web.archive.org/web/20160917153650/https://www.vidbit.co/videos?c=0&amp;p=4&amp;order=n&amp;time=4">4</a> 
        <a href="https://web.archive.org/web/20160917153650/https://www.vidbit.co/videos?c=0&amp;p=5&amp;order=n&amp;time=4">5</a> 
        <a href="https://web.archive.org/web/20160917153650/https://www.vidbit.co/videos?c=0&amp;p=2&amp;order=n&amp;time=4">Next</a>
    </div>
</main>

<div style="clear:both"></div>

<?php
    include("footer.php");
?>

</body>
</html>