<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;
use DB;
use Log;

class ZipSubmission implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $submission;
    
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $submission)
    {
        $this->user = $user;
        $this->submission = $submission;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        sleep(30);
        
        $userID = $this->user;
        $submissionID = $this->submission;
        
        exec("bash /var/www/html/image-assessment/app/Scripts/BuildSubmissionFolder.sh $userID $submissionID");
        
        $keepers = DB::table('images')
            ->select('id', 'filename', 'userID', 'submissionID')
            ->where('userID', $userID)
            ->where('submissionID', $submissionID)
            ->where('aesthetic', '>', 5.0)
            ->get();
        
        $tossers = DB::table('images')
            ->select('id', 'filename', 'userID', 'submissionID')
            ->where('userID', $userID)
            ->where('submissionID', $submissionID)
            ->where('aesthetic', '<=', 5.0)
            ->get();
                    
        foreach ($keepers as $file) {
            $filepath = str_pad($file->id, 10, '0', STR_PAD_LEFT).'-'.$file->filename;
         
            Storage::move("/unscored/$filepath", "/users/$file->userID/$file->submissionID/keep/$file->filename");
        }
        
        foreach ($tossers as $file) {
            $filepath = str_pad($file->id, 10, '0', STR_PAD_LEFT).'-'.$file->filename;
         
            Storage::move("/unscored/$filepath", "/users/$file->userID/$file->submissionID/toss/$file->filename");
        }    
        
    }
}
