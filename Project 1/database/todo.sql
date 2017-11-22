CREATE TABLE users (
	usr_id INTEGER PRIMARY KEY AUTOINCREMENT,
	usr_username VARCHAR UNIQUE,
	usr_name VARCHAR NOT NULL,
	usr_email VARCHAR NOT NULL,
	usr_image VARCHAR NOT NULL,
	usr_password VARCHAR NOT NULL
);

CREATE TABLE categories (
	cat_id INTEGER PRIMARY KEY AUTOINCREMENT,
	cat_name VARCHAR NOT NULL
);

CREATE TABLE todos (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	name VARCHAR NOT NULL,
	limit_date DATE,
	priority INTEGER DEFAULT(0),
	cat_id INTEGER REFERENCES categories NOT NULL,
	usr_id INTEGER REFERENCES users NOT NULL
);

CREATE TABLE belongs (
	todo_id INTEGER REFERENCES todos NOT NULL, 
	usr_id INTEGER REFERENCES users NOT NULL,
	PRIMARY KEY(todo_id, usr_id)
);

CREATE TABLE hasCategories (
	todo_id INTEGER REFERENCES todos NOT NULL
);

INSERT INTO users VALUES (NULL, 'john', 'john', 'john@gmail.com', 'https://farm5.staticflickr.com/4026/4654109388_465c99f66f.jpg', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'); --1234
INSERT INTO users VALUES (NULL, 'anadaisy', 'ana', 'ana@gmail.com', 'https://farm5.staticflickr.com/4026/4654109388_465c99f66f.jpg', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'); --1234
INSERT INTO categories VALUES (NULL, 'Limpeza');
INSERT INTO categories VALUES (NULL, 'C++');
INSERT INTO todos VALUES (NULL, 'Limpar a casa', '2017-11-27', 1, 1, 1);
INSERT INTO todos VALUES (NULL, 'Fazer Projeto', '2018-01-01', 2, 2, 1);