<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Image;
use App\User;
use App\Jobs\AnalyzeImage;
use App\Jobs\SendNotificationAfterScoring; 
use App\Jobs\ZipSubmission; 
use File;
use DB;
use Auth;


class ImageUploadController extends Controller
{
	    /**
     	* Show the form for creating a new resource.
     	*
     	* @return \Illuminate\Http\Response
     	*/
    	public function create()
    	{

			return view('upload');

    	}

    	/**
     	* Store a newly created resource in storage.
     	*
     	* @param  \Illuminate\Http\Request  $request
     	* @return \Illuminate\Http\Response
     	*/
    	public function store(Request $request)
    	{
        	$this->validate($request, [
                'file' => 'required',
                'file.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:30000'
        ]);

        if($request->hasfile('file'))
        {
            $user = Auth::user();
			$userid = $user->id;
			$useremail = $user->email;
			$subID = 1;

			$result = DB::table('images')
				->select('submissionID')
				->where('userID', $userid)
				->orderBy('submissionID', 'desc')
				->limit(1)
				->get();
			
						
			if (!$result->isEmpty()) {
				$result = json_decode($result, true);
				$subID = $result[0]['submissionID'] + 1;
			}

					
			foreach($request->file('file') as $file)
            {

                $name=$file->getClientOriginalName();
		        $path='/var/www/html/image-assessment/storage/app/unscored/';

                $image = new Image;
				//$image->submissionID = 1;
				$image->submissionID = $subID;
				$image->userID = $userid;
				
                $image->filename = $name;
				$image->save();
                
                $currentID = $image->id;

			    $file->move($path, str_pad($currentID, 10, '0', STR_PAD_LEFT).'-'.$name);
			     
                AnalyzeImage::dispatch($image);
		    }
            
            //SendNotificationAfterScoring::dispatch($user);
			//SendNotificationAfterScoring::dispatch($user,$subID);
			
 			ZipSubmission::withChain([
				new SendNotificationAfterScoring($useremail, $userid, $subID)
			])->dispatch($userid, $subID); 
            
           }

     	 return redirect()->back()->with('success', 'Your images have been successfully uploaded.');
    }

}

