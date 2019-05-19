<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Image as ImageModel;

class AnalyzeImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    protected $image;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ImageModel $image)
    {
        $this->image = $image;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $image = $this->image;
        //$filename = escapeshellarg($this->filename);
		$filepath = str_pad($image->id, 10, '0', STR_PAD_LEFT).'-'.$image->filename;

        $image->aesthetic = exec("bash /var/www/html/image-assessment/app/Scripts/getScoreAesthetic.sh $filepath");
        $image->technical = exec("bash /var/www/html/image-assessment/app/Scripts/getScoreTechnical.sh $filepath");
		
        //$aesthetic = exec("bash /var/www/html/image-assessment/app/Scripts/getScoreAesthetic.sh $filepath");
        //$technical = exec("bash /var/www/html/image-assessment/app/Scripts/getScoreTechnical.sh $filepath");
		//Log::info($aesthetic);
		//Log::info($technical);
		
		//$image->aesthetic = 6.9;
		//$image->technical = 6.9;

        $image->save();
		
    }
}
