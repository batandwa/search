<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

</head>

<body>

<form action="index.php?mode=upload" method="post" enctype="multipart/form-data">
    Select file to upload:
	<br>
	<br>
<!--	<br>
    <input type="file" name="file" id="file" class="input-group mb-3">
	<br>
    <input type="submit" value="Upload Image" name="submit" class="input-group-text">
	
	-->
	
	<div class="input-group mb-3">
  <div class="input-group-prepend">
    <input type="submit" value="Upload" name="submit" class="input-group-text">
  </div>
  <div class="custom-file">
    <input type="file" name="file" class="custom-file-input" id="inputGroupFile01">
    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
  </div>
</div>
</form>

</body>
</html>


<?php

if (isset($_POST['submit'])) {
    $name = $_FILES['file']['name'];
    $size = $_FILES['file']['size'];
    $type = $_FILES['file']['type'];

    $tmp_name = $_FILES['file']['tmp_name'];

    $error = $_FILES['file']['error'];

    $fileExt = explode('.', $name);
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
        $fileDestination = 'uploads/' . $name;
        move_uploaded_file($tmp_name, $fileDestination);
        parseXml($fileDestination);
        echo "upload success";
    } else {
        echo "Your file is too big!!";
    }
}
