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

