<?php
			Session_start();
			if(IsSet($_SESSION["user_id"])) {
			
			
			?>
			
			
			<?php
				
				if($_SERVER["REQUEST_METHOD"]=="POST") {
				$email=$text="";
				function sec($data) {
					$data=trim($data);
					$data=stripslashes($data);
					$data=htmlspecialchars($data);
					return $data;
				}
				$email=sec($_POST["n1"]);
				$text=sec($_POST["t1"]);
				$resid=MySQLi_Connect('localhost','acontr12','acontr12','acontr12');
					if(MySQLi_Connect_Errno()) {
						echo "<tr align='center'> <td colspan='5'> Failed to connect to MySQL </td> </tr>";
					}
					else {
						$count=MySQLi_Query($resid,"select id from students where email='".$email."'");
						$count_id=MySQLi_Fetch_Assoc($count);
						if($count_id) {
						$receiver=$count_id["id"];
						$sender=$_SESSION["user_id"];
						
						$count=MySQLi_Query($resid,"select (max(id)+1) as count  from messages");
						$count_id=MySQLi_Fetch_Assoc($count);
						
						if($count_id["count"]) {
						$query="insert into messages values (".$count_id["count"].",".$sender.",".$receiver.",'$text')";
						}
						else {
						$query="insert into messages values (1,".$sender.",".$receiver.",'$text')";
						}
						
						$res=MySQLi_Query($resid,$query);
						
						
						
						
						
						}
						
						MySQLi_Close($resid);
					}
			
			}
			?>
			
			<?php }
			else {
				echo "<tr align='center'> <td colspan='5'> <font color='red'> Sorry, You not Logged in! </font> Login again:- <a href='login.php'>Login</a> </td> </tr>";
			}
			?>
<!doctype html>
<html>
<head>
<link rel='stylesheet' href='body.css'>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Student's Hangout </title>
	
		<script src='jquery.js'></script>
	<script type='text/javascript'>
		function sec() {
			var f_email=document.f1.n1.value;
			var f_message=document.f1.t1.value;
			f_message = f_message.trim();
			
			if(f_email.length==0) {
		s1.innerHTML="<font color='red'>Field is Required</font>";
			}
			else if(f_message.length==0) {
		s1.innerHTML="<font color='red'>Please add some message</font>";
			}
			
		else if(f_email.length>50||f_message.length>500) {
			if(f_email.length>50) {
			s2.innerHTML="<font color='red'>Characters should be less than 50 </font>";
			}
			
			if(f_message.length>500) {
			s3.innerHTML="<font color='red'>Characters should be less than 500 </font>";
			}
			
		}
			
			else {
				document.f1.submit();
			}
		}
		
		$(document).ready(function() 
		{
			$("#sam").hide(2000);
		});
		
	</script>
	
</head>
<body>

							
						<script type="text/javascript" src="notify.js"></script>
						<script>
						
						if(<?php echo $res?>) {
						$(document).ready(function() {
						  $.notify(
						  "Message Sent!","success");
						});
					}
						
						</script>
							
						


<button class="openbtn" onclick="openNav()">&#8652; </button>
			
			<div id="main">
					<!--Logo-->
					<img src='images/logo.png' height='10%' width='100%' > <!--1350x160-->
					<br>
					<br>
					<table>
						<tr align='center'> 
				<td colspan='5'>
					<form method='POST' name='f1' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
						<table>
							<tr>
								<td> Friend's Email:- </td> <td> <input type='email' name='n1' maxlength='50'> </td> <td> <span id='s1'> </span> </td> <td> <span id='s2'> </span> </td>
							</tr>
							<tr>
								<td> Message:- </td> <td> <textarea rows='5' cols='22' maxlength='500' name='t1'> </textarea> </td> <td> <span id='s3'> </span> </td> <td> <span id='s4'> </span> </td>
							</tr>
							
							<tr>
								<td> <br> <input type='button' value='Send' onclick='sec()'> </td>
							</tr>
							
						</table>
					</form>
				</td>
			</tr>
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
