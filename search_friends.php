
			
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
				if(IsSet($_SESSION["user_id"])) {
				if(IsSet($_POST["search"])) {
					$name=$_POST["search"];
					$query="select * from students where name like '%".$name."%' or email like '%".$name."%'";
					
					
					//MySQL++
						
					$resid=MySQLi_Connect('localhost','acontr12','acontr12','acontr12');
				
					if(MySQLi_Connect_Errno()) {
						echo "<tr align='center'> <td colspan='5'> Failed to connect to MySQL </td> </tr>";
					}
					else {
						$result=MySQLi_Query($resid,$query);
						if($result==true) {
							$f=1;
							while(($rows=MySQLi_Fetch_Row($result))==True) {
							$f++;
							if($f==2) {
							echo "<tr align='center'> <td colspan='5'>Search Results:-</td> </tr> <tr align='center'> <td colspan='5'><table class='tableL' align='center' >";
							}
							//START:- Exclude if already request is sent;
							$query4="select status, comp from friends where id=(select max(id) from friends where receiver_id=".$rows[0]." and friend_id=".$_SESSION["user_id"].")"; 
							$result4=MySQLi_Query($resid,$query4);
							if($result4==true) {
								$res4=MySQLi_Fetch_Row($result4);
							}
							
							if($res4[0]==NULL AND $res4[1]==NULL) {
								$flo=0;
							}
							else if($res4[0]==0 AND $res4[1]==0){  
								$flo=1;
							}
							else {
								$flo=2;
							}
							
							
							//START:- Exclude those who are engaged and self;
							$query2="select status from are_friends where frnd_one_id=".$_SESSION["user_id"]." and frnd_two_id=".$rows[0]."";
							$query3="select status from are_friends where frnd_one_id=".$rows[0]." and frnd_two_id=".$_SESSION["user_id"]."";
							
							$result2=MySQLi_Query($resid,$query2);
							$result3=MySQLi_Query($resid,$query3);
							
							if($result2==true) {
								$res2=MySQLi_Fetch_Row($result2);
							} 
							if($result3==true) {
								$res3=MySQLi_Fetch_Row($result3);
							}
							
							if($rows[0]==$_SESSION["user_id"]) {$flori=1;} else {$flori=2;}  
							
							if($res2[0]==1 OR $res3[0]==1 OR $flo==1 OR $flori==1) {
							
							}
							else {
							echo "<tr align='right'> <td align='right'>".$rows[1]."</td> <td align='center'> <form method='POST' action='sendfr.php'>
							<input type='hidden' name='h1' value='".$rows[0]."'>
							<input type='hidden' name='h2' value='".$rows[1]."'>
							<input type='submit' name='sfr' value='Send Request'>
							</form></td> </tr>";
												
							}

							
							}
							
							}
							
							echo "</table></td></tr>";
							
							
						}	
						
						if($f<2)
						{
							echo "<tr align='center'> <td colspan='5'><font color='lightblue'> No such Friends!</font> </td> </tr>";
						}
						
						MySQLi_Close($resid);	
					}
					
					//MySQL++
					
				}
				
			else {
				echo "<tr align='center'> <td colspan='5'> <font color='red'> Sorry, You not Logged in! </font> Login again:- <a href='login.php'>Login</a> </td> </tr>";

			}
			
			?>		
													
			

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
