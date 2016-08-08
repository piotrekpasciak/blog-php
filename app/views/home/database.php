<?php

$connection = new Database;

$connection->mysqli->query("CREATE TABLE `users` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`username` varchar(25) NOT NULL,
`email` varchar(25) NOT NULL,
`password` varchar(128) NOT NULL,
`role_id` int(11) NOT NULL,
PRIMARY KEY (`id`),
KEY `user_id` (`role_id`),
CONSTRAINT `roles_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
UNIQUE KEY `username_UNIQUE` (`username`),
UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1");

$connection->mysqli->query("CREATE TABLE `comments` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`text` varchar(128) NOT NULL,
`created_at` datetime NOT NULL,
`post_id` int(11) NOT NULL,
`user_id` int(11) NULL,
PRIMARY KEY (`id`),
KEY `post_id` (`post_id`),
KEY `user_id` (`user_id`),
CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1");

$connection->mysqli->query("CREATE TABLE `posts` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`title` varchar(128) NOT NULL,
`text` text NOT NULL,
`image` varchar(256) NOT NULL,
`created_at` datetime NOT NULL,
`category_id` int(11) NOT NULL,
`user_id` int(11) NOT NULL,
PRIMARY KEY (`id`),
KEY `category_id` (`category_id`),
KEY `user_id` (`user_id`),
CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1");

$connection->mysqli->query("CREATE TABLE `categories` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(64) NOT NULL,
PRIMARY KEY (`id`),
UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1");

$connection->mysqli->query("CREATE TABLE `roles` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(64) NOT NULL,
PRIMARY KEY (`id`),
UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1");

$connection->mysqli->query("INSERT INTO `roles`(`name`) VALUES (\"User\")");

$connection->mysqli->query("
INSERT INTO `roles`(`name`) VALUES (\"Admin\")");

$connection->mysqli->query("INSERT INTO USERS (username, email, password, role_id) VALUES ('admin','admin@test.com','123',(SELECT ID FROM ROLES WHERE NAME = 'Admin'))");

$connection->mysqli->query("INSERT INTO USERS (username, email, password, role_id) VALUES ('Piotr','piotrek.pasciak@test.com','123',(SELECT ID FROM ROLES WHERE NAME = 'Admin'))");
