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
            Categories
        </div>
        <ul>
            <li><a href="https://web.archive.org/web/20160917153650/https://www.vidbit.co/videos?c=1&amp;order=n&amp;time=4">Film &amp; Animation</a></li>
            <li><a href="https://web.archive.org/web/20160917153650/https://www.vidbit.co/videos?c=2&amp;order=n&amp;time=4">Autos &amp; Vehicles</a></li>
            <li><a href="https://web.archive.org/web/20160917153650/https://www.vidbit.co/videos?c=3&amp;order=n&amp;time=4">Music</a></li>
            <li><a href="https://web.archive.org/web/20160917153650/https://www.vidbit.co/videos?c=4&amp;order=n&amp;time=4">Pets &amp; Animals</a></li>
            <li><a href="https://web.archive.org/web/20160917153650/https://www.vidbit.co/videos?c=5&amp;order=n&amp;time=4">Sports</a></li>
            <li><a href="https://web.archive.org/web/20160917153650/https://www.vidbit.co/videos?c=6&amp;order=n&amp;time=4">Gaming</a></li>
            <li><a href="https://web.archive.org/web/20160917153650/https://www.vidbit.co/videos?c=7&amp;order=n&amp;time=4">People &amp; Blogs</a></li>
            <li><a href="https://web.archive.org/web/20160917153650/https://www.vidbit.co/videos?c=8&amp;order=n&amp;time=4">Comedy</a></li>
            <li><a href="https://web.archive.org/web/20160917153650/https://www.vidbit.co/videos?c=9&amp;order=n&amp;time=4">Entertainment</a></li>
            <li><a href="https://web.archive.org/web/20160917153650/https://www.vidbit.co/videos?c=10&amp;order=n&amp;time=4">News &amp; Politics</a></li>
            <li><a href="https://web.archive.org/web/20160917153650/https://www.vidbit.co/videos?c=11&amp;order=n&amp;time=4">Howto &amp; Style</a></li>
            <li><a href="https://web.archive.org/web/20160917153650/https://www.vidbit.co/videos?c=12&amp;order=n&amp;time=4">Education</a></li>
            <li><a href="https://web.archive.org/web/20160917153650/https://www.vidbit.co/videos?c=13&amp;order=n&amp;time=4">Science &amp; Technology</a></li>
            <li><a href="https://web.archive.org/web/20160917153650/https://www.vidbit.co/videos?c=14&amp;order=n&amp;time=4">Nonprofits &amp; Activism</a></li>
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
            <li class="selected">Newest</li>
            <li style="display:hidden;padding: 0 19px;">Newest</li>
            <li><a href="https://web.archive.org/web/20160917153650/https://www.vidbit.co/videos?c=0&amp;order=m&amp;time=4"> Most Viewed</a></li>
            <li><a href="https://web.archive.org/web/20160917153650/https://www.vidbit.co/videos?c=0&amp;order=md&amp;time=4"> Most Discussed</a></li>
            <li><a href="https://web.archive.org/web/20160917153650/https://www.vidbit.co/videos?c=0&amp;order=t&amp;time=4"> Top Rated</a></li>
        </ul>
    </div>
    <div class="s_hide"></div>
    <ul class="cat_nav">
        <div class="cat_l">
            in <strong>All Categories</strong>
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
            
            //query for newest videos
            $sql = "SELECT * FROM Videos ORDER BY video_id DESC";
            
            //query for most viewed videos
            //$sql = "SELECT * FROM Videos ORDER BY views DESC";
            
            //todo: get # of comments on each video to sort by "most discussed"
            
            $result = $conn->query($sql);

            $video_ids = array();
            $video_names = array();
            $video_thumbnails = array();
            $video_views = array();
            $video_durations = array();
            
            $uploader_ids = array();
            $video_uploaders = array();

            $num_videos = $result->num_rows;
            
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    
                    array_push($video_ids, $row["video_id"]);
                    array_push($video_names, $row["video_name"]);
                    array_push($video_thumbnails, $row["thumbnail"]);
                    array_push($video_views, $row["views"]);
                    array_push($video_durations, $row["duration"]);
                    
                    array_push($uploader_ids, $row["uploader"]);
                    
                    $get_uploader_name = "SELECT * FROM Users WHERE user_id=".$row["uploader"]."";
                    $result2 = $conn->query($get_uploader_name);
                    while($row2 = $result2->fetch_assoc()) {
                        array_push($video_uploaders, $row2["username"]);
                    }
                }
                    
            }
            
            for ($i = 0; $i < 16; $i++) {
                if (($i + 1) % 4 == 0) {
                    $className = "vids_sct mg0";
                }
                else {
                    $className = "vids_sct";
                }
                
                echo '<div class="'.$className.'">
                    <div class="th"><div class="th_t">0:00</div>
                    <a href="watch_video.php?id='.$video_ids[$i].'"><img class="vid_th" alt="" src="images/thumbnails/'.$video_thumbnails[$i].'" width="177" height="111"></a></div>
                    <a href="watch_video.php?id='.$video_ids[$i].'" class="line2b">'.$video_names[$i].'</a>
                    <div class="views sm">'.$video_views[$i].' views</div>
                    <div class="chn_lnk sm"><a href="channel.php?user='.$uploader_ids[$i].'">'.$video_uploaders[$i].'</a></div>
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