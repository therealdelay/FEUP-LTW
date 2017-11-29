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

CREATE TABLE lists (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	title VARCHAR NOT NULL,
	priority INTEGER DEFAULT(0)
);

CREATE TABLE todos (
	todo_id INTEGER PRIMARY KEY AUTOINCREMENT,
	name VARCHAR NOT NULL,
	limit_date DATE,
	done INTEGER DEFAULT(0),
	list_id INTEGER REFERENCES lists NOT NULL
);

CREATE TABLE hasItems(
	list_id INTEGER REFERENCES lists NOT NULL,
	todo_id INTEGER REFERENCES todos NOT NULL,
	PRIMARY KEY(list_id, todo_id)
);

CREATE TABLE belongs (
	list_id INTEGER REFERENCES lists NOT NULL, 
	usr_id INTEGER REFERENCES users NOT NULL,
	PRIMARY KEY(list_id, usr_id)
);

CREATE TABLE hasCategories (
	list_id INTEGER REFERENCES lists NOT NULL,
	cat_id INTEGER REFERENCES categories NOT NULL,
	PRIMARY KEY(list_id, cat_id)
);

INSERT INTO users VALUES (NULL, 'john', 'john', 'john@gmail.com', 'https://farm5.staticflickr.com/4026/4654109388_465c99f66f.jpg', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'); --1234
INSERT INTO users VALUES (NULL, 'anadaisy', 'ana', 'ana@gmail.com', 'https://farm5.staticflickr.com/4026/4654109388_465c99f66f.jpg', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'); --1234
INSERT INTO categories VALUES (NULL, 'PHP');
INSERT INTO categories VALUES (NULL, 'HTML');
INSERT INTO categories VALUES (NULL, 'Javascript');
INSERT INTO lists VALUES (NULL, 'Projeto LTW', 2);
INSERT INTO lists VALUES (NULL, 'Projeto LAIG', 1);
INSERT INTO todos VALUES (NULL, 'Fazer Landing Page', '2017-11-27', 1);
INSERT INTO todos VALUES (NULL, 'Mostrar os Todos', '2017-11-27', 1);
INSERT INTO todos VALUES (NULL, 'Fazer tudo bonito', '2017-11-27', 1);
INSERT INTO todos VALUES (NULL, 'Fazer Animações', '2018-01-01', 2);
INSERT INTO hasItems VALUES (1,1);
INSERT INTO hasItems VALUES (1,2);
INSERT INTO hasItems VALUES (1,3);
INSERT INTO hasItems VALUES (2,4);
INSERT INTO belongs VALUES (1,1);
INSERT INTO belongs VALUES (1,2);
INSERT INTO belongs VALUES (2,1);
INSERT INTO hasCategories VALUES (1,1);
INSERT INTO hasCategories VALUES (1,2);
INSERT INTO hasCategories VALUES (2,3);