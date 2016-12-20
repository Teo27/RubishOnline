CREATE DATABASE RubishOnline;

USE RubishOnline;

CREATE TABLE Pending
(
Q_id int NOT NULL AUTO_INCREMENT,
Question varchar(200) NOT NULL,
`Right` varchar(50) NOT NULL,
`Left` varchar(50) NOT NULL,

PRIMARY KEY(Q_id)

);

CREATE TABLE Approved
(
Q_id int NOT NULL AUTO_INCREMENT,
Question varchar(200) NOT NULL,
`Right` varchar(50) NOT NULL,
`Left` varchar(50) NOT NULL,
Votes int DEFAULT 0,

PRIMARY KEY(Q_id)

);

CREATE TABLE Bins
(
Bin_Id int NOT NULL AUTO_INCREMENT,
Question varchar(200) NOT NULL,
A_Right varchar(50) NOT NULL,
A_Left varchar(50) NOT NULL,
Right_Result int DEFAULT 0,
Left_Result int DEFAULT 0,
Published date NOT NULL,
Address varchar(255) NOT NULL,
Longitude float(10,6),
Latitude float(10,6),

PRIMARY KEY(Bin_Id)

);

CREATE TABLE Results
(
Q_id int NOT NULL AUTO_INCREMENT,
Question varchar(200) NOT NULL,
`Right` varchar(50) NOT NULL,
`Left` varchar(50) NOT NULL,
Right_Result int DEFAULT 0,
Left_Result int DEFAULT 0,
Published date NOT NULL,

PRIMARY KEY(Q_id)

);

CREATE TABLE Admin
(
`Name` varchar(50) NOT NULL,
`Password` binary(60) NOT NULL,

PRIMARY KEY(`Name`)

)


