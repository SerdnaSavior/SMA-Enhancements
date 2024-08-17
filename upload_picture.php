<?php
	session_start();

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$picture = $_SESSION['picture'];


      
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".<br>";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }
  // Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }
  // Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "png" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
      $picture = $target_file;
    } else {
      echo "Sorry, there was an error uploading your file.<br>";
      print_r($_FILES);
    }
  }
}
else {
    if(isset($_SESSION['user_id'])) {
        $id = $_SESSION['user_id'];
        $picture = $_SESSION['picture'];
    
    $resid=MySQLi_Connect('localhost','acontr12','acontr12','acontr12');
			if(MySQLi_Connect_Errno()) {
				echo " Failed to connect to MySQL ";
			}
            

    if(isset($_POST["a1"])){
        $picture ="images/anon.png" ;
    }
    elseif(isset($_POST["a2"])){
        $picture ="images/emoji.png" ;
    }
    elseif(isset($_POST["a3"])){
        $picture ="images/logo.png" ;
    }
    elseif(isset($_POST["a4"])){
        $picture ="images/tophat.png" ;
    }
    else {
        $picture ="images/profile.png" ;
    }   
    }    
}
    $query = "update students set picture = '$picture' where id = $id ";
    $result=MySQLi_Query($resid,$query);
    $_SESSION['picture'] = $picture;


    MySQLi_Close($resid);




if(IsSet($_SESSION['user_id'])) {
    Header("Location: view_profile.php");
    }
else {
    Header("Location: home.php");
}

?>