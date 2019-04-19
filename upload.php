<?php


$servername = "localhost";
$username = "root";
$password = "CS4320";
$db = "image_assessment_schema";

// Create mySQL connection
$conn = new mysqli($servername, $username, $password, $db);

// Check mySQL connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "mySQL connected successfully.";
echo "<br/>";
echo "<br/>";

//$files = array_filter($_FILES['filesToUpload']['name']); 
$total = count($_FILES['filesToUpload']['name']);

$target_dir = "/home/ubuntu/photos/users/";

// Loop through each file
for( $i=0 ; $i < $total ; $i++ ) {
    echo "<br/>";
    
    // Get the temp file path
    $tmpFilePath = $_FILES['filesToUpload']['tmp_name'][$i];

    // Make sure we have a file path
    if ($tmpFilePath != "") {
        
        // Setup our new file path
        $filename = basename($_FILES['filesToUpload']['name'][$i]);
        $newFilePath = $target_dir . $filename;

        // Upload the file into the temp dir
        $uploadOk = 1;

        $imageFileType = strtolower(pathinfo($newFilePath,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if (isset($_POST['submit'])) {
            $check = getimagesize($tmpFilePath);
            if($check !== false) {
                echo "File is an image - " . $check['mime'] . ". ";
                $uploadOk = 1;
            } else {
                echo "File is not an image. ";
                $uploadOk = 0;
            }
        }
        
        // Check if file already exists
        if (file_exists($newFilePath)) {
            echo "Sorry, file already exists. ";
            $uploadOk = 0;
        }
        
        // Check file size
        if ($_FILES["filesToUpload"]["size"][$i] > 100000000) {
            echo "Sorry, your file is too large. ";
            $uploadOk = 0;
        }
        
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed. ";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded. ";
        } 
        
        // Upload the file into the temp dir
        else {
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                echo "The file has been uploaded. ";
                
                
                $technical = shell_exec("bash ./getScoreTechnical.sh $filename");
                $technical = substr($technical,-7,-3);
				echo "technical ". $technical . " / 10. ";
        
                $aesthetic = shell_exec("bash ./getScoreAesthetic.sh $filename");
				$aesthetic = substr($aesthetic,-7,-3);
                echo "aesthetic ". $aesthetic . " / 10. ";
                
                
                mysqli_query($conn,"INSERT INTO Images (FilePath,UploadDate,UploaderID,AestheticScore,TechnicalScore) VALUES ('$filename',curdate(),'joebob22','$aesthetic','$technical')");

            }
            else {
                echo "Sorry, there was an error uploading your file. ";
            }
        }
    }
}


echo "<br/>";
echo "<br/>";
echo "It seems that good images are rated at about 5.0+ in both metrics, while bad images are rated less than ~4.3. There will be some calibration needed to find what images are desirable that do not fall within those ranges.";

// Close mySQL connection
mysqli_close($conn);
?>