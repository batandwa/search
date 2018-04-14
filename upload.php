<!DOCTYPE html>
<html>
<body>

<form action="index.php?mode=upload" method="post" enctype="multipart/form-data">
    Select image to upload:
	<br>
    <input type="file" name="file" id="file">
	<br>
    <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html> 


<?php

if  (isset($_POST['submit'])) {
	$name = $_FILES['file']['name'];
	$size = $_FILES['file']['size'];
	$type = $_FILES['file']['type'];

	$tmp_name = $_FILES['file']['tmp_name'];

	$error = $_FILES['file']['error'];

	$fileExt = explode('.',$name);
	$fileActualExt = strtolower(end($fileExt));

	 $allowed = array('xml');
	 
	 if ($vulnerable === false) {
		 	 
		if (!in_array($fileActualExt, $allowed)) {
		echo "invalid file";
		exit;
			}
	}
	 
	 if ($error > 0) {
		echo "there was an error";
		 exit;
	}
			
	if ($size <= 512000) {
		$fileDestination = 'uploads/'.$name;
		move_uploaded_file($tmp_name, $fileDestination);
	//	header("Location: indexx.php?uploadsuccess");
		echo "upload success";
	} else {
		echo "Your file is too big!!";
	}	
}

?>


