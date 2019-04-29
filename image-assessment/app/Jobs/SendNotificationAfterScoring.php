<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;


class SendNotificationAfterScoring implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
	protected $useremail;
	protected $userid;
	protected $submission;
	
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($useremail, $userid, $submission)
    {
        $this->useremail = $useremail;
		$this->userid = $userid;
        $this->submission = $submission;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
		//$user = $this->user;
		//$username =  $user->name;
		$useremail = $this->useremail;
		$userid = $this->userid;
		$submissionID = $this->submission;
		exec("bash /var/www/html/image-assessment/app/Scripts/SendNotificationEmail.sh $useremail $userid $submissionID");
		//exec("bash /var/www/html/image-assessment/app/Scripts/SendNotificationEmail.sh $useremail $username");
    }
}
