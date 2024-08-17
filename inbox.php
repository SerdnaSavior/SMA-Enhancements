<!doctype html>
<html>
<head>
<link rel='stylesheet' href='body.css'>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Student's Hangout </title>
	<script src='jquery.js'></script>

</head>
<body>
		<button class="openbtn" onclick="openNav()">&#8652; </button>
			
			<div id="main">
				<table cellpadding='3' cellspacing='3' >
					<!--Logo-->
					<img src='images/logo.png' height='10%' width='100%' > <!--1350x160-->
					<br>
					<br>
												
			

				
			
			<?php
			Session_start();
			if(IsSet($_SESSION["user_id"])) {
				$id=$_SESSION["user_id"];
				$query="select * from messages where receiver_id=".$id." order by id desc";
				$resid=MySQLi_Connect('localhost','acontr12','acontr12','acontr12');
				
				if(MySQLi_Connect_Errno()) {
					echo "<tr align='center'> <td colspan='5'> Failed to connect to MySQL </td> </tr>";
				}
				else {
				$result=MySQLi_Query($resid,$query);
				$data=MySQLi_Fetch_Row($result);
				if($data) {
				$query="select name,email from students where id=".$data[1]."";
				$sender=MySQLi_Query($resid,$query);
				$sender=MySQLi_Fetch_Row($sender);
				//if($data) {
				 
				echo "<tr align='center'> <td colspan='5'> <table cellpadding='4' cellspacing='5' width='100%' style='table-layout:fixed'> <col width='100%'> ";
				echo "<td>From:- <font color='blue'>".$sender[0]." </font> [".$sender[1]."] </td> </tr>";
				echo "<tr> <td style='word-wrap:break-word'>Message:-".$data[3]."</td> </tr>";
				echo "</table> </td> </tr>";
				
			}
				else {
				echo "<tr align='center'> <td colspan='5'> <font color='lightblue'> No Messages! </font> </td> </tr>";
				}
				MySQLi_Close($resid);
				}
			}
			else {
				echo "<tr align='center'> <td colspan='5'> <font color='red'> Sorry, You not Logged in! </font> Login again:- <a href='login.php'>Login</a> </td> </tr>";

			}
			
			?>
		</table>
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
		
		
