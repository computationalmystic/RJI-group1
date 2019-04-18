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
        echo "File is an image - " . $check["mime"] . ". ";
        $uploadOk = 1;
    } else {
        echo "File is not an image. ";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists. ";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 100000000) {
    echo "Sorry, your file is too large. ";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed. ";
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
        echo "Connected successfully. ";
        
        echo "The file has been uploaded.";
        //Using API to replace EXEC function
        //$technical = exec("bash ./getScoreTechnical.sh $filename");
		
        $file_contents1=file_get_contents('http://localhost:8000/getScoreTechnicalAPI?NAME='.$filename);
        $technical2= substr($file_contents1,-5,-1);
        //echo "technical ". $technical . " / 10. ";
        echo "technical ". $technical2 . " / 10. ";
        
        //$aesthetic = exec("bash ./getScoreAesthetic.sh $filename");
		//$file_contents2=file_get_contents('http://localhost:8000/getScoreAestheticAPI?NAME=20170909_MizzouSouthCarolina_EC_1420.JPG');
        $file_contents2=file_get_contents('http://localhost:8000/getScoreAestheticAPI?NAME='.$filename);
        $aesthetic2= substr($file_contents2,-5,-1);
        //echo "aesthetic ". $aesthetic . " / 10. ";
        echo "aesthetic ". $aesthetic2 . " / 10. ";
        
        mysqli_query($conn,"INSERT INTO Images (FilePath,UploadDate,UploaderID,AestheticScore,TechnicalScore) VALUES ('$filename',curdate(),'joebob22','$aesthetic','$technical')");
        
        mysqli_close($conn);
        
        echo "It seems that good images are rated at about 5.0+ in both metrics, while bad images are rated less than ~4.3. There will be some calibration needed to find what images are desirable that do not fall within those ranges.";
    } else {
        echo "Sorry, there was an error uploading your file. ";
    }
}

?>
