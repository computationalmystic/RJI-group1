 Step 1: install Apache, Mysql, Php and some php packages to your EC2 which can be used to host basic website functions.
 
 Step : update php.ini file, then you can upload large file via php
 
 Step two: follow the directions in the README.md at https://github.com/idealo/image-quality-assessment. And install docker, python environment, and build docker image. Then you can get predictions from aesthetic or technical model by running command line 
 
 Step three: install laravel and create two controllers which are working for uploading and downloading images.
 
 Step :Setup a MySQL database
 Setup the database in the .env file.
 
 Step : Compose a model and migration file
 run php artisan make:model User and php artisan make:model Image , then laravel will create two models which could be used to connect with laravel and database and generate other two php files
- create_images_table.php
- create_users_table.php 
execute those files, two new tables will be created in the Mysql Database 
 
 Step : set up Mailgun, get ready for sending email 
 
 Step : write five shell scripts, so the laravel and php files can call system resouerce easily
 - getScoreTechnical.sh
 - getScoreAesthetic.sh
 - BuildSubmissionFolder.sh (each user has a folder)
 - ZipSubmissionFolder.sh
 - SendNotificationEmail.sh

Step : you might need to execute dos2unix command after writing scripts
Convert text files with DOS or Mac line endings to Unix line endings

 Step four: Add three jobs to laravel which execute specific job
 - Analyze image
 - Send Notification to user
 - Zip images
 
 Step five: install supervior and configure a queue system in laravel. integrade them, you can parallel processing images.
 
 Step : create main page 
 
 Step : create two view files
 - upload.blade.php
 - download.blade.php
 
 Step : Configure Dropzone
 provide a friendly environment for user to upload images
 
 Step : create route
 
```php
 
Route::get('/upload', function () {
    return view('upload');
})->middleware('auth');

Route::get('form','ImageUploadController@create');
Route::post('form','ImageUploadController@store');

Route::get('/scores/{userid}/{submissionid}', function ($userid, $submissionid) {
    return View::make('/scores')->with('userid', $userid);
})->middleware('auth');

Route::get('/download', function () {
    return view('download');
})->middleware('auth');

Route::get( '/download/{userID}/{submissionID}', 'DownloadController@getDownload')->middleware('auth');

```

you can use the laravel build-in Login/Register system and pages
you need to login first before doing any other activity after adding  ->middleware('auth') at the end of each record
