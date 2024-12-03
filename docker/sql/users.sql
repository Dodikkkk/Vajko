CREATE TABLE `users` (
 `user_id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
 `name` varchar(32) NOT NULL,
 `password` varchar(96) NOT NULL
);

create table activities
(
    id       int auto_increment primary key,
    user_id  int    not null,
    movie_id int    not null,
    rating   double null
);


insert into users (name, password) VALUES ('admin', 'admin');
