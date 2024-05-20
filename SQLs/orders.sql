-CREATE TABLE orders(

	id int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
	ordered_by int(11) NOT NULL,
	given_by int(11) NOT NULL,
	ordered_item int(11) NOT NULL,
	quantity int(11) NOT NULL,
	created_at varchar(255) NOT NULL


);