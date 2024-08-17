<?php
	session_start();
		$_SESSION["searchName"] = "friends";	
if(IsSet($_POST["search"])) {
					$name=$_POST["search"];
					$resid=MySQLi_Connect('localhost','acontr12','acontr12','acontr12');
					$query="select * from students where name like '%".$name."%' or email like '%".$name."%'";
					$result = mysqli_query($resid,$query)	
					$friends = [];		
                    
							if (mysqli_num_rows($result) > 0) {
							// output data of each row
							while($row = mysqli_fetch_assoc($result)) {
								 $friends = array_push($friends,$row[0]);
							}
							} else {
							echo "0 results";
							}
                            
							MySQLi_Close($resid);
                            
						}
					?>