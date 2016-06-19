#DROP DATABASE todolist;
CREATE DATABASE todolist;

#CREATE USER 'appuser'@'localhost' IDENTIFIED BY 'appuser123';
GRANT SELECT, UPDATE, INSERT, DELETE ON todolist.* TO 'appuser'@'localhost';

USE todolist;

CREATE TABLE user
(
	id int UNSIGNED NOT NULL UNIQUE AUTO_INCREMENT,
	username varchar(32) NOT NULL,
	pwd varchar(40) NOT NULL,
	CONSTRAINT USER_PK PRIMARY KEY (username)
) ENGINE=InnoDB;

CREATE TABLE task
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
(1, 'wdgarey', Sha1('pimp99'));