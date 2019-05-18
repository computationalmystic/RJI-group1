### Step 1: Install Apache, Mysql, PHP and some PHP packages

They can host basic website functions.

```shell
sudo apt update

//install Apache2
sudo apt install apache2

//install mysql
sudo apt-get install mysql-server
mysql_secure_installation

//install PHP
sudo apt-get install php libapache2-mod-php php-mcrypt php-mysql

sudo systemctl restart apache2
```

 
### Step 2: Update php.ini file

After that we can upload large file via php.
 
### Step 3: Set up a Machine Learning model

Follow the directions in the README.md at https://github.com/idealo/image-quality-assessment. 

Install docker, python environment, and build docker image. Then we can get predictions from aesthetic or technical model by running command line.
 
### Step 4: Download Laravel Project and create controller 

Those two controllers are working for uploading and downloading images.

```shell
//download Laravel Project
composer create-project --prefer-dist laravel/laravel image-assessment

//create controller
php artisan make:controller ImageUploadController
php artisan make:controller ImageUploadController
``` 

### Step 5:Setup a MySQL database
 
Setup the database in the ```.env``` file.
 
### Step 6: Compose a model and migration file

```shell 
php artisan make:model User
php artisan make:model Image
```

  It will create two model files which could be used to connect with laravel and database and generate other two migration files
  - Image.php model 
  - User.php  model
  - create_images_table.php migration file
  - create_users_table.php migration file

We need to create Schema for the image upload table 

```php
//create_users_table.php

public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }
    
//create_images_table.php
public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('filename');
            $table->timestamps();
            $table->float('aesthetic')->nullable();
            $table->float('technical')->nullable();
			         $table->bigInteger('userID');
			         $table->bigInteger('submissionID');
        });
    }
```
 
### Step 7: Set up Mailgun

Get ready for sending email to users.
 
### Step 8: Write five shell scripts

Laravel and php files can call system resources easily

- getScoreTechnical.sh
- getScoreAesthetic.sh
- BuildSubmissionFolder.sh
- ZipSubmissionFolder.sh
- SendNotificationEmail.sh

### Step 9: Execute ```dos2unix``` command

We might need to execute ```dos2unix scriptname``` after writing scripts.

Convert text files with DOS or Mac line endings to Unix line endings.

### Step 10: Add three jobs to laravel which execute specific jobs

```shell
php artisan make:job AnalyzeImage                    //Analyze image
php artisan make:job SendNotificationAfterScoring    //Send Notification to user
php artisan make:job ZipSubmission                   //Zip images
```

### Step 11: Install supervior and configure a queue system in Laravel

Integrade them together, we can parallel processing images.

### Step 12: Create main website page

https://rjimizzou.info
 
### Step 13: Create two view files

- upload.blade.php
- download.blade.php

### Step 14: Configure Dropzone

Provide a friendly environment for user to upload images

### Step 15: Create route
 
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

We can use the Laravel build-in Login/Register system and pages.

We need to login first before doing any other activity after adding  ```->middleware('auth')``` at the end of each record

### Step 16: Set proper permission to files

### Step 17: Secure Apache with Let's Encrypt

Set up a TLS/SSL certificate

Follow this tutorial https://www.digitalocean.com/community/tutorials/how-to-secure-apache-with-let-s-encrypt-on-ubuntu-16-04 

### Entity Relationship Diagram:

![](https://github.com/computationalmystic/RJI-group1/blob/master/UseCaseDiagrams/Sprint%203%20ERD.png)

Foreign keys: 
Images - Submission ID references Jobs JobID and UserID references Users UserID

Password Resets - Email references Users Email

Failed Jobs - ID references Jobs JobID


