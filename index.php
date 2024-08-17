<!doctype html>
<html>
<head>
	<link rel='stylesheet' onclick="myFunction()"ss'>
	<title> Student's Hangout </title>

	<script src='jquery.js'></script>
	<script type='text/javascript'>	
	</script>
</head>
<body>

<script type="text/javascript" src="notfiyindex.js"></script>
	
	
		<table cellpadding='3' cellspacing='3' class='tab_main'>
			<!--Logo-->
			<tr>
				<td  colspan='5'><img src='images/logo.png' height='65%' width='100%' ></td> <!--1350x160-->
			</tr>
			<!--Nav_Tabs-->
			<tr align='center' bgcolor='lightgrey' class='td_bor'>
				<td width='5%'> <a  onclick="myFunction()"> Home </a></td>
				<td width='5%'> <a onclick="myFunction()">Login </a></td>
				<td width='5%'> <a onclick="myFunction()">Sign-up </a></td> 
				<td width='5%'> <a onclick="myFunction()">Contact-Us </a></td>
				<td width='5%'> <a onclick="myFunction()">About-us </a></td>
			</tr>
			
			<tr>
				<td> <hr> </td> 
				<td> <hr> </td> 
				<td> <hr> </td> 
				<td> <hr> </td> 
				<td> <hr> </td> 
			</tr>
			
			<tr>
				
				<td  colspan='4'> 
				
					  <h3 id="tooBad">Welcome to Socioexplore</h3>
					  <p id="timer" ></p>
						
				</td>
				
			</tr>

		</table><script>
							function newDoc() {
								window.location.assign("home.php");
							}
							
							function myFunction() {
								var txt;								
								if (confirm("New update! Please Confirm Below!")) {
									window.location.assign("home.php");
								} 
								else {									
									setTimeout(newDoc, 6000);
									txt ="Too bad here it comes!";	

								} 	document.getElementById("tooBad").innerHTML= txt;

								setInterval(mytimer,1000);
								var x =5;
								function mytimer()
								{
									document.getElementById("timer").innerHTML = x;
									x--;
								}							
							}
							
								document.getElementById("tooBad").style.color = "red";
								document.getElementById("tooBad").style.fontFamily = "Arial";
								document.getElementById("tooBad").style.fontSize = "larger";
								document.getElementById("timer").style.color = "red";
								document.getElementById("timer").style.fontFamily = "Arial";
								document.getElementById("timer").style.fontSize = "larger";
									
						</script>
		<p ></p>

		
			<footer align='center'>
			&copy; 2019 Abhishek Nagekar All rights Reserved.<br>
			https://github.com/abhn/simple-php-mysql-project?tab=MIT-1-ov-file
	
			</footer>
</body>
</html>
