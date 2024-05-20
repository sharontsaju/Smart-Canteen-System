CREATE TABLE students(

id int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
name varchar(255) NOT NULL,
reg_no int(11) NOT NULL,
phone varchar(255) NOT NULL, 
address varchar(255) DEFAULT NULL,
created_at varchar(255) NOT NULL
);