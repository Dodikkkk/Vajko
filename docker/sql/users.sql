CREATE TABLE `users` (
 `user_id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
 `name` varchar(32) NOT NULL,
 `password` varchar(96) NOT NULL
);

insert into users (name, password) VALUES ('admin', 'admin');

#TODO hashovanie hesiel