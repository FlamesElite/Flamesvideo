
<!-- saved from url=(0035)https://vyinx.com/example/login.php -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>FlamesVideo - Your Digital Video Repository</title>

<link href="./Vynix - Your Digital Video Repository2_files/styles.css" rel="stylesheet" type="text/css">
<link rel="alternate" type="application/rss+xml" title="Flamesvideo " "="" recently="" added="" videos="" [rss]"="" href="https://vyinx.com/example/static/rss/global/recently_added.rss">
</head>

<body>
<!-- Header -->
<?php
    session_start();
    include("header.php");
?>

<!-- Start of main -->

<div class="pageTitle">Log In</div>

<table width="80%" align="center" cellpadding="5" cellspacing="0" border="0">
	<tbody><tr valign="top">
		<td>
		<span class="highlight">What is Flamesvideo?</span>
		
		<br><br>
		
		Flamesvideo is a way to get your videos to the people who matter to you. With VidBit you can:
		
		<ul>
		<li> Show off your favorite videos to the world
		</li><li> Blog the videos you take with your digital camera or cell phone
		</li><li> Securely and privately show videos to your friends and family around the world
		</li><li> ... and much, much more!
		</li></ul>
		
		<br><span class="highlight"><a href="signup.php">Sign up now</a> and open a free account.</span>
		
		<br><br><br>
		
		To learn more about our service, please see our <a href="help.php">Help</a> section.<br><br><br>
		</td>
		<td width="20"><img src="./Vynix - Your Digital Video Repository2_files/pixel.gif" width="20" height="1"></td>
		<td width="300">
		
		<div style="background-color: #D5E5F5; padding: 10px; padding-top: 5px; border: 6px double #FFFFFF;">
		<table width="100%" bgcolor="#D5E5F5" cellpadding="5" cellspacing="0" border="0">
			<form method="post" action="processLogin.php">
			<input type="hidden" name="field_command" value="login_submit">
				<tbody><tr>
					<td align="center" colspan="2"><div style="font-size: 14px; font-weight: bold; color:#003366; margin-bottom: 5px;">VidBit Log In</div></td>
				</tr>
				<tr>
					<td align="right"><span class="label">User Name:</span></td>
					<td><input type="text" size="20" name="userName" value=""></td>
				</tr>
				<tr>
					<td align="right"><span class="label">Password:</span></td>
					<td><input type="password" size="20" name="userPass"></td>
				</tr>
				<tr>
					<td align="right"><span class="label">&nbsp;</span></td>
					<td><button type="submit">Log in</button></td>
				</tr>
				<tr>
					<td align="center" colspan="2"><a href="forgot_password.php">Forgot your password?</a></td>
				</tr>
			
			</tbody></form></table>
			
		</div></td>
	</tr>
</tbody></table>
	
<?php
    include("footer.php");
?>

</body></html>