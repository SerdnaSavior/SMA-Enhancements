<!doctype html>
<html>
<head>
<link rel='stylesheet' href='body.css'>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Student's Hangout </title>
	
	<script src='jquery.js'></script>
	<script type='text/javascript'>
	
		function sec() {
			var stat=document.f1.status.value;
			stat = stat.trim();

			if(stat.length==0) {
				check.innerHTML="<font color='red'> Field is Required </font>";
			}
			else if(stat.length>300) {
				check.innerHTML="<font color='red'> Maximum 300 Characters!</font>";
			
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
<button class="openbtn" onclick="openNav()">&#8652; </button>
<div id="main">

					<!--Logo-->
					<img src='images/logo.png' height='10%' width='100%' > <!--1350x160-->
					<br>
					<br>
	<?php
			Session_start();
			if(IsSet($_SESSION["user_id"])) {
			?>

<tr align='center'> 
	<td colspan='5'> 
		<form name='f1' method='POST' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>'>
			<table>
				<tr>
					<td> Update your Status:- </td> <td> <textarea rols='20' cols='45' maxlength='300' name='status'> </textarea> </td> <td> (MAX 300 Characters) </td>
				</tr>
				<tr>
					<td colspan='2'> <input type='button' value='Update' onclick='sec()' > </td> <td> <span id='check'> </span> </td>
				</tr>
			</table>  
		</form>
	</td> 
</tr>
		<!-- Updating status -->
		<?php
		
		if($_SERVER["REQUEST_METHOD"]=="POST") {
		$status = $_POST["status"];
		//$status = trim("$_POST['status']");
		//$status = stripslashes("$_POST['status']");
		//$status = htmlspecialchars("$_POST['status']");
	
		include 'mysql.php';
		
		if($resid) {
		$user_id = $_SESSION['user_id'];
		$query = "insert into status_here (status,user_id,timestamp,future_use) values ('$status',$user_id,NOW(),NULL)";
		$qwer = MySQLi_Query($resid,$query);
		if($qwer) {
			?>
			<script type="text/javascript" src="notify.js"></script>
			<script>
			$(document).ready(function() {
			  $.notify(
			  "Status Updated!","success");
			});
			</script>
			<?php
		}
		else {
			echo "<tr align='center'> <td colspan='5'> <font color='green'> Sorry, Something went wrong! Refresh the page and try again! </font> </td> </tr>";
		}
		MySQLi_Close($resid);
			}
		}
		?>
		
		<?php
		
		if($_SESSION['user_id']) {
			$user_id = $_SESSION['user_id'];
			include 'mysql.php';
				//Displaying past statuses
			if($resid) {
				$query1 = "select status,time_format(timestamp,'%l:%i:%s %p') as time,date_format(timestamp,'%D of %M,%Y') as date from status_here where user_id = $user_id order by id desc";
				$result = MySQLi_Query($resid,$query1);
				$f=1;
				while(($rows=MySQLi_Fetch_Row($result))==True) {
				$f++;
				if($f==2) {
				echo "<tr align='center'> <td colspan='5'>Your statuses till now:-</td> </tr> <tr align='center'> <td colspan='5'><table align='center' align='center' cellspacing='5' cellpadding='5' width='100%' style='table-layout:fixed'> <col style='width:25%'> <col style='width:25%'>  <col style='width:25%'>";
				
				echo "<thead> <tr> <th> Status: </th> <th> Updated on: </th> <th> Time: </th> </tr> </thead>";
				}
				echo " <tbody> <tr align='center' style='border-bottom:1pt solid black'>";
				echo "<td style='word-wrap:break-word'> $rows[0] </td> <td> $rows[2] </td> <td> $rows[1] </td>";
				echo "</tr> </tbody>";
				}
				
				echo "</table>";
			}
			MySQLi_Close($resid);
		}
		
		?>
		
<?php }
			else {
				echo "<tr align='center'> <td colspan='5'> <font color='red'> Sorry, You not Logged in! </font> Login again:- <a href='login.php'>Login</a> </td> </tr>";
			}
			?>				
												
			

				<script src="sidebar.js"></script>
				<div  id='mySidebar' class='sidebar'>
					<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
					<?php /*Session_start()*/; if(IsSet($_SESSION["user_id"])) {echo "<a href='user_page.php'>"; } else {echo "<a href='home.php'>";}?>Home </a>
					<a href='send_message.php'>Send Message </a>
					<a href='inbox.php'>Inbox (Only Recent Message) </a>
					<a href='view_profile.php'>View Profile </a>
					<a href='signout.php'>Signout </a>	
				</div>	
			</div>
			
				
		</table>
			<footer align='center'>
			&copy; 2019 Abhishek Nagekar All rights Reserved.<br>
			https://github.com/abhn/simple-php-mysql-project?tab=MIT-1-ov-file
	
			</footer>
</body>
</html>		
		
		




