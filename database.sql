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

CREATE TABLE `reviews` (
  `id` int(11) not null,
  `user_id` int(11) not null,
  `shop_id` int(11) not null,
  `title` varchar(255) not null,
  `body` text not null,
  `score` int(11) not null,
  `created` datetime not null,
  `updated` datetime not null
) ENGINE=InnoDB;

ALTER TABLE `reviews`
ADD PRIMARY KEY (`id`);

ALTER TABLE `reviews`
MODIFY `id` int(11) not null AUTO_INCREMENT;

ALTER TABLE `reviews`
ADD KEY `user_id` (`user_id`),
ADD KEY `shop_id` (`shop_id`);

ALTER TABLE `reviews`
ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`),
ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
