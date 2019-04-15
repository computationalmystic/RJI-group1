<?php
$target_dir = "/home/ubuntu/photos/users/";
$filename = basename($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir . $filename;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 100000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} 
else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        
        $servername = "localhost";
        $username = "root";
        $password = "CS4320";
        $db = "image_assessment_schema";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $db);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        echo "Connected successfully";
        
        echo "The file has been uploaded.";
		$technical = exec("bash ./getScoreTechnical.sh $filename");
        echo "technical ". $technical . ". ";
    
		$aesthetic = exec("bash ./getScoreAesthetic.sh $filename");
        echo "aesthetic ". $aesthetic . ". ";
        
        mysqli_query($conn,"INSERT INTO Images (FilePath,UploadDate,UploaderID,AestheticScore,TechnicalScore) VALUES ('$filename',curdate(),'joebob22','$aesthetic','$technical')");
        
        mysqli_close($conn);
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

?>