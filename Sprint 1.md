# Sprint 1 Design Document Template

## Deployment Environment

[Link to your deployment environment](http://rji.glike.cf)

## Functional Requirements

1. Use Case Name A
	- Functional Requirement 1
	- Functional Requirement 2
	- ... etc.
2. Use Case Name B		
	- Functional Requirement 1
	- Functional Requirement 2
	- ... etc.
3. ... etc. 

## Database Design

### ERD

![ERD](./image_assessment_erd.png)

### DDL 

```SQL

    CREATE TABLE `Images` (
    `ImageID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `FilePath` varchar(60) NOT NULL UNIQUE,
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
    
%% ETC
```    


### User Interface Files

[Main Interface](./index.html)


### Model Files (Database Access)

[Model](https://github.com/computationalmystic/RJI-group1/tree/model) 

[SQL](./image_assessment_schema.sql)



### Controller Files (API or other)

[Image Upload](./upload.php)


## Describe languages you need to use, and any gaps in skills on your team. 

1. Python
    - used with docker as a framework for machine learning based image assessment
2. PHP/CSS/HTML 
    - used as user interface and to communicate with database using mySQL
3. SQL
    - main DDL used to store image data with scores as well as user data
    
4. Language Proficiency
    - Gavin: work with python and docker
    - Chase: database definition, PHP
    - Allan: help with database
    - John: help with docker

