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
		        
        $exists = Storage::exists("/users/$userID/$submissionID/submission.zip");
        
		if ($myUser == $userID && $exists) { 
			return Storage::download("/users/$userID/$submissionID/submission.zip", "submission.zip", $headers);	
		}
		elseif (!$exists) {
			return redirect()->back()->with('alert', 'File must be processed before download!');
		}
        
        elseif ($myUser != $userID) {
			return redirect()->back()->with('alert', 'You must be signed in as the correct user to access this file!');
		}
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


