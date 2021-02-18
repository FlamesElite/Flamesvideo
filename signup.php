<!-- saved from url=(0035)https://vyinx.com/example/login.php -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>VidBit - Your Digital Video Repository</title>

<link href="./Vynix - Your Digital Video Repository2_files/styles.css" rel="stylesheet" type="text/css">
<link rel="alternate" type="application/rss+xml" title="Vynix " "="" recently="" added="" videos="" [rss]"="" href="https://vyinx.com/example/static/rss/global/recently_added.rss">
</head>

<body>
<!-- Header -->
<?php
    session_start();
    include("header.php");
?>

<div class="formTitle">Sign Up</div>
				
<div class="formTable">
					
<div class="formIntro">Please enter your account information below. All fields are required.</div>

			<table width="720" cellpadding="5" cellspacing="0" border="0">
			<form method="post" action="processSignup.php">
			<input type="hidden" name="field_command" value="signup_submit">
			
				<tbody><tr>
					<td width="200" align="right"><span class="label">Email Address:</span></td>
					<td><input type="text" size="30" maxlength="60" name="email" value=""></td>
				</tr>
				<tr>
					<td align="right"><span class="label">User Name:</span></td>
					<td><input type="text" size="20" maxlength="20" name="userName" value=""></td>
				</tr>
				<tr>
					<td align="right"><span class="label">Password:</span></td>
					<td><input type="password" size="20" maxlength="20" name="userPass" value=""></td>
				</tr>
				<tr>
					<td align="right"><span class="label">Retype Password:</span></td>
					<td><input type="password" size="20" maxlength="20" name="confirmUserPass" value=""></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><br>- I certify I am over 13 years old.
					<br>- I agree to the <a href="tos.html" target="_blank">terms of use</a> and <a href="privacy.php" target="_blank">privacy policy</a>.</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><button type="submit">Sign Up</button></td>
				</tr>
				
				<tr>
					<td>&nbsp;</td>
					<td><br>Or, <a href="index.php">return to the homepage</a>.</td>
				</tr>
			</tbody></form></table>
		</div>

<?php
    include("footer.php");
?>

</body></html>