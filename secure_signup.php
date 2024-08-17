

<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel='stylesheet' href='body.css'>
	<title> Student's Hangout </title>
	<script type='text/javascript'>
		function sec() {
			var name=document.f1.n1.value;
			var email=document.f1.e1.value;
			var age=document.f1.a1.value;
			var password=document.f1.p1.value;
			
			
			if(name.length==0||email.length==0||age.length==0||password.length==0) {
				
				if(name.length==0) {
				s1.innerHTML="<font color='red'>Field is Required</font>";				
				}
				
				if(email.length==0) {
				s2.innerHTML="<font color='red'>Field is Required</font>";				
				}
				
				if(age.length==0) {
				s3.innerHTML="<font color='red'>Field is Required</font>";				
				}
				
				if(password.length==0) {
				s4.innerHTML="<font color='red'>Field is Required</font>";				
				}
			}
			
			else if (name.length>50||email.length>50||password.length>50) {
				
				if(name.length>50) {
				s5.innerHTML="<font color='red'>Characters should be less than 50 </font>";				
				}
				
				if(email.length>50) {
				s6.innerHTML="<font color='red'>Characters should be less than 50 </font>";				
				}
				
				if(password.length>50) {
				s7.innerHTML="<font color='red'>Characters should be less than 50 </font>";				
				}
			}
			
			else {
				document.f1.submit();
			}			
		}
	</script>
</head>
<body>

<?php
	
	$name=$email=$age=$gender=$password=$count=$count_id=$picture="";
	if($_SERVER["REQUEST_METHOD"]=="POST") {
		function sec($data) {
		$data=trim($data);
		$data=stripslashes($data);
		$data=htmlspecialchars($data);
		return $data;
	}
			$name=sec($_POST["n1"]);
			$email=sec($_POST["e1"]);
			$age=sec($_POST["a1"]);
			$gender=sec($_POST["g1"]);
			$password=sec($_POST["p1"]);
			$picture = "images/profile.png";
	
			//$query="INSERT INTO studs VALUES('$name','$email',$age);";
		//MySQL Magic :D
			//Getting Resource ID
			$resid=MySQLi_Connect('localhost','acontr12','acontr12','acontr12');
			if(MySQLi_Connect_Errno()) {
				$result = "Failed to connect to MySQL";
			}
			else {
			$check_email=MySQLi_Query($resid,"select name from students where email='".$email."'");
			$r_email=MySQLi_Fetch_Row($check_email);
			
			if($r_email) {
				$result = "<font color='red'> Email already Registered, Registration Failed!  </font>";
			}
			
			else {
			$count=MySQLi_Query($resid,"select (max(id)+1) as count  from students");
			$count_id=MySQLi_Fetch_Assoc($count);
			if($count_id["count"]) {
				$query="insert into students values (".$count_id["count"].",'$name','$email',$age,'$gender','$password','$picture')";
			}
			else {
				$query="insert into students values (1,'$name','$email',$age,'$gender','$password','$picture')";
			}
			$res=MySQLi_Query($resid,$query);
			if($res) {
			$result = "<font color='green'> Registration Successful! </font> You may login now from here: <a href='login.php'>Login</a>";
			}
			else {
				$result = " <font color='red'> Registration Failed! </font>";
			}
			}
			MySQLi_Close($resid);
			}
			
			
	
	}
	?> 	



<button class="openbtn" onclick="openNav()">&#8652; </button>
	
	<div  id='main'>
		
		<!--Logo-->
		<img src='images/logo.png' height='10%' width='100%' > <!--1350x160-->	 
		
				<div class="forms">
					<form method='POST' name='f1' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
						<br><br>							
						Name:-  <input type='text' name='n1' maxlength='50'>  <span id='s1'> </span>  <span id='s5'> </span> <br>				
				
						Email:-  <input type='email' name='e1' maxlength='50'>  <span id='s2'> </span>  <span id='s6'> </span> <br>				
				
						Age:-  <input type='number' name='a1' min='18' max='27'>  <span id='s3'> </span> <br>				
				
						Gender:-   <select name='g1'> 
									<option value='M'>Male
									<option value='F'>Female
									</select> <br>

						Password:-  <input type='password' name='p1' maxlength='50'>  <span id='s4'> </span>  <span id='s7'> </span> <br>				
				
						<br> <input type='button' value='Sign-up' name='s1' onclick='sec()'> OR <a href='login.php'>Login</a>						
					</form>
					<div> 
						<?php echo $result; ?> 
					</div>
				</div>
			

		 
	</div>
	<!--Nav_Tabs-->
		<script src="sidebar.js"></script>
		<div  id='mySidebar' class='sidebar'>
			<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
			<a href='home.php'> Home </a>
			<a href='login.php'>Login </a>
			 <a href='secure_signup.php'>Sign-up </a> 
			 <a href='contact-us.html'>Contact-Us </a>
			 <a href='about-us.html'>About-us </a>
		</div>			
			
			
	
	<div id="footer">
			<h3>&copy; 2019 Abhishek Nagekar All rights Reserved.<br>
			https://github.com/abhn/simple-php-mysql-project?tab=MIT-1-ov-file
			</h3>	
		</div>		
		
</body>
</html>





















