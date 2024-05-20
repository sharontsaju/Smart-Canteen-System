CREATE TABLE admin(

id int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
name varchar(40) NOT NULL,
phone varchar(20) NOT NULL,
address varchar(20) NOT NULL,
password varchar(20) NOT NULL,
is_siteadmin boolean DEFAULT 0,
is_verified boolean DEFAULT 0,
created_at datetime NOT NULL

);