<?php
			Session_start();
			$email=$password=$no_msg="";
			
			if(!isset($_SESSION['user_id']) && !isset($_POST['h1'])) {
			 Header("Location: home.php");
			}
			

			if(isset($_SESSION['user_id'])) {
				$_POST['h1'] = "holla";
				$_POST['e1'] = $_SESSION['email'];
				$_POST['p1'] = $_SESSION['password'];
				$no_msg = 1;
			}

		function sec($data) {
		$data=trim($data);
		$data=stripslashes($data);
		$data=htmlspecialchars($data);
		return $data;
	}
			if($_POST['h1']=="holla") {
			$email=sec($_POST["e1"]);
		    $password=$_POST["p1"];
			}
			$query="select * from students where email='$email' and password='$password'";
			$query2="select name from students";
			$resid=MySQLi_Connect('localhost','acontr12','acontr12','acontr12');
			if(MySQLi_Connect_Errno()) {
				
			}
			else {
				$result=MySQLi_Query($resid,$query);
				$result2=MySQLi_Query($resid,$query2);
				$friends = [];
				if (mysqli_num_rows($result2) > 0) {
					// output data of each row
					while($row = mysqli_fetch_assoc($result2)) {
						 array_push($friends,$row['name']);
				
					}
				}
				$_SESSION['nameList'] =$friends;


				
				$array=MySQLi_Fetch_Assoc($result);
					if($array) {
						//Session_start();
						$_SESSION["user_id"] = $array["id"]; 
						$user_here = $_SESSION["user_id"];
						$_SESSION["name"] = $array["name"];
						$_SESSION["password"] = $array["password"];
						$_SESSION["age"]  = $array["AGE"];
						$_SESSION["email"] = $array["email"];
						$_SESSION["gender"] = $array["gender"];
						$_SESSION["picture"] = $array["picture"];
						
						$options = "<a href='friends.php'>Friends </a><br><br>								
									 <a href='update_status.php'> Status Update </a><br><br>								
									 <a href='friend_list.php'>Friend List</a>";
				
						$update = " <h3> Updates from your Friends: </h3> ";
				
						$count = MySQLi_Query($resid,"select frnd_two_id from are_friends where frnd_one_id = $user_here union select frnd_one_id from are_friends where frnd_two_id = $user_here");
						if($count) {
						$f=1;
						while(($rows=MySQLi_Fetch_Row($count))==True) {
							$f=2;
							$query = "select status,time_format(timestamp,'%l:%i:%s %p') as time,date_format(timestamp,'%D of %M,%Y') as date from status_here where user_id = $rows[0] order by id desc";
							$queryx = "select name from students where id = $rows[0]";
							$queryx2 = "select picture from students where id = $rows[0]";
							$result = MySQLi_Query($resid,$query);
							$result1 = MySQLi_Query($resid,$queryx);
							$resultx2 = MySQLi_Query($resid,$queryx2);
							$name_here = MySQLi_Fetch_Row($result1);
							$picture_here = MySQLi_Fetch_Row($resultx2);
							if($result) {

										while(($rows1=MySQLi_Fetch_Row($result))==True) {
											$img = "<img class='statuspic' src=$picture_here[0]>";
											$postName = " <font style='color:blue'>$name_here[0]: </font> ";
											$postC = "  $rows1[0] ";
											$postD = " (On $rows1[2] at $rows1[1]) ";
											
										}								
							}							
						}
						if($f==1) {
							$nofreinds =" <i> Sorry, you don't have friends yet! </i> ";
						}
												
					}
													
						
					}
					else {
						$loginFailed = " <font color='red'> Login Failed! </font> Make sure you input your email and password correctly and login again: <a href='login.php'>Login</a> ";
					}
			MySQLi_Close($resid);
			}
		
		?>
		
<!DOCTYPE html>
<html>
<head>
	<link rel='stylesheet' href='body.css'>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Student's Hangout </title>

	
	
	<script src='jquery.js'></script>
	<script type='text/javascript'>
	$(document).ready(function() 
	{
		$("#sam").hide(2000);
	});
	</script>
</head>
<body>
	<script type="text/javascript" src="notify.js"></script>
	<script>
	if (<?php echo $no_msg != 1?>){		
		$(document).ready(function() {
			$.notify(
			"Login Successful!","success");
		});
	}
		
	</script>

		<button class="openbtn" onclick="openNav()">&#8652; </button>
			<div  id='userPage'>
					
					<!--Logo-->
					<img src='images/logo.png' height='10%' width='100%' > <!--1350x160-->
					<br>

					<div class="options"><?php echo $options ?> </div>
					<div > <?php echo $update?><br>	
					<?php echo $img?>
					 <?php echo $postName ?>		
					 <?php echo $postC ?>
					 <br><br><?php echo $postD ?></div>
					 <div><?php echo $nofreinds ?></div>
					<div><?php echo $loginFailed ?></div>					
			</div>

				<script src="sidebar.js"></script>
				<div  id='mySidebar' class='sidebar'>
					<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
					<?php /*Session_start();*/ if(IsSet($_SESSION["user_id"])) {echo "<a href='user_page.php'>"; } else {echo "<a href='home.php'>";}?>Home </a>
					<a href='send_message.php'>Send Message </a>
					<a href='inbox.php'>Inbox (Only Recent Message) </a>
					<a href='view_profile.php'>View Profile </a>
					<a href='signout.php'>Signout </a>	
				</div>	

		<div id="footer">
			
			<?php if(isset($_SESSION["user_id"])) {echo $_SESSION["name"]; } ?>
			<h3>&copy; 2019 Abhishek Nagekar All rights Reserved.<br>
			https://github.com/abhn/simple-php-mysql-project?tab=MIT-1-ov-file
			</h3>	
			
		</div>	
</body>
</html>
