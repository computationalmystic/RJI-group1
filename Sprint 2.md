# Sprint 2 Design Document 

## Deployment Environment

- **[Prototype Implementation](http://rji2.glike.cf)**

- **[Laravel Implementation](http://rji.glike.cf/image-assessment/public/)**

## User Interface
### Main Page:

![](https://github.com/computationalmystic/RJI-group1/blob/master/MainPage.JPG)

### Upload Page:

![](https://github.com/computationalmystic/RJI-group1/blob/master/UploadPage.png)


## Use Cases

### 1. User File Management

![](https://github.com/computationalmystic/RJI-group1/blob/master/Sprint2_usecase/ufm_Sprint2.png)


### 2. Image Assessment	

![](https://github.com/computationalmystic/RJI-group1/blob/master/Sprint2_usecase/ia_Sprint2.png)


### 3. Photo Browser
(**Not Yet Implemented**)
![](https://github.com/computationalmystic/RJI-group1/blob/master/UseCaseDiagrams/Photo%20Browser.png)


### 4. Train Model
(**Not Yet Implemented**)
![](https://github.com/computationalmystic/RJI-group1/blob/master/UseCaseDiagrams/tm.png)


## Project Direction
In the case of excessively large files being uploaded, our previous implementation would not be feasible as the user would be forced to sit at the browser for hours. As such, we have decided to implement the Laravel PHP framework to facilitate the development of this project. This framework allows for easy creation of a queue system so that file assessment may be done in parallel; using Beanstalkd as our queue, Supervisor as our listener, and Symfony to deploy workers using console commands, the assessment process should be further optimized. Additionally, we have added the ImageID from our mySQL database to the filename upon storage so that there will be no collisions when uploading files that share names with previously uploaded files.

### Current Implementation:

a.	**Prototype**
- Able to assess images and adds score to database
- Can upload/process folders with multiple images
- Uploads then assesses each image individually
	

b.	**Laravel**
- Can upload folders with multiple images
- Renames files for directory structure optimization
- Sends notification once all files have been submitted
	

### To Do:
- Implement submission progress bar for uploads
- Assessment needs to be implemented using Symfony
- Potentially customize assessment to different categories
- Send notification to users once assessment complete
- Optimize file system for large number of files
- Need to add login interface and database queries



## Database Design

### ERD

![ERD](https://github.com/computationalmystic/RJI-group1/blob/master/image_assessment_erd.png)

### DDL 

```SQL

CREATE TABLE `Images` (
`ImageID` int(10) UNSIGNED NOT NULL UNIQUE AUTO_INCREMENT,
`FilePath` varchar(60) NOT NULL,
`UploadDate` date NOT NULL,
`UploaderID` varchar(12) NOT NULL,
`AestheticScore` float UNSIGNED NULL,
`TechnicalScore` float UNSIGNED NULL,
PRIMARY KEY (`ImageID`) 
);
CREATE TABLE `Users` (
`UserID` varchar(12) NOT NULL,
`Password` varchar(12) NOT NULL,
`FullName` varchar(30) NULL,
`PermissionLevel` int(1) UNSIGNED NOT NULL DEFAULT 0,
PRIMARY KEY (`UserID`) 
);

ALTER TABLE `Images` ADD CONSTRAINT `fk_Photo_User_1` FOREIGN KEY (`UploaderID`) REFERENCES `Users` (`UserID`);
```    

## Relevant Files

### User Interface Files

**a. Prototype**

- [Main Page](https://github.com/computationalmystic/RJI-group1/blob/master/html%26CSS/index.html)


- [Upload Page](https://github.com/computationalmystic/RJI-group1/blob/master/html%26CSS/Upload.html)

**b. Laravel**

- [Laravel Upload](https://github.com/computationalmystic/RJI-group1/blob/master/image-assessment/resources/views/create.blade.php)


### Model Files (Database Access)

- [Model](https://github.com/computationalmystic/RJI-group1/tree/master/model) 

- [SQL](https://github.com/computationalmystic/RJI-group1/blob/master/image_assessment_schema.sql)


### Controller Files (API or other)

- [Aesthetic Score](https://github.com/computationalmystic/RJI-group1/blob/master/html%26CSS/getScoreAestheticAPI.sh)

- [Technical Score](https://github.com/computationalmystic/RJI-group1/blob/master/html%26CSS/getScoreTechnicalAPI.sh)

**a. Prototype**

- [Image Upload](https://github.com/computationalmystic/RJI-group1/blob/master/image-assessment/public/index.php)

**b. Laravel**

- [Image Upload](https://github.com/computationalmystic/RJI-group1/blob/master/image-assessment/app/Http/Controllers/ImageUploadController.php)


### Unit Tests:
- Upload different types of file extensions
- File with name of previously uploaded file
- File name valid(prevent SQL/script injections)
- Server has enough storage for file uploads
- Multiple users uploading files at same time


