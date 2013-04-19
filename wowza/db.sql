CREATE TABLE log ( 
	`id` int(10) unsigned NOT NULL auto_increment,
	`copy` tinyint(1) NOT NULL,
	`ftp` tinyint(1) NOT NULL,
	`upload` tinyint(1) NOT NULL,
	`create` int(10) NOT NULL,
	`file` varchar(255) NOT NULL,
	PRIMARY KEY  (id)
) ENGINE=MyISAM;

CREATE TABLE file ( 
	`id` int(10) unsigned NOT NULL auto_increment,
	`file` varchar(255) NOT NULL,
	`create` int(10) NOT NULL,
	PRIMARY KEY  (id)
) ENGINE=MyISAM;
