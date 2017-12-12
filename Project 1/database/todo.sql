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
	done INTEGER DEFAULT(-1),
	priority INTEGER DEFAULT(3)
);

CREATE TABLE todos (
	todo_id INTEGER PRIMARY KEY AUTOINCREMENT,
	name VARCHAR NOT NULL,
	limit_date DATE,
	done INTEGER DEFAULT(-1),
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

CREATE TABLE requests (
	usr_id INTEGER REFERENCES users NOT NULL,
	list_id INTEGER REFERENCES lists NOT NULL,
	owner_usr_id INTEGER REFERENCES users NOT NULL,
	PRIMARY KEY (usr_id, list_id, owner_usr_id)
);

CREATE TABLE comments (
	comment_id INTEGER PRIMARY KEY AUTOINCREMENT,
	comment_text TEXT,
	date_written DATE DEFAULT(Date('now')) NOT NULL,
	usr_id INTEGER REFERENCES users NOT NULL,
	todo_id INTEGER REFERENCES todos NOT NULL
);

/**
	Deletes all thing of a user when this one is deleted
*/
CREATE TRIGGER remove_user_info
AFTER DELETE ON users
FOR EACH ROW 
BEGIN
	DELETE FROM belongs WHERE usr_id = old.usr_id;
	DELETE FROM comments WHERE usr_id = old.usr_id;
	DELETE FROM requests WHERE usr_id = old.usr_id;
END;

/**
	If all the users are removed from a list, the list is completely deleted from the database
*/
CREATE TRIGGER list_user
AFTER DELETE ON belongs
FOR EACH ROW 
WHEN ((SELECT COUNT(*) FROM belongs WHERE belongs.list_id = old.list_id) = 0)
BEGIN
	DELETE FROM lists WHERE lists.id = old.list_id;
	DELETE FROM todos WHERE todos.list_id = old.list_id;
	DELETE FROM hasItems WHERE hasItems.list_id = old.list_id;
	DELETE FROM hasCategories WHERE hasCategories.list_id = old.list_id;
END;

/**
	If all the todos of a list are checked, the list is completely done
*/
CREATE TRIGGER check_list_done
AFTER UPDATE ON todos
FOR EACH ROW
WHEN ((SELECT COUNT(*) FROM todos WHERE todos.done = 1 AND todos.list_id = old.list_id) = (SELECT COUNT(*) FROM todos WHERE todos.list_id = old.list_id))
BEGIN
	UPDATE lists SET done = 1 WHERE id = old.list_id; 
END;

/**
	If one of the todos of a list ins't checked, the list isn't completely done
*/
CREATE TRIGGER check_list_not_done
AFTER UPDATE ON todos
FOR EACH ROW
WHEN ((SELECT COUNT(*) FROM todos WHERE todos.done = -1 AND todos.list_id = old.list_id) > 0 )
BEGIN
	UPDATE lists SET done = -1 WHERE id = old.list_id; 
END;

/**
	If a todo is added on an once done list, the list is switched to not done
*/
CREATE TRIGGER check_list_done_add
AFTER INSERT ON todos
FOR EACH ROW
WHEN ((SELECT COUNT(*) FROM lists WHERE new.list_id = lists.id AND lists.done = 1) > 0)
BEGIN
	UPDATE lists SET done = -1 WHERE id = new.list_id;
END;

CREATE TRIGGER check_repeated_categories
BEFORE INSERT ON hasCategories
FOR EACH ROW
WHEN ((SELECT COUNT(*) FROM hasCategories WHERE new.list_id = hasCategories.list_id AND new.cat_id = hasCategories.cat_id) > 0)
BEGIN
	SELECT RAISE(IGNORE);
END;


CREATE TRIGGER check_non_existing_user_requests
BEFORE INSERT ON requests
WHEN ((SELECT COUNT(*) FROM users WHERE usr_id = new.usr_id) = 0)
BEGIN
	SELECT RAISE(IGNORE);
END;

CREATE TRIGGER check_unvalid_requests
BEFORE INSERT ON requests
FOR EACH ROW
WHEN ((SELECT COUNT(*) FROM belongs WHERE new.list_id = belongs.list_id AND new.usr_id = belongs.usr_id) > 0)
BEGIN
	SELECT RAISE(IGNORE);
END;

CREATE TRIGGER check_repeated_requests
BEFORE INSERT ON requests
FOR EACH ROW 
WHEN ((SELECT COUNT(*) FROM requests, belongs WHERE requests.list_id = new.list_id 
				AND requests.usr_id = new.usr_id AND requests.owner_usr_id = new.owner_usr_id) > 0)
BEGIN
	SELECT RAISE(IGNORE);
END;


INSERT INTO users VALUES (NULL, 'test1', 'john', 'john@gmail.com', 'https://farm5.staticflickr.com/4026/4654109388_465c99f66f.jpg', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'); --1234
INSERT INTO users VALUES (NULL, 'test2', 'ana', 'ana@gmail.com', 'https://farm5.staticflickr.com/4026/4654109388_465c99f66f.jpg', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'); --1234
INSERT INTO users VALUES (NULL, 'test3', 'jack', 'jack@gmail.com', 'https://farm5.staticflickr.com/4026/4654109388_465c99f66f.jpg', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'); --1234
INSERT INTO users VALUES (NULL, 'margarida', 'Margarida', 'margarida@gmail.com', 'https://farm5.staticflickr.com/4026/4654109388_465c99f66f.jpg', '$2y$12$q0xxhiA3i6Ved6wZ7hFsJ.ke3uaF58QeWFpg7IC1IMiLPLGEMr3Ei'); --Margarida1234-
INSERT INTO categories VALUES (NULL, 'PHP');
INSERT INTO categories VALUES (NULL, 'HTML');
INSERT INTO categories VALUES (NULL, 'Javascript');
INSERT INTO lists VALUES (NULL, 'Projeto LTW', -1, 2);
INSERT INTO lists VALUES (NULL, 'Projeto LAIG', -1, 1);
INSERT INTO todos VALUES (NULL, 'Fazer Landing Page', '2017-11-27', -1, 1);
INSERT INTO todos VALUES (NULL, 'Mostrar os Todos', '2017-11-27', -1, 1);
INSERT INTO todos VALUES (NULL, 'Fazer tudo bonito', '2017-11-27', -1, 1);
INSERT INTO todos VALUES (NULL, 'Fazer Animações', '2018-01-01', -1, 2);
INSERT INTO comments VALUES (NULL, 'This is very difficult! Can someone else do it?', Date('now'), 4, 1);
INSERT INTO hasItems VALUES (1,1);
INSERT INTO hasItems VALUES (1,2);
INSERT INTO hasItems VALUES (1,3);
INSERT INTO hasItems VALUES (2,4);
INSERT INTO belongs VALUES (1,1);
INSERT INTO belongs VALUES (1,2);
INSERT INTO belongs VALUES (1,3);
INSERT INTO belongs VALUES (1,4);
INSERT INTO belongs VALUES (2,1);
INSERT INTO belongs VALUES (2,3);
INSERT INTO hasCategories VALUES (1,1);
INSERT INTO hasCategories VALUES (1,2);
INSERT INTO hasCategories VALUES (2,3);

/*
INSERT INTO users VALUES (NULL, 'john', 'john', 'john@gmail.com', 'https://farm5.staticflickr.com/4026/4654109388_465c99f66f.jpg', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'); --1234
INSERT INTO users VALUES (NULL, 'anadaisy', 'ana', 'ana@gmail.com', 'https://farm5.staticflickr.com/4026/4654109388_465c99f66f.jpg', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'); --1234
INSERT INTO categories VALUES (NULL, 'PHP');
INSERT INTO categories VALUES (NULL, 'HTML');
INSERT INTO categories VALUES (NULL, 'Javascript');
INSERT INTO lists VALUES (NULL, 'Projeto LTW', 2);
INSERT INTO lists VALUES (NULL, 'Projeto LAIG', 1);
INSERT INTO todos VALUES (NULL, 'Fazer Landing Page', '2017-11-27', -1, 1);
INSERT INTO todos VALUES (NULL, 'Mostrar os Todos', '2017-11-27', -1, 1);
INSERT INTO todos VALUES (NULL, 'Fazer tudo bonito', '2017-11-27', -1, 1);
INSERT INTO todos VALUES (NULL, 'Fazer Animações', '2018-01-01', -1, 2);
INSERT INTO hasItems VALUES (1,1);
INSERT INTO hasItems VALUES (1,2);
INSERT INTO hasItems VALUES (1,3);
INSERT INTO hasItems VALUES (2,4);
INSERT INTO belongs VALUES (1,1);
INSERT INTO belongs VALUES (1,2);
INSERT INTO belongs VALUES (2,1);
INSERT INTO hasCategories VALUES (1,1);
INSERT INTO hasCategories VALUES (1,2);
INSERT INTO hasCategories VALUES (2,3);*/