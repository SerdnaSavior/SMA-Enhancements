<?php

Session_start();
$y = $_SESSION['nameList'];


			if(IsSet($_SESSION["user_id"])) {
				
					
					$id=$_SESSION["user_id"];
					$query="select friend_name,friend_id from friends where receiver_id=".$id." and status=0 and comp=0";
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
							$freindReqT = "Friend Requests: <br>";
							}
							$freindReq = "".$rows[0].", wants to be your friend! <form method='POST' action='access.php'>
							<input type='hidden' name='header1' value='".$rows[1]."'>
							<input type='submit' name='accp' value='Accept'> &nbsp;&nbsp;&nbsp; <input type='submit' name='decl' value='Decline'>
							</form>";
							
							}

							
						}	
						
						if($f<2)
						{
							$noFriend =  "<font color='lightblue'> No Friend Requests!</font> ";
						}
						
						MySQLi_Close($resid);	
					}
				
			
		}
			else {
				$nologin = " <font color='red'> Sorry, You not Logged in! </font> Login again: <a href='login.php'>Login</a>";
			}
			?>


<!doctype html>
<html>
<head>
<link rel='stylesheet' href='body.css'>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Student's Hangout </title>
	<script type='text/javascript'>
		function sec() {
			var f_search=document.f1.search.value;
			if(f_search==0) {
				s1.innerHTML="<font color='red'>Field is Required</font>";
			}
			
			else if(f_search>50) {
				s2.innerHTML="<font color='red'>Characters should be less than 50 </font>";
			}
			
			else {
				document.f1.submit();
			}
			
		}
		</script>
</head>
<body>
<button class="openbtn" onclick="openNav()">&#8652; </button>
			
			<div id="main">
					<!--Logo-->
					<img src='images/logo.png' height='10%' width='100%' > <!--1350x160-->
					<br>
					<br>

					<div class="forms">
						<form autocomplete='off' method='POST' name='f1' action='search_friends.php'>
							<div class="autocomplete">					
							Search Friend:  <input id="myInput" type='text' name='search' maxlength='50'>  <span id='s1'> </span> <span id='s2'> </span> 
							<br> <input type='button' value='Search' onclick='sec()'>		
							</div>
						</form>
						<!-- Embedding PHP array as JSON in a hidden input -->
						<input type="hidden" id="y" value="<?php echo htmlspecialchars(json_encode($y)); ?>">
						<script src='autocomplete.js'></script>
						
						<script>
						var names = JSON.parse(document.getElementById('y').value);
						autocomplete(document.getElementById("myInput"), names);
						</script>
					</div>
					<div><?php echo $freindReqT?> </div>		
					<div><?php echo $freindReq?> </div>	
					<div><?php echo $noFriend?> </div>	
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

