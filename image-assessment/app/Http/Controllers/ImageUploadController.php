<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Image;

use App\Jobs\AnalyzeImage;

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
                'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:30000'
        ]);

        if($request->hasfile('filename'))
        {

            foreach($request->file('filename') as $file)
            {

                $name=$file->getClientOriginalName();
		        $path=public_path().'/images/';

                $image = new Image;
                $image->filename = $name;
		$image->save();
                
                $currentID = $image->id;

			    $file->move($path, str_pad($currentID, 10, '0', STR_PAD_LEFT).'-'.$name);
			     
                AnalyzeImage::dispatch($image);
		    }

         }

     	 return back()->with('success', 'Your images have been successfully uploaded.');
    }

}

