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
				
<?php
Session_start();
	$user_id = $_SESSION["user_id"];
	include 'mysql.php';
	if($resid) {
	
	
	$count = MySQLi_Query($resid,"select frnd_two_id from are_friends where frnd_one_id = $user_id union select frnd_one_id from are_friends where frnd_two_id = $user_id");
	
	echo "<table class='tableL' align='center' cellspacing='5' cellpadding='5'>
			<tr align='center'> <td colspan='5'>Your Friends:- </td> </tr> <tr align='center'> <td colspan='5'>";
	
	echo "<tr align='center'> <th> Name: </th> <th> Email: </th> <th> Gender: </th> </tr>";
				
	while(($rows=MySQLi_Fetch_Row($count))==True) {

	$query = "select name,email,gender from students where id = $rows[0] ";
	$result = MySQLi_Query($resid,$query);

	if($result) {

				while(($rows=MySQLi_Fetch_Row($result))==True) {



				echo "<tr align='center'>";
				echo "<td> $rows[0] </td> <td> $rows[1] </td> <td> $rows[2] </td>";
				echo "</tr>";
				}
				
		}
	}
	
	echo "</table> ";
}
	
	
?>	
						
			

				<script src="sidebar.js"></script>
				<div  id='mySidebar' class='sidebar'>
					<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
					<?php  if(IsSet($_SESSION["user_id"])) {echo "<a href='user_page.php'>"; } else {echo "<a href='home.php'>";}?>Home </a>
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
