CREATE TABLE Customer 
(
	CustomerID INT UNSIGNED NOT NULL AUTO_INCREMENT,
     Firstname VARCHAR(50) NOT NULL,
     Lastname VARCHAR(50) NOT NULL,
     Password VARCHAR(255) NOT NULL,
     Email VARCHAR(256) NOT NULL UNIQUE, 
     Phone VARCHAR(12) NOT NULL,
     CreatedOn TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
     PRIMARY KEY (CustomerID)
);