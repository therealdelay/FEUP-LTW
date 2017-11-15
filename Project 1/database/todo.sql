CREATE TABLE user (
	usr_username VARCHAR PRIMARY KEY,
	usr_name VARCHAR NOT NULL,
	usr_email VARCHAR NOT NULL,
	usr_image VARCHAR NOT NULL,
	usr_password VARCHAR NOT NULL
);

CREATE TABLE category (
	cat_id INTEGER AUTO_INCREMENT PRIMARY KEY,
	cat_name VARCHAR NOT NULL
);

CREATE TABLE todo (
	id INTEGER AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR NOT NULL,
	limit_date DATE,
	priority INTEGER DEFAULT(0),
	cat_id INTEGER REFERENCES category NOT NULL
);

CREATE TABLE belongs (
	todo_id INTEGER REFERENCES todo NOT NULL, 
	usr_username INTEGER REFERENCES user NOT NULL,
	PRIMARY KEY(todo_id, usr_username)
);

CREATE TABLE hasCategory (
	todo_id INTEGER REFERENCES todo NOT NULL
);

INSERT INTO user VALUES('john', 'john', 'john@gmail.com', 'https://farm5.staticflickr.com/4026/4654109388_465c99f66f.jpg', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'); --1234