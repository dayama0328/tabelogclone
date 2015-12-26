create table `shops` (
  `id` int(11) not null,
  `name` varchar(255) not null,
  `tel` varchar(100) not null,
  `addr` varchar(255) not null,
  `url` varchar(255) not null,
  `created` datetime not null,
  `updated` datetime not null
)  ENGINE=InnoDB;

ALTER TABLE `shops`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `shops`
 MODIFY `id` int(11) not null AUTO_INCREMENT;


CREATE TABLE `users` (
  `id` int(11) not null,
  `email` varchar(255) not null,
  `password` varchar(100) not null,
  `created` datetime not null,
  `updated` datetime not null
) ENGINE=InnoDB;

ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
 MODIFY `id` int(11) not null AUTO_INCREMENT;