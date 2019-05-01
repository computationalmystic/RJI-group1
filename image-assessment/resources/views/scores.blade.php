@extends('layouts.app')

@section('content')
<div class="container">
	<?php
	/* Attempt MySQL server connection. Assuming you are running MySQL
	server with default setting (user 'root' with no password) */
	$mysqli = new mysqli("localhost", "root", "CS4320", "image_assessment_schema");
	 
	// Check connection
	if($mysqli === false){
		die("ERROR: Could not connect. " . $mysqli->connect_error);
	}
	 
	// Attempt select query execution
	$sql = "SELECT filename,aesthetic,technical from images WHERE userID=1 AND submissionID=1;";
	if($result = $mysqli->query($sql)){
		if($result->num_rows > 0){
			echo "<table>";
				echo "<tr>";
					echo "<th>FileName</th>";
					echo "<th>Aesthetic Score</th>";
					echo "<th>Technical Score</th>";
					//echo "<th>email</th>";
				echo "</tr>";
			while($row = $result->fetch_array()){
				echo "<tr>";
					echo "<td>" . $row['filename'] . "</td>";
					echo "<td>" . $row['aesthetic'] . "</td>";
					echo "<td>" . $row['technical'] . "</td>";
					//echo "<td>" . $row['email'] . "</td>";
				echo "</tr>";
			}
			echo "</table>";
			// Free result set
			$result->free();
		} else{
			echo "No records matching your query were found.";
		}
	} else{
		echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
	}
	 
	// Close connection
	$mysqli->close();
	?>
</div>
@endsection

