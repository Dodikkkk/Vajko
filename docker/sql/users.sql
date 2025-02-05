CREATE TABLE `users` (
 `user_id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
 `name` varchar(32) NOT NULL,
 `password` varchar(61) NOT NULL,
 `is_admin` int not null
);

create table activities
(
    id       int auto_increment primary key,
    user_id  int    not null,
    movie_id int    not null,
    rating   double null,
    date     varchar(24) not null,
    foreign key (user_id) references users (user_id) on delete cascade
);

create table movies
(
    id int auto_increment primary key,
    title varchar(150),
    synopsis longtext,
    image varchar(96),
    runtime int,
    release_date varchar(24),
    rating float,
    genres varchar(96),
    director varchar(96),
    trailer varchar(96)
);

create table actors
(
    actor_id int auto_increment primary key,
    name varchar(96),
    image varchar(96)
);

create table relations
(
    actor_id int not null,
    movie_id int not null,
    primary key (actor_id, movie_id),
    foreign key (actor_id) references actors (actor_id),
    foreign key (movie_id) references movies (id)
);

create table updateHistory
(
    zaznam datetime primary key not null
);

insert into users (name, password, is_admin) VALUES ('admin', '$2a$10$QrDXixROcz5azNGyYOnA1uoBs3Q/qlVd56Uqtp6eEvS9nuO1FOW/m', 1);
