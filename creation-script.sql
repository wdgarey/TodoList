#DROP DATABASE todolist;
CREATE DATABASE todolist;

#CREATE USER 'todolistwebuser'@'localhost' IDENTIFIED BY 'todolistwebuser1234';
GRANT SELECT, UPDATE, INSERT, DELETE ON todolist.* TO 'todolistwebuser'@'localhost';

USE todolist;

CREATE TABLE todolist.user
(
	id int UNSIGNED NOT NULL UNIQUE AUTO_INCREMENT,
	username varchar(32) NOT NULL,
	pwd varchar(40) NOT NULL,
	CONSTRAINT USER_PK PRIMARY KEY (username)
) ENGINE=InnoDB;

CREATE TABLE todolist.task
(
	id int UNSIGNED NOT NULL UNIQUE AUTO_INCREMENT,
	title varchar(40) NOT NULL,
	description text NOT NULL,
	completed date,
	deadline date,
	CONSTRAINT TASK_PK PRIMARY KEY (id)
) ENGINE=InnoDB;

INSERT INTO user (id, username, pwd)
VALUES
(1, 'wesley', Sha1('pimp99')),
(2, 'victoria', Sha1('1234'));
