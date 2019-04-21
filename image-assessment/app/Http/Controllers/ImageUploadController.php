<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ImageUploadModel;

use File;

use DB;

class ImageUploadController extends Controller
{
	/**
     	* Show the form for creating a new resource.
     	*
     	* @return \Illuminate\Http\Response
     	*/
    	public function create()
    	{

        	return view('create');
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
                'filename' => 'required',
                'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000'
        ]);

        if($request->hasfile('filename'))
        {

		$result=DB::table('Images')
			->orderBy('ImageID', 'desc')
			->select('ImageID')
			->limit(1)
			->get();


		$currentID = 1;

		if (!$result->isEmpty()) {
			$result = json_decode($result,true);
			$currentID = ++$result[0]['ImageID'];
		}

		\Log::info($currentID);


        	foreach($request->file('filename') as $image)
            	{

			$name=$image->getClientOriginalName();
			$path=public_path().'/images/';

			$image->move($path, str_pad($currentID, 10, '0', STR_PAD_LEFT).'-'.$name);

			DB::insert("insert into Images (FilePath,UploadDate,UploaderID,AestheticScore,TechnicalScore) values ('$name', curdate(), 'joebob22', 1.00, 1.00)");
			$currentID++;
		}
         }

     	 return back()->with('success', 'Your images have been successfully uploaded.');
    }

}

