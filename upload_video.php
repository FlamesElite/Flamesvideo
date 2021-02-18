<title> Vidbit - Display Yourself</title>

<html>
<body>

<div class="Header">
</div>
 
<?php
session_start();
include 'header.php';

if ($_SESSION['userName'] == null)
{
    die('You need to be signed in to upload videos.<br />
        <a href="signup.php">Sign up</a><br />
        <a href="index.php">Back to home page</a><br />');
}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>VidBit - Upload</title>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link href="static/css/styles.css" rel="stylesheet" type="text/css">
<link rel="alternate" type="application/rss+xml" title="Vidbit " " recently added videos [rss]" href="rss/global/recently_added.rss">
</head>

<body onload="javascript:sf();" return false;>
<table align="center" width="60%" bgcolor="#D5E5F5" cellpadding="0" cellspacing="0" border="0">

		
</table></div>

	<?php
if (isset($_POST['upload_video']))
{
    include ("db_credentials.php");

    $videoName = $_POST['videoTitle'];
    $videoDescription = $_POST['videoDescription'];
    $videoTags = $_POST['videoTags'];

    $videoName = addslashes($videoName);
    $videoDescription = addslashes($videoDescription);
    $videoTags = addslashes($videoTags);

    $videoTags = str_replace(",", ":", $videoTags); //replace commas w/ colons for storing in database
    $videoTags = str_replace(" ", "", $videoTags); //remove spacing
    $filePath = $_FILES["videoFile"]["name"];
    $pathParts = pathinfo($filePath);

    $fileName = $pathParts["filename"];
    $videoExt = $pathParts["extension"];

    $category = $_POST['category'];

    $userId = $_SESSION['userId'];

    // videos...
    $videos_dir = "videos/uploaded/";
    $videoFile = $videos_dir . $fileName . "." . $videoExt;

    //upload the thumbnail, if one was supplied
    $thumbnailPath = $_FILES["videoThumbnail"]["name"];
    $thumbPathParts = pathinfo($thumbnailPath);

    $thumbnails_dir = "images/thumbnails/";
    $target_thumb_file = $thumbnails_dir . basename($_FILES["videoThumbnail"]["name"]);
    $upload_ok = 1;

    $check = getimagesize($_FILES["videoThumbnail"]["tmp_name"]);
    if ($check !== false)
    {
        $upload_ok = 1;
    }
    else
    {
        $upload_ok = 0;
    }

    if ($upload_ok != 0)
    {
        if (move_uploaded_file($_FILES["videoThumbnail"]["tmp_name"], $target_thumb_file))
        {
            echo "Thumbnail successfully uploaded. <br/>";
        }
    }
    //else, take 1st frame of uploaded video and use that as thumbnail
    else
    {
        $auto_generate_thumbnail = True;
    }

    $query_existing_videos = "SELECT * FROM Videos";
    $result = $conn->query($query_existing_videos);

    $all_video_ids = array();

    $latest_id = 0;
    $query_latest_video = "SELECT * FROM Videos ORDER BY video_id DESC LIMIT 1";
    $result = $conn->query($query_latest_video);
    if ($result->num_rows === 1)
    {
        while ($row = $result->fetch_assoc())
        {
            $latest_id = $row['video_id'];
        }
    }

    echo ('<br />');

    if (move_uploaded_file($_FILES['videoFile']['tmp_name'], $videoFile)) {
        $videoName = str_replace("'", "''", $videoName);
        $videoDescription = str_replace("'", "''", $videoDescription);
        $videoTags = str_replace("'", "''", $videoTags);
        $fileName = str_replace("'", "''", $fileName);
        $videoFile = str_replace("'", "''", $videoFile);
        $thumbnailPath = str_replace("'", "''", $thumbnailPath);
        
        $date_now = gmdate("Y-m-d"); // <-- greenwich mean time for now
        
        $duration = 0; // <-- for now, will want to work on a solution for this
        
        // add the video to DB
        $query_add_video = "INSERT INTO Videos (video_id, video_name, video_description, video_tags, views, file_name, 
					video_extension, video_file, date_uploaded, uploader, category, thumbnail, deleted, duration)
					VALUES (" . ($latest_id + 1) . ", '$videoName', '$videoDescription', '$videoTags', 0, '$fileName', 
					'$videoExt', '$videoFile', '$date_now', '$userId', '$category', '$thumbnailPath', 0, $duration)";

        echo ($query_add_video);

        if ($conn->query($query_add_video) === true)
        {
            echo "Video successfully uploaded.";
        }
        else
        {
            echo "Error uploading video.";
        }
    }

    //require("index.php");
    
}
?>
	
<div class="uploadWindow">
		<div class="leftSide">
			<form class="form-upload" method='POST' enctype="multipart/form-data">
				<div class="uploader" style="width: 60%; margin: auto;">
				    <div class="heading">
				        <b>Upload Video</b>
				        <br />
			        </div>
			        <br />
                                    <table>
                                    <tr>
                                        <td><label><strong>Video file to upload</strong></label></td>
                                    </tr>
                                    <tr>
                                        <td><input class="form-control" type="file" name="videoFile" accept="video/*" required/></td>
                                    </tr>					
                                    <tr>
                                        <td><label><strong>Title</strong></label></td>
                                    </tr>
                                    <tr>
                                        <td><input class="form-control" type="text" name="videoTitle" required/></td>
                                    </tr>
                                    <tr>
                                        <td><label><strong>Description</strong></label></td>
                                    </tr>
                                    <tr>
                                        <td><textarea class="form-control" rows="6" cols="50" name="videoDescription"></textarea></td>						
                                    </tr>
                                    <tr>
                                        <td><label><strong>Category</strong></label></td>
                                    </tr>
                                    <tr>
                                        <td>
                                        <select class="form-control" name="category">
                                            <option value="">- select a category -</option>
                                            <option value="Howto & Style">Howto & Style</option>
                                            <option value="Pets & Animals">Pets & Animals</option>
                                            <option value="Travel">Travel</option>
                                            <option value="Education">Education</option>
                                            <option value="Nonprofits & Activism">Nonprofits & Activism</option>
                                            <option value="Entertainment">Entertainment</option>
                                            <option value="Film">Film</option>
                                            <option value="Comedy">Comedy</option>
                                            <option value="Science">Science</option>
                                            <option value="News">News</option>
                                            <option value="Music">Music</option>
                                            <option value="Gaming">Gaming</option>
                                            <option value="Autos & Vehicles">Autos & Vehicles</option>
                                            <option value="Technology">Technology</option>
                                            <option value="Sports">Sports</option>
                                        </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label><strong>Tags</strong></label></td>
                                    </tr>
                                    <tr>
                                        <td><textarea class="form-control" rows="6" cols="50" name="videoTags" placeholder=
                                        "Write your tags as a comma-separated list; e.g. keyboard, cat, video, original"></textarea></td>						
                                    </tr>
                                    <tr>
                                        <td><label><strong>Thumbnail</strong></label></td>
                                    </tr>
                                    <tr>
                                        <td><input class="form-control" type="file" name="videoThumbnail" accept="image/*" /></td>					
                                    </tr>
                                    <tr>
                                        <td><p style="font-size: 12px; font-style: italic;">Thumbnails should have a 16:9 aspect ratio,
                                        as any and all thumbnails uploaded to VidBit will be stretched to fit a 16:9 ratio and some 
                                        thumbnails may end up looking awkward as a result.</p></td>
                                    </tr>
                                    </table>
                                
                                <br />
                                <input type="submit" name="upload_video" value="Upload" />
                                <br />
                                <div class="heading">
                                    <br />
                                    <b>About uploading</b>
                                </div>
                                This is the page where you upload videos to VidBit.
                            </form>
                        </div>
                    </div>
                </div>
<br><table bgcolor="#FFFFFF" align="center" cellpadding="10" border="0">
	<tr>
		<td align="center" valign="center"><span class="footer"><a href="whats_new.php">What's New</a> | <a href="about.php">About Us</a> | <a href="help.php">Help</a> | <a href="terms.php">Terms of Use</a> | <a href="privacy.php">Privacy Policy</a> | Copyright &copy; 2020 Vidbit&#8482; | <a href="rss/global/recently_added.rss"><img src="static/img/rss.gif" width="36" height="14" border="0" style="vertical-align: text-top;"></a></span></td>
	</tr>
</table>

</body>
</html>

</body>
</html>
