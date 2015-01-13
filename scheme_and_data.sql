DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `login` varchar(255) NOT NULL DEFAULT '',
    `name` varchar(255) NOT NULL DEFAULT '',
    `password` varchar(255) NOT NULL DEFAULT '',
    PRIMARY KEY (`id`),
    UNIQUE (`login`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

insert into `users` values
(1, 'user1', 'Алиса', 'fcea920f7412b5da7be0cf42b8c93759'),
(2, 'user2', 'Белый кролик', 'fcea920f7412b5da7be0cf42b8c93759'),
(3, 'user3', 'Чеширский Кот', 'fcea920f7412b5da7be0cf42b8c93759');

DROP TABLE IF EXISTS `messages`;

CREATE TABLE `messages` (
    `id` bigint(20) NOT NULL AUTO_INCREMENT,
    `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
    `sender_id` int(11) NOT NULL DEFAULT '0',
    `receiver_id` int(11) NOT NULL DEFAULT '0',
    `text` text NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
