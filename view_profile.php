<?php
			Session_start();
			if(IsSet($_SESSION["user_id"])) {

						$profile = "<img class='profile' src=".$_SESSION["picture"]."><br><br>Name: ".$_SESSION["name"]." <br><br>
						Email: ".$_SESSION["email"]." <br><br>
						Gender: ".$_SESSION["gender"]."<br><br>
						Age: ".$_SESSION["age"]."<br><br>
						Password: ".$_SESSION["password"]."";
								
					}
			else {
				$nologin= "<font color='red'> Sorry, You not Logged in! </font> Login again:- <a href='login.php'>Login</a> ";
			}
			
			?>
<!doctype html>
<html>
<head>
<link rel='stylesheet' href='body.css'>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Student's Hangout </title>
</head>
<body>
<button class="openbtn" onclick="openNav()">&#8652; </button>
			
			<div id="main">
					<!--Logo-->
					<img src='images/logo.png' height='10%' width='100%' > <!--1350x160-->
					<br>
					<br>
					
					
					
					<div><?php echo $profile?> </div>	
					<form action="upload_picture.php" method="post" enctype="multipart/form-data">
						<input  type="file" id="fileToUpload" name="fileToUpload">
						<input  type="submit" value="Upload Image" name="submit">
					</form><br>
					<h3>OR</h3><br>
					<form action="upload_picture.php" method="post">
					<button class='avabut' type="submit" name="a1"> <img class='avatar' src="images/anon.png"  alt="Submit" width="48" height="48">
					<button class='avabut' type="submit" name="a2"> <img class='avatar' src="images/emoji.png"  alt= "Submit" width="48" height="48">
					<button class='avabut' type="submit" name="a3"> <img class='avatar' src="images/logo.png" alt= "Submit" width="48" height="48">
					<button class='avabut' type="submit" name="a4"> <img class='avatar' src="images/tophat.png"  alt="Submit" width="48" height="48">
					<button class='avabut' type="submit" name="a5"> <img class='avatar' src="images/profile.png"  alt= "Submit" width="48" height="48">
					</form>
					
					<div><?php echo $nologin?> </div>								
			

				<script src="sidebar.js"></script>
				<div  id='mySidebar' class='sidebar'>
					<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
					<?php /*Session_start();*/ if(IsSet($_SESSION["user_id"])) {echo "<a href='user_page.php'>"; } else {echo "<a href='home.php'>";}?>Home </a>
					<a href='send_message.php'>Send Message </a>
					<a href='inbox.php'>Inbox (Only Recent Message) </a>
					<a href='view_profile.php'>View Profile </a>
					<a href='signout.php'>Signout </a>	
				</div>	
			</div>
			
			
			<div id="footer">
			
			<?php if(isset($_SESSION["user_id"])) {echo $_SESSION["name"]; } ?>
			<h3>&copy; 2019 Abhishek Nagekar All rights Reserved.<br>
			https://github.com/abhn/simple-php-mysql-project?tab=MIT-1-ov-file
			</h3>	
			
		</div>	
</body>
</html>
