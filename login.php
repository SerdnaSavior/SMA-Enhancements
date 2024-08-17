<!doctype html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel='stylesheet' href='body.css'>
	<title> Student's Hangout </title>
		<script type='text/javascript'>
		function sec() {
			var email=document.f1.e1.value;
			var password=document.f1.p1.value;
			
			
			if(email.length==0||password.length==0) {

				if(email.length==0) {
				s1.innerHTML="<font color='red'>Field is Required</font>";
				
				}

				
				if(password.length==0) {
				s2.innerHTML="<font color='red'>Field is Required</font>";
				
				}
			}
			
			else if (email.length>50||password.length>50) {

				if(email.length>50) {
				s3.innerHTML="<font color='red'>Characters should be less than 50 </font>";
				
				}
				
				if(password.length>50) {
				s4.innerHTML="<font color='red'>Characters should be less than 50 </font>";
				
				}
			}
			
			else {
				document.f1.submit();
			}			
		}
	</script>	
</head>

<body>
<button class="openbtn" onclick="openNav()">&#8652; </button>
	
	<div  id='main'>
		
		<!--Logo-->
		<img src='images/logo.png' height='10%' width='100%' > <!--1350x160-->	 
		<div class="forms"> 
			
					<form method='POST' name='f1' action='user_page.php'>
						<br><br>
							
							 Email:  <input type='email' name='e1' maxlength='50'>  <span id='s1'> </span>   <span id='s3'> </span> <br>													
							 Password: <input type='password' name='p1' maxlength='50'>  <span id='s2'> </span>  <span id='s4'> </span> <br>
														
							  <input type='hidden' name='h1' value='holla'>  		
							
							 <br> <input type='button' value='Login' name='s1' onclick='sec()'> OR <a href='secure_signup.php'>Sign-up</a> 
							
						
					</form>

		   
		
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
			
			 
				
			
			</div>
		<div id="footer">
			<h3>&copy; 2019 Abhishek Nagekar All rights Reserved.<br>
			https://github.com/abhn/simple-php-mysql-project?tab=MIT-1-ov-file
			</h3>	
		</div>
</body>
</html>




