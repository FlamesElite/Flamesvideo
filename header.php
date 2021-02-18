<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<link rel="stylesheet" type="text/css" href="css/banner-styles.css">
<link rel="stylesheet" type="text/css" href="css/iconochive.css">
<!-- End Wayback Rewrite JS Include -->

<title>VidBit - Display Yourself.</title>

<meta name="theme-color" content="#3498DB">

<link rel="stylesheet" href="css/main2.css">
</head>

<body>
<style type="text/css">
body {
  margin-top:0 !important;
  padding-top:0 !important;
}
</style>

<div class="m_div">
    <header class="hd">
    <div class="hd_l">
        <div class="hd_l_logo">
            <a href="index.php"><img src="Pictures/vidbit.png" alt="vidbit" width="115" height="45"></a>
        </div>
        <div class="hd_l_s">
            Display Yourself<br>
            <a href="#">Worldwide</a><a href="#" class="small_nav">English</a>
        </div>
    </div>
    <div class="hd_r">
        <div class="hr_r_nav">
            <?php
                if ($_SESSION['userName'] != null) {
                    echo ' <a href="channel.php?user='.$_SESSION['userId'].'"><strong>'.$_SESSION['userName'].' </strong></a>';
                    echo '<a href="help.php" class="small_nav">Help</a>';
                    echo '<a href="processLogout.php" class="small_nav">Sign Out</a>';
                    echo '<a href="video_history.php" class="small_nav">Video history</a>';
                }
                else {
                    echo '<strong><a href="signup.php">Sign Up</a></strong>';
                    echo '<a href="help.php" class="small_nav">Help</a>';
                    echo '<a href="login.php" class="small_nav">Sign In</a>';
                    echo '<a href="video_history.php" class="small_nav">Video history</a>';
                }
            ?>
        </div>
    </div>
</header>
<div style="clear:both"></div>
<nav class="hd_nav">
    <div class="hd_nav_menu">
        <ul>
            <a href="index.php" tabindex="3"><li>Home</li></a>
            <a href="videos.php" tabindex="4"><li>Videos</li></a>
            <a href="channels.php" tabindex="5"><li>Channels</li></a>
            <a href="community.php" tabindex="6"><li>Community</li></a>
        </ul>
    </div>
    <div class="hd_nav_search">
        <form action="search.php" method="GET">
            <input type="text" class="search" name="video_query" tabindex="1" maxlength="64" autofocus=""> <input type="submit" value="Search" class="s_b" tabindex="2">
        </form>
    </div>
    <div class="hd_up">
        <a href="upload_video.php" class="sub">
            Upload
        </a>
        
    </div>
</nav>