<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;


use DB;
use Auth;
use Log;
use Storage;

class DownloadController extends Controller
{

	public static function getDownload($userID, $submissionID) {
				
		$headers = array(
			'Content-Type: application/zip',
		);
		
		$user = Auth::user();
		$myUser = $user->id;
		
		if ($myUser == $userID ) { 
			return Storage::download("/users/$userID/$submissionID/submission.zip", "submission.zip", $headers);	
		}
/* 		else {
				route
		} */
	}



	public static function buildPage() {
        $user = Auth::user();
		$userID = $user->id;
		
		$submissions = DB::table('images')
            ->select('submissionID')
            ->where('userID', $userID)
			->groupBy('submissionID')
            ->get();  
	  		
		foreach ($submissions as $submission) {
				$submissionID = $submission->submissionID;
					
                					
				echo "<a href='http://rjimizzou.info/download/$userID/$submissionID/'>Download Submission $submissionID </a>";
				

		}	
	}	
	
}


