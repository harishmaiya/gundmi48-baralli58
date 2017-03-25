CREATE TABLE `bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_item` int(20) NOT NULL DEFAULT '0',
  `the_date` date NOT NULL DEFAULT '0000-00-00',
  `id_state` int(11) NOT NULL DEFAULT '0',
  `id_booking` int(10) NOT NULL DEFAULT '0',
  `PropId` varchar(255) NOT NULL,
  `price` float(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_item` (`id_item`),
  KEY `id_state` (`id_state`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;INSERT INTO bookings VALUES("1","1","2016-09-01","1","0","1","0.00");INSERT INTO bookings VALUES("2","1","2016-09-02","1","0","1","0.00");INSERT INTO bookings VALUES("3","1","2016-09-03","1","0","1","0.00");INSERT INTO bookings VALUES("4","1","2016-09-06","1","0","1","0.00");INSERT INTO bookings VALUES("5","1","2016-09-07","1","0","1","0.00");INSERT INTO bookings VALUES("6","1","2016-09-08","1","0","1","0.00");INSERT INTO bookings VALUES("7","1","2016-08-30","1","0","1","0.00");INSERT INTO bookings VALUES("8","1","2016-08-31","1","0","1","0.00");INSERT INTO bookings VALUES("9","1","2016-09-13","1","0","1","0.00");INSERT INTO bookings VALUES("10","1","2016-09-14","1","0","1","0.00");INSERT INTO bookings VALUES("11","1","2016-09-20","1","0","1","0.00");INSERT INTO bookings VALUES("12","1","2016-09-21","1","0","1","0.00");INSERT INTO bookings VALUES("13","1","2016-09-22","1","0","1","0.00");INSERT INTO bookings VALUES("14","1","2016-09-23","1","0","1","0.00");INSERT INTO bookings VALUES("15","1","2016-09-24","1","0","1","0.00");INSERT INTO bookings VALUES("16","1","2016-09-25","1","0","1","0.00");INSERT INTO bookings VALUES("17","1","2016-09-26","1","0","1","0.00");INSERT INTO bookings VALUES("18","1","2016-09-27","1","0","1","0.00");INSERT INTO bookings VALUES("19","1","2016-09-28","1","0","1","0.00");CREATE TABLE `bookings_admin_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` tinyint(1) NOT NULL DEFAULT '2',
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `date_visit` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `visits` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;INSERT INTO bookings_admin_users VALUES("1","1","admin","fe01ce2a7fbac8fafaed7c982a04e229","1","2014-01-03 16:23:49","2");CREATE TABLE `bookings_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `num_months` tinyint(3) NOT NULL DEFAULT '3',
  `default_lang` varchar(6) NOT NULL DEFAULT 'en',
  `theme` varchar(50) NOT NULL DEFAULT 'default',
  `start_day` enum('mon','sun') NOT NULL DEFAULT 'sun',
  `date_format` enum('us','eu') NOT NULL DEFAULT 'eu',
  `click_past_dates` enum('on','off') NOT NULL DEFAULT 'off',
  `cal_url` varchar(255) NOT NULL DEFAULT '',
  `local_path` varchar(255) NOT NULL DEFAULT '/calendar',
  `version` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;INSERT INTO bookings_config VALUES("1","Availability Calendar","6","en","default","sun","eu","off","http://192.168.1.251:8081/renters/Renters2.1/","/calendar","v3.03.07");CREATE TABLE `bookings_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL DEFAULT '1',
  `id_ref_external` int(11) NOT NULL COMMENT 'link to external db table',
  `desc_en` varchar(100) NOT NULL DEFAULT '',
  `desc_es` varchar(100) NOT NULL DEFAULT '',
  `list_order` int(11) NOT NULL DEFAULT '0',
  `state` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_ref_external` (`id_ref_external`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;INSERT INTO bookings_items VALUES("1","1","0","Demo Item","Demo","1","1");CREATE TABLE `bookings_last_update` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_item` int(10) NOT NULL DEFAULT '0',
  `date_mod` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `id_item` (`id_item`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;INSERT INTO bookings_last_update VALUES("1","1","2014-01-21 10:38:03");CREATE TABLE `bookings_states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc_en` varchar(100) NOT NULL DEFAULT '',
  `desc_es` varchar(100) NOT NULL DEFAULT '',
  `code` varchar(10) NOT NULL DEFAULT '',
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `list_order` int(11) NOT NULL DEFAULT '0',
  `class` varchar(30) NOT NULL DEFAULT '',
  `show_in_key` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;INSERT INTO bookings_states VALUES("1","Booked","Reservado","b","1","0","booked","1");INSERT INTO bookings_states VALUES("4","Unavailable","Unavailable","pr","1","3","booked_pr","1");CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;CREATE TABLE `contactus` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `message` text NOT NULL,
  `security_code` varchar(20) NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;INSERT INTO contactus VALUES("1","dsfsd","fsdfsd@resf","sdfsdf","sdf","","2016-05-30 22:47:24");CREATE TABLE `country_code` (
  `Country` varchar(80) NOT NULL,
  `Code` varchar(80) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;CREATE TABLE `fc_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `admin_name` varchar(24) NOT NULL,
  `admin_password` varchar(500) NOT NULL,
  `email` varchar(5000) NOT NULL,
  `dropbox_email` varchar(500) NOT NULL,
  `dropbox_password` varchar(500) NOT NULL,
  `admin_type` enum('super','sub') NOT NULL DEFAULT 'super',
  `privileges` text NOT NULL,
  `last_login_date` datetime NOT NULL,
  `last_logout_date` datetime NOT NULL,
  `last_login_ip` varchar(16) NOT NULL,
  `is_verified` enum('No','Yes') NOT NULL,
  `site_pagination_per_page` int(20) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `twilio_account_sid` varchar(1000) NOT NULL,
  `twilio_account_token` varchar(1000) NOT NULL,
  `twilio_phone_number` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;INSERT INTO fc_admin VALUES("1","2016-02-11","2016-06-30","admin","21232f297a57a5a743894a0e4a801fc3","muthukrishnan@teamtweaks.com","","","super","","2016-09-19 10:10:19","2016-09-15 07:19:35","192.168.1.55","Yes","20","Active","ACd41cea54df7a442694d70c09939fa93f","8e1e357aedc95563c01b677380c5f972","+13475149838");CREATE TABLE `fc_admin_settings` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `dropbox_email` varchar(500) NOT NULL,
  `dropbox_password` varchar(500) NOT NULL,
  `site_contact_mail` varchar(200) NOT NULL,
  `site_contact_number` varchar(50) NOT NULL,
  `email_title` varchar(400) NOT NULL,
  `google_verification` varchar(500) NOT NULL,
  `google_verification_code` longtext NOT NULL,
  `google_redirect_url_db` varchar(120) NOT NULL,
  `facebook_link` varchar(200) NOT NULL,
  `twitter_link` varchar(100) NOT NULL,
  `tumblr_link` text NOT NULL,
  `instagram_link` text NOT NULL,
  `snapchat_link` text NOT NULL,
  `pinterest` varchar(500) NOT NULL,
  `googleplus_link` varchar(100) NOT NULL,
  `linkedin_link` varchar(500) NOT NULL,
  `rss_link` varchar(500) NOT NULL,
  `youtube_link` varchar(500) NOT NULL,
  `footer_content` varchar(255) NOT NULL,
  `logo_image` varchar(255) NOT NULL,
  `home_logo_image` varchar(255) NOT NULL,
  `background_image` varchar(255) NOT NULL,
  `videoUrl` varchar(200) NOT NULL,
  `currency_type` varchar(20) NOT NULL,
  `slider` enum('on','off') NOT NULL DEFAULT 'off',
  `meta_title` varchar(100) NOT NULL,
  `meta_keyword` varchar(150) NOT NULL,
  `meta_description` mediumtext NOT NULL,
  `fevicon_image` varchar(255) NOT NULL,
  `watermark` varchar(255) NOT NULL,
  `facebook_api` varchar(100) NOT NULL,
  `facebook_secret_key` varchar(100) NOT NULL,
  `paypal_api_name` varchar(100) NOT NULL,
  `paypal_api_pw` varchar(100) NOT NULL,
  `paypal_api_key` varchar(100) NOT NULL,
  `authorize_net_key` varchar(100) NOT NULL,
  `paypal_id` varchar(500) NOT NULL,
  `paypal_live` enum('1','2') NOT NULL,
  `smtp_port` int(200) NOT NULL,
  `smtp_uname` varchar(200) NOT NULL,
  `smtp_password` varchar(200) NOT NULL,
  `consumer_key` varchar(500) NOT NULL,
  `consumer_secret` varchar(500) NOT NULL,
  `google_client_secret` varchar(500) NOT NULL,
  `google_client_id` varchar(500) NOT NULL,
  `google_redirect_url` varchar(500) NOT NULL,
  `google_redirect_url_connect` varchar(100) NOT NULL,
  `google_developer_key` varchar(500) NOT NULL,
  `linkedin_app_id` varchar(50) NOT NULL,
  `linkedin_app_id1` varchar(120) NOT NULL,
  `linkedin_app_key1` varchar(80) NOT NULL,
  `linkedin_app_key` varchar(50) NOT NULL,
  `facebook_app_id` text NOT NULL,
  `facebook_app_secret` text NOT NULL,
  `like_text` mediumtext NOT NULL,
  `unlike_text` mediumtext NOT NULL,
  `liked_text` mediumtext NOT NULL,
  `banner_text` varchar(1000) NOT NULL,
  `site_pagination_per_page` int(20) NOT NULL,
  `twilio_account_sid` varchar(1000) NOT NULL,
  `twilio_account_token` varchar(1000) NOT NULL,
  `twilio_phone_number` varchar(1000) NOT NULL,
  `google_map_api` text NOT NULL,
  `home_title_1` varchar(250) NOT NULL,
  `home_title_2` varchar(250) NOT NULL,
  `home_title_3` varchar(200) NOT NULL,
  `home_title_4` varchar(200) NOT NULL,
  `s3_bucket_name` varchar(130) NOT NULL,
  `s3_access_key` varchar(132) NOT NULL,
  `s3_secret_key` varchar(250) NOT NULL,
  `instagram` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;INSERT INTO fc_admin_settings VALUES("1","","","muthukrishnan@teamtweaks.com","","Renters","","","","https://fb.com","https://twitter.com","","","","https://in.pinterest.com/","https://google.com","","","https://youtube.com","Copyright 2016. Renters. All rights reserved.","admin_logo.png","renters-landing-logo3.png","bg22.jpg","https://www.youtube.com/embed/TmDKbUrSYxQ","USD","on","Renters","Renters","Renters","favicon1.png","favicon2.png","","","","","","","","","0","","","","","Vs3K8gdo_KwCoVVhkT4j38cv","664360393494-62f9726trsh73ggkdfgbbrkdmlb1516u.apps.googleusercontent.com","","","AIzaSyC1Ne5KQt8vMgEioY-aaqexOAwF60lN-9","","","","","","","Like","Unlike","Like\'d","","20","ACd41cea54df7a442694d70c09939fa93f","8e1e357aedc95563c01b677380c5f972","+13475149838","AIzaSyAPG1EM5hpOkE3ZnGeT6EqBKd4xI1cQrac","","","","","","","","");CREATE TABLE `fc_attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attribute_name` varchar(500) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `attribute_seourl` varchar(500) NOT NULL,
  `attribute_title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;INSERT INTO fc_attribute VALUES("1","Amenities","Active","2015-08-12 14:44:14","amenities","Common amenities at most Hosts listings.");INSERT INTO fc_attribute VALUES("4","Extras","Active","2015-03-16 15:51:41","extras","");INSERT INTO fc_attribute VALUES("5","Special Features","Active","2016-08-30 12:16:17","specialfeatures","Features of your listing for guests with specific needs.");CREATE TABLE `fc_banner_category` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` mediumtext NOT NULL,
  `image` mediumtext NOT NULL,
  `link` mediumtext NOT NULL,
  `status` enum('Publish','Unpublish') NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;INSERT INTO fc_banner_category VALUES("5","Nursery","nursery.jpg","","Publish","2013-09-24 22:13:07");INSERT INTO fc_banner_category VALUES("6","Season Indoors","season-indoors.jpg","","Publish","2013-09-24 22:13:17");CREATE TABLE `fc_booking` (
  `id` int(11) NOT NULL,
  `From_date` datetime NOT NULL,
  `To_date` datetime NOT NULL,
  `prd_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `Details` varchar(300) CHARACTER SET utf8 NOT NULL,
  `NoofGuest` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;CREATE TABLE `fc_category` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(500) NOT NULL,
  `rootID` int(20) NOT NULL,
  `seourl` varchar(255) NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  `cat_position` int(11) NOT NULL,
  `seo_title` longblob NOT NULL,
  `seo_keyword` longblob NOT NULL,
  `seo_description` longblob NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;INSERT INTO fc_category VALUES("1","","0","","","Active","0","","","","2014-10-31 13:12:15");CREATE TABLE `fc_cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `countryid` int(11) NOT NULL,
  `stateid` int(11) NOT NULL,
  `state_code` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL,
  `contid` varchar(50) NOT NULL,
  `seourl` varchar(250) NOT NULL,
  `status` enum('InActive','Active') NOT NULL,
  `featured` enum('0','1') NOT NULL,
  `description` longblob NOT NULL,
  `meta_title` varchar(1000) NOT NULL,
  `meta_keyword` varchar(1000) NOT NULL,
  `meta_description` blob NOT NULL,
  `citylogo` varchar(1000) NOT NULL,
  `citythumb` varchar(1000) NOT NULL,
  `neighborhoods` varchar(1000) NOT NULL,
  `tags` varchar(1000) NOT NULL,
  `short_description` varchar(1000) NOT NULL,
  `latitude` varchar(1000) NOT NULL,
  `longitude` varchar(1000) NOT NULL,
  `get_around` varchar(1000) NOT NULL,
  `known_for` varchar(1000) NOT NULL,
  `view_order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=449 DEFAULT CHARSET=utf8;INSERT INTO fc_cities VALUES("1","95","860","","chennai","","chennai","Active","0","","","","","","","0","","","37.77264","-122.40992","","","0");INSERT INTO fc_cities VALUES("436","215","43","","New york","","new-york","Active","1","","New York - Renters","","","1432131783-new-york-city111.jpg","new-york-city111.jpg","0","","","40.71278","-74.00594","","","0");INSERT INTO fc_cities VALUES("3","145","4","TRG","Al Muktatfi Bil","","al-muktatfi-bil","Active","0","","","","","1436762897-10988494_10153063739605309_3582694735587706984_n.jpg","10988494_10153063739605309_3582694735587706984_n.jpg","0","","","4.61990","103.20890","","","0");INSERT INTO fc_cities VALUES("4","145","0","MLK","Alor Gajah","","alor-gajah","Active","0","","","","","","","","","","2.3618","102.2215","","","0");INSERT INTO fc_cities VALUES("5","145","0","KDH","Alor Setar","","alor-setar","Active","0","","","","","","","","","","6.1063","100.3685","","","0");INSERT INTO fc_cities VALUES("6","145","0","KDH","Alor Star","","alor-star","Active","0","","","","","","","","","","6.1194","100.3677","","","0");INSERT INTO fc_cities VALUES("7","145","0","SGR","Ampang","","ampang","Active","0","","","","","","","","","","3.1549","101.7412","","","0");INSERT INTO fc_cities VALUES("8","145","0","PLS","Arau","","arau","Active","0","","","","","","","","","","6.4246","100.2736","","","0");INSERT INTO fc_cities VALUES("9","145","0","MLK","Asahan","","asahan","Active","0","","","","","","","","","","2.38","102.4819","","","0");INSERT INTO fc_cities VALUES("10","145","0","SRW","Asajaya","","asajaya","Active","0","","","","","","","","","","1.5424","110.516","","","0");INSERT INTO fc_cities VALUES("11","145","0","JHR","Ayer Baloi","","ayer-baloi","Active","0","","","","","","","","","","1.6927","103.2524","","","0");INSERT INTO fc_cities VALUES("12","145","0","JHR","Ayer Hitam","","ayer-hitam","Active","0","","","","","","","","","","1.9032","103.2165","","","0");INSERT INTO fc_cities VALUES("13","145","0","PNG","Ayer Itam","","ayer-itam","Active","0","","","","","","","","","","5.3681","100.305","","","0");INSERT INTO fc_cities VALUES("14","145","0","MLK","Ayer Keroh","","ayer-keroh","Active","0","","","","","","","","","","2.2872","102.2759","","","0");INSERT INTO fc_cities VALUES("15","145","0","KTN","Ayer Lanas","","ayer-lanas","Active","0","","","","","","","","","","5.8142","101.9253","","","0");INSERT INTO fc_cities VALUES("16","145","0","PRK","Ayer Tawar","","ayer-tawar","Active","0","","","","","","","","","","4.3674","100.8604","","","0");INSERT INTO fc_cities VALUES("17","145","0","JHR","Ayer Tawar 3","","ayer-tawar-3","Active","0","","","","","","","","","","1.721","103.8967","","","0");INSERT INTO fc_cities VALUES("18","215","18","KTN","Miami ","","miami","Active","0","","","","","1432130738-miami+skyrise+tower111.jpg","miami+skyrise+tower111.jpg","0","","","25.76168","-80.19179","","","0");INSERT INTO fc_cities VALUES("19","145","0","PRK","Bagan Datoh","","bagan-datoh","Active","0","","","","","","","","","","3.9793","100.7593","","","0");INSERT INTO fc_cities VALUES("20","145","0","PRK","Bagan Serai","","bagan-serai","Active","0","","","","","","","","","","4.8687","100.6968","","","0");INSERT INTO fc_cities VALUES("21","145","0","NSN","Bahau","","bahau","Active","0","","","","","","","","","","2.8199","102.2934","","","0");INSERT INTO fc_cities VALUES("22","145","0","PNG","Balik Pulau","","balik-pulau","Active","0","","","","","","","","","","5.352","100.2824","","","0");INSERT INTO fc_cities VALUES("23","145","0","KDH","Baling","","baling","Active","0","","","","","","","","","","5.7229","100.7831","","","0");INSERT INTO fc_cities VALUES("24","145","0","SRW","Balingian","","balingian","Active","0","","","","","","","","","","2.2248","111.6044","","","0");INSERT INTO fc_cities VALUES("25","145","0","PHG","Balok","","balok","Active","0","","","","","","","","","","3.912","103.3298","","","0");INSERT INTO fc_cities VALUES("26","145","0","KDH","Bandar Baharu","","bandar-baharu","Active","0","","","","","","","","","","5.1873","100.5156","","","0");INSERT INTO fc_cities VALUES("27","145","0","KDH","Bandar Bahru","","bandar-bahru","Active","0","","","","","","","","","","5.6564","100.5422","","","0");INSERT INTO fc_cities VALUES("28","145","0","SGR","Bandar Baru Ban","","bandar-baru-ban","Active","0","","","","","","","","","","2.9918","101.7455","","","0");INSERT INTO fc_cities VALUES("29","145","0","NSN","Bandar Baru Ens","","bandar-baru-ens","Active","0","","","","","","","","","","2.7526","101.7667","","","0");INSERT INTO fc_cities VALUES("30","145","0","JHR","Bandar Penawar","","bandar-penawar","Active","0","","","","","","","","","","1.6712","103.9725","","","0");INSERT INTO fc_cities VALUES("31","145","0","SGR","Bandar Puncak A","","bandar-puncak-a","Active","0","","","","","","","","","","3.1682","101.5271","","","0");INSERT INTO fc_cities VALUES("32","145","0","PHG","Bandar Pusat  J","","bandar-pusat-j","Active","0","","","","","","","","","","3.7416","102.5443","","","0");INSERT INTO fc_cities VALUES("33","145","0","PHG","Bandar Pusat Je","","bandar-pusat-je","Active","0","","","","","","","","","","3.6739","102.5212","","","0");INSERT INTO fc_cities VALUES("34","145","0","PRK","Bandar Seri Isk","","bandar-seri-isk","Active","0","","","","","","","","","","4.3587","100.9673","","","0");INSERT INTO fc_cities VALUES("35","145","0","NSN","Bandar Seri Jem","","bandar-seri-jem","Active","0","","","","","","","","","","2.8299","102.2531","","","0");INSERT INTO fc_cities VALUES("36","145","0","JHR","Bandar Tenggara","","bandar-tenggara","Active","0","","","","","","","","","","1.7876","103.6699","","","0");INSERT INTO fc_cities VALUES("37","145","0","PHG","Bandar Tun Abdu","","bandar-tun-abdu","Active","0","","","","","","","","","","2.9499","102.6818","","","0");INSERT INTO fc_cities VALUES("38","145","0","SGR","Bangi","","bangi","Active","0","","","","","","","","","","2.9271","101.7802","","","0");INSERT INTO fc_cities VALUES("39","145","0","SGR","Banting","","banting","Active","0","","","","","","","","","","2.9092","101.5279","","","0");INSERT INTO fc_cities VALUES("40","145","0","SRW","Baram","","baram","Active","0","","","","","","","","","","2.0768","112.3837","","","0");INSERT INTO fc_cities VALUES("41","145","0","SGR","Batang Berjunta","","batang-berjunta","Active","0","","","","","","","","","","3.3036","101.46","","","0");INSERT INTO fc_cities VALUES("42","145","0","SGR","Batang Kali","","batang-kali","Active","0","","","","","","","","","","3.3751","101.6306","","","0");INSERT INTO fc_cities VALUES("43","145","0","JHR","Batu Anam","","batu-anam","Active","0","","","","","","","","","","2.4247","102.8497","","","0");INSERT INTO fc_cities VALUES("44","215","43","KUL","Newark","","newark","Active","1","","","","","1432131688-NYC_Buildings1.jpg","NYC_Buildings1.jpg","0","","","43.04673","-77.09525","","","0");INSERT INTO fc_cities VALUES("45","145","0","PNG","Batu Ferringhi","","batu-ferringhi","Active","0","","","","","","","","","","5.4452","100.2911","","","0");INSERT INTO fc_cities VALUES("46","145","0","PRK","Batu Gajah","","batu-gajah","Active","0","","","","","","","","","","4.4422","101.0546","","","0");INSERT INTO fc_cities VALUES("47","145","0","NSN","Batu Kikir","","batu-kikir","Active","0","","","","","","","","","","2.8352","102.2086","","","0");INSERT INTO fc_cities VALUES("48","145","0","PRK","Batu Kurau","","batu-kurau","Active","0","","","","","","","","","","4.9553","100.8398","","","0");INSERT INTO fc_cities VALUES("49","145","0","PNG","Batu Maung","","batu-maung","Active","0","","","","","","","","","","5.355","100.2709","","","0");INSERT INTO fc_cities VALUES("50","145","0","JHR","Batu Pahat","","batu-pahat","Active","0","","","","","","","","","","1.8578","103.0357","","","0");INSERT INTO fc_cities VALUES("51","145","0","SRW","Bau","","bau","Active","0","","","","","","","","","","1.4813","110.1013","","","0");INSERT INTO fc_cities VALUES("52","145","0","PNG","Bayan Lepas","","bayan-lepas","Active","0","","","","","","","","","","5.3163","100.281","","","0");INSERT INTO fc_cities VALUES("53","145","0","SBH","Beaufort","","beaufort","Active","0","","","","","","","","","","5.3452","115.7078","","","0");INSERT INTO fc_cities VALUES("54","145","0","KDH","Bedong","","bedong","Active","0","","","","","","","","","","5.7879","100.4719","","","0");INSERT INTO fc_cities VALUES("55","145","0","PRK","Behrang Stesen","","behrang-stesen","Active","0","","","","","","","","","","3.889","101.4121","","","0");INSERT INTO fc_cities VALUES("56","145","0","SRW","Bekenu","","bekenu","Active","0","","","","","","","","","","4.0678","113.8315","","","0");INSERT INTO fc_cities VALUES("57","145","0","JHR","Bekok","","bekok","Active","0","","","","","","","","","","2.1332","103.4663","","","0");INSERT INTO fc_cities VALUES("58","145","0","SRW","Belaga","","belaga","Active","0","","","","","","","","","","2.4811","113.6292","","","0");INSERT INTO fc_cities VALUES("59","145","0","SRW","Belawai","","belawai","Active","0","","","","","","","","","","1.9636","111.0947","","","0");INSERT INTO fc_cities VALUES("60","145","0","SBH","Beluran","","beluran","Active","0","","","","","","","","","","5.9945","117.3361","","","0");INSERT INTO fc_cities VALUES("61","145","0","PHG","Benta","","benta","Active","0","","","","","","","","","","3.9583","102.1692","","","0");INSERT INTO fc_cities VALUES("62","145","0","PHG","Bentong","","bentong","Active","0","","","","","","","","","","3.5281","101.9763","","","0");INSERT INTO fc_cities VALUES("63","145","0","JHR","Benut","","benut","Active","0","","","","","","","","","","1.6864","103.2713","","","0");INSERT INTO fc_cities VALUES("64","145","0","SGR","Beranang","","beranang","Active","0","","","","","","","","","","2.952","101.8261","","","0");INSERT INTO fc_cities VALUES("65","145","0","SRW","Betong","","betong","Active","0","","","","","","","","","","1.5038","111.4675","","","0");INSERT INTO fc_cities VALUES("66","145","0","SBH","Beverly","","beverly","Active","0","","","","","","","","","","5.4204","116.7968","","","0");INSERT INTO fc_cities VALUES("67","145","0","PRK","Bidor","","bidor","Active","0","","","","","","","","","","4.1787","101.2265","","","0");INSERT INTO fc_cities VALUES("68","145","0","SRW","Bintangor","","bintangor","Active","0","","","","","","","","","","2.2244","111.5791","","","0");INSERT INTO fc_cities VALUES("69","145","0","SRW","Bintulu","","bintulu","Active","0","","","","","","","","","","2.6262","112.1367","","","0");INSERT INTO fc_cities VALUES("70","145","0","SBH","Bongawan","","bongawan","Active","0","","","","","","","","","","5.4835","115.7834","","","0");INSERT INTO fc_cities VALUES("71","145","0","PHG","Brinchang","","brinchang","Active","0","","","","","","","","","","4.3557","101.6275","","","0");INSERT INTO fc_cities VALUES("72","145","0","PRK","Bruas","","bruas","Active","0","","","","","","","","","","4.7499","100.837","","","0");INSERT INTO fc_cities VALUES("73","145","0","TRG","Bukit Besi","","bukit-besi","Active","0","","","","","","","","","","5.0395","102.7909","","","0");INSERT INTO fc_cities VALUES("74","145","0","PHG","Bukit Fraser","","bukit-fraser","Active","0","","","","","","","","","","3.7188","101.7403","","","0");INSERT INTO fc_cities VALUES("75","145","0","JHR","Bukit Gambir","","bukit-gambir","Active","0","","","","","","","","","","2.1437","102.8537","","","0");INSERT INTO fc_cities VALUES("76","145","0","PHG","Bukit Goh","","bukit-goh","Active","0","","","","","","","","","","3.7793","102.9106","","","0");INSERT INTO fc_cities VALUES("77","145","0","KDH","Bukit Kayu Hita","","bukit-kayu-hita","Active","0","","","","","","","","","","6.3493","100.4429","","","0");INSERT INTO fc_cities VALUES("78","145","0","PNG","Bukit Mertajam","","bukit-mertajam","Active","0","","","","","","","","","","5.3344","100.4673","","","0");INSERT INTO fc_cities VALUES("79","145","0","JHR","Bukit Pasir","","bukit-pasir","Active","0","","","","","","","","","","2.1122","102.7617","","","0");INSERT INTO fc_cities VALUES("80","145","0","TRG","Bukit Payong","","bukit-payong","Active","0","","","","","","","","","","5.2321","103.1041","","","0");INSERT INTO fc_cities VALUES("81","145","0","SGR","Bukit Rotan","","bukit-rotan","Active","0","","","","","","","","","","3.1956","101.3926","","","0");INSERT INTO fc_cities VALUES("82","145","0","PNG","Butterworth","","butterworth","Active","0","","","","","","","","","","5.4093","100.3649","","","0");INSERT INTO fc_cities VALUES("83","145","0","TRG","Ceneh","","ceneh","Active","0","","","","","","","","","","4.1373","103.2476","","","0");INSERT INTO fc_cities VALUES("84","145","0","JHR","Chaah","","chaah","Active","0","","","","","","","","","","2.0491","103.1443","","","0");INSERT INTO fc_cities VALUES("85","145","0","TRG","Chalok","","chalok","Active","0","","","","","","","","","","5.3867","102.8676","","","0");INSERT INTO fc_cities VALUES("86","145","0","PRK","Changkat Jering","","changkat-jering","Active","0","","","","","","","","","","4.7067","100.832","","","0");INSERT INTO fc_cities VALUES("87","145","0","PRK","Changkat Keruin","","changkat-keruin","Active","0","","","","","","","","","","4.2702","100.8909","","","0");INSERT INTO fc_cities VALUES("88","145","0","PRK","Chemor","","chemor","Active","0","","","","","","","","","","4.7281","101.12","","","0");INSERT INTO fc_cities VALUES("89","145","0","PRK","Chenderiang","","chenderiang","Active","0","","","","","","","","","","4.3111","101.2339","","","0");INSERT INTO fc_cities VALUES("90","145","0","PRK","Chenderong Bala","","chenderong-bala","Active","0","","","","","","","","","","4.2992","101.0101","","","0");INSERT INTO fc_cities VALUES("91","145","0","PHG","Chenor","","chenor","Active","0","","","","","","","","","","3.5018","102.6455","","","0");INSERT INTO fc_cities VALUES("92","145","0","KTN","Cherang Ruku","","cherang-ruku","Active","0","","","","","","","","","","5.8722","102.4363","","","0");INSERT INTO fc_cities VALUES("93","145","0","KUL","Cheras","","cheras","Active","0","","","","","","","","","","3.1056","101.7253","","","0");INSERT INTO fc_cities VALUES("94","145","0","PRK","Chikus","","chikus","Active","0","","","","","","","","","","4.3082","101.0173","","","0");INSERT INTO fc_cities VALUES("95","145","0","PHG","Chini","","chini","Active","0","","","","","","","","","","3.2106","103.0223","","","0");INSERT INTO fc_cities VALUES("96","145","0","TRG","Cukai","","cukai","Active","0","","","","","","","0","","","4.33050","103.35200","","","0");INSERT INTO fc_cities VALUES("97","145","0","SGR","Cyberjaya","","cyberjaya","Active","0","","","","","","","","","","2.9679","101.653","","","0");INSERT INTO fc_cities VALUES("98","145","0","KTN","Dabong","","dabong","Active","0","","","","","","","","","","5.4938","102.0523","","","0");INSERT INTO fc_cities VALUES("99","145","0","SRW","Dalat","","dalat","Active","0","","","","","","","","","","2.2853","111.9027","","","0");INSERT INTO fc_cities VALUES("100","215","57","PHG","Houston","","houston","Active","1","","","","","1432131090-houston-wallpaper-hd1.jpg","houston-wallpaper-hd1.jpg","0","","","29.76043","-95.36980","","","0");INSERT INTO fc_cities VALUES("101","145","0","SRW","Daro","","daro","Active","0","","","","","","","","","","2.5321","111.5253","","","0");INSERT INTO fc_cities VALUES("102","145","0","SRW","Debak","","debak","Active","0","","","","","","","","","","1.5775","111.2168","","","0");INSERT INTO fc_cities VALUES("103","145","0","SGR","Dengkil","","dengkil","Active","0","","","","","","","","","","2.9686","101.652","","","0");INSERT INTO fc_cities VALUES("104","145","0","PHG","Dong","","dong","Active","0","","","","","","","","","","3.8834","101.983","","","0");INSERT INTO fc_cities VALUES("105","145","0","TRG","Dungun","","dungun","Active","0","","","","","","","","","","4.8168","103.3036","","","0");INSERT INTO fc_cities VALUES("106","145","0","MLK","Durian Tunggal","","durian-tunggal","Active","0","","","","","","","","","","2.3013","102.2842","","","0");INSERT INTO fc_cities VALUES("107","145","0","JHR","Endau","","endau","Active","0","","","","","","","","","","2.5415","103.542","","","0");INSERT INTO fc_cities VALUES("108","145","0","PRK","Enggor","","enggor","Active","0","","","","","","","","","","4.8218","100.946","","","0");INSERT INTO fc_cities VALUES("109","145","0","SRW","Engkilili","","engkilili","Active","0","","","","","","","","","","1.2817","110.9074","","","0");INSERT INTO fc_cities VALUES("110","145","0","PHG","Gambang","","gambang","Active","0","","","","","","","","","","3.7444","103.1378","","","0");INSERT INTO fc_cities VALUES("111","145","0","JHR","Gelang Patah","","gelang-patah","Active","0","","","","","","","","","","1.4619","103.5857","","","0");INSERT INTO fc_cities VALUES("112","145","0","PNG","Gelugor","","gelugor","Active","0","","","","","","","","","","5.3653","100.3067","","","0");INSERT INTO fc_cities VALUES("113","145","0","NSN","Gemas","","gemas","Active","0","","","","","","","","","","2.6637","102.5259","","","0");INSERT INTO fc_cities VALUES("114","145","0","NSN","Gemencheh","","gemencheh","Active","0","","","","","","","","","","2.6213","102.3113","","","0");INSERT INTO fc_cities VALUES("115","145","0","PHG","Genting Highlan","","genting-highlan","Active","0","","","","","","","","","","3.422","101.7892","","","0");INSERT INTO fc_cities VALUES("116","145","0","PRK","Gerik","","gerik","Active","0","","","","","","","","","","5.2806","101.1007","","","0");INSERT INTO fc_cities VALUES("117","145","0","JHR","Gerisek","","gerisek","Active","0","","","","","","","","","","2.215","102.7854","","","0");INSERT INTO fc_cities VALUES("118","145","0","PRK","Gopeng","","gopeng","Active","0","","","","","","","","","","4.5193","101.1153","","","0");INSERT INTO fc_cities VALUES("119","145","0","KTN","Gua Musang","","gua-musang","Active","0","","","","","","","","","","5.0356","102.0247","","","0");INSERT INTO fc_cities VALUES("120","145","0","JHR","Gugusan Taib An","","gugusan-taib-an","Active","0","","","","","","","","","","1.7601","103.6852","","","0");INSERT INTO fc_cities VALUES("121","145","0","KDH","Gurun","","gurun","Active","0","","","","","","","","","","5.8064","100.5136","","","0");INSERT INTO fc_cities VALUES("122","145","0","SGR","Hulu Langat","","hulu-langat","Active","0","","","","","","","","","","3.0719","101.8347","","","0");INSERT INTO fc_cities VALUES("123","145","0","PRK","Hutan Melintang","","hutan-melintang","Active","0","","","","","","","","","","4.0333","100.9471","","","0");INSERT INTO fc_cities VALUES("124","145","0","SBH","Inanam","","inanam","Active","0","","","","","","","","","","5.9933","116.1322","","","0");INSERT INTO fc_cities VALUES("125","145","0","PRK","Intan","","intan","Active","0","","","","","","","","","","5.4297","101.0342","","","0");INSERT INTO fc_cities VALUES("126","145","0","PRK","Ipoh","","ipoh","Active","0","","","","","","","","","","4.6502","101.0682","","","0");INSERT INTO fc_cities VALUES("127","145","0","MLK","Jasin","","jasin","Active","0","","","","","","","","","","2.2933","102.4146","","","0");INSERT INTO fc_cities VALUES("128","145","0","PHG","Jaya Gading","","jaya-gading","Active","0","","","","","","","","","","3.8173","103.1733","","","0");INSERT INTO fc_cities VALUES("129","145","0","KTN","Jeli","","jeli","Active","0","","","","","","","","","","5.728","101.9225","","","0");INSERT INTO fc_cities VALUES("130","145","0","PNG","Jelutong","","jelutong","Active","0","","","","","","","","","","5.3956","100.3111","","","0");INSERT INTO fc_cities VALUES("131","145","0","JHR","Jementah","","jementah","Active","0","","","","","","","","","","2.1737","102.9493","","","0");INSERT INTO fc_cities VALUES("132","145","0","KDH","Jeniang","","jeniang","Active","0","","","","","","","","","","5.8343","100.6252","","","0");INSERT INTO fc_cities VALUES("133","145","0","SGR","Jenjarom","","jenjarom","Active","0","","","","","","","","","","2.9723","101.5282","","","0");INSERT INTO fc_cities VALUES("134","145","0","PRK","Jeram","","jeram","Active","0","","","","","","","","","","4.3641","101.1539","","","0");INSERT INTO fc_cities VALUES("135","145","0","PHG","Jerantut","","jerantut","Active","0","","","","","","","","","","3.868","102.4271","","","0");INSERT INTO fc_cities VALUES("136","145","0","TRG","Jerteh","","jerteh","Active","0","","","","","","","","","","5.6111","102.5729","","","0");INSERT INTO fc_cities VALUES("137","145","0","KDH","Jitra","","jitra","Active","0","","","","","","","","","","6.1316","100.4351","","","0");INSERT INTO fc_cities VALUES("138","145","0","NSN","Johol","","johol","Active","0","","","","","","","","","","2.6182","102.2701","","","0");INSERT INTO fc_cities VALUES("139","145","0","JHR","Johor Bahru","","johor-bahru","Active","0","","","","","","","","","","1.5035","103.7405","","","0");INSERT INTO fc_cities VALUES("140","145","0","SRW","Julau","","julau","Active","0","","","","","","","","","","1.783","111.9699","","","0");INSERT INTO fc_cities VALUES("141","145","0","SRW","Kabong","","kabong","Active","0","","","","","","","","","","1.8453","111.4252","","","0");INSERT INTO fc_cities VALUES("142","145","0","JHR","Kahang","","kahang","Active","0","","","","","","","","","","2.1504","103.5336","","","0");INSERT INTO fc_cities VALUES("143","145","0","SGR","Kajang","","kajang","Active","0","","","","","","","","","","3.0094","101.7755","","","0");INSERT INTO fc_cities VALUES("144","145","0","PLS","Kaki Bukit","","kaki-bukit","Active","0","","","","","","","","","","6.6472","100.2022","","","0");INSERT INTO fc_cities VALUES("145","145","0","PRK","Kampar","","kampar","Active","0","","","","","","","","","","4.3551","101.1252","","","0");INSERT INTO fc_cities VALUES("146","145","0","PRK","Kampung Gajah","","kampung-gajah","Active","0","","","","","","","","","","4.3923","100.9307","","","0");INSERT INTO fc_cities VALUES("147","145","0","PRK","Kampung Kepayan","","kampung-kepayan","Active","0","","","","","","","","","","4.5595","101.0673","","","0");INSERT INTO fc_cities VALUES("148","145","0","TRG","Kampung Raja","","kampung-raja","Active","0","","","","","","","","","","5.7332","102.613","","","0");INSERT INTO fc_cities VALUES("149","145","0","PRK","Kamunting","","kamunting","Active","0","","","","","","","","","","4.8263","100.7717","","","0");INSERT INTO fc_cities VALUES("150","145","0","PLS","Kangar","","kangar","Active","0","","","","","","","","","","6.4312","100.2056","","","0");INSERT INTO fc_cities VALUES("151","145","0","SRW","Kanowit","","kanowit","Active","0","","","","","","","","","","1.9416","112.0866","","","0");INSERT INTO fc_cities VALUES("152","145","0","SGR","Kapar","","kapar","Active","0","","","","","","","","","","3.1331","101.4207","","","0");INSERT INTO fc_cities VALUES("153","145","0","SRW","Kapit","","kapit","Active","0","","","","","","","","","","1.9499","113.1692","","","0");INSERT INTO fc_cities VALUES("154","145","0","PHG","Karak","","karak","Active","0","","","","","","","","","","3.4339","102.1543","","","0");INSERT INTO fc_cities VALUES("155","145","0","KDH","Karangan","","karangan","Active","0","","","","","","","","","","5.5748","100.6005","","","0");INSERT INTO fc_cities VALUES("156","145","0","KTN","Kem Desa Pahlaw","","kem-desa-pahlaw","Active","0","","","","","","","","","","5.8938","102.2273","","","0");INSERT INTO fc_cities VALUES("157","145","0","MLK","Kem Trendak","","kem-trendak","Active","0","","","","","","","","","","2.2891","102.3256","","","0");INSERT INTO fc_cities VALUES("158","145","0","TRG","Kemasek","","kemasek","Active","0","","","","","","","","","","4.62","103.353","","","0");INSERT INTO fc_cities VALUES("159","145","0","PHG","Kemayan","","kemayan","Active","0","","","","","","","","","","3.251","102.5593","","","0");INSERT INTO fc_cities VALUES("160","145","0","SBH","Keningau","","keningau","Active","0","","","","","","","","","","5.3561","116.3049","","","0");INSERT INTO fc_cities VALUES("161","145","0","KDH","Kepala Batas","","kepala-batas","Active","0","","","","","","","","","","5.9661","100.4734","","","0");INSERT INTO fc_cities VALUES("162","145","0","SGR","Kerling","","kerling","Active","0","","","","","","","","","","3.5566","101.5612","","","0");INSERT INTO fc_cities VALUES("163","145","0","TRG","Kerteh","","kerteh","Active","0","","","","","","","","","","4.6985","103.3568","","","0");INSERT INTO fc_cities VALUES("164","145","0","TRG","Ketengah Jaya","","ketengah-jaya","Active","0","","","","","","","","","","4.4348","103.3763","","","0");INSERT INTO fc_cities VALUES("165","145","0","KTN","Ketereh","","ketereh","Active","0","","","","","","","","","","5.9179","102.2274","","","0");INSERT INTO fc_cities VALUES("166","145","0","TRG","Kijal","","kijal","Active","0","","","","","","","","","","4.436","103.4175","","","0");INSERT INTO fc_cities VALUES("167","145","0","SGR","Klang","","klang","Active","0","","","","","","","","","","3.0349","101.5119","","","0");INSERT INTO fc_cities VALUES("168","145","0","SGR","KLIA","","klia","Active","0","","","","","","","","","","2.8239","101.687","","","0");INSERT INTO fc_cities VALUES("169","145","0","JHR","Kluang","","kluang","Active","0","","","","","","","","","","1.9226","103.4038","","","0");INSERT INTO fc_cities VALUES("170","145","0","KDH","Kodiang","","kodiang","Active","0","","","","","","","","","","6.2045","100.3746","","","0");INSERT INTO fc_cities VALUES("171","145","0","NSN","Kota","","kota","Active","0","","","","","","","","","","2.5231","102.1388","","","0");INSERT INTO fc_cities VALUES("172","145","0","KTN","Kota Bahru","","kota-bahru","Active","0","","","","","","","","","","6.122","102.2523","","","0");INSERT INTO fc_cities VALUES("173","145","0","SBH","Kota Belud","","kota-belud","Active","0","","","","","","","","","","6.3463","116.4665","","","0");INSERT INTO fc_cities VALUES("174","145","0","KTN","Kota Bharu","","kota-bharu","Active","0","","","","","","","","","","6.1253","102.2461","","","0");INSERT INTO fc_cities VALUES("175","145","0","SBH","Kota Kinabalu","","kota-kinabalu","Active","0","","","","","","","","","","5.8626","115.9946","","","0");INSERT INTO fc_cities VALUES("176","145","0","SBH","Kota Kinabatang","","kota-kinabatang","Active","0","","","","","","","","","","5.2438","117.4841","","","0");INSERT INTO fc_cities VALUES("177","145","0","KDH","Kota Kuala Muda","","kota-kuala-muda","Active","0","","","","","","","","","","5.7405","100.4243","","","0");INSERT INTO fc_cities VALUES("178","145","0","SBH","Kota Marudu","","kota-marudu","Active","0","","","","","","","","","","6.5407","116.8224","","","0");INSERT INTO fc_cities VALUES("179","145","0","SRW","Kota Samarahan","","kota-samarahan","Active","0","","","","","","","","","","1.4727","110.402","","","0");INSERT INTO fc_cities VALUES("180","145","0","KDH","Kota Sarang Sem","","kota-sarang-sem","Active","0","","","","","","","","","","5.9008","100.4089","","","0");INSERT INTO fc_cities VALUES("181","145","0","JHR","Kota Tinggi","","kota-tinggi","Active","0","","","","","","","","","","1.7427","103.7788","","","0");INSERT INTO fc_cities VALUES("182","145","0","KTN","Kuala Balah","","kuala-balah","Active","0","","","","","","","","","","5.4526","101.9212","","","0");INSERT INTO fc_cities VALUES("183","145","0","TRG","Kuala Berang","","kuala-berang","Active","0","","","","","","","","","","5.1048","102.9733","","","0");INSERT INTO fc_cities VALUES("184","145","0","TRG","Kuala Besut","","kuala-besut","Active","0","","","","","","","","","","5.7998","102.5579","","","0");INSERT INTO fc_cities VALUES("185","145","0","PRK","Kuala Kangsar","","kuala-kangsar","Active","0","","","","","","","","","","4.7073","100.9381","","","0");INSERT INTO fc_cities VALUES("186","145","0","KDH","Kuala Kedah","","kuala-kedah","Active","0","","","","","","","","","","5.9919","100.3635","","","0");INSERT INTO fc_cities VALUES("187","145","0","KDH","Kuala Ketil","","kuala-ketil","Active","0","","","","","","","","","","5.6747","100.6754","","","0");INSERT INTO fc_cities VALUES("188","145","0","NSN","Kuala Klawang","","kuala-klawang","Active","0","","","","","","","","","","2.9555","102.0719","","","0");INSERT INTO fc_cities VALUES("189","145","0","KTN","Kuala Krai","","kuala-krai","Active","0","","","","","","","","","","5.5693","102.1786","","","0");INSERT INTO fc_cities VALUES("190","145","0","PHG","Kuala Krau","","kuala-krau","Active","0","","","","","","","","","","3.6237","102.456","","","0");INSERT INTO fc_cities VALUES("191","145","0","SGR","Kuala Kubu Baru","","kuala-kubu-baru","Active","0","","","","","","","","","","3.386","101.5488","","","0");INSERT INTO fc_cities VALUES("192","145","0","PRK","Kuala Kurau","","kuala-kurau","Active","0","","","","","","","","","","4.9211","100.5186","","","0");INSERT INTO fc_cities VALUES("193","145","0","PHG","Kuala Lipis","","kuala-lipis","Active","0","","","","","","","","","","4.0629","102.1071","","","0");INSERT INTO fc_cities VALUES("194","215","62","KUL","Seattle","","seattle","Active","1","","","","","1432131243-seattle-21.jpg","seattle-21.jpg","0","","","47.60621","-122.33207","","","0");INSERT INTO fc_cities VALUES("195","145","0","KDH","Kuala Nerang","","kuala-nerang","Active","0","","","","","","","","","","6.1461","100.5833","","","0");INSERT INTO fc_cities VALUES("196","145","0","KDH","Kuala Pegang","","kuala-pegang","Active","0","","","","","","","","","","5.7874","100.6923","","","0");INSERT INTO fc_cities VALUES("197","145","0","SBH","Kuala Penyu","","kuala-penyu","Active","0","","","","","","","","","","5.4894","115.5347","","","0");INSERT INTO fc_cities VALUES("198","145","0","PLS","Kuala Perlis","","kuala-perlis","Active","0","","","","","","","","","","6.2683","100.2088","","","0");INSERT INTO fc_cities VALUES("199","145","0","NSN","Kuala Pilah","","kuala-pilah","Active","0","","","","","","","","","","2.7226","102.2138","","","0");INSERT INTO fc_cities VALUES("200","145","0","PHG","Kuala Rompin","","kuala-rompin","Active","0","","","","","","","","","","2.9496","103.4089","","","0");INSERT INTO fc_cities VALUES("201","145","0","SGR","Kuala Selangor","","kuala-selangor","Active","0","","","","","","","","","","3.2457","101.3678","","","0");INSERT INTO fc_cities VALUES("202","145","0","PRK","Kuala Sepetang","","kuala-sepetang","Active","0","","","","","","","","","","4.9204","100.6607","","","0");INSERT INTO fc_cities VALUES("203","145","0","MLK","Kuala Sungai Ba","","kuala-sungai-ba","Active","0","","","","","","","","","","2.33","102.0961","","","0");INSERT INTO fc_cities VALUES("204","145","0","TRG","Kuala Terenggan","","kuala-terenggan","Active","0","","","","","","","","","","5.2847","103.1475","","","0");INSERT INTO fc_cities VALUES("205","145","0","PHG","Kuantan","","kuantan","Active","0","","","","","","","","","","3.8099","103.2893","","","0");INSERT INTO fc_cities VALUES("206","145","0","PNG","Kubang Semang","","kubang-semang","Active","0","","","","","","","","","","5.4088","100.4837","","","0");INSERT INTO fc_cities VALUES("207","145","865","SRW","Kuching","","kuching","InActive","0","","","","","1434493639-12.jpg","12.jpg","0","","","1.54550","110.34390","","","0");INSERT INTO fc_cities VALUES("208","145","0","SBH","Kudat","","kudat","Active","0","","","","","","","","","","6.8298","116.8867","","","0");INSERT INTO fc_cities VALUES("209","145","0","JHR","Kukup","","kukup","Active","0","","","","","","","","","","1.423","103.4425","","","0");INSERT INTO fc_cities VALUES("210","145","0","JHR","Kulai","","kulai","Active","0","","","","","","","","","","1.7259","103.5011","","","0");INSERT INTO fc_cities VALUES("211","145","0","KDH","Kulim","","kulim","Active","0","","","","","","","","","","5.4724","100.5385","","","0");INSERT INTO fc_cities VALUES("212","145","0","SBH","Kunak","","kunak","Active","0","","","","","","","","","","4.677","118.1392","","","0");INSERT INTO fc_cities VALUES("213","145","0","KDH","Kupang","","kupang","Active","0","","","","","","","","","","5.6818","100.758","","","0");INSERT INTO fc_cities VALUES("214","145","0","JHR","Labis","","labis","Active","0","","","","","","","","","","2.2604","103.5458","","","0");INSERT INTO fc_cities VALUES("215","145","0","NSN","Labu","","labu","Active","0","","","","","","","","","","2.7339","101.8927","","","0");INSERT INTO fc_cities VALUES("216","145","0","LBN","Labuan","","labuan","Active","0","","","","","","","","","","5.296","115.2429","","","0");INSERT INTO fc_cities VALUES("217","145","0","SBH","Lahad Datu","","lahad-datu","Active","0","","","","","","","","","","5.0434","118.346","","","0");INSERT INTO fc_cities VALUES("218","145","0","PRK","Lambor Kanan","","lambor-kanan","Active","0","","","","","","","","","","4.385","100.9163","","","0");INSERT INTO fc_cities VALUES("219","145","0","PHG","Lanchang","","lanchang","Active","0","","","","","","","","","","3.5547","102.265","","","0");INSERT INTO fc_cities VALUES("220","145","0","KDH","Langgar","","langgar","Active","0","","","","","","","","","","6.0479","100.407","","","0");INSERT INTO fc_cities VALUES("221","145","0","PRK","Langkap","","langkap","Active","0","","","","","","","","","","4.2015","101.0814","","","0");INSERT INTO fc_cities VALUES("222","145","0","KDH","Langkawi","","langkawi","Active","0","","","","","","","","","","6.2439","99.9533","","","0");INSERT INTO fc_cities VALUES("223","145","0","SRW","Lawas","","lawas","Active","0","","","","","","","","","","3.9117","114.0909","","","0");INSERT INTO fc_cities VALUES("224","145","0","JHR","Layang-Layang","","layang-layang","Active","0","","","","","","","","","","1.7832","103.4388","","","0");INSERT INTO fc_cities VALUES("225","145","0","PRK","Lenggong","","lenggong","Active","0","","","","","","","","","","4.9846","100.973","","","0");INSERT INTO fc_cities VALUES("226","145","0","SBH","Likas","","likas","Active","0","","","","","","","","","","6.008","116.1256","","","0");INSERT INTO fc_cities VALUES("227","145","0","SRW","Limbang","","limbang","Active","0","","","","","","","","","","4.1371","114.6005","","","0");INSERT INTO fc_cities VALUES("228","145","0","SRW","Lingga","","lingga","Active","0","","","","","","","","","","1.3306","111.1952","","","0");INSERT INTO fc_cities VALUES("229","145","0","NSN","Linggi","","linggi","Active","0","","","","","","","","","","2.5272","102.026","","","0");INSERT INTO fc_cities VALUES("230","145","0","SRW","Long Lama","","long-lama","Active","0","","","","","","","","","","3.9671","114.2984","","","0");INSERT INTO fc_cities VALUES("231","145","0","SRW","Lubok Antu","","lubok-antu","Active","0","","","","","","","","","","1.2548","111.6771","","","0");INSERT INTO fc_cities VALUES("232","145","0","MLK","Lubok China","","lubok-china","Active","0","","","","","","","","","","2.4326","102.1127","","","0");INSERT INTO fc_cities VALUES("233","145","0","PRK","Lumut","","lumut","Active","0","","","","","","","","","","4.317","100.7977","","","0");INSERT INTO fc_cities VALUES("234","145","0","KDH","Lunas","","lunas","Active","0","","","","","","","","","","5.5071","100.5589","","","0");INSERT INTO fc_cities VALUES("235","145","0","SRW","Lundu","","lundu","Active","0","","","","","","","","","","1.6733","109.8363","","","0");INSERT INTO fc_cities VALUES("236","145","0","PHG","Lurah Bilut","","lurah-bilut","Active","0","","","","","","","","","","3.6623","101.9202","","","0");INSERT INTO fc_cities VALUES("237","145","0","SRW","Lutong","","lutong","Active","0","","","","","","","","","","4.4803","114.0108","","","0");INSERT INTO fc_cities VALUES("238","145","0","KTN","Machang","","machang","Active","0","","","","","","","","","","5.7573","102.2168","","","0");INSERT INTO fc_cities VALUES("239","145","0","PRK","Malim Nawar","","malim-nawar","Active","0","","","","","","","","","","4.3844","101.1174","","","0");INSERT INTO fc_cities VALUES("240","145","0","PRK","Mambang Di Awan","","mambang-di-awan","Active","0","","","","","","","","","","4.4423","101.1131","","","0");INSERT INTO fc_cities VALUES("241","145","0","PRK","Manong","","manong","Active","0","","","","","","","","","","4.6523","100.8827","","","0");INSERT INTO fc_cities VALUES("242","145","0","NSN","Mantin","","mantin","Active","0","","","","","","","","","","2.8078","101.9088","","","0");INSERT INTO fc_cities VALUES("243","145","0","TRG","Marang","","marang","Active","0","","","","","","","","","","5.2424","103.126","","","0");INSERT INTO fc_cities VALUES("244","145","0","JHR","Masai","","masai","Active","0","","","","","","","","","","1.5558","103.7616","","","0");INSERT INTO fc_cities VALUES("245","145","0","MLK","Masjid Tanah","","masjid-tanah","Active","0","","","","","","","","","","2.3301","102.1472","","","0");INSERT INTO fc_cities VALUES("246","145","0","PRK","Matang","","matang","Active","0","","","","","","","","","","4.7804","100.7247","","","0");INSERT INTO fc_cities VALUES("247","145","0","SRW","Matu","","matu","Active","0","","","","","","","","","","2.6413","111.4437","","","0");INSERT INTO fc_cities VALUES("248","145","0","MLK","Melaka","","melaka","Active","0","","","","","","","","","","2.2019","102.2518","","","0");INSERT INTO fc_cities VALUES("249","145","0","KTN","Melor","","melor","Active","0","","","","","","","","","","5.92","102.2742","","","0");INSERT INTO fc_cities VALUES("250","145","0","SBH","Membakut","","membakut","Active","0","","","","","","","","","","5.5243","115.6889","","","0");INSERT INTO fc_cities VALUES("251","145","0","PHG","Mentakab","","mentakab","Active","0","","","","","","","","","","3.5435","102.3122","","","0");INSERT INTO fc_cities VALUES("252","145","0","SBH","Menumbok","","menumbok","Active","0","","","","","","","","","","5.3398","115.3766","","","0");INSERT INTO fc_cities VALUES("253","145","0","KDH","Merbok","","merbok","Active","0","","","","","","","","","","5.7262","100.4529","","","0");INSERT INTO fc_cities VALUES("254","145","0","MLK","Merlimau","","merlimau","Active","0","","","","","","","","","","2.198","102.3718","","","0");INSERT INTO fc_cities VALUES("255","145","0","JHR","Mersing","","mersing","Active","0","","","","","","","","","","2.3043","103.7599","","","0");INSERT INTO fc_cities VALUES("256","145","0","SRW","Miri","","miri","Active","0","","","","","","","","","","4.2678","113.9692","","","0");INSERT INTO fc_cities VALUES("257","145","0","PHG","Muadzam Shah","","muadzam-shah","Active","0","","","","","","","","","","3.2041","102.8052","","","0");INSERT INTO fc_cities VALUES("258","145","0","JHR","Muar","","muar","Active","0","","","","","","","","","","2.0051","102.7335","","","0");INSERT INTO fc_cities VALUES("259","145","0","SRW","Mukah","","mukah","Active","0","","","","","","","","","","2.4118","112.0435","","","0");INSERT INTO fc_cities VALUES("260","145","0","SBH","Nabawan","","nabawan","Active","0","","","","","","","","","","4.7676","116.4017","","","0");INSERT INTO fc_cities VALUES("261","145","0","SRW","Nanga Medamit","","nanga-medamit","Active","0","","","","","","","","","","2.5574","113.0012","","","0");INSERT INTO fc_cities VALUES("262","145","0","SRW","Niah","","niah","Active","0","","","","","","","","","","3.195","112.6848","","","0");INSERT INTO fc_cities VALUES("263","145","0","PNG","Nibong Tebal","","nibong-tebal","Active","0","","","","","","","","","","5.2141","100.4518","","","0");INSERT INTO fc_cities VALUES("264","145","0","NSN","Nilai","","nilai","Active","0","","","","","","","","","","2.8093","101.8334","","","0");INSERT INTO fc_cities VALUES("265","145","0","JHR","Nusajaya","","nusajaya","Active","0","","","","","","","","","","1.5014","103.6439","","","0");INSERT INTO fc_cities VALUES("266","145","0","PLS","Padang Besar","","padang-besar","Active","0","","","","","","","","","","6.5341","100.31","","","0");INSERT INTO fc_cities VALUES("267","145","0","PRK","Padang Rengas","","padang-rengas","Active","0","","","","","","","","","","4.8174","100.8677","","","0");INSERT INTO fc_cities VALUES("268","145","0","KDH","Padang Serai","","padang-serai","Active","0","","","","","","","","","","5.5331","100.5534","","","0");INSERT INTO fc_cities VALUES("269","145","0","PHG","Padang Tengku","","padang-tengku","Active","0","","","","","","","","","","4.1907","102.0495","","","0");INSERT INTO fc_cities VALUES("270","145","0","JHR","Pagoh","","pagoh","Active","0","","","","","","","","","","2.087","102.8871","","","0");INSERT INTO fc_cities VALUES("271","145","0","TRG","Paka","","paka","Active","0","","","","","","","","","","4.7314","103.358","","","0");INSERT INTO fc_cities VALUES("272","145","0","JHR","Paloh","","paloh","Active","0","","","","","","","","","","2.1593","103.507","","","0");INSERT INTO fc_cities VALUES("273","145","0","SBH","Pamol","","pamol","Active","0","","","","","","","","","","6.0793","117.5024","","","0");INSERT INTO fc_cities VALUES("274","145","0","JHR","Panchor","","panchor","Active","0","","","","","","","","","","2.0423","102.9538","","","0");INSERT INTO fc_cities VALUES("275","145","0","PRK","Pangkor","","pangkor","Active","0","","","","","","","","","","4.2597","100.6095","","","0");INSERT INTO fc_cities VALUES("276","145","0","PRK","Pantai Remis","","pantai-remis","Active","0","","","","","","","","","","4.5708","100.6901","","","0");INSERT INTO fc_cities VALUES("277","145","0","SBH","Papar","","papar","Active","0","","","","","","","","","","5.5174","115.9036","","","0");INSERT INTO fc_cities VALUES("278","145","0","PRK","Parit","","parit","Active","0","","","","","","","","","","4.5504","100.9064","","","0");INSERT INTO fc_cities VALUES("279","145","0","PRK","Parit Buntar","","parit-buntar","Active","0","","","","","","","","","","4.907","100.6029","","","0");INSERT INTO fc_cities VALUES("280","145","0","JHR","Parit Jawa","","parit-jawa","Active","0","","","","","","","","","","1.9152","102.8197","","","0");INSERT INTO fc_cities VALUES("281","145","0","JHR","Parit Raja","","parit-raja","Active","0","","","","","","","","","","1.8605","103.1004","","","0");INSERT INTO fc_cities VALUES("282","145","0","JHR","Parit Sulong","","parit-sulong","Active","0","","","","","","","","","","1.9663","102.9015","","","0");INSERT INTO fc_cities VALUES("283","145","0","KTN","Pasir  Puteh","","pasir-puteh","Active","0","","","","","","","","","","5.876","102.3841","","","0");INSERT INTO fc_cities VALUES("284","145","0","JHR","Pasir Gudang","","pasir-gudang","Active","0","","","","","","","","","","1.5002","103.8273","","","0");INSERT INTO fc_cities VALUES("285","145","0","KTN","Pasir Mas","","pasir-mas","Active","0","","","","","","","","","","6.0129","102.1459","","","0");INSERT INTO fc_cities VALUES("286","145","0","PHG","Pekan","","pekan","Active","0","","","","","","","","","","3.5374","103.2801","","","0");INSERT INTO fc_cities VALUES("287","145","0","SGR","Pelabuhan Klang","","pelabuhan-klang","Active","0","","","","","","","","","","3.0186","101.4286","","","0");INSERT INTO fc_cities VALUES("288","145","0","PNG","Penaga","","penaga","Active","0","","","","","","","","","","5.4632","100.4027","","","0");INSERT INTO fc_cities VALUES("289","145","0","SBH","Penampang","","penampang","Active","0","","","","","","","","","","5.8883","116.1026","","","0");INSERT INTO fc_cities VALUES("290","145","0","PNG","Penang Hill","","penang-hill","Active","0","","","","","","","","","","5.418","100.2775","","","0");INSERT INTO fc_cities VALUES("291","145","0","KDH","Pendang","","pendang","Active","0","","","","","","","","","","5.9623","100.472","","","0");INSERT INTO fc_cities VALUES("292","145","0","JHR","Pengerang","","pengerang","Active","0","","","","","","","","","","1.4656","103.9435","","","0");INSERT INTO fc_cities VALUES("293","145","0","PRK","Pengkalan Hulu","","pengkalan-hulu","Active","0","","","","","","","","","","5.4731","101.0105","","","0");INSERT INTO fc_cities VALUES("294","145","0","PNG","Perai","","perai","Active","0","","","","","","","","","","5.3769","100.3848","","","0");INSERT INTO fc_cities VALUES("295","145","0","TRG","Permaisuri","","permaisuri","Active","0","","","","","","","","","","5.4698","102.8602","","","0");INSERT INTO fc_cities VALUES("296","145","0","PNG","Permatang Pauh","","permatang-pauh","Active","0","","","","","","","","","","5.3934","100.4107","","","0");INSERT INTO fc_cities VALUES("297","145","0","SGR","Petaling Jaya","","petaling-jaya","Active","0","","","","","","","","","","3.107","101.6305","","","0");INSERT INTO fc_cities VALUES("298","145","0","KDH","Pokok Sena","","pokok-sena","Active","0","","","","","","","","","","6.1542","100.5613","","","0");INSERT INTO fc_cities VALUES("299","145","0","JHR","Pontian","","pontian","Active","0","","","","","","","","","","1.5666","103.3873","","","0");INSERT INTO fc_cities VALUES("300","145","0","NSN","Port Dickson","","port-dickson","Active","0","","","","","","","","","","2.5932","101.8413","","","0");INSERT INTO fc_cities VALUES("301","145","0","SGR","Puchong","","puchong","Active","0","","","","","","","","","","3.0757","101.6198","","","0");INSERT INTO fc_cities VALUES("302","145","0","KTN","Pulai Chondong","","pulai-chondong","Active","0","","","","","","","","","","5.8908","102.2376","","","0");INSERT INTO fc_cities VALUES("303","145","0","SGR","Pulau Carey","","pulau-carey","Active","0","","","","","","","","","","2.8879","101.3913","","","0");INSERT INTO fc_cities VALUES("304","145","0","SGR","Pulau Ketam","","pulau-ketam","Active","0","","","","","","","","","","2.9555","101.3268","","","0");INSERT INTO fc_cities VALUES("305","145","0","PNG","Pulau Pinang","","pulau-pinang","Active","0","","","","","","","","","","5.4166","100.3305","","","0");INSERT INTO fc_cities VALUES("306","145","0","SRW","Pusa","","pusa","Active","0","","","","","","","","","","1.6097","111.4337","","","0");INSERT INTO fc_cities VALUES("307","145","0","NSN","Pusat  Bandar P","","pusat-bandar-p","Active","0","","","","","","","","","","2.7184","102.5765","","","0");INSERT INTO fc_cities VALUES("308","145","0","PRK","Pusing","","pusing","Active","0","","","","","","","","","","4.5117","100.9917","","","0");INSERT INTO fc_cities VALUES("309","145","0","SBH","Putatan","","putatan","Active","0","","","","","","","","","","5.4204","116.7968","","","0");INSERT INTO fc_cities VALUES("310","145","0","PJY","Putrajaya","","putrajaya","Active","0","","","","","","","","","","2.9264","101.6964","","","0");INSERT INTO fc_cities VALUES("311","145","0","SBH","Ranau","","ranau","Active","0","","","","","","","","","","5.9589","116.6402","","","0");INSERT INTO fc_cities VALUES("312","145","0","NSN","Rantau","","rantau","Active","0","","","","","","","","","","2.589","101.9629","","","0");INSERT INTO fc_cities VALUES("313","145","0","KTN","Rantau Panjang","","rantau-panjang","Active","0","","","","","","","","","","5.9632","102.0073","","","0");INSERT INTO fc_cities VALUES("314","145","0","SGR","Rasa","","rasa","Active","0","","","","","","","","","","3.3861","101.6093","","","0");INSERT INTO fc_cities VALUES("315","145","0","PHG","Raub","","raub","Active","0","","","","","","","","","","3.7577","101.9827","","","0");INSERT INTO fc_cities VALUES("316","145","0","SGR","Rawang","","rawang","Active","0","","","","","","","","","","3.2549","101.5705","","","0");INSERT INTO fc_cities VALUES("317","145","0","NSN","Rembau","","rembau","Active","0","","","","","","","","","","2.5798","102.1108","","","0");INSERT INTO fc_cities VALUES("318","145","0","JHR","Rengam","","rengam","Active","0","","","","","","","","","","1.8498","103.3555","","","0");INSERT INTO fc_cities VALUES("319","145","0","JHR","Rengit","","rengit","Active","0","","","","","","","","","","1.664","103.2453","","","0");INSERT INTO fc_cities VALUES("320","145","0","PHG","Ringlet","","ringlet","Active","0","","","","","","","","","","4.2961","101.5451","","","0");INSERT INTO fc_cities VALUES("321","145","0","SRW","Roban","","roban","Active","0","","","","","","","","","","1.8838","111.3155","","","0");INSERT INTO fc_cities VALUES("322","145","0","NSN","Rompin","","rompin","Active","0","","","","","","","","","","2.694","102.4612","","","0");INSERT INTO fc_cities VALUES("323","145","0","SGR","Sabak Bernam","","sabak-bernam","Active","0","","","","","","","","","","3.6254","101.0593","","","0");INSERT INTO fc_cities VALUES("324","145","0","SBH","Sandakan","","sandakan","Active","0","","","","","","","","","","5.848","117.9591","","","0");INSERT INTO fc_cities VALUES("325","145","0","SRW","Saratok","","saratok","Active","0","","","","","","","","","","1.6629","111.2076","","","0");INSERT INTO fc_cities VALUES("326","145","0","SRW","Sarikei","","sarikei","Active","0","","","","","","","","","","2.0455","111.5346","","","0");INSERT INTO fc_cities VALUES("327","145","0","PRK","Sauk","","sauk","Active","0","","","","","","","","","","4.8496","100.9456","","","0");INSERT INTO fc_cities VALUES("328","145","0","SRW","Sebauh","","sebauh","Active","0","","","","","","","","","","2.7811","112.6702","","","0");INSERT INTO fc_cities VALUES("329","145","0","SRW","Sebuyau","","sebuyau","Active","0","","","","","","","","","","1.3337","110.9275","","","0");INSERT INTO fc_cities VALUES("330","145","0","PHG","Sega","","sega","Active","0","","","","","","","","","","3.9817","101.9348","","","0");INSERT INTO fc_cities VALUES("331","145","0","JHR","Segamat","","segamat","Active","0","","","","","","","","","","2.3134","102.9786","","","0");INSERT INTO fc_cities VALUES("332","145","0","SGR","Sekinchan","","sekinchan","Active","0","","","","","","","","","","3.3788","101.2798","","","0");INSERT INTO fc_cities VALUES("333","145","0","PRK","Selama","","selama","Active","0","","","","","","","","","","4.829","100.8841","","","0");INSERT INTO fc_cities VALUES("334","145","0","MLK","Selandar","","selandar","Active","0","","","","","","","","","","2.384","102.3584","","","0");INSERT INTO fc_cities VALUES("335","145","0","PRK","Selekoh","","selekoh","Active","0","","","","","","","","","","3.9955","100.768","","","0");INSERT INTO fc_cities VALUES("336","145","0","KTN","Selising","","selising","Active","0","","","","","","","","","","5.8899","102.2958","","","0");INSERT INTO fc_cities VALUES("337","145","0","SGR","Semenyih","","semenyih","Active","0","","","","","","","","","","2.9982","101.8017","","","0");INSERT INTO fc_cities VALUES("338","145","0","JHR","Semerah","","semerah","Active","0","","","","","","","","","","1.9075","102.8813","","","0");INSERT INTO fc_cities VALUES("339","145","0","SBH","Semporna","","semporna","Active","0","","","","","","","","","","4.4363","118.5318","","","0");INSERT INTO fc_cities VALUES("340","145","0","JHR","Senai","","senai","Active","0","","","","","","","","","","1.6446","103.5973","","","0");INSERT INTO fc_cities VALUES("341","145","0","JHR","Senggarang","","senggarang","Active","0","","","","","","","","","","1.8138","103.0467","","","0");INSERT INTO fc_cities VALUES("342","145","0","SGR","Sepang","","sepang","Active","0","","","","","","","","","","2.9765","101.7067","","","0");INSERT INTO fc_cities VALUES("343","145","0","KDH","Serdang","","serdang","Active","0","","","","","","","","","","5.4765","100.5938","","","0");INSERT INTO fc_cities VALUES("344","145","0","NSN","Seremban","","seremban","Active","0","","","","","","","","","","2.8109","101.9012","","","0");INSERT INTO fc_cities VALUES("345","145","0","SGR","Serendah","","serendah","Active","0","","","","","","","","","","3.23","101.6374","","","0");INSERT INTO fc_cities VALUES("346","145","0","JHR","Seri Gading","","seri-gading","Active","0","","","","","","","","","","1.8197","103.2399","","","0");INSERT INTO fc_cities VALUES("347","145","0","SGR","Seri Kembangan","","seri-kembangan","Active","0","","","","","","","","","","3.0383","101.7094","","","0");INSERT INTO fc_cities VALUES("348","145","0","PRK","Seri Manjung","","seri-manjung","Active","0","","","","","","","","","","4.602","100.7979","","","0");INSERT INTO fc_cities VALUES("349","145","0","SRW","Serian","","serian","Active","0","","","","","","","","","","1.2438","110.2563","","","0");INSERT INTO fc_cities VALUES("350","145","0","KUL","Setapak","","setapak","Active","0","","","","","","","","","","3.1876","101.7102","","","0");INSERT INTO fc_cities VALUES("351","145","0","SGR","Shah Alam","","shah-alam","Active","0","","","","","","","","","","3.0797","101.5186","","","0");INSERT INTO fc_cities VALUES("352","145","0","NSN","Si Rusa","","si-rusa","Active","0","","","","","","","","","","2.5099","102.0049","","","0");INSERT INTO fc_cities VALUES("353","145","0","SRW","Sibu","","sibu","Active","0","","","","","","","","","","2.2086","111.6","","","0");INSERT INTO fc_cities VALUES("354","145","0","SRW","Siburan","","siburan","Active","0","","","","","","","","","","1.3148","110.3751","","","0");INSERT INTO fc_cities VALUES("355","145","0","KDH","Sik","","sik","Active","0","","","","","","","","","","5.8207","100.6951","","","0");INSERT INTO fc_cities VALUES("356","145","0","PRK","Simpang","","simpang","Active","0","","","","","","","","","","4.7183","100.7986","","","0");INSERT INTO fc_cities VALUES("357","145","0","PLS","Simpang Ampat","","simpang-ampat","Active","0","","","","","","","","","","6.3155","100.2026","","","0");INSERT INTO fc_cities VALUES("358","145","0","PRK","Simpang Ampat S","","simpang-ampat-s","Active","0","","","","","","","","","","4.9211","100.7084","","","0");INSERT INTO fc_cities VALUES("359","145","0","NSN","Simpang Durian","","simpang-durian","Active","0","","","","","","","","","","3.0168","102.1793","","","0");INSERT INTO fc_cities VALUES("360","145","0","KDH","Simpang Empat","","simpang-empat","Active","0","","","","","","","","","","6.013","100.4018","","","0");INSERT INTO fc_cities VALUES("361","145","0","NSN","Simpang Pertang","","simpang-pertang","Active","0","","","","","","","","","","3.018","102.3018","","","0");INSERT INTO fc_cities VALUES("362","145","0","JHR","Simpang Rengam","","simpang-rengam","Active","0","","","","","","","","","","1.881","103.3957","","","0");INSERT INTO fc_cities VALUES("363","145","0","SRW","Simunjan","","simunjan","Active","0","","","","","","","","","","1.2657","110.8125","","","0");INSERT INTO fc_cities VALUES("364","145","0","SBH","Sipitang","","sipitang","Active","0","","","","","","","","","","5.0331","115.5728","","","0");INSERT INTO fc_cities VALUES("365","145","0","PRK","Sitiawan","","sitiawan","Active","0","","","","","","","","","","4.3227","100.8021","","","0");INSERT INTO fc_cities VALUES("366","145","0","PRK","Slim River","","slim-river","Active","0","","","","","","","","","","4.0303","101.294","","","0");INSERT INTO fc_cities VALUES("367","145","0","SRW","Song","","song","Active","0","","","","","","","","","","1.735","112.533","","","0");INSERT INTO fc_cities VALUES("368","145","0","SRW","Spaoh","","spaoh","Active","0","","","","","","","","","","1.6533","111.5983","","","0");INSERT INTO fc_cities VALUES("369","145","0","SRW","Sri Aman","","sri-aman","Active","0","","","","","","","","","","1.3177","111.3894","","","0");INSERT INTO fc_cities VALUES("370","145","0","JHR","Sri Medan","","sri-medan","Active","0","","","","","","","","","","1.5084","103.7136","","","0");INSERT INTO fc_cities VALUES("371","145","0","SGR","Subang Airport","","subang-airport","Active","0","","","","","","","","","","3.1851","101.6275","","","0");INSERT INTO fc_cities VALUES("372","145","0","SGR","Subang Jaya","","subang-jaya","Active","0","","","","","","","","","","3.0542","101.5949","","","0");INSERT INTO fc_cities VALUES("373","145","0","SRW","Sundar","","sundar","Active","0","","","","","","","","","","3.9777","114.0651","","","0");INSERT INTO fc_cities VALUES("374","145","0","SGR","Sungai Ayer Taw","","sungai-ayer-taw","Active","0","","","","","","","","","","3.776","100.875","","","0");INSERT INTO fc_cities VALUES("375","145","0","SGR","Sungai Besar","","sungai-besar","Active","0","","","","","","","","","","3.5615","101.146","","","0");INSERT INTO fc_cities VALUES("376","145","0","SGR","Sungai Buloh","","sungai-buloh","Active","0","","","","","","","","","","3.1618","101.598","","","0");INSERT INTO fc_cities VALUES("377","145","0","PHG","Sungai Koyan","","sungai-koyan","Active","0","","","","","","","","","","4.1582","101.84","","","0");INSERT INTO fc_cities VALUES("378","145","0","PHG","Sungai Lembing","","sungai-lembing","Active","0","","","","","","","","","","3.8104","102.9129","","","0");INSERT INTO fc_cities VALUES("379","145","0","JHR","Sungai Mati","","sungai-mati","Active","0","","","","","","","","","","1.5141","103.7014","","","0");INSERT INTO fc_cities VALUES("380","145","0","SGR","Sungai Pelek","","sungai-pelek","Active","0","","","","","","","","","","2.8526","101.632","","","0");INSERT INTO fc_cities VALUES("381","145","0","KDH","Sungai Petani","","sungai-petani","Active","0","","","","","","","","","","5.6639","100.4902","","","0");INSERT INTO fc_cities VALUES("382","145","0","MLK","Sungai Rambai","","sungai-rambai","Active","0","","","","","","","","","","2.1368","102.5051","","","0");INSERT INTO fc_cities VALUES("383","145","0","MLK","Sungai Rambai\'","","sungai-rambai","Active","0","","","","","","","","","","2.1368","102.5051","","","0");INSERT INTO fc_cities VALUES("384","145","0","PRK","Sungai Siput","","sungai-siput","Active","0","","","","","","","","","","4.9134","101.0665","","","0");INSERT INTO fc_cities VALUES("385","145","0","PRK","Sungai Sumun","","sungai-sumun","Active","0","","","","","","","","","","4.0448","100.8621","","","0");INSERT INTO fc_cities VALUES("386","145","0","TRG","Sungai Tong","","sungai-tong","Active","0","","","","","","","","","","5.2448","102.8795","","","0");INSERT INTO fc_cities VALUES("387","145","0","MLK","Sungai Udang","","sungai-udang","Active","0","","","","","","","","","","2.2867","102.1406","","","0");INSERT INTO fc_cities VALUES("388","145","0","PRK","Sungkai","","sungkai","Active","0","","","","","","","","","","4.112","101.2529","","","0");INSERT INTO fc_cities VALUES("389","145","0","PRK","Taiping","","taiping","Active","0","","","","","","","","","","4.7969","100.7934","","","0");INSERT INTO fc_cities VALUES("390","145","0","SBH","Tambunan","","tambunan","Active","0","","","","","","","","","","5.6933","116.3797","","","0");INSERT INTO fc_cities VALUES("391","145","0","SBH","Tamparuli","","tamparuli","Active","0","","","","","","","","","","6.117","116.2675","","","0");INSERT INTO fc_cities VALUES("392","145","0","NSN","Tampin","","tampin","Active","0","","","","","","","","","","2.5687","102.1824","","","0");INSERT INTO fc_cities VALUES("393","145","0","KTN","Tanah Merah","","tanah-merah","Active","0","","","","","","","","","","5.7687","102.1201","","","0");INSERT INTO fc_cities VALUES("394","145","0","PHG","Tanah Rata","","tanah-rata","Active","0","","","","","","","","","","4.3972","101.4559","","","0");INSERT INTO fc_cities VALUES("395","145","0","JHR","Tangkak","","tangkak","Active","0","","","","","","","","","","2.1462","102.7848","","","0");INSERT INTO fc_cities VALUES("396","145","0","PNG","Tanjong Bungah","","tanjong-bungah","Active","0","","","","","","","","","","5.4515","100.2943","","","0");INSERT INTO fc_cities VALUES("397","145","0","NSN","Tanjong Ipoh","","tanjong-ipoh","Active","0","","","","","","","","","","2.73","102.1526","","","0");INSERT INTO fc_cities VALUES("398","145","0","SGR","Tanjong Karang","","tanjong-karang","Active","0","","","","","","","","","","3.316","101.3201","","","0");INSERT INTO fc_cities VALUES("399","145","0","MLK","Tanjong Kling","","tanjong-kling","Active","0","","","","","","","","","","2.2376","102.1588","","","0");INSERT INTO fc_cities VALUES("400","145","0","PRK","Tanjong Malim","","tanjong-malim","Active","0","","","","","","","","","","3.9159","101.3812","","","0");INSERT INTO fc_cities VALUES("401","145","0","PRK","Tanjong Piandan","","tanjong-piandan","Active","0","","","","","","","","","","4.9011","100.5731","","","0");INSERT INTO fc_cities VALUES("402","145","0","PRK","Tanjong Rambuta","","tanjong-rambuta","Active","0","","","","","","","","","","4.5601","101.1448","","","0");INSERT INTO fc_cities VALUES("403","145","0","SGR","Tanjong Sepat","","tanjong-sepat","Active","0","","","","","","","","","","2.7691","101.5625","","","0");INSERT INTO fc_cities VALUES("404","145","0","PRK","Tanjong Tualang","","tanjong-tualang","Active","0","","","","","","","","","","4.3912","101.0461","","","0");INSERT INTO fc_cities VALUES("405","145","0","SBH","Tanjung Aru","","tanjung-aru","Active","0","","","","","","","","","","5.9771","116.0678","","","0");INSERT INTO fc_cities VALUES("406","145","0","PRK","Tapah","","tapah","Active","0","","","","","","","","","","4.3279","101.1595","","","0");INSERT INTO fc_cities VALUES("407","145","0","PRK","Tapah Road","","tapah-road","Active","0","","","","","","","","","","4.2684","101.1236","","","0");INSERT INTO fc_cities VALUES("408","145","0","PNG","Tasek Gelugor","","tasek-gelugor","Active","0","","","","","","","","","","5.4558","100.4549","","","0");INSERT INTO fc_cities VALUES("409","145","0","PNG","Tasek Gelugur","","tasek-gelugur","Active","0","","","","","","","","","","5.2632","100.4846","","","0");INSERT INTO fc_cities VALUES("410","145","0","SRW","Tatau","","tatau","Active","0","","","","","","","","","","2.5733","112.6906","","","0");INSERT INTO fc_cities VALUES("411","145","0","SBH","Tawau","","tawau","Active","0","","","","","","","","","","4.2901","117.8994","","","0");INSERT INTO fc_cities VALUES("412","145","0","SGR","Telok Panglima ","","telok-panglima","Active","0","","","","","","","","","","3.0195","101.5246","","","0");INSERT INTO fc_cities VALUES("413","145","0","PRK","Teluk Intan","","teluk-intan","Active","0","","","","","","","","","","4.1739","101.0194","","","0");INSERT INTO fc_cities VALUES("414","145","0","KTN","Temangan","","temangan","Active","0","","","","","","","","","","5.7612","102.1769","","","0");INSERT INTO fc_cities VALUES("415","145","0","PHG","Temerloh","","temerloh","Active","0","","","","","","","","","","3.484","102.4266","","","0");INSERT INTO fc_cities VALUES("416","145","0","PRK","Temoh","","temoh","Active","0","","","","","","","","","","4.3504","101.1622","","","0");INSERT INTO fc_cities VALUES("417","145","0","SBH","Tenghilan","","tenghilan","Active","0","","","","","","","","","","5.9977","116.529","","","0");INSERT INTO fc_cities VALUES("418","145","0","SBH","Tenom","","tenom","Active","0","","","","","","","","","","4.9839","115.93","","","0");INSERT INTO fc_cities VALUES("419","145","0","PRK","TLDM Lumut","","tldm-lumut","Active","0","","","","","","","","","","4.8073","100.8","","","0");INSERT INTO fc_cities VALUES("420","145","0","PHG","Triang","","triang","Active","0","","","","","","","","","","3.4051","102.6233","","","0");INSERT INTO fc_cities VALUES("421","145","0","PRK","Trolak","","trolak","Active","0","","","","","","","","","","3.9577","101.3342","","","0");INSERT INTO fc_cities VALUES("422","145","0","PRK","Trong","","trong","Active","0","","","","","","","","","","4.6539","100.7739","","","0");INSERT INTO fc_cities VALUES("423","145","0","PRK","Tronoh","","tronoh","Active","0","","","","","","","","","","4.4306","101.014","","","0");INSERT INTO fc_cities VALUES("424","145","0","SBH","Tuaran","","tuaran","Active","0","","","","","","","","","","6.132","116.2069","","","0");INSERT INTO fc_cities VALUES("425","145","0","KTN","Tumpat","","tumpat","Active","0","","","","","","","","","","6.1411","102.1763","","","0");INSERT INTO fc_cities VALUES("426","145","0","PRK","Ulu Bernam","","ulu-bernam","Active","0","","","","","","","","","","3.9111","101.2078","","","0");INSERT INTO fc_cities VALUES("427","145","0","PRK","Ulu Kinta","","ulu-kinta","Active","0","","","","","","","","","","4.6008","101.1007","","","0");INSERT INTO fc_cities VALUES("428","145","0","JHR","Ulu Tiram","","ulu-tiram","Active","0","","","","","","","","","","1.6728","103.6325","","","0");INSERT INTO fc_cities VALUES("429","145","0","KDH","Universiti Utar","","universiti-utar","Active","0","","","","","","","","","","6.4574","100.506","","","0");INSERT INTO fc_cities VALUES("430","145","0","PNG","USM Pulau Pinan","","usm-pulau-pinan","Active","0","","","","","","","","","","5.3572","100.3055","","","0");INSERT INTO fc_cities VALUES("431","145","0","KTN","Wakaf Bharu","","wakaf-bharu","Active","0","","","","","","","","","","6.0573","102.1743","","","0");INSERT INTO fc_cities VALUES("432","145","0","KDH","Yan","","yan","Active","0","","","","","","","","","","5.8366","100.4039","","","0");INSERT INTO fc_cities VALUES("433","145","0","JHR","Yong Peng","","yong-peng","Active","0","","","","","","","","","","1.9139","103.1326","","","0");INSERT INTO fc_cities VALUES("435","215","4","","Brickworks estate","","brickworks-estate","Active","0","","","","","1430997868-Chrysanthemum.jpg","Chrysanthemum.jpg","0","","","37.77264","-122.40992","","","0");INSERT INTO fc_cities VALUES("437","215","51","","Philadelphia","","philadelphia","Active","0","","","","","1432132012-pennsylvania-fall-widescreen-0021.jpg","pennsylvania-fall-widescreen-0021.jpg","0","","","39.95258","-75.16522","","","0");INSERT INTO fc_cities VALUES("438","215","862","","Los Angeles","","los-angeles","Active","0","","","","","1432132277-Los-Angeles1.jpg","Los-Angeles1.jpg","0","","","34.05223","-118.24368","","","0");INSERT INTO fc_cities VALUES("439","215","23","","Chicago","","chicago","Active","0","","","","","1432132410-ChicagoSkyline12.jpg","ChicagoSkyline12.jpg","0","","","41.87811","-87.62980","","","0");INSERT INTO fc_cities VALUES("440","215","21","","Lahaina","","lahaina","Active","0","","","","","1434898101-us-hi-lahaina.jpg","us-hi-lahaina.jpg","0","","","20.87833","-156.68250","","","0");INSERT INTO fc_cities VALUES("441","70","866","","london","","london","Active","0","","","","","1434980703-images.jpeg","images.jpeg","0","","","52.35552","-1.17432","","","0");INSERT INTO fc_cities VALUES("442","152","0","","Rotterdam","","rotterdam","Active","1","","","","","1436033047-41127_fullimage_Rotterdam-skyline.jpg","41127_fullimage_Rotterdam-skyline.jpg","0","","","51.92442","4.47773","","","0");INSERT INTO fc_cities VALUES("443","95","0","","Bangalore","","bangalore","Active","0","","","","","1436162897-29525F-1331010088-Brand_Factory_-__Marathalli.jpeg","29525F-1331010088-Brand_Factory_-__Marathalli.jpeg","0","","","12.97160","77.59456","","","0");INSERT INTO fc_cities VALUES("446","215","4","","Arizona","","arizona","Active","0","","","","","1437821495-Arizona.jpg","Arizona.jpg","0","","","34.04893","-111.09373","","","0");INSERT INTO fc_cities VALUES("447","200","0","","Chiang Mai","","chiang-mai","Active","0","","","","","1438053313-android-chrome-96x96.png","android-chrome-96x96.png","0","","","18.78775","98.99313","","","0");INSERT INTO fc_cities VALUES("448","207","873","","Osmangazi","","osmangazi","Active","0","","","","","1439068807-bursa.jpg","bursa.jpg","0","","","40.18853","29.06096","","","0");CREATE TABLE `fc_cities_old` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `countryid` int(11) NOT NULL,
  `stateid` int(11) NOT NULL,
  `state_code` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL,
  `contid` varchar(50) NOT NULL,
  `seourl` varchar(250) NOT NULL,
  `status` enum('InActive','Active') NOT NULL,
  `featured` enum('0','1') NOT NULL,
  `description` longblob NOT NULL,
  `meta_title` varchar(1000) NOT NULL,
  `meta_keyword` varchar(1000) NOT NULL,
  `meta_description` blob NOT NULL,
  `citylogo` varchar(1000) NOT NULL,
  `citythumb` varchar(1000) NOT NULL,
  `neighborhoods` varchar(1000) NOT NULL,
  `tags` varchar(1000) NOT NULL,
  `short_description` varchar(1000) NOT NULL,
  `latitude` varchar(1000) NOT NULL,
  `longitude` varchar(1000) NOT NULL,
  `get_around` varchar(1000) NOT NULL,
  `known_for` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=892 DEFAULT CHARSET=utf8;INSERT INTO fc_cities_old VALUES("872","0","41","","Newark","","newark","Active","1","<p>you are within walking distance to the train, the beach, shopping, restaurants, yoga, art galleries, and music venues.</p>","","","","city.jpg","city2.jpg","871","style","you are within walking distance to the train, the beach, shopping, restaurants, yoga, art galleries, and music venues.","40.735657","-74.1723667","","");INSERT INTO fc_cities_old VALUES("873","215","4","","Phoenix","","phoenix","Active","1","<dl><dd>
<p>Located in the Hudson Valley, and just a short drive from the  Berkshires, Ancramdale is a burgeoning farming community.  There are  many small towns around that each offer their own unique activities,  restaurants, stores.  There is an uncountable amount of things to do in  the area, from hiking, to skiing, to kayaking and canoeing.   On the  weekends there are farmers markets in all the towns offering great  locally grown produce and crafts.</p>
<p>Our own farm store also has many local products as well as our own  Grass fed Beef, Pork, Lamb and chicken and our own Charcuterie made on  the farm.</p>
</dd></dl>","","","","11.jpg","24260521.jpg","0","newark","Located in the Hudson Valley, and just a short drive from the Berkshires, Ancramdale is a burgeoning farming community. There are many small towns around that each offer their own unique activities, restaurants, stores. ","33.44838","-112.07404","Public Transit","La Sagrada Familia, GaudÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â­, FC Barcelona, Las Ramblas, warm sun and cool beaches, avant-garde architecture, museums, and music, gastronomic pioneers");INSERT INTO fc_cities_old VALUES("871","0","12","","San Francisco","","san-francisco","Active","1","<p>If an address has two conflicting lines, such as a post office box line<br /> and a street address line, the lower line will normally be used if mail can be<br /> delivered to that address.<br /> Most often conflicting lines are not used.</p>","","","","536216.jpg","462786_(1).jpg","0","new","If an address has two conflicting lines, such as a post office box line
and a street address line, the lower line will normally be used if mail can be
","37.7749295","-122.4194155","Public Transit","La Sagrada Familia, GaudÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â­, FC Barcelona, Las Ramblas, warm sun and cool beaches, avant-garde architecture, museums, and music, gastronomic pioneers");INSERT INTO fc_cities_old VALUES("874","0","859","","Krefeld","","krefeld","Active","1","<p>sdfsdfsd fsdf sdf sdfsd f</p>","","","","444289_(1).jpg","334138.jpg","0","good","tetd","51.3387609","6.5853417","Public Transit","La Sagrada Familia, GaudÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â­, FC Barcelona, Las Ramblas, warm sun and cool beaches, avant-garde architecture, museums, and music, gastronomic pioneers");INSERT INTO fc_cities_old VALUES("891","95","860","","Chennai","","chennai","Active","0","","","","","9aaac9f54cb5b6236c280832fe3f9138.jpg","9aaac9f54cb5b6236c280832fe3f91381.jpg","0","","","13.08160","80.27518","","");INSERT INTO fc_cities_old VALUES("885","0","4","","gani","","gani","Active","0","","","","","39.jpg","310.jpg","0","","","","","gani","gani");INSERT INTO fc_cities_old VALUES("888","215","4","","ari","","ari","Active","0","","","","","313.jpg","44.jpg","0","","","34.86443","-114.14846","ari","ari");INSERT INTO fc_cities_old VALUES("887","0","41","","Jersy","","jersy","Active","0","","","","","312.jpg","43.jpg","0","","","","","Jersy","");INSERT INTO fc_cities_old VALUES("889","0","6","","gang","","gang","Active","0","","","","","314.jpg","315.jpg","0","","","","","gang","gang");INSERT INTO fc_cities_old VALUES("890","0","6","","gang1","","gang1","Active","0","","","","","316.jpg","45.jpg","0","","","","","gang1","gang1");CREATE TABLE `fc_city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `state_name` varchar(50) NOT NULL,
  `country_name` varchar(50) NOT NULL,
  `seourl` varchar(250) NOT NULL,
  `status` enum('InActive','Active') NOT NULL,
  `featured` enum('0','1') NOT NULL,
  `citylogo` varchar(1000) NOT NULL,
  `citythumb` varchar(1000) NOT NULL,
  `latitude` varchar(1000) NOT NULL,
  `longitude` varchar(1000) NOT NULL,
  `meta_title` blob NOT NULL,
  `meta_keyword` blob NOT NULL,
  `meta_description` blob NOT NULL,
  `view_order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;INSERT INTO fc_city VALUES("1","Paris","Gangwon-do","South Korea","paris","Active","1","1460448490-paris-1574785.jpg","paris-1574785.jpg","37.75185","128.87606","","","","1");INSERT INTO fc_city VALUES("2","London","ì„œìš¸","South Korea","london","Active","1","1460448550-MaxW640imageVersiondefaultAR-140709178.jpg","MaxW640imageVersiondefaultAR-140709178.jpg","37.56654","126.97797","안동","안동","안동","13");INSERT INTO fc_city VALUES("3","Newyork","Jeju-do","South Korea","newyork","Active","1","1461058976-Argentina.jpg","Argentina.jpg","33.49962","126.53119","","","","3");INSERT INTO fc_city VALUES("4","Houston","Texas","United States","houston","Active","1","1460448531-mysore-palace-during.jpg","mysore-palace-during.jpg","29.76043","-95.36980","","","","4");INSERT INTO fc_city VALUES("6","Miami","Florida","United States","miami","Active","1","1460448482-1565012.jpg","1565012.jpg","35.17955","129.07564","","","","2");INSERT INTO fc_city VALUES("7","Chennai","Tamil Nadu","India","chennai","InActive","0","1460448523-ancient-india.jpg","ancient-india.jpg","13.08268","80.27072","","","","7");INSERT INTO fc_city VALUES("8","Mumbai","Maharashtra","India","mumbai","Active","0","1460448295-gateway_to_india.jpg","gateway_to_india.jpg","19.07598","72.87766","","","","0");CREATE TABLE `fc_cms` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(500) NOT NULL,
  `page_title` varchar(200) NOT NULL,
  `section` varchar(50) NOT NULL,
  `seourl` varchar(1000) NOT NULL,
  `hidden_page` enum('Yes','No') NOT NULL DEFAULT 'No',
  `category` enum('Main','Sub') NOT NULL DEFAULT 'Main',
  `parent` int(11) NOT NULL DEFAULT '0',
  `meta_tag` varchar(500) NOT NULL,
  `meta_description` blob NOT NULL,
  `description` blob NOT NULL,
  `status` enum('Publish','UnPublish') NOT NULL,
  `meta_title` varchar(1000) NOT NULL,
  `lang_code` varchar(120) NOT NULL,
  `toId` int(12) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;INSERT INTO fc_cms VALUES("1","Cancellation Policy","Cancellation Policy","discover","cancellation-policy","No","Main","0","Cancellation Policy","<p>Cancellation Policy</p>","<table id=\"cms_tbl\" class=\"display display_tbl dataTable\">
<tbody>
<tr class=\"odd\">
<td class=\"center  sorting_1\">cancellation-policy<br /><br /></td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<p><img src=\"http://airbnbv2.zoplay.com/uploaded/008.jpg\" alt=\"\" width=\"800\" height=\"600\" /></p>","Publish","Cancellation Policy","en","1");INSERT INTO fc_cms VALUES("9","Help","Help","company","help","No","Main","0","","","<p>What is Renters ?</p>
<p>Renters is a market place where property owners, can list their property with th eimages and the ammenites they give while the gues books their property. Renters gives you the flexibility to give all the details of the property in a easy way.</p>
<p>&nbsp;</p>
<table style=\"width: 1000px;\" cellspacing=\"10\" cellpadding=\"20\">
<tbody>
<tr style=\"height: 83px;\">
<td style=\"width: 346px; height: 83px;\">
<table style=\"border-color: #000000; width: 450px; float: left; background-color: #ff6600;\" border=\"1\" cellspacing=\"30\" cellpadding=\"30\">
<tbody>
<tr style=\"height: 49px;\">
<td style=\"height: 49px;\">
<div>Welcome</div>
</td>
</tr>
<tr style=\"height: 49px;\">
<td style=\"height: 49px;\">
<div>sdfsdfsdfsdfsdfsdfsdf</div>
</td>
</tr>
<tr style=\"height: 49px;\">
<td style=\"height: 49px;\">
<div>sdfsdfsdfsdf</div>
</td>
</tr>
</tbody>
</table>
</td>
<td style=\"width: 356px; height: 83px;\">
<table style=\"border-color: #000000; width: 450px; float: left; background-color: #ff6600;\" border=\"1\" cellspacing=\"30\" cellpadding=\"30\">
<tbody>
<tr style=\"height: 49px;\">
<td style=\"height: 49px;\">Renters</td>
</tr>
<tr style=\"height: 49px;\">
<td style=\"height: 49px;\">sdfsdfsdfssdfsdfsdfsdf</td>
</tr>
<tr style=\"height: 49px;\">
<td style=\"height: 49px;\">sdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdf</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>","Publish","","en","9");INSERT INTO fc_cms VALUES("31","Terms of Service","Terms of Service","","terms-of-service","No","Main","0","","","<div id=\"container-wrapper\">
<div class=\"container \">
<div class=\"main3\">
<div id=\"content_text\" class=\"middle_section\">
<p style=\"text-align: justify;\"><span style=\"font-family: verdana, geneva; font-size: medium;\"><strong>1 &nbsp;Acceptance The Use Of Zoplay Terms and Conditions</strong></span></p>
<p style=\"text-align: justify;\"><span style=\"font-family: verdana, geneva; font-size: medium;\">Your access to and use of Zoplay is subject exclusively to these Terms and Conditions. You will not use the Website for any purpose that is unlawful or prohibited by these Terms and Conditions. By using the Website you are fully accepting the terms, conditions and disclaimers contained in this notice. If you do not accept these Terms and Conditions you must immediately stop using the Website.</span></p>
<p style=\"text-align: justify;\"><span style=\"font-family: verdana, geneva; font-size: medium;\">&nbsp;</span></p>
<p style=\"text-align: justify;\"><span style=\"font-family: verdana, geneva; font-size: medium;\"><strong>2 &nbsp;Credit card details</strong></span></p>
<p style=\"text-align: justify;\"><span style=\"font-family: verdana, geneva; font-size: medium;\">Insert your credit card policy</span></p>
<p style=\"text-align: justify;\"><span style=\"font-family: verdana, geneva; font-size: medium;\">&nbsp;</span></p>
<p style=\"text-align: justify;\"><span style=\"font-family: verdana, geneva; font-size: medium;\"><strong>3 &nbsp;LEGAL ADVICE</strong></span></p>
<p style=\"text-align: justify;\"><span style=\"font-family: verdana, geneva; font-size: medium;\">The contents of Zoplay website do not constitute advice and should not be relied upon in making or refraining from making, any decision.&nbsp;</span><br /><span style=\"font-family: verdana, geneva; font-size: medium;\">All material contained on Zoplay is provided without any or warranty of any kind. You use the material on Zoplay at your own discretion</span></p>
<p style=\"text-align: justify;\"><span style=\"font-family: verdana, geneva; font-size: medium;\">&nbsp;</span></p>
<p style=\"text-align: justify;\"><span style=\"font-family: verdana, geneva; font-size: medium;\"><strong>4 &nbsp;CHANGE OF USE</strong></span></p>
<p style=\"text-align: justify;\"><span style=\"font-family: verdana, geneva; font-size: medium;\">Zoplay reserves the right to:</span></p>
<p style=\"text-align: justify;\"><br /><span style=\"font-family: verdana, geneva; font-size: medium;\">4.1 &nbsp;change or remove (temporarily or permanently) the Website or any part of it without notice and you confirm that Zoplay shall not be liable to you for any such change or removal and.</span><br /><span style=\"font-family: verdana, geneva; font-size: medium;\">4.2 &nbsp;change these Terms and Conditions at any time, and your continued use of the Website following any changes shall be deemed to be your acceptance of such change.</span></p>
<p style=\"text-align: justify;\"><span style=\"font-family: verdana, geneva; font-size: medium;\">&nbsp;</span></p>
<p style=\"text-align: justify;\"><span style=\"font-family: verdana, geneva; font-size: medium;\"><strong>5 &nbsp;Links to Third Party Websites</strong></span></p>
<p style=\"text-align: justify;\"><span style=\"font-family: verdana, geneva; font-size: medium;\">Zoplay Website may include links to third party websites that are controlled and maintained by others. Any link to other websites is not an endorsement of such websites and you acknowledge and agree that we are not responsible for the content or availability of any such sites.</span></p>
<p style=\"text-align: justify;\"><span style=\"font-family: verdana, geneva; font-size: medium;\">&nbsp;</span></p>
<p style=\"text-align: justify;\"><span style=\"font-family: verdana, geneva; font-size: medium;\"><strong>6 &nbsp;COPYRIGHT</strong></span></p>
<p style=\"text-align: justify;\"><span style=\"font-family: verdana, geneva; font-size: medium;\">6.1 &nbsp;All copyright, trade marks and all other intellectual property rights in the Website and its content (including without limitation the Website design, text, graphics and all software and source codes connected with the Website) are owned by or licensed to Zoplay or otherwise used by Zoplay as permitted by law.</span><br /><span style=\"font-family: verdana, geneva; font-size: medium;\">6.2 &nbsp;In accessing the Website you agree that you will access the content solely for your personal, non-commercial use. None of the content may be downloaded, copied, reproduced, transmitted, stored, sold or distributed without the prior written consent of the copyright holder. This excludes the downloading, copying and/or printing of pages of the Website for personal, non-commercial home use only.</span></p>
<p style=\"text-align: justify;\"><span style=\"font-family: verdana, geneva; font-size: medium;\">&nbsp;</span></p>
<p style=\"text-align: justify;\"><span style=\"font-family: verdana, geneva; font-size: medium;\"><strong>7 &nbsp;LINKS TO AND FROM OTHER WEBSITES</strong></span></p>
<p style=\"text-align: justify;\"><span style=\"font-family: verdana, geneva; font-size: medium;\">7.1 &nbsp;Throughout this Website you may find links to third party websites. The provision of a link to such a website does not mean that we endorse that website. If you visit any website via a link on this Website you do so at your own risk.</span></p>
<p style=\"text-align: justify;\"><br /><span style=\"font-family: verdana, geneva; font-size: medium;\">7.2 &nbsp;Any party wishing to link to this website is entitled to do so provided that the conditions below are observed:</span><br /><span style=\"font-family: verdana, geneva; font-size: medium;\">&nbsp;&nbsp;&nbsp;(a) &nbsp;you do not seek to imply that we are endorsing the services or products of another party unless this has been agreed with us in writing;</span><br /><span style=\"font-family: verdana, geneva; font-size: medium;\">&nbsp;&nbsp;&nbsp;(b) &nbsp;you do not misrepresent your relationship with this website; and</span><br /><span style=\"font-family: verdana, geneva; font-size: medium;\">&nbsp;&nbsp;&nbsp;(c) ;&nbsp;the website from which you link to this Website does not contain offensive or otherwise controversial content or, content that infringes any intellectual property rights or other rights of a third party.</span></p>
<p style=\"text-align: justify;\"><br /><span style=\"font-family: verdana, geneva; font-size: medium;\">7.3 &nbsp;By linking to this Website in breach of our terms, you shall indemnify us for any loss or damage suffered to this Website as a result of such linking.</span></p>
<p style=\"text-align: justify;\"><span style=\"font-family: verdana, geneva; font-size: medium;\">&nbsp;</span></p>
<p style=\"text-align: justify;\"><span style=\"font-family: verdana, geneva; font-size: medium;\"><strong>8 &nbsp; DISCLAIMERS AND LIMITATION OF LIABILITY</strong></span></p>
<p style=\"text-align: justify;\"><span style=\"font-family: verdana, geneva; font-size: medium;\">8.1 &nbsp;The Website is provided on an AS IS and AS AVAILABLE basis without any representation or endorsement made and without warranty of any kind whether express or implied, including but not limited to the implied warranties of satisfactory quality, fitness for a particular purpose, non-infringement, compatibility, security and accuracy.</span></p>
<p style=\"text-align: justify;\"><br /><span style=\"font-family: verdana, geneva; font-size: medium;\">8.2 &nbsp;To the extent permitted by law, Zoplay will not be liable for any indirect or consequential loss or damage whatever (including without limitation loss of business, opportunity, data, profits) arising out of or in connection with the use of the Website.</span></p>
<p style=\"text-align: justify;\"><br /><span style=\"font-family: verdana, geneva; font-size: medium;\">8.3 &nbsp;Zoplay makes no warranty that the functionality of the Website will be uninterrupted or error free, that defects will be corrected or that the Website or the server that makes it available are free of viruses or anything else which may be harmful or destructive.</span></p>
<p style=\"text-align: justify;\"><br /><span style=\"font-family: verdana, geneva; font-size: medium;\">8.4 &nbsp;Nothing in these Terms and Conditions shall be construed so as to exclude or limit the liability of Zoplay for death or personal injury as a result of the negligence of Zoplay or that of its employees or agents.</span></p>
<p style=\"text-align: justify;\"><span style=\"font-family: verdana, geneva; font-size: medium;\">&nbsp;</span></p>
<p style=\"text-align: justify;\"><span style=\"font-family: verdana, geneva; font-size: medium;\"><strong>9 &nbsp;INDEMNITY</strong></span></p>
<p style=\"text-align: justify;\"><span style=\"font-family: verdana, geneva; font-size: medium;\">You agree to indemnify and hold Zoplay and its employees and agents harmless from and against all liabilities, legal fees, damages, losses, costs and other expenses in relation to any claims or actions brought against Zoplay arising out of any breach by you of these Terms and Conditions or other liabilities arising out of your use of this Website.</span></p>
<p style=\"text-align: justify;\"><span style=\"font-family: verdana, geneva; font-size: medium;\">&nbsp;</span></p>
<p style=\"text-align: justify;\"><span style=\"font-family: verdana, geneva; font-size: medium;\"><strong>10 &nbsp;SEVERANCE</strong></span></p>
<p style=\"text-align: justify;\"><span style=\"font-family: verdana, geneva; font-size: medium;\">If any of these Terms and Conditions should be determined to be invalid, illegal or unenforceable for any reason by any court of competent jurisdiction then such Term or Condition shall be severed and the remaining Terms and Conditions shall survive and remain in full force and effect and continue to be binding and enforceable.</span></p>
<p style=\"text-align: justify;\"><span style=\"font-family: verdana, geneva; font-size: medium;\">&nbsp;</span></p>
<p style=\"text-align: justify;\"><span style=\"font-family: verdana, geneva; font-size: medium;\"><strong>11 &nbsp;WAIVER</strong></span></p>
<p style=\"text-align: justify;\"><span style=\"font-family: verdana, geneva; font-size: medium;\">If you breach these Conditions of Use and we take no action, we will still be entitled to use our rights and remedies in any other situation where you breach these Conditions of Use.</span></p>
<p style=\"text-align: justify;\"><span style=\"font-family: verdana, geneva; font-size: medium;\">&nbsp;</span></p>
<p style=\"text-align: justify;\"><span style=\"font-family: verdana, geneva; font-size: medium;\"><strong>12 &nbsp;GOVERNING LAW</strong></span></p>
<p style=\"text-align: justify;\"><span style=\"font-family: verdana, geneva; font-size: medium;\">These Terms and Conditions shall be governed by and construed in accordance with the law of india and you hereby submit to the exclusive jurisdiction of the india courts.</span></p>
</div>
</div>
</div>
</div>","Publish","","en","31");INSERT INTO fc_cms VALUES("38","Privacy Policy","Privacy Policy","","privacy-policy","No","Main","0","","","","Publish","","en","38");INSERT INTO fc_cms VALUES("49","개인 정보 정책","개인 정보 정책","","privacy-policy","No","Main","0","","","<pre id=\"tw-target-text\" class=\"tw-data-text vk_txt tw-ta tw-text-medium\" dir=\"ltr\" data-placeholder=\"Translation\" data-fulltext=\"\"><span lang=\"ko\">개인 정보 정책</span></pre>","Publish","","kr","38");INSERT INTO fc_cms VALUES("48","서비스 약관","서비스 약관","","terms-of-service","No","Main","0","","","<pre id=\"tw-target-text\" class=\"tw-data-text vk_txt tw-ta tw-text-medium\" dir=\"ltr\" data-placeholder=\"Translation\" data-fulltext=\"\"><span lang=\"ko\">서비스 약관</span></pre>","Publish","","kr","31");INSERT INTO fc_cms VALUES("47","도움","도움","","help","No","Main","0","","","<pre id=\"tw-target-text\" class=\"tw-data-text vk_txt tw-ta tw-text-large\" dir=\"ltr\" data-placeholder=\"Translation\" data-fulltext=\"\"><span lang=\"ko\">도움</span></pre>","Publish","","kr","9");INSERT INTO fc_cms VALUES("46","취소 정책","취소 정책","","cancellation-policy","No","Main","0","","","<pre id=\"tw-target-text\" class=\"tw-data-text vk_txt tw-ta tw-text-medium\" dir=\"ltr\" data-placeholder=\"Translation\" data-fulltext=\"\"><span lang=\"ko\">취소 정책</span></pre>","Publish","","kr","1");CREATE TABLE `fc_commission` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `commission_type` varchar(250) NOT NULL,
  `commission_percentage` varchar(200) NOT NULL,
  `promotion_type` enum('flat','percentage') NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `seo_tag` varchar(50) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;INSERT INTO fc_commission VALUES("1","Host Listing","5","flat","Active","host-listing","2016-09-16 15:05:32");INSERT INTO fc_commission VALUES("2","Guest Booking","2","percentage","Active","guest-booking","2016-09-16 15:40:15");INSERT INTO fc_commission VALUES("3","Host Accept The Reservation Request","5","flat","Active","host-accept","2016-03-02 09:05:57");CREATE TABLE `fc_commission_paid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `host_email` varchar(250) NOT NULL,
  `host_id` int(11) NOT NULL,
  `amount` float(10,2) NOT NULL,
  `transaction_id` varchar(250) NOT NULL,
  `comission_track_id` int(11) NOT NULL,
  `status` enum('Pending','Paid') NOT NULL DEFAULT 'Pending',
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;INSERT INTO fc_commission_paid VALUES("1","muthukrishnan@teamtweaks.com","1","35.00","41111111111111111","3","Pending","2016-09-09 12:42:53");CREATE TABLE `fc_commission_tracking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `host_email` varchar(100) NOT NULL,
  `host_id` int(11) NOT NULL,
  `booking_no` varchar(100) NOT NULL,
  `total_amount` float(10,2) NOT NULL,
  `guest_fee` float(10,2) NOT NULL,
  `host_fee` float(10,2) NOT NULL,
  `payable_amount` float(10,2) NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `paid_status` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;INSERT INTO fc_commission_tracking VALUES("1","muthukrishnan@teamtweaks.com","1","EN1500028","102.00","2.00","5.00","95.00","2016-08-30 17:29:16","no");INSERT INTO fc_commission_tracking VALUES("2","muthukrishnan@teamtweaks.com","1","EN1500038","32.00","2.00","5.00","25.00","2016-08-30 17:40:16","no");INSERT INTO fc_commission_tracking VALUES("3","muthukrishnan@teamtweaks.com","1","EN1500018","42.00","2.00","5.00","35.00","2016-08-30 18:07:40","yes");INSERT INTO fc_commission_tracking VALUES("4","muthukrishnan@teamtweaks.com","1","EN1500058","32.00","2.00","5.00","25.00","2016-08-31 12:16:34","no");INSERT INTO fc_commission_tracking VALUES("5","muthukrishnan@teamtweaks.com","1","EN1500088","52.00","2.00","5.00","45.00","2016-08-31 19:19:07","yes");INSERT INTO fc_commission_tracking VALUES("6","muthukrishnan@teamtweaks.com","1","EN1500098","402.00","2.00","5.00","395.00","2016-09-01 12:14:50","yes");CREATE TABLE `fc_contactus` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(500) NOT NULL,
  `lastname` varchar(500) NOT NULL,
  `adults` varchar(500) NOT NULL,
  `children` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `mobile_no` varchar(100) NOT NULL,
  `contact_sub` varchar(1000) NOT NULL,
  `message` varchar(5000) NOT NULL,
  `status` enum('Active','InActive') NOT NULL DEFAULT 'Active',
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `arrival_date` date NOT NULL,
  `departure_date` date NOT NULL,
  `rental_id` varchar(1000) NOT NULL,
  `renter_id` varchar(1000) NOT NULL,
  `read_staus` enum('UnRead','Read') NOT NULL,
  `user_read_status` enum('UnRead','Read') NOT NULL,
  `customer_id` int(100) NOT NULL,
  `enquiry_timezone` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;CREATE TABLE `fc_country` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `contid` varchar(255) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `country_code` varchar(2) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL,
  `country_mobile_code` varchar(200) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL,
  `seourl` varchar(750) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `currency_type` char(3) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `currency_symbol` text NOT NULL,
  `shipping_cost` decimal(10,2) NOT NULL,
  `shipping_tax` decimal(10,2) NOT NULL,
  `meta_title` blob NOT NULL,
  `meta_keyword` blob NOT NULL,
  `meta_description` blob NOT NULL,
  `description` longblob NOT NULL,
  `status` enum('Active','InActive') CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL DEFAULT 'Active',
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `currency_default` enum('No','Yes') CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL DEFAULT 'No',
  `slider_image` varchar(1000) NOT NULL,
  `logo` varchar(1000) NOT NULL,
  `map` varchar(1000) NOT NULL,
  `thumb` varchar(1000) NOT NULL,
  `language_code` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=232 DEFAULT CHARSET=utf8;INSERT INTO fc_country VALUES("1","EU","AD","+376","Andorra","andorra","EUR","$","0.00","0.00","","","","","InActive","2015-02-19 13:11:51","No","0","0","0","","en");INSERT INTO fc_country VALUES("2","AS","AE","+971","United Arab Emirates","united-arab-emirates","AED","$","0.00","0.00","","","","","Active","2014-12-13 13:30:58","No","0","0","0","","en");INSERT INTO fc_country VALUES("3","AS","AF","+93 ","Afghanistan","afghanistan","AFN","0","3.00","0.00","","","","<p>hjgjf</p>","InActive","2015-07-07 12:35:17","No","0","Chrysanthemum2.jpg","0","Koala8.jpg","en");INSERT INTO fc_country VALUES("4","NA","AG","+268","Antigua And Barbuda","antigua-and-barbuda","XCD","$","2.00","3.00","","","","","Active","2014-12-13 13:34:56","No","0","0","0","","en");INSERT INTO fc_country VALUES("5","EU","AL","+355","Albania","albania","ALL","","0.00","0.00","","","","","InActive","2015-02-19 13:21:51","No","0","0","0","","en");INSERT INTO fc_country VALUES("6","AS","AM","+374","Armenia","armenia","AMD","","0.00","0.00","","","","","Active","2014-12-13 13:35:30","No","0","0","0","","en");INSERT INTO fc_country VALUES("7","AF","AO","+244","Angola","angola","AOA","","0.00","0.00","","","","","InActive","2015-02-19 13:23:23","No","0","0","0","","en");INSERT INTO fc_country VALUES("8","AN","AQ","+672","Antarctica","antarctica","XCD","","0.00","0.00","","","","","InActive","2015-02-19 14:37:57","No","0","0","0","","en");INSERT INTO fc_country VALUES("9","SA","AR","+54 ","Argentina","argentina","ARS","","0.00","0.00","","","","","Active","2014-12-13 13:36:52","No","0","0","0","","en");INSERT INTO fc_country VALUES("10","OC","AS","+684","American Samoa","american-samoa","USD","","0.00","0.00","","","","","InActive","2015-02-19 13:23:16","No","0","0","0","","en");INSERT INTO fc_country VALUES("11","EU","AT","+43","Austria","austria","EUR","","0.00","0.00","","","","","Active","2014-12-13 13:37:46","No","0","0","0","","en");INSERT INTO fc_country VALUES("12","OC","AU","+61","Australia","australia","AUD","$","0.00","0.00","","","","","Active","2014-12-13 13:38:00","No","0","0","0","","en");INSERT INTO fc_country VALUES("13","NA","AW","+297","Aruba","aruba","AWG","","0.00","0.00","","","","","Active","2014-12-13 13:38:47","No","0","0","0","","en");INSERT INTO fc_country VALUES("14","","AX","+358
","Aland Islands","aland-islands","EUR","ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€¦Ã‚Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬","0.00","0.00","","","","<p>dfsdf</p>","InActive","2015-04-28 16:21:02","No","0","Chrysanthemum1.jpg","0","Lighthouse3.jpg","en");INSERT INTO fc_country VALUES("15","AS","AZ","+994","Azerbaijan","azerbaijan","AZN","","0.00","0.00","","","","","Active","2014-12-13 13:40:43","No","0","0","0","","en");INSERT INTO fc_country VALUES("16","","BA","+387","Bosnia And Herzegovina","bosnia-and-herzegovina","BAM","","0.00","0.00","","","","","Active","2014-12-13 13:40:57","No","0","0","0","","en");INSERT INTO fc_country VALUES("17","NA","BB","+246","Barbados","barbados","BBD","","0.00","0.00","","","","","Active","2014-12-13 13:42:49","No","0","0","0","","en");INSERT INTO fc_country VALUES("18","AS","BD","+880","Bangladesh","bangladesh","BDT","","0.00","0.00","","","","","Active","2014-12-13 13:43:02","No","0","0","0","","en");INSERT INTO fc_country VALUES("19","EU","BE","+32","Belgium","belgium","EUR","","0.00","0.00","","","","","Active","2014-12-13 13:43:36","No","0","0","0","","en");INSERT INTO fc_country VALUES("20","AF","BF","+226","Burkina Faso","burkina-faso","XOF","","0.00","0.00","","","","","Active","2014-12-13 13:44:05","No","0","0","0","","en");INSERT INTO fc_country VALUES("21","EU","BG","+359","Bulgaria","bulgaria","BGN","","0.00","0.00","","","","","Active","2014-12-13 13:44:27","No","0","0","0","","en");INSERT INTO fc_country VALUES("22","AS","BH","+973","Bahrain","bahrain","BHD","","0.00","0.00","","","","","Active","2014-12-13 13:44:48","No","0","0","0","","en");INSERT INTO fc_country VALUES("23","AF","BI","+257","Burundi","burundi","BIF","","0.00","0.00","","","","","Active","2014-12-13 13:45:04","No","0","0","0","","en");INSERT INTO fc_country VALUES("24","AF","BJ","+229 ","Benin","benin","XOF","","0.00","0.00","","","","","Active","2014-12-13 13:45:36","No","0","0","0","","en");INSERT INTO fc_country VALUES("25","NA","BM","+1441","Bermuda","bermuda","BMD","","0.00","0.00","","","","","Active","2014-12-13 13:46:42","No","0","0","0","","en");INSERT INTO fc_country VALUES("26","","BN","+673","Brunei","brunei","BND","","0.00","0.00","","","","","Active","2014-12-13 13:46:54","No","0","0","0","","en");INSERT INTO fc_country VALUES("27","SA","BO","+591","Bolivia","bolivia","BOB","","0.00","0.00","","","","","Active","2014-12-13 13:47:16","No","0","0","0","","en");INSERT INTO fc_country VALUES("28","","BQ","+599","Bonaire, Saint Eustatius And Saba ","bonaire,-saint-eustatius-and-saba","USD","","0.00","0.00","","","","","InActive","2015-07-07 12:35:29","No","0","0","0","","en");INSERT INTO fc_country VALUES("29","SA","BR","+55","Brazil","brazil","BRL","","0.00","0.00","","","","","Active","2014-12-13 13:48:32","No","0","0","0","","en");INSERT INTO fc_country VALUES("30","NA","BS","+242","Bahamas","bahamas","BSD","","0.00","0.00","","","","","Active","2014-12-13 13:48:46","No","0","0","0","","en");INSERT INTO fc_country VALUES("31","AS","BT","+975","Bhutan","bhutan","BTN","","0.00","0.00","","","","","Active","2014-12-13 13:49:06","No","0","0","0","","en");INSERT INTO fc_country VALUES("32","AN","BV","+47	","Bouvet Island","bouvet-island","NOK","","0.00","0.00","","","","","Active","2014-12-13 13:50:27","No","0","0","0","","en");INSERT INTO fc_country VALUES("33","AF","BW","+267","Botswana","botswana","BWP","","0.00","0.00","","","","","Active","2014-12-13 13:51:06","No","0","0","0","","en");INSERT INTO fc_country VALUES("34","EU","BY","+375","Belarus","belarus","BYR","","0.00","0.00","","","","","Active","2014-12-13 13:51:20","No","0","0","0","","en");INSERT INTO fc_country VALUES("35","NA","BZ","+501","Belize","belize","BZD","","0.00","0.00","","","","","Active","2014-12-13 13:51:32","No","0","0","0","","en");INSERT INTO fc_country VALUES("36","NA","CA","+1","Canada","canada","CAD","","0.00","0.00","","","","","Active","2014-12-13 13:51:55","No","0","0","0","","en");INSERT INTO fc_country VALUES("37","","CD","+243","Democratic Republic Of The Congo","democratic-republic-of-the-congo","DRC","","0.00","0.00","","","","","Active","2014-12-13 13:52:19","No","0","0","0","","en");INSERT INTO fc_country VALUES("38","AF","CF","+236
","Central African Republic","central-african-republic","XAF","","0.00","0.00","","","","","Active","2014-12-13 13:52:31","No","0","0","0","","en");INSERT INTO fc_country VALUES("39","","CG","+ 242","Republic Of The Congo","republic-of-the-congo","DRC","","0.00","0.00","","","","","Active","2014-12-13 13:52:52","No","0","0","0","","en");INSERT INTO fc_country VALUES("40","EU","CH","+41
","Switzerland","switzerland","CHF","","0.00","0.00","","","","","Active","2014-12-13 13:54:43","No","0","0","0","","en");INSERT INTO fc_country VALUES("41","","CI","+225","Ivory Coast","ivory-coast","XOF","","0.00","0.00","","","","","Active","2014-12-13 13:54:59","No","0","0","0","","en");INSERT INTO fc_country VALUES("42","SA","CL","+56
","Chile","chile","CLP","","0.00","0.00","","","","","Active","2014-12-13 13:55:34","No","0","0","0","","en");INSERT INTO fc_country VALUES("43","AF","CM","+237","Cameroon","cameroon","XAF","","0.00","0.00","","","","","Active","2014-12-13 13:56:12","No","0","0","0","","en");INSERT INTO fc_country VALUES("44","AS","CN","+86","China","china","CNY","","0.00","0.00","","","","","Active","2014-12-13 13:56:32","No","0","0","0","","en");INSERT INTO fc_country VALUES("45","SA","CO","+57","Colombia","colombia","COP","","0.00","0.00","","","","","Active","2014-12-13 13:56:43","No","0","0","0","","en");INSERT INTO fc_country VALUES("46","NA","CR","+506
","Costa Rica","costa-rica","CRC","","0.00","0.00","","","","","Active","2014-12-13 13:56:58","No","0","0","0","","en");INSERT INTO fc_country VALUES("47","NA","CU","+53
","Cuba","cuba","CUP","","0.00","0.00","","","","","Active","2014-12-13 13:57:11","No","0","0","0","","en");INSERT INTO fc_country VALUES("48","AF","CV","+238
","Cape Verde","cape-verde","CVE","","0.00","0.00","","","","","Active","2014-12-13 13:57:22","No","0","0","0","","en");INSERT INTO fc_country VALUES("49","EU","CY","+357
","Cyprus","cyprus","EUR","","0.00","0.00","","","","","Active","2014-12-13 13:57:34","No","0","0","0","","en");INSERT INTO fc_country VALUES("50","EU","CZ","+420
","Czech Republic","czech-republic","CZK","","0.00","0.00","","","","","Active","2014-12-13 13:57:47","No","0","0","0","","en");INSERT INTO fc_country VALUES("51","EU","DE","+49","Germany","germany","EUR","0","0.00","0.00","","","","","Active","2014-12-13 13:58:01","No","0","0","0","","de");INSERT INTO fc_country VALUES("52","AF","DJ","+253","Djibouti","djibouti","DJF","","0.00","0.00","","","","","Active","2014-12-13 13:58:12","No","0","0","0","","en");INSERT INTO fc_country VALUES("53","EU","DK","+45","Denmark","denmark","DKK","","0.00","0.00","","","","","Active","2014-12-13 13:58:33","No","0","0","0","","en");INSERT INTO fc_country VALUES("54","NA","DM","+ 1 767","Dominica","dominica","XCD","","0.00","0.00","","","","","Active","2014-12-13 13:58:55","No","0","0","0","","en");INSERT INTO fc_country VALUES("55","NA","DO","+1 809 ","Dominican Republic","dominican-republic","DOP","","0.00","0.00","","","","","Active","2014-12-13 13:59:55","No","0","0","0","","en");INSERT INTO fc_country VALUES("56","AF","DZ","+213","Algeria","algeria","DZD","","0.00","0.00","","","","","InActive","2015-02-19 13:23:07","No","0","0","0","","en");INSERT INTO fc_country VALUES("57","SA","EC","+593","Ecuador","ecuador","ECS","","0.00","0.00","","","","","Active","2014-12-13 14:00:16","No","0","0","0","","en");INSERT INTO fc_country VALUES("58","EU","EE","+372","Estonia","estonia","EUR","","0.00","0.00","","","","","Active","2014-12-13 14:00:26","No","0","0","0","","en");INSERT INTO fc_country VALUES("59","AF","EG","+20","Egypt","egypt","EGP","","0.00","0.00","","","","","Active","2014-12-13 14:00:38","No","0","0","0","","en");INSERT INTO fc_country VALUES("60","AF","EH","+212","Western Sahara","western-sahara","MAD","","0.00","0.00","","","","","Active","2014-12-13 14:01:28","No","0","0","0","","en");INSERT INTO fc_country VALUES("61","AF","ER","+291","Eritrea","eritrea","ERN","","0.00","0.00","","","","","Active","2014-12-13 14:45:36","No","0","0","0","","en");INSERT INTO fc_country VALUES("62","EU","ES","+34","Spain","spain","EUR","","0.00","0.00","","","","","Active","2014-12-13 14:46:03","No","0","0","0","","en");INSERT INTO fc_country VALUES("63","AF","ET","+251","Ethiopia","ethiopia","ETB","","0.00","0.00","","","","","Active","2014-12-13 14:46:18","No","0","0","0","","en");INSERT INTO fc_country VALUES("64","EU","FI","+358","Finland","finland","EUR","","0.00","0.00","","","","","Active","2014-12-13 14:46:34","No","0","0","0","","en");INSERT INTO fc_country VALUES("65","OC","FJ","+679","Fiji","fiji","FJD","","0.00","0.00","","","","","Active","2014-12-13 14:46:47","No","0","0","0","","en");INSERT INTO fc_country VALUES("66","","FM","+691","Micronesia","micronesia","USD","","0.00","0.00","","","","","Active","2014-12-13 14:47:01","No","0","0","0","","en");INSERT INTO fc_country VALUES("67","EU","FO","+298","Faroe Islands","faroe-islands","DKK","","0.00","0.00","","","","","Active","2014-12-13 14:47:20","No","0","0","0","","en");INSERT INTO fc_country VALUES("68","EU","FR","+33","France","france","EUR","","0.00","0.00","","","","","Active","2014-12-13 14:47:33","No","0","0","0","","en");INSERT INTO fc_country VALUES("69","AF","GA","+241 ","Gabon","gabon","XAF","","0.00","0.00","","","","","Active","2014-12-13 14:47:49","No","0","0","0","","en");INSERT INTO fc_country VALUES("70","EU","GB","+44","United Kingdom","united-kingdom","USD","","0.00","0.00","","","","","Active","2014-12-13 14:48:13","No","0","0","0","","en");INSERT INTO fc_country VALUES("71","NA","GD","+1 473","Grenada","grenada","XCD","","0.00","0.00","","","","","Active","2014-12-13 14:48:37","No","0","0","0","","en");INSERT INTO fc_country VALUES("72","AS","GE","+995","Georgia","georgia","GEL","","0.00","0.00","","","","","Active","2014-12-13 14:48:53","No","0","0","0","","en");INSERT INTO fc_country VALUES("73","SA","GF","+594","French Guiana","french-guiana","EUR","","0.00","0.00","","","","","Active","2014-12-13 14:49:18","No","0","0","0","","en");INSERT INTO fc_country VALUES("74","","GG","+44","Guernsey","guernsey","GGP","","0.00","0.00","","","","","Active","2014-12-13 14:49:48","No","0","0","0","","en");INSERT INTO fc_country VALUES("75","AF","GH","+233","Ghana","ghana","GHS","","0.00","0.00","","","","","Active","2014-12-13 14:50:00","No","0","0","0","","en");INSERT INTO fc_country VALUES("76","NA","GL","+299","Greenland","greenland","DKK","","0.00","0.00","","","","","Active","2014-12-13 14:50:11","No","0","0","0","","en");INSERT INTO fc_country VALUES("77","AF","GM","+220","Gambia","gambia","GMD","","0.00","0.00","","","","","Active","2014-12-13 14:50:24","No","0","0","0","","en");INSERT INTO fc_country VALUES("78","AF","GN","+224 ","Guinea","guinea","GNF","","0.00","0.00","","","","","Active","2014-12-13 14:51:16","No","0","0","0","","en");INSERT INTO fc_country VALUES("79","NA","GP","+590","Guadeloupe","guadeloupe","EUD","","0.00","0.00","","","","","Active","2014-12-13 14:51:30","No","0","0","0","","en");INSERT INTO fc_country VALUES("80","AF","GQ","+240","Equatorial Guinea","equatorial-guinea","XAF","","0.00","0.00","","","","","Active","2014-12-13 14:51:43","No","0","0","0","","en");INSERT INTO fc_country VALUES("81","EU","GR","+30","Greece","greece","EUR","","0.00","0.00","","","","","Active","2014-12-13 14:52:04","No","0","0","0","","en");INSERT INTO fc_country VALUES("82","NA","GT","+502","Guatemala","guatemala","QTQ","","0.00","0.00","","","","","Active","2014-12-13 14:52:51","No","0","0","0","","en");INSERT INTO fc_country VALUES("83","OC","GU","+1 671","Guam","guam","USD","","0.00","0.00","","","","","Active","2014-12-13 14:53:11","No","0","0","0","","en");INSERT INTO fc_country VALUES("84","AF","GW","+245","Guinea-Bissau","guineabissau","GWP","","0.00","0.00","","","","","Active","2014-12-13 14:53:31","No","0","0","0","","en");INSERT INTO fc_country VALUES("85","SA","GY","+592","Guyana","guyana","GYD","","0.00","0.00","","","","","Active","2014-12-13 14:53:51","No","0","0","0","","en");INSERT INTO fc_country VALUES("86","AS","HK","+852","Hong Kong","hong-kong","HKD","","0.00","0.00","","","","","Active","2014-12-13 14:54:09","No","0","0","0","","en");INSERT INTO fc_country VALUES("87","NA","HN","+504","Honduras","honduras","HNL","","0.00","0.00","","","","","Active","2014-12-13 14:54:21","No","0","0","0","","en");INSERT INTO fc_country VALUES("88","EU","HR","+385","Croatia","croatia","HRK","","0.00","0.00","","","","","Active","2014-12-13 14:54:35","No","0","0","0","","en");INSERT INTO fc_country VALUES("89","NA","HT","+509","Haiti","haiti","HTG","","0.00","0.00","","","","","Active","2014-12-13 14:54:49","No","0","0","0","","en");INSERT INTO fc_country VALUES("90","EU","HU","+36","Hungary","hungary","HUF","","0.00","0.00","","","","","Active","2014-12-13 14:55:05","No","0","0","0","","en");INSERT INTO fc_country VALUES("91","AS","ID","+62","Indonesia","indonesia","IDR","","0.00","0.00","","","","","Active","2014-12-13 14:55:23","No","0","0","0","","en");INSERT INTO fc_country VALUES("92","EU","IE","+353","Ireland","ireland","EUR","","0.00","0.00","","","","","Active","2014-12-13 14:55:40","No","0","0","0","","en");INSERT INTO fc_country VALUES("93","AS","IL","+972 ","Israel","israel","ILS","","0.00","0.00","","","","","Active","2014-12-13 14:56:06","No","0","0","0","","en");INSERT INTO fc_country VALUES("94","","IM","+44","Isle Of Man","isle-of-man","GBP","","0.00","0.00","","","","","Active","2014-12-13 14:56:18","No","0","0","0","","en");INSERT INTO fc_country VALUES("95","AS","IN","+91","India","india","INR","0","15.00","10.00","","","","","Active","2015-04-28 16:21:02","Yes","0","0","0","","en");INSERT INTO fc_country VALUES("96","AS","IO","+246","British Indian Ocean Territory","british-indian-ocean-territory","USD","","0.00","0.00","","","","","Active","2014-12-13 14:57:18","No","0","0","0","","en");INSERT INTO fc_country VALUES("97","AS","IQ","+964","Iraq","iraq","IQD","","0.00","0.00","","","","","Active","2014-12-13 14:57:40","No","0","0","0","","en");INSERT INTO fc_country VALUES("98","","IR","+98","Iran","iran","IRR","","0.00","0.00","","","","","Active","2014-12-13 14:57:52","No","0","0","0","","en");INSERT INTO fc_country VALUES("99","EU","IS","+354","Iceland","iceland","ISK","","0.00","0.00","","","","","Active","2014-12-13 14:58:08","No","0","0","0","","en");INSERT INTO fc_country VALUES("100","EU","IT","+39","Italy","italy","EUR","","0.00","0.00","","","","","Active","2014-12-13 15:14:29","No","0","0","0","","en");INSERT INTO fc_country VALUES("101","","JE","+44 ","Jersey","jersey","GBP","","0.00","0.00","","","","","Active","2014-12-13 15:14:54","No","0","0","0","","en");INSERT INTO fc_country VALUES("102","NA","JM","+1 876","Jamaica","jamaica","JMD","","0.00","0.00","","","","","Active","2014-12-13 15:15:08","No","0","0","0","","en");INSERT INTO fc_country VALUES("103","AS","JO","+962","Jordan","jordan","JOD","","0.00","0.00","","","","","Active","2014-12-13 15:15:25","No","0","0","0","","en");INSERT INTO fc_country VALUES("104","AS","JP","+81 ","Japan","japan","JPY","","0.00","0.00","","","","","Active","2014-12-13 15:15:44","No","0","0","0","","en");INSERT INTO fc_country VALUES("105","AF","KE","+254","Kenya","kenya","KES","","0.00","0.00","","","","","Active","2014-12-13 15:15:56","No","0","0","0","","en");INSERT INTO fc_country VALUES("106","AS","KG","+996","Kyrgyzstan","kyrgyzstan","KGS","","0.00","0.00","","","","","Active","2014-12-13 15:16:19","No","0","0","0","","en");INSERT INTO fc_country VALUES("107","AS","KH","+855","Cambodia","cambodia","KHR","","0.00","0.00","","","","","Active","2014-12-13 15:16:29","No","0","0","0","","en");INSERT INTO fc_country VALUES("108","OC","KI","+686","Kiribati","kiribati","AUD","","0.00","0.00","","","","","Active","2014-12-13 15:16:38","No","0","0","0","","en");INSERT INTO fc_country VALUES("109","AF","KM","+269","Comoros","comoros","KMF","","0.00","0.00","","","","","Active","2014-12-13 15:16:53","No","0","0","0","","en");INSERT INTO fc_country VALUES("110","NA","KN","+1 869","Saint Kitts And Nevis","saint-kitts-and-nevis","XCD","","0.00","0.00","","","","","Active","2014-12-13 15:17:06","No","0","0","0","","en");INSERT INTO fc_country VALUES("111","","KP","+850","North Korea","north-korea","KPW","","0.00","0.00","","","","","Active","2014-12-13 15:17:21","No","0","0","0","","en");INSERT INTO fc_country VALUES("112","","KR","+82","South Korea","south-korea","KRW","","0.00","0.00","","","","","Active","2014-12-13 15:17:34","No","0","0","0","","en");INSERT INTO fc_country VALUES("113","AS","KW","+965","Kuwait","kuwait","KWD","","0.00","0.00","","","","","Active","2014-12-13 15:17:47","No","0","0","0","","en");INSERT INTO fc_country VALUES("114","AS","KZ","+7","Kazakhstan","kazakhstan","KZT","","0.00","0.00","","","","","Active","2014-12-13 15:18:00","No","0","0","0","","en");INSERT INTO fc_country VALUES("115","","LA","+856","Laos","laos","LAK","","0.00","0.00","","","","","Active","2014-12-13 15:18:14","No","0","0","0","","en");INSERT INTO fc_country VALUES("116","AS","LB","+961","Lebanon","lebanon","LBP","","0.00","0.00","","","","","Active","2014-12-13 15:18:24","No","0","0","0","","en");INSERT INTO fc_country VALUES("117","NA","LC","+1 758","Saint Lucia","saint-lucia","XCD","","0.00","0.00","","","","","Active","2014-12-13 15:18:44","No","0","0","0","","en");INSERT INTO fc_country VALUES("118","EU","LI","+423","Liechtenstein","liechtenstein","CHF","","0.00","0.00","","","","","Active","2014-12-13 15:18:58","No","0","0","0","","en");INSERT INTO fc_country VALUES("119","AS","LK","+94","Sri Lanka","sri-lanka","LKR","Rs","20.00","12.00","","","","","Active","2014-12-13 15:19:12","No","0","0","0","","en");INSERT INTO fc_country VALUES("120","AF","LR","+231","Liberia","liberia","LRD","","0.00","0.00","","","","","Active","2014-12-13 15:19:26","No","0","0","0","","en");INSERT INTO fc_country VALUES("121","AF","LS","+266","Lesotho","lesotho","LSL","","0.00","0.00","","","","","Active","2014-12-13 16:37:37","No","0","0","0","","en");INSERT INTO fc_country VALUES("122","EU","LT","+370","Lithuania","lithuania","LTL","","0.00","0.00","","","","","Active","2014-12-13 16:37:49","No","0","0","0","","en");INSERT INTO fc_country VALUES("123","EU","LU","+352","Luxembourg","luxembourg","EUR","","0.00","0.00","","","","","Active","2014-12-13 16:38:03","No","0","0","0","","en");INSERT INTO fc_country VALUES("124","EU","LV","+371","Latvia","latvia","LVL","","0.00","0.00","","","","","Active","2014-12-13 16:38:17","No","0","0","0","","en");INSERT INTO fc_country VALUES("125","","LY","+ 218","Libya","libya","LYD","","0.00","0.00","","","","","Active","2014-12-13 16:38:34","No","0","0","0","","en");INSERT INTO fc_country VALUES("126","AF","MA","+212","Morocco","morocco","MAD","","0.00","0.00","","","","","Active","2014-12-13 16:39:49","No","0","0","0","","en");INSERT INTO fc_country VALUES("127","EU","MC","+377","Monaco","monaco","EUR","","0.00","0.00","","","","","Active","2014-12-13 16:40:06","No","0","0","0","","en");INSERT INTO fc_country VALUES("128","","MD","+373","Moldova","moldova","MDL","","0.00","0.00","","","","","Active","2014-12-13 16:40:20","No","0","0","0","","en");INSERT INTO fc_country VALUES("129","","ME","+382","Montenegro","montenegro","EUR","","0.00","0.00","","","","","Active","2014-12-13 16:40:33","No","0","0","0","","en");INSERT INTO fc_country VALUES("130","AF","MG","+261","Madagascar","madagascar","MGF","","0.00","0.00","","","","","Active","2014-12-13 16:40:47","No","0","0","0","","en");INSERT INTO fc_country VALUES("131","OC","MH","+692","Marshall Islands","marshall-islands","USD","","0.00","0.00","","","","","Active","2014-12-13 16:41:04","No","0","0","0","","en");INSERT INTO fc_country VALUES("132","","MK","+389","Macedonia","macedonia","MKD","","0.00","0.00","","","","","Active","2014-12-13 16:41:20","No","0","0","0","","en");INSERT INTO fc_country VALUES("133","AF","ML","+223","Mali","mali","XOF","","0.00","0.00","","","","","Active","2014-12-13 16:41:33","No","0","0","0","","en");INSERT INTO fc_country VALUES("134","AS","MM","+95","Myanmar","myanmar","MMK","","0.00","0.00","","","","","Active","2014-12-13 16:42:12","No","0","0","0","","en");INSERT INTO fc_country VALUES("135","AS","MN","+976","Mongolia","mongolia","MNT","","0.00","0.00","","","","","Active","2014-12-13 16:42:26","No","0","0","0","","en");INSERT INTO fc_country VALUES("136","","MO","+853","Macao","macao","MOP","","0.00","0.00","","","","","Active","2014-12-13 16:42:38","No","0","0","0","","en");INSERT INTO fc_country VALUES("137","OC","MP","+1 670","Northern Mariana Islands","northern-mariana-islands","USD","","0.00","0.00","","","","","Active","2014-12-13 16:42:58","No","0","0","0","","en");INSERT INTO fc_country VALUES("138","NA","MQ","+596","Martinique","martinique","EUR","","0.00","0.00","","","","","Active","2014-12-13 16:43:48","No","0","0","0","","en");INSERT INTO fc_country VALUES("139","AF","MR","+222","Mauritania","mauritania","MRO","","0.00","0.00","","","","","Active","2014-12-13 16:44:00","No","0","0","0","","en");INSERT INTO fc_country VALUES("140","NA","MS","+1664","Montserrat","montserrat","XCD","","0.00","0.00","","","","","Active","2014-12-13 16:44:26","No","0","0","0","","en");INSERT INTO fc_country VALUES("141","AF","MU","+230","Mauritius","mauritius","MUR","","0.00","0.00","","","","","Active","2014-12-13 16:45:18","No","0","0","0","","en");INSERT INTO fc_country VALUES("142","AS","MV","+960","Maldives","maldives","MVR","","0.00","0.00","","","","","Active","2014-12-13 16:45:31","No","0","0","0","","en");INSERT INTO fc_country VALUES("143","AF","MW","+265","Malawi","malawi","MWK","","0.00","0.00","","","","","Active","2014-12-13 16:45:47","No","0","0","0","","en");INSERT INTO fc_country VALUES("144","NA","MX","+52","Mexico","mexico","MXN","","0.00","0.00","","","","<p><strong>Traveling to Mexico</strong></p>
<p>Mexico vacation rentals and Mexico vacation homes have increased in volume, as has the tourism industry in the area. This is one of the most popular places to visit in the whole of North  America and it is easy to see why. Mexico covers a huge surface area of around 760,000 square miles, which means there is certainly not a shortage of things to see and do here.</p>
<p>&nbsp;</p>
<p><strong>Things to do in Mexico</strong></p>
<p>After checking into Mexico vacation rentals and Mexico vacation homes, listing the places to visit is certainly a worth while thing to do. One thing that this place is known for is having some great sites of archaeological interest, which are great with people that love to explore. It was here that many different forms of communication were developed, including writing. Alongside this, lots of arithmetic and astronomy based discoveries have been made here over the centuries, which makes this an interesting place to visit for all of the family.</p>
<p>&nbsp;</p>
<p>Of course, a visit to a Mexico vacation rental will allow people to explore some of the many beaches that are on offer. The reality is that there is certainly not a shortage of top quality beaches to explore. Mexico is home to around 6,000 miles of coast line, which means that there are a great range of different beaches, including coves, caves but also small bays. The waves here are not particularly large, but many of the beaches are well known for incorporating exciting water sports into every day life.</p>
<p>&nbsp;</p>
<p>Alongside the beaches and the many archaeological discoveries that are worth exploring, another option is to experience many of the adventures that are on offer. Mexico is full of tour guides that specialise in all types of things. This includes the likes of 4x4 tours, but also guided walks and mountain bike rides. This allows people to explore this great place using different forms of transport, which allows them to see Mexico in a whole new light. Of course, there are plenty of options to choose from here.</p>
<p>&nbsp;</p>
<p><strong>Accommodations in Mexico</strong></p>
<p>Accommodations in Mexico have been a huge part of helping to grow the tourism industry here. The Ritz Carlton is certainly one of the greater hotels in the area. Just in front of it, is around 1,200ft of white sandy beach, which means relaxing here is certainly not going to be difficult. It is conveniently located, which means that all the major attractions are within a short distance of the hotel here. The facilities here are more than luxurious and they help people to see the true beauty of Mexico.</p>
<p>&nbsp;</p>
<p><strong>Weather in Mexico</strong></p>
<p>The weather in Mexico is known for being exceptional during the summer months, which makes it perfect for a summer vacation. During the summer months, throughout this great destination, visitors should expect temperatures of around 28 &deg;C which is warm, but certainly comfortable at the same time. It is during the summer months that the majority of the tourists that visit here.</p>","Active","2014-12-13 16:46:20","No","0","0","0","","en");INSERT INTO fc_country VALUES("145","AS","MY","+60","Malaysia","malaysia","MYR","","0.00","0.00","","","","","Active","2015-02-19 14:48:00","No","0","0","0","","en");INSERT INTO fc_country VALUES("146","AF","MZ","+258","Mozambique","mozambique","MZN","","0.00","0.00","","","","","Active","2014-12-13 16:46:46","No","0","0","0","","en");INSERT INTO fc_country VALUES("147","AF","NA","+264","Namibia","namibia","NAD","","0.00","0.00","","","","","Active","2014-12-13 16:47:10","No","0","0","0","","en");INSERT INTO fc_country VALUES("148","OC","NC","+687","New Caledonia","new-caledonia","CFP","","0.00","0.00","","","","","Active","2014-12-13 16:47:31","No","0","0","0","","en");INSERT INTO fc_country VALUES("149","AF","NE","+227","Niger","niger","XOF","","0.00","0.00","","","","","Active","2014-12-13 16:48:48","No","0","0","0","","en");INSERT INTO fc_country VALUES("150","AF","NG","+234","Nigeria","nigeria","NGN","","0.00","0.00","","","","","Active","2014-12-13 16:49:28","No","0","0","0","","en");INSERT INTO fc_country VALUES("151","NA","NI","+505","Nicaragua","nicaragua","NIO","","0.00","0.00","","","","","Active","2014-12-13 16:49:48","No","0","0","0","","en");INSERT INTO fc_country VALUES("152","EU","NL","+31","Netherlands","netherlands","EUR","","0.00","0.00","","","","","Active","2014-12-13 16:50:05","No","0","0","0","","en");INSERT INTO fc_country VALUES("153","EU","NO","+47","Norway","norway","NOK","","0.00","0.00","","","","","Active","2014-12-13 16:50:23","No","0","0","0","","en");INSERT INTO fc_country VALUES("154","AS","NP","+977","Nepal","nepal","NPR","","0.00","0.00","","","","","Active","2014-12-13 16:50:36","No","0","0","0","","en");INSERT INTO fc_country VALUES("155","OC","NR","+674","Nauru","nauru","AUD","","0.00","0.00","","","","","Active","2014-12-13 16:50:59","No","0","0","0","","en");INSERT INTO fc_country VALUES("156","OC","NZ","+64","New Zealand","new-zealand","NZD","","0.00","0.00","","","","","Active","2014-12-13 16:51:14","No","0","0","0","","en");INSERT INTO fc_country VALUES("157","AS","OM","+968","Oman","oman","OMR","","0.00","0.00","","","","","Active","2014-12-13 16:51:28","No","0","0","0","","en");INSERT INTO fc_country VALUES("158","NA","PA","+507","Panama","panama","PAB","","0.00","0.00","","","","","Active","2014-12-13 16:51:42","No","0","0","0","","en");INSERT INTO fc_country VALUES("159","SA","PE","+51","Peru","peru","PEN","","0.00","0.00","","","","","Active","2014-12-13 16:51:53","No","0","0","0","","en");INSERT INTO fc_country VALUES("160","OC","PF","+689","French Polynesia","french-polynesia","CFP","","0.00","0.00","","","","","Active","2014-12-13 16:52:06","No","0","0","0","","en");INSERT INTO fc_country VALUES("161","OC","PG","+675","Papua New Guinea","papua-new-guinea","PGK","","0.00","0.00","","","","","Active","2014-12-13 16:52:20","No","0","0","0","","en");INSERT INTO fc_country VALUES("162","AS","PH","+63","Philippines","philippines","PHP","","0.00","0.00","","","","","Active","2014-12-13 16:52:36","No","0","0","0","","en");INSERT INTO fc_country VALUES("163","AS","PK","+92","Pakistan","pakistan","PKR","","0.00","0.00","","","","","Active","2014-12-13 16:52:51","No","0","0","0","","en");INSERT INTO fc_country VALUES("164","EU","PL","+48 ","Poland","poland","PLN","","0.00","0.00","","","","","Active","2014-12-13 16:53:11","No","0","0","0","","en");INSERT INTO fc_country VALUES("165","","PM","+508","Saint Pierre And Miquelon","saint-pierre-and-miquelon","EUR","","0.00","0.00","","","","","Active","2014-12-13 16:53:39","No","0","0","0","","en");INSERT INTO fc_country VALUES("166","NA","PR","+787","Puerto Rico","puerto-rico","USD","","0.00","0.00","","","","","Active","2014-12-13 16:54:15","No","0","0","0","","en");INSERT INTO fc_country VALUES("167","","PS","+970","Palestinian Territory","palestinian-territory","PAB","","0.00","0.00","","","","","Active","2014-12-13 16:54:43","No","0","0","0","","en");INSERT INTO fc_country VALUES("168","EU","PT","+351","Portugal","portugal","EUR","","0.00","0.00","","","","","Active","2014-12-13 16:55:07","No","0","0","0","","en");INSERT INTO fc_country VALUES("169","OC","PW","+680","Palau","palau","USD","","0.00","0.00","","","","","Active","2014-12-13 16:56:25","No","0","0","0","","en");INSERT INTO fc_country VALUES("170","SA","PY","+595","Paraguay","paraguay","PYG","","0.00","0.00","","","","","Active","2014-12-13 16:56:38","No","0","0","0","","en");INSERT INTO fc_country VALUES("171","AS","QA","+974","Qatar","qatar","QAR","","0.00","0.00","","","","","Active","2014-12-13 16:56:55","No","0","0","0","","en");INSERT INTO fc_country VALUES("172","AF","RE","+262","Reunion","reunion","EUR","","0.00","0.00","","","","","Active","2014-12-13 16:57:12","No","0","0","0","","en");INSERT INTO fc_country VALUES("173","EU","RO","+40","Romania","romania","RON","","0.00","0.00","","","","","Active","2014-12-13 16:57:23","No","0","0","0","","en");INSERT INTO fc_country VALUES("174","","RS","+381","Serbia","serbia","RSD","","0.00","0.00","","","","","Active","2014-12-13 16:57:37","No","0","0","0","","en");INSERT INTO fc_country VALUES("175","","RU","+7","Russia","russia","RUB","","0.00","0.00","","","","","Active","2014-12-13 16:57:54","No","0","0","0","","en");INSERT INTO fc_country VALUES("176","AF","RW","+250","Rwanda","rwanda","RWF","","0.00","0.00","","","","","Active","2014-12-13 16:58:06","No","0","0","0","","en");INSERT INTO fc_country VALUES("177","AS","SA","+966","Saudi Arabia","saudi-arabia","SAR","","0.00","0.00","","","","","Active","2014-12-13 16:58:20","No","0","0","0","","en");INSERT INTO fc_country VALUES("178","OC","SB","+677","Solomon Islands","solomon-islands","SBD","","0.00","0.00","","","","","Active","2014-12-13 16:58:38","No","0","0","0","","en");INSERT INTO fc_country VALUES("179","AF","SC","+248 ","Seychelles","seychelles","SCR","","0.00","0.00","","","","","Active","2014-12-13 17:00:16","No","0","0","0","","en");INSERT INTO fc_country VALUES("180","AF","SD","+249","Sudan","sudan","SDG","","0.00","0.00","","","","","Active","2014-12-13 17:00:30","No","0","0","0","","en");INSERT INTO fc_country VALUES("181","EU","SE","+46 ","Sweden","sweden","SEK","","0.00","0.00","","","","","Active","2014-12-13 17:01:07","No","0","0","0","","en");INSERT INTO fc_country VALUES("182","AS","SG","+65","Singapore","singapore","SGD","","0.00","0.00","","","","","Active","2014-12-13 17:01:24","No","0","0","0","","en");INSERT INTO fc_country VALUES("183","","SH","+290","Saint Helena","saint-helena","SHP","","0.00","0.00","","","","","Active","2014-12-13 17:01:36","No","0","0","0","","en");INSERT INTO fc_country VALUES("184","EU","SI","+386","Slovenia","slovenia","EUR","","0.00","0.00","","","","","Active","2014-12-13 17:01:50","No","0","0","0","","en");INSERT INTO fc_country VALUES("185","","SJ","+47","Svalbard And Jan Mayen","svalbard-and-jan-mayen","NOK","","0.00","0.00","","","","","Active","2014-12-13 17:02:26","No","0","0","0","","en");INSERT INTO fc_country VALUES("186","","SK","+421","Slovakia","slovakia","EUR","","0.00","0.00","","","","","Active","2014-12-13 17:02:38","No","0","0","0","","en");INSERT INTO fc_country VALUES("187","AF","SL","+232","Sierra Leone","sierra-leone","SLL","","0.00","0.00","","","","","Active","2014-12-13 17:02:52","No","0","0","0","","en");INSERT INTO fc_country VALUES("188","EU","SM","+378","San Marino","san-marino","EUR","","0.00","0.00","","","","","Active","2014-12-13 17:03:13","No","0","0","0","","en");INSERT INTO fc_country VALUES("189","AF","SN","+221","Senegal","senegal","XOF","","0.00","0.00","","","","","Active","2014-12-13 17:03:27","No","0","0","0","","en");INSERT INTO fc_country VALUES("190","AF","SO","+252","Somalia","somalia","SOS","","0.00","0.00","","","","","Active","2014-12-13 17:03:41","No","0","0","0","","en");INSERT INTO fc_country VALUES("191","SA","SR","+597","Suriname","suriname","SRD","","0.00","0.00","","","","","Active","2014-12-13 17:03:54","No","0","0","0","","en");INSERT INTO fc_country VALUES("192","","SS","+211","South Sudan","south-sudan","SSP","","0.00","0.00","","","","","Active","2014-12-13 17:04:41","No","0","0","0","","en");INSERT INTO fc_country VALUES("193","AF","ST","+239","Sao Tome And Principe","sao-tome-and-principe","STD","","0.00","0.00","","","","","Active","2014-12-13 17:04:57","No","0","0","0","","en");INSERT INTO fc_country VALUES("194","NA","SV","+503","El Salvador","el-salvador","SVC","","0.00","0.00","","","","","Active","2014-12-13 17:05:19","No","0","0","0","","en");INSERT INTO fc_country VALUES("195","","SY","+963","Syria","syria","SYP","","0.00","0.00","","","","","Active","2014-12-13 17:05:43","No","0","0","0","","en");INSERT INTO fc_country VALUES("196","AF","SZ","+268","Swaziland","swaziland","SZL","","0.00","0.00","","","","","Active","2014-12-13 17:06:03","No","0","0","0","","en");INSERT INTO fc_country VALUES("197","AF","TD","+235","Chad","chad","XAF","","0.00","0.00","","","","","Active","2014-12-13 17:07:02","No","0","0","0","","en");INSERT INTO fc_country VALUES("198","AN","TF","","French Southern Territories","french-southern-territories","EUR","","0.00","0.00","","","","","Active","2014-08-26 07:54:29","No","0","0","0","","en");INSERT INTO fc_country VALUES("199","AF","TG","+228","Togo","togo","XOF","","0.00","0.00","","","","","Active","2014-12-13 17:10:14","No","0","0","0","","en");INSERT INTO fc_country VALUES("200","AS","TH","+66","Thailand","thailand","THB","","0.00","0.00","","","","","Active","2014-12-13 17:10:38","No","0","0","0","","en");INSERT INTO fc_country VALUES("201","AS","TJ","+992","Tajikistan","tajikistan","TJS","","0.00","0.00","","","","","Active","2014-12-13 17:10:53","No","0","0","0","","en");INSERT INTO fc_country VALUES("202","OC","TK","+690","Tokelau","tokelau","NZD","","0.00","0.00","","","","","Active","2014-12-13 17:11:07","No","0","0","0","","en");INSERT INTO fc_country VALUES("203","OC","TL","+670","East Timor","east-timor","USD","","0.00","0.00","","","","","Active","2014-12-13 17:11:19","No","0","0","0","","en");INSERT INTO fc_country VALUES("204","AS","TM","+993","Turkmenistan","turkmenistan","TMT","","0.00","0.00","","","","","Active","2014-12-13 17:11:30","No","0","0","0","","en");INSERT INTO fc_country VALUES("205","AF","TN","+216","Tunisia","tunisia","TND","","0.00","0.00","","","","","Active","2014-12-13 17:11:44","No","0","0","0","","en");INSERT INTO fc_country VALUES("206","OC","TO","+676","Tonga","tonga","TOP","","0.00","0.00","","","","","Active","2014-12-13 17:12:00","No","0","0","0","","en");INSERT INTO fc_country VALUES("207","AS","TR","+90","Turkey","turkey","TRY","","0.00","0.00","","","","","Active","2014-12-13 17:18:51","No","0","0","0","","en");INSERT INTO fc_country VALUES("208","NA","TT","+868
","Trinidad And Tobago","trinidad-and-tobago","TTD","","0.00","0.00","","","","","Active","2014-12-13 17:19:41","No","0","0","0","","en");INSERT INTO fc_country VALUES("209","OC","TV","+688","Tuvalu","tuvalu","AUD","","0.00","0.00","","","","","Active","2014-12-13 17:19:56","No","0","0","0","","en");INSERT INTO fc_country VALUES("210","AS","TW","+886","Taiwan","taiwan","TWD","","0.00","0.00","","","","","Active","2014-12-13 17:47:11","No","0","0","0","","en");INSERT INTO fc_country VALUES("211","","TZ","+255","Tanzania","tanzania","TZS","","0.00","0.00","","","","","Active","2014-12-13 17:47:54","No","0","0","0","","en");INSERT INTO fc_country VALUES("212","EU","UA","+380","Ukraine","ukraine","UAH","","0.00","0.00","","","","","Active","2014-12-13 17:48:07","No","0","0","0","","en");INSERT INTO fc_country VALUES("213","AF","UG","+256","Uganda","uganda","UGX","","0.00","0.00","","","","","Active","2014-12-13 17:48:31","No","0","0","0","","en");INSERT INTO fc_country VALUES("214","OC","UM","+1","United States Minor Outlying Islands","united-states-minor-outlying-islands","USD","","0.00","0.00","","","","","Active","2014-12-13 17:50:23","No","0","0","0","","en");INSERT INTO fc_country VALUES("215","NA","US","+1","United States","united-states","USD","0","0.00","0.00","","","","","Active","2014-12-13 17:50:51","No","0","0","0","","da");INSERT INTO fc_country VALUES("216","SA","UY","+598
","Uruguay","uruguay","UYU","","0.00","0.00","","","","","Active","2014-12-13 17:51:11","No","0","0","0","","en");INSERT INTO fc_country VALUES("217","AS","UZ","+998","Uzbekistan","uzbekistan","UZS","","0.00","0.00","","","","","Active","2014-12-13 17:51:22","No","0","0","0","","en");INSERT INTO fc_country VALUES("218","NA","VC","+1 784 ","Saint Vincent And The Grenadines","saint-vincent-and-the-grenadines","XCD","","0.00","0.00","","","","","Active","2014-12-13 17:51:38","No","0","0","0","","en");INSERT INTO fc_country VALUES("219","SA","VE","+58","Venezuela","venezuela","VEF","","0.00","0.00","","","","","Active","2014-12-13 17:51:53","No","0","0","0","","en");INSERT INTO fc_country VALUES("220","","VI","+1 340","U.S. Virgin Islands","u.s.-virgin-islands","USD","","0.00","0.00","","","","","Active","2014-12-13 17:52:21","No","0","0","0","","en");INSERT INTO fc_country VALUES("221","","VN","+84","Vietnam","vietnam","VND","","0.00","0.00","","","","","Active","2014-12-13 17:52:37","No","0","0","0","","en");INSERT INTO fc_country VALUES("222","OC","VU","+678","Vanuatu","vanuatu","VUV","","0.00","0.00","","","","","Active","2014-12-13 17:52:47","No","0","0","0","","en");INSERT INTO fc_country VALUES("223","","WF","+681 ","Wallis And Futuna","wallis-and-futuna","XPF","","0.00","0.00","","","","","Active","2014-12-13 17:53:12","No","0","0","0","","en");INSERT INTO fc_country VALUES("224","OC","WS","+685","Samoa","samoa","WST","","0.00","0.00","","","","","Active","2014-12-13 17:53:28","No","0","0","0","","en");INSERT INTO fc_country VALUES("225","","XK","+381","Kosovo","kosovo","EUR","","0.00","0.00","","","","","Active","2014-12-13 17:53:43","No","0","0","0","","en");INSERT INTO fc_country VALUES("226","AS","YE","+967","Yemen","yemen","YER","","0.00","0.00","","","","","Active","2014-12-13 17:53:55","No","0","0","0","","en");INSERT INTO fc_country VALUES("227","AF","YT","+262","Mayotte","mayotte","EUR","","0.00","0.00","","","","","Active","2014-12-13 17:54:08","No","0","0","0","","en");INSERT INTO fc_country VALUES("228","AF","ZA","+27","South Africa","south-africa","ZAR","","0.00","0.00","","","","","Active","2014-12-13 17:54:19","No","0","0","0","","en");INSERT INTO fc_country VALUES("229","AF","ZM","+260","Zambia","zambia","ZMW","","0.00","0.00","","","","","Active","2014-12-13 17:54:39","No","0","0","0","","en");INSERT INTO fc_country VALUES("230","AF","ZW","+263","Zimbabwe","zimbabwe","ZWD","","0.00","0.00","","","","","Active","2014-12-13 17:54:56","No","0","0","0","","en");CREATE TABLE `fc_couponcards` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `coupon_name` varchar(250) NOT NULL,
  `code` varchar(50) NOT NULL,
  `price_type` enum('1','2','3') NOT NULL DEFAULT '1',
  `coupon_type` varchar(500) NOT NULL,
  `price_value` float(10,2) NOT NULL,
  `quantity` int(100) NOT NULL,
  `description` blob NOT NULL,
  `datefrom` date NOT NULL,
  `dateto` date NOT NULL,
  `category_id` varchar(500) NOT NULL,
  `product_id` varchar(500) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `card_status` enum('redeemed','not used','expired') NOT NULL DEFAULT 'not used',
  `purchase_count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;INSERT INTO fc_couponcards VALUES("1","TEST","TEST5","2","","5.00","5","","2016-08-30","2016-09-07","","","Active","redeemed","5");INSERT INTO fc_couponcards VALUES("2","demo testing","12345","2","","10.00","10","","2016-09-01","2016-09-30","","","Active","not used","0");INSERT INTO fc_couponcards VALUES("3","testing again","55555","1","","20.00","10","","2016-09-01","2016-09-30","","","Active","not used","0");CREATE TABLE `fc_currency` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(255) NOT NULL,
  `seourl` varchar(755) NOT NULL,
  `currency_symbols` text NOT NULL,
  `currency_rate` float(10,2) NOT NULL,
  `currency_type` char(3) NOT NULL,
  `meta_title` blob NOT NULL,
  `meta_keyword` blob NOT NULL,
  `meta_description` blob NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `default_currency` enum('No','Yes') NOT NULL DEFAULT 'No',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;INSERT INTO fc_currency VALUES("3","United States Dollar","united-states-dollar","$","1.00","USD","","","","Active","2016-07-01 16:25:01","Yes");INSERT INTO fc_currency VALUES("4","Philippines","philippines","₱","47.55","PHP","","","","Active","2016-09-12 19:21:03","No");INSERT INTO fc_currency VALUES("5","Ecuador","ecuador","€","0.89","EUR","","","","InActive","2016-09-12 19:21:04","No");INSERT INTO fc_currency VALUES("10","India","india","Rs","66.90","INR","","","","Active","2016-09-12 19:21:06","No");INSERT INTO fc_currency VALUES("12","Malaysia","malaysia","RM","4.13","MYR","","","","Active","2016-09-12 19:21:07","No");INSERT INTO fc_currency VALUES("13","United Kingdom","united-kingdom","£","0.75","GBP","","","","Active","2016-07-01 16:25:11","No");INSERT INTO fc_currency VALUES("14","Greenland","greenland","Kr","6.64","DKK","","","","Active","2016-09-12 19:21:09","No");CREATE TABLE `fc_dispute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prd_id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  `message` varchar(200) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;CREATE TABLE `fc_help_main` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `type` enum('Both','User','Host') NOT NULL DEFAULT 'Both',
  `status` enum('Active','InActive') NOT NULL DEFAULT 'Active',
  `lang` varchar(25) NOT NULL DEFAULT 'en',
  `toId` int(11) NOT NULL,
  `seo` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;CREATE TABLE `fc_help_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `main` int(11) NOT NULL,
  `sub` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `feature` enum('yes','no') NOT NULL,
  `lang` varchar(25) NOT NULL DEFAULT 'en',
  `toId` int(11) NOT NULL,
  `seo` varchar(250) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;CREATE TABLE `fc_help_sub` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `main` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` enum('User','Host','Both') NOT NULL DEFAULT 'User',
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `lang` varchar(25) NOT NULL DEFAULT 'en',
  `toId` int(11) NOT NULL,
  `seo` varchar(250) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;CREATE TABLE `fc_hostalert` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hostId` int(11) NOT NULL,
  `propertyId` int(11) NOT NULL,
  `seen` enum('no','yes') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;CREATE TABLE `fc_inbox` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(1000) NOT NULL,
  `sender_id` varchar(1000) NOT NULL,
  `product_id` int(100) NOT NULL,
  `description` blob NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mailsubject` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;INSERT INTO fc_inbox VALUES("1","3","muthukrishnan@teamtweaks.com","0","<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
			<meta name=\"viewport\" content=\"width=device-width\"/><body><table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img style=\"margin: 15px 5px 0; padding: 0px; border: none;\" src=\"http://192.168.1.251:8081/renters/renters2.1/images/logo/admin_logo.png\" alt=\"logo\" width=\"200\" /></td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi vasu s</td>
</tr>
<tr>
<td height=\"50\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">We\'re excited to tell you that you have booked Sample Listing To help make check-in seamless, we suggest you continue the conversation with Muthu Krishnan</td>
</tr>
<tr>
<td style=\"color: #000; padding: 10px 20px 10px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">through Renters\'s message system to confirm their arrival time, ask any questions you may have, and help them figure out how to best get to your listing.</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 10px; font-weight: bold; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\" valign=\"top\">Itinerary</td>
</tr>
<tr>
<td align=\"center\" valign=\"middle\">
<div style=\"background-color: #f3402e; display: table; border-radius: 5px; color: #ffffff; font-family: Open Sans, Arial, sans-serif; font-size: 13px; text-transform: uppercase; font-weight: bold; padding: 7px 12px; text-align: center; text-decoration: none; width: 140px; margin: auto;\"><a style=\"color: #ffffff; text-decoration: none;\" href=\"http://192.168.1.251:8081/renters/renters2.1/rental/1\"><img src=\"http://192.168.1.251:8081/renters/renters2.1/server/php/rental/Tulips6.jpg\" alt=\"\" width=\"300\" /> Sample Listing</a></div>
</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\" bgcolor=\"#EAEAEA\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th width=\"75\">Time</th> <th width=\"75\">Date</th>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Arrive</td>
<td bgcolor=\"#FFFFFF\">01-Sep-2016</td>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Depart</td>
<td bgcolor=\"#FFFFFF\">03-Sep-2016</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th align=\"left\">Your Green house</th>
</tr>
<tr bgcolor=\"#EAEAEA\">
<td width=\"150px\"><img src=\"http://rc.nextio.co.kr/images/users/\" alt=\"\" width=\"50\" height=\"50\" /></td>
<td>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\">Muthu Krishnan</td>
</tr>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\">9790605724</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold;\" align=\"left\">Payment</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">On the day after the guest checks in, the payout method you supplied will be credited. For details, see your Transaction History.</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold;\" align=\"left\">Cancellation Policy</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">Flexible: Full refund 1 day prior to arrival, except fees</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #4f595b; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; padding: 0px 20px;\" width=\"300px\" align=\"left\" valign=\"top\">                                                        
<table style=\"width: 100%; font-size: 13px;\">
<tbody>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\">for 2 Night</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\"><span>KRW&nbsp;</span>100.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Service Fee</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 2.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Total</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 102.00</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renters Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table></body>","2016-08-30 17:29:16","Notification Mail");INSERT INTO fc_inbox VALUES("2","3","muthukrishnan@teamtweaks.com","0","<body><table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img style=\"margin: 15px 5px 0; padding: 0px; border: none;\" src=\"http://192.168.1.251:8081/renters/renters2.1/images/logo/admin_logo.png\" alt=\"\" width=\"200\" /></td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi Admin</td>
</tr>
<tr>
<td height=\"50\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">We\'re excited to tell you that vasu s just booked Sample Listing with Muthu Krishnan</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 10px; font-weight: bold; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\" valign=\"top\">Itinerary</td>
</tr>
<tr>
<td align=\"center\" valign=\"middle\">
<div style=\"background-color: #f3402e; display: table; border-radius: 5px; color: #ffffff; font-family: Open Sans, Arial, sans-serif; font-size: 13px; text-transform: uppercase; font-weight: bold; padding: 7px 12px; text-align: center; text-decoration: none; width: 140px; margin: auto;\"><a style=\"color: #ffffff; text-decoration: none;\" href=\"http://192.168.1.251:8081/renters/renters2.1/rental/1\"><img src=\"http://192.168.1.251:8081/renters/renters2.1/server/php/rental/Tulips6.jpg\" alt=\"\" /> Sample Listing</a></div>
</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\" bgcolor=\"#EAEAEA\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th width=\"75\">Time</th> <th width=\"75\">Date</th>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Arrive</td>
<td bgcolor=\"#FFFFFF\">01-09-16</td>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Depart</td>
<td bgcolor=\"#FFFFFF\">03-09-16</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th align=\"left\">Guest</th>
</tr>
<tr bgcolor=\"#EAEAEA\">
<td width=\"150px\"><img src=\"product.png\" alt=\"\" /></td>
<td>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\">vasu s</td>
</tr>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\"></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #4f595b; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; padding: 0px 20px;\" width=\"300px\" align=\"left\" valign=\"top\">
<table style=\"width: 100%; font-size: 13px;\">
<tbody>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\"><span>KRW</span> *2 Night</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\"><span>KRW</span> 100.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\">Service Fee</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\"><span>KRW</span> 2.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Total</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 102.00</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renters Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table></body>
			</html>","2016-08-30 17:29:16","Reservation Confirmed");INSERT INTO fc_inbox VALUES("3","3","tomcabout@gmail.com","0","<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
			<meta name=\"viewport\" content=\"width=device-width\"/><body><table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img style=\"margin: 15px 5px 0; padding: 0px; border: none;\" src=\"http://192.168.1.251:8081/renters/renters2.1/images/logo/admin_logo.png\" alt=\"\" width=\"200\" /></td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi Muthu Krishnan</td>
</tr>
<tr>
<td height=\"50\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">We\'re excited to tell you that, your Sample Listing is booked now. To help make check-in seamless, we suggest you continue the conversation with your guest vasu s</td>
</tr>
<tr>
<td style=\"color: #000; padding: 10px 20px 10px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">through Renter\'s message system to confirm your guest arrival time, ask any questions you may have, and help them figure out how to best get to your listing.</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 10px; font-weight: bold; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\" valign=\"top\">Itinerary</td>
</tr>
<tr>
<td align=\"center\" valign=\"middle\">
<div style=\"background-color: #f3402e; display: table; border-radius: 5px; color: #ffffff; font-family: Open Sans, Arial, sans-serif; font-size: 13px; text-transform: uppercase; font-weight: bold; padding: 7px 12px; text-align: center; text-decoration: none; width: 140px; margin: auto;\"><a style=\"color: #ffffff; text-decoration: none;\" href=\"http://192.168.1.251:8081/renters/renters2.1/rental/1\"><img src=\"http://192.168.1.251:8081/renters/renters2.1/server/php/rental/Tulips6.jpg\" alt=\"\" width=\"300\" /> Sample Listing</a></div>
</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\" bgcolor=\"#EAEAEA\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th width=\"75\">Time</th> <th width=\"75\">Date</th>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Arrive</td>
<td bgcolor=\"#FFFFFF\">01-Sep-2016</td>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Depart</td>
<td bgcolor=\"#FFFFFF\">03-Sep-2016</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #4f595b; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; padding: 0px 20px;\" width=\"300px\" align=\"left\" valign=\"top\">           
<table style=\"width: 100%; font-size: 13px;\">
<tbody>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\">for2 Night</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\"><span>KRW</span> 100.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Service Fee</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 2.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Total</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 102.00</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renter Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table></body>
			</html>","2016-08-30 17:29:17","Reservation Confirmation");INSERT INTO fc_inbox VALUES("4","3","muthukrishnan@teamtweaks.com","0","<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
			<meta name=\"viewport\" content=\"width=device-width\"/><body><table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img style=\"margin: 15px 5px 0; padding: 0px; border: none;\" src=\"http://192.168.1.251:8081/renters/renters2.1/images/logo/admin_logo.png\" alt=\"logo\" width=\"200\" /></td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi vasu s</td>
</tr>
<tr>
<td height=\"50\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">We\'re excited to tell you that you have booked Sample Listing To help make check-in seamless, we suggest you continue the conversation with Muthu Krishnan</td>
</tr>
<tr>
<td style=\"color: #000; padding: 10px 20px 10px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">through Renters\'s message system to confirm their arrival time, ask any questions you may have, and help them figure out how to best get to your listing.</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 10px; font-weight: bold; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\" valign=\"top\">Itinerary</td>
</tr>
<tr>
<td align=\"center\" valign=\"middle\">
<div style=\"background-color: #f3402e; display: table; border-radius: 5px; color: #ffffff; font-family: Open Sans, Arial, sans-serif; font-size: 13px; text-transform: uppercase; font-weight: bold; padding: 7px 12px; text-align: center; text-decoration: none; width: 140px; margin: auto;\"><a style=\"color: #ffffff; text-decoration: none;\" href=\"http://192.168.1.251:8081/renters/renters2.1/rental/1\"><img src=\"http://192.168.1.251:8081/renters/renters2.1/server/php/rental/Tulips6.jpg\" alt=\"\" width=\"300\" /> Sample Listing</a></div>
</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\" bgcolor=\"#EAEAEA\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th width=\"75\">Time</th> <th width=\"75\">Date</th>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Arrive</td>
<td bgcolor=\"#FFFFFF\">06-Sep-2016</td>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Depart</td>
<td bgcolor=\"#FFFFFF\">08-Sep-2016</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th align=\"left\">Your Green house</th>
</tr>
<tr bgcolor=\"#EAEAEA\">
<td width=\"150px\"><img src=\"http://rc.nextio.co.kr/images/users/\" alt=\"\" width=\"50\" height=\"50\" /></td>
<td>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\">Muthu Krishnan</td>
</tr>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\">9790605724</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold;\" align=\"left\">Payment</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">On the day after the guest checks in, the payout method you supplied will be credited. For details, see your Transaction History.</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold;\" align=\"left\">Cancellation Policy</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">Flexible: Full refund 1 day prior to arrival, except fees</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #4f595b; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; padding: 0px 20px;\" width=\"300px\" align=\"left\" valign=\"top\">                                                        
<table style=\"width: 100%; font-size: 13px;\">
<tbody>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\">for 2 Night</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\"><span>KRW&nbsp;</span>30.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Service Fee</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 2.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Total</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 32.00</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renters Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table></body>","2016-08-30 17:40:16","Notification Mail");INSERT INTO fc_inbox VALUES("5","3","muthukrishnan@teamtweaks.com","0","<body><table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img style=\"margin: 15px 5px 0; padding: 0px; border: none;\" src=\"http://192.168.1.251:8081/renters/renters2.1/images/logo/admin_logo.png\" alt=\"\" width=\"200\" /></td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi Admin</td>
</tr>
<tr>
<td height=\"50\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">We\'re excited to tell you that vasu s just booked Sample Listing with Muthu Krishnan</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 10px; font-weight: bold; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\" valign=\"top\">Itinerary</td>
</tr>
<tr>
<td align=\"center\" valign=\"middle\">
<div style=\"background-color: #f3402e; display: table; border-radius: 5px; color: #ffffff; font-family: Open Sans, Arial, sans-serif; font-size: 13px; text-transform: uppercase; font-weight: bold; padding: 7px 12px; text-align: center; text-decoration: none; width: 140px; margin: auto;\"><a style=\"color: #ffffff; text-decoration: none;\" href=\"http://192.168.1.251:8081/renters/renters2.1/rental/1\"><img src=\"http://192.168.1.251:8081/renters/renters2.1/server/php/rental/Tulips6.jpg\" alt=\"\" /> Sample Listing</a></div>
</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\" bgcolor=\"#EAEAEA\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th width=\"75\">Time</th> <th width=\"75\">Date</th>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Arrive</td>
<td bgcolor=\"#FFFFFF\">06-09-16</td>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Depart</td>
<td bgcolor=\"#FFFFFF\">08-09-16</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th align=\"left\">Guest</th>
</tr>
<tr bgcolor=\"#EAEAEA\">
<td width=\"150px\"><img src=\"product.png\" alt=\"\" /></td>
<td>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\">vasu s</td>
</tr>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\"></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #4f595b; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; padding: 0px 20px;\" width=\"300px\" align=\"left\" valign=\"top\">
<table style=\"width: 100%; font-size: 13px;\">
<tbody>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\"><span>KRW</span> *2 Night</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\"><span>KRW</span> 30.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\">Service Fee</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\"><span>KRW</span> 2.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Total</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 32.00</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renters Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table></body>
			</html>","2016-08-30 17:40:17","Reservation Confirmed");INSERT INTO fc_inbox VALUES("6","3","tomcabout@gmail.com","0","<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
			<meta name=\"viewport\" content=\"width=device-width\"/><body><table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img style=\"margin: 15px 5px 0; padding: 0px; border: none;\" src=\"http://192.168.1.251:8081/renters/renters2.1/images/logo/admin_logo.png\" alt=\"\" width=\"200\" /></td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi Muthu Krishnan</td>
</tr>
<tr>
<td height=\"50\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">We\'re excited to tell you that, your Sample Listing is booked now. To help make check-in seamless, we suggest you continue the conversation with your guest vasu s</td>
</tr>
<tr>
<td style=\"color: #000; padding: 10px 20px 10px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">through Renter\'s message system to confirm your guest arrival time, ask any questions you may have, and help them figure out how to best get to your listing.</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 10px; font-weight: bold; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\" valign=\"top\">Itinerary</td>
</tr>
<tr>
<td align=\"center\" valign=\"middle\">
<div style=\"background-color: #f3402e; display: table; border-radius: 5px; color: #ffffff; font-family: Open Sans, Arial, sans-serif; font-size: 13px; text-transform: uppercase; font-weight: bold; padding: 7px 12px; text-align: center; text-decoration: none; width: 140px; margin: auto;\"><a style=\"color: #ffffff; text-decoration: none;\" href=\"http://192.168.1.251:8081/renters/renters2.1/rental/1\"><img src=\"http://192.168.1.251:8081/renters/renters2.1/server/php/rental/Tulips6.jpg\" alt=\"\" width=\"300\" /> Sample Listing</a></div>
</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\" bgcolor=\"#EAEAEA\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th width=\"75\">Time</th> <th width=\"75\">Date</th>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Arrive</td>
<td bgcolor=\"#FFFFFF\">06-Sep-2016</td>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Depart</td>
<td bgcolor=\"#FFFFFF\">08-Sep-2016</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #4f595b; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; padding: 0px 20px;\" width=\"300px\" align=\"left\" valign=\"top\">           
<table style=\"width: 100%; font-size: 13px;\">
<tbody>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\">for2 Night</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\"><span>KRW</span> 30.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Service Fee</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 2.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Total</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 32.00</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renter Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table></body>
			</html>","2016-08-30 17:40:18","Reservation Confirmation");INSERT INTO fc_inbox VALUES("7","2","muthukrishnan@teamtweaks.com","0","<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
			<meta name=\"viewport\" content=\"width=device-width\"/><body><table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img style=\"margin: 15px 5px 0; padding: 0px; border: none;\" src=\"http://192.168.1.251:8081/renters/renters2.1/images/logo/admin_logo.png\" alt=\"logo\" width=\"200\" /></td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi Raja Rajan</td>
</tr>
<tr>
<td height=\"50\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">We\'re excited to tell you that you have booked Sample Listing To help make check-in seamless, we suggest you continue the conversation with Muthu Krishnan</td>
</tr>
<tr>
<td style=\"color: #000; padding: 10px 20px 10px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">through Renters\'s message system to confirm their arrival time, ask any questions you may have, and help them figure out how to best get to your listing.</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 10px; font-weight: bold; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\" valign=\"top\">Itinerary</td>
</tr>
<tr>
<td align=\"center\" valign=\"middle\">
<div style=\"background-color: #f3402e; display: table; border-radius: 5px; color: #ffffff; font-family: Open Sans, Arial, sans-serif; font-size: 13px; text-transform: uppercase; font-weight: bold; padding: 7px 12px; text-align: center; text-decoration: none; width: 140px; margin: auto;\"><a style=\"color: #ffffff; text-decoration: none;\" href=\"http://192.168.1.251:8081/renters/renters2.1/rental/1\"><img src=\"http://192.168.1.251:8081/renters/renters2.1/server/php/rental/Tulips6.jpg\" alt=\"\" width=\"300\" /> Sample Listing</a></div>
</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\" bgcolor=\"#EAEAEA\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th width=\"75\">Time</th> <th width=\"75\">Date</th>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Arrive</td>
<td bgcolor=\"#FFFFFF\">30-Aug-2016</td>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Depart</td>
<td bgcolor=\"#FFFFFF\">31-Aug-2016</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th align=\"left\">Your Green house</th>
</tr>
<tr bgcolor=\"#EAEAEA\">
<td width=\"150px\"><img src=\"http://rc.nextio.co.kr/images/users/\" alt=\"\" width=\"50\" height=\"50\" /></td>
<td>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\">Muthu Krishnan</td>
</tr>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\">9790605724</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold;\" align=\"left\">Payment</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">On the day after the guest checks in, the payout method you supplied will be credited. For details, see your Transaction History.</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold;\" align=\"left\">Cancellation Policy</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">Flexible: Full refund 1 day prior to arrival, except fees</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #4f595b; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; padding: 0px 20px;\" width=\"300px\" align=\"left\" valign=\"top\">                                                        
<table style=\"width: 100%; font-size: 13px;\">
<tbody>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\">for 1 Night</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\"><span>KRW&nbsp;</span>37.90</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Service Fee</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 2.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Total</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 39.90</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renters Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table></body>","2016-08-30 18:07:40","Notification Mail");INSERT INTO fc_inbox VALUES("8","2","muthukrishnan@teamtweaks.com","0","<body><table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img style=\"margin: 15px 5px 0; padding: 0px; border: none;\" src=\"http://192.168.1.251:8081/renters/renters2.1/images/logo/admin_logo.png\" alt=\"\" width=\"200\" /></td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi Admin</td>
</tr>
<tr>
<td height=\"50\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">We\'re excited to tell you that Raja Rajan just booked Sample Listing with Muthu Krishnan</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 10px; font-weight: bold; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\" valign=\"top\">Itinerary</td>
</tr>
<tr>
<td align=\"center\" valign=\"middle\">
<div style=\"background-color: #f3402e; display: table; border-radius: 5px; color: #ffffff; font-family: Open Sans, Arial, sans-serif; font-size: 13px; text-transform: uppercase; font-weight: bold; padding: 7px 12px; text-align: center; text-decoration: none; width: 140px; margin: auto;\"><a style=\"color: #ffffff; text-decoration: none;\" href=\"http://192.168.1.251:8081/renters/renters2.1/rental/1\"><img src=\"http://192.168.1.251:8081/renters/renters2.1/server/php/rental/Tulips6.jpg\" alt=\"\" /> Sample Listing</a></div>
</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\" bgcolor=\"#EAEAEA\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th width=\"75\">Time</th> <th width=\"75\">Date</th>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Arrive</td>
<td bgcolor=\"#FFFFFF\">30-08-16</td>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Depart</td>
<td bgcolor=\"#FFFFFF\">31-08-16</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th align=\"left\">Guest</th>
</tr>
<tr bgcolor=\"#EAEAEA\">
<td width=\"150px\"><img src=\"product.png\" alt=\"\" /></td>
<td>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\">Raja Rajan</td>
</tr>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\"></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #4f595b; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; padding: 0px 20px;\" width=\"300px\" align=\"left\" valign=\"top\">
<table style=\"width: 100%; font-size: 13px;\">
<tbody>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\"><span>KRW</span> *1 Night</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\"><span>KRW</span> 37.90</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\">Service Fee</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\"><span>KRW</span> 2.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Total</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 39.90</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renters Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table></body>
			</html>","2016-08-30 18:07:41","Reservation Confirmed");INSERT INTO fc_inbox VALUES("9","2","tomcabout@gmail.com","0","<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
			<meta name=\"viewport\" content=\"width=device-width\"/><body><table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img style=\"margin: 15px 5px 0; padding: 0px; border: none;\" src=\"http://192.168.1.251:8081/renters/renters2.1/images/logo/admin_logo.png\" alt=\"\" width=\"200\" /></td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi Muthu Krishnan</td>
</tr>
<tr>
<td height=\"50\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">We\'re excited to tell you that, your Sample Listing is booked now. To help make check-in seamless, we suggest you continue the conversation with your guest Raja Rajan</td>
</tr>
<tr>
<td style=\"color: #000; padding: 10px 20px 10px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">through Renter\'s message system to confirm your guest arrival time, ask any questions you may have, and help them figure out how to best get to your listing.</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 10px; font-weight: bold; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\" valign=\"top\">Itinerary</td>
</tr>
<tr>
<td align=\"center\" valign=\"middle\">
<div style=\"background-color: #f3402e; display: table; border-radius: 5px; color: #ffffff; font-family: Open Sans, Arial, sans-serif; font-size: 13px; text-transform: uppercase; font-weight: bold; padding: 7px 12px; text-align: center; text-decoration: none; width: 140px; margin: auto;\"><a style=\"color: #ffffff; text-decoration: none;\" href=\"http://192.168.1.251:8081/renters/renters2.1/rental/1\"><img src=\"http://192.168.1.251:8081/renters/renters2.1/server/php/rental/Tulips6.jpg\" alt=\"\" width=\"300\" /> Sample Listing</a></div>
</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\" bgcolor=\"#EAEAEA\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th width=\"75\">Time</th> <th width=\"75\">Date</th>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Arrive</td>
<td bgcolor=\"#FFFFFF\">30-Aug-2016</td>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Depart</td>
<td bgcolor=\"#FFFFFF\">31-Aug-2016</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #4f595b; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; padding: 0px 20px;\" width=\"300px\" align=\"left\" valign=\"top\">           
<table style=\"width: 100%; font-size: 13px;\">
<tbody>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\">for1 Night</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\"><span>KRW</span> 37.90</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Service Fee</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 2.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Total</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 39.90</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renter Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table></body>
			</html>","2016-08-30 18:07:41","Reservation Confirmation");INSERT INTO fc_inbox VALUES("10","2","muthukrishnan@teamtweaks.com","0","<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
			<meta name=\"viewport\" content=\"width=device-width\"/><body><table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img style=\"margin: 15px 5px 0; padding: 0px; border: none;\" src=\"http://192.168.1.251:8081/renters/renters2.1/images/logo/admin_logo.png\" alt=\"logo\" width=\"200\" /></td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi Raja Rajan</td>
</tr>
<tr>
<td height=\"50\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">We\'re excited to tell you that you have booked Sample Listing To help make check-in seamless, we suggest you continue the conversation with Muthu Krishnan</td>
</tr>
<tr>
<td style=\"color: #000; padding: 10px 20px 10px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">through Renters\'s message system to confirm their arrival time, ask any questions you may have, and help them figure out how to best get to your listing.</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 10px; font-weight: bold; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\" valign=\"top\">Itinerary</td>
</tr>
<tr>
<td align=\"center\" valign=\"middle\">
<div style=\"background-color: #f3402e; display: table; border-radius: 5px; color: #ffffff; font-family: Open Sans, Arial, sans-serif; font-size: 13px; text-transform: uppercase; font-weight: bold; padding: 7px 12px; text-align: center; text-decoration: none; width: 140px; margin: auto;\"><a style=\"color: #ffffff; text-decoration: none;\" href=\"http://192.168.1.251:8081/renters/renters2.1/rental/1\"><img src=\"http://192.168.1.251:8081/renters/renters2.1/server/php/rental/Tulips6.jpg\" alt=\"\" width=\"300\" /> Sample Listing</a></div>
</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\" bgcolor=\"#EAEAEA\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th width=\"75\">Time</th> <th width=\"75\">Date</th>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Arrive</td>
<td bgcolor=\"#FFFFFF\">30-Aug-2016</td>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Depart</td>
<td bgcolor=\"#FFFFFF\">31-Aug-2016</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th align=\"left\">Your Green house</th>
</tr>
<tr bgcolor=\"#EAEAEA\">
<td width=\"150px\"><img src=\"http://rc.nextio.co.kr/images/users/\" alt=\"\" width=\"50\" height=\"50\" /></td>
<td>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\">Muthu Krishnan</td>
</tr>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\">9790605724</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold;\" align=\"left\">Payment</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">On the day after the guest checks in, the payout method you supplied will be credited. For details, see your Transaction History.</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold;\" align=\"left\">Cancellation Policy</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">Flexible: Full refund 1 day prior to arrival, except fees</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #4f595b; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; padding: 0px 20px;\" width=\"300px\" align=\"left\" valign=\"top\">                                                        
<table style=\"width: 100%; font-size: 13px;\">
<tbody>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\">for 1 Night</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\"><span>KRW&nbsp;</span>40.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Service Fee</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 2.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Total</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 42.00</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renters Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table></body>","2016-08-30 18:10:08","Notification Mail");INSERT INTO fc_inbox VALUES("11","2","muthukrishnan@teamtweaks.com","0","<body><table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img style=\"margin: 15px 5px 0; padding: 0px; border: none;\" src=\"http://192.168.1.251:8081/renters/renters2.1/images/logo/admin_logo.png\" alt=\"\" width=\"200\" /></td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi Admin</td>
</tr>
<tr>
<td height=\"50\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">We\'re excited to tell you that Raja Rajan just booked Sample Listing with Muthu Krishnan</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 10px; font-weight: bold; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\" valign=\"top\">Itinerary</td>
</tr>
<tr>
<td align=\"center\" valign=\"middle\">
<div style=\"background-color: #f3402e; display: table; border-radius: 5px; color: #ffffff; font-family: Open Sans, Arial, sans-serif; font-size: 13px; text-transform: uppercase; font-weight: bold; padding: 7px 12px; text-align: center; text-decoration: none; width: 140px; margin: auto;\"><a style=\"color: #ffffff; text-decoration: none;\" href=\"http://192.168.1.251:8081/renters/renters2.1/rental/1\"><img src=\"http://192.168.1.251:8081/renters/renters2.1/server/php/rental/Tulips6.jpg\" alt=\"\" /> Sample Listing</a></div>
</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\" bgcolor=\"#EAEAEA\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th width=\"75\">Time</th> <th width=\"75\">Date</th>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Arrive</td>
<td bgcolor=\"#FFFFFF\">30-08-16</td>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Depart</td>
<td bgcolor=\"#FFFFFF\">31-08-16</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th align=\"left\">Guest</th>
</tr>
<tr bgcolor=\"#EAEAEA\">
<td width=\"150px\"><img src=\"product.png\" alt=\"\" /></td>
<td>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\">Raja Rajan</td>
</tr>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\"></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #4f595b; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; padding: 0px 20px;\" width=\"300px\" align=\"left\" valign=\"top\">
<table style=\"width: 100%; font-size: 13px;\">
<tbody>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\"><span>KRW</span> *1 Night</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\"><span>KRW</span> 40.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\">Service Fee</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\"><span>KRW</span> 2.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Total</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 42.00</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renters Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table></body>
			</html>","2016-08-30 18:10:09","Reservation Confirmed");INSERT INTO fc_inbox VALUES("12","2","tomcabout@gmail.com","0","<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
			<meta name=\"viewport\" content=\"width=device-width\"/><body><table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img style=\"margin: 15px 5px 0; padding: 0px; border: none;\" src=\"http://192.168.1.251:8081/renters/renters2.1/images/logo/admin_logo.png\" alt=\"\" width=\"200\" /></td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi Muthu Krishnan</td>
</tr>
<tr>
<td height=\"50\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">We\'re excited to tell you that, your Sample Listing is booked now. To help make check-in seamless, we suggest you continue the conversation with your guest Raja Rajan</td>
</tr>
<tr>
<td style=\"color: #000; padding: 10px 20px 10px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">through Renter\'s message system to confirm your guest arrival time, ask any questions you may have, and help them figure out how to best get to your listing.</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 10px; font-weight: bold; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\" valign=\"top\">Itinerary</td>
</tr>
<tr>
<td align=\"center\" valign=\"middle\">
<div style=\"background-color: #f3402e; display: table; border-radius: 5px; color: #ffffff; font-family: Open Sans, Arial, sans-serif; font-size: 13px; text-transform: uppercase; font-weight: bold; padding: 7px 12px; text-align: center; text-decoration: none; width: 140px; margin: auto;\"><a style=\"color: #ffffff; text-decoration: none;\" href=\"http://192.168.1.251:8081/renters/renters2.1/rental/1\"><img src=\"http://192.168.1.251:8081/renters/renters2.1/server/php/rental/Tulips6.jpg\" alt=\"\" width=\"300\" /> Sample Listing</a></div>
</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\" bgcolor=\"#EAEAEA\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th width=\"75\">Time</th> <th width=\"75\">Date</th>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Arrive</td>
<td bgcolor=\"#FFFFFF\">30-Aug-2016</td>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Depart</td>
<td bgcolor=\"#FFFFFF\">31-Aug-2016</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #4f595b; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; padding: 0px 20px;\" width=\"300px\" align=\"left\" valign=\"top\">           
<table style=\"width: 100%; font-size: 13px;\">
<tbody>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\">for1 Night</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\"><span>KRW</span> 40.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Service Fee</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 2.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Total</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 42.00</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renter Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table></body>
			</html>","2016-08-30 18:10:10","Reservation Confirmation");INSERT INTO fc_inbox VALUES("13","2","muthukrishnan@teamtweaks.com","0","<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
			<meta name=\"viewport\" content=\"width=device-width\"/><body><table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img style=\"margin: 15px 5px 0; padding: 0px; border: none;\" src=\"http://192.168.1.251:8081/renters/renters2.1/images/logo/admin_logo.png\" alt=\"logo\" width=\"200\" /></td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi Raja Rajan</td>
</tr>
<tr>
<td height=\"50\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">We\'re excited to tell you that you have booked Sample Listing To help make check-in seamless, we suggest you continue the conversation with Muthu Krishnan</td>
</tr>
<tr>
<td style=\"color: #000; padding: 10px 20px 10px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">through Renters\'s message system to confirm their arrival time, ask any questions you may have, and help them figure out how to best get to your listing.</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 10px; font-weight: bold; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\" valign=\"top\">Itinerary</td>
</tr>
<tr>
<td align=\"center\" valign=\"middle\">
<div style=\"background-color: #f3402e; display: table; border-radius: 5px; color: #ffffff; font-family: Open Sans, Arial, sans-serif; font-size: 13px; text-transform: uppercase; font-weight: bold; padding: 7px 12px; text-align: center; text-decoration: none; width: 140px; margin: auto;\"><a style=\"color: #ffffff; text-decoration: none;\" href=\"http://192.168.1.251:8081/renters/renters2.1/rental/1\"><img src=\"http://192.168.1.251:8081/renters/renters2.1/server/php/rental/Tulips6.jpg\" alt=\"\" width=\"300\" /> Sample Listing</a></div>
</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\" bgcolor=\"#EAEAEA\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th width=\"75\">Time</th> <th width=\"75\">Date</th>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Arrive</td>
<td bgcolor=\"#FFFFFF\">30-Aug-2016</td>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Depart</td>
<td bgcolor=\"#FFFFFF\">31-Aug-2016</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th align=\"left\">Your Green house</th>
</tr>
<tr bgcolor=\"#EAEAEA\">
<td width=\"150px\"><img src=\"http://rc.nextio.co.kr/images/users/\" alt=\"\" width=\"50\" height=\"50\" /></td>
<td>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\">Muthu Krishnan</td>
</tr>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\">9790605724</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold;\" align=\"left\">Payment</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">On the day after the guest checks in, the payout method you supplied will be credited. For details, see your Transaction History.</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold;\" align=\"left\">Cancellation Policy</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">Flexible: Full refund 1 day prior to arrival, except fees</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #4f595b; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; padding: 0px 20px;\" width=\"300px\" align=\"left\" valign=\"top\">                                                        
<table style=\"width: 100%; font-size: 13px;\">
<tbody>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\">for 1 Night</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\"><span>KRW&nbsp;</span>40.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Service Fee</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 2.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Total</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 42.00</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renters Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table></body>","2016-08-30 18:16:00","Notification Mail");INSERT INTO fc_inbox VALUES("14","2","muthukrishnan@teamtweaks.com","0","<body><table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img style=\"margin: 15px 5px 0; padding: 0px; border: none;\" src=\"http://192.168.1.251:8081/renters/renters2.1/images/logo/admin_logo.png\" alt=\"\" width=\"200\" /></td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi Admin</td>
</tr>
<tr>
<td height=\"50\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">We\'re excited to tell you that Raja Rajan just booked Sample Listing with Muthu Krishnan</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 10px; font-weight: bold; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\" valign=\"top\">Itinerary</td>
</tr>
<tr>
<td align=\"center\" valign=\"middle\">
<div style=\"background-color: #f3402e; display: table; border-radius: 5px; color: #ffffff; font-family: Open Sans, Arial, sans-serif; font-size: 13px; text-transform: uppercase; font-weight: bold; padding: 7px 12px; text-align: center; text-decoration: none; width: 140px; margin: auto;\"><a style=\"color: #ffffff; text-decoration: none;\" href=\"http://192.168.1.251:8081/renters/renters2.1/rental/1\"><img src=\"http://192.168.1.251:8081/renters/renters2.1/server/php/rental/Tulips6.jpg\" alt=\"\" /> Sample Listing</a></div>
</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\" bgcolor=\"#EAEAEA\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th width=\"75\">Time</th> <th width=\"75\">Date</th>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Arrive</td>
<td bgcolor=\"#FFFFFF\">30-08-16</td>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Depart</td>
<td bgcolor=\"#FFFFFF\">31-08-16</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th align=\"left\">Guest</th>
</tr>
<tr bgcolor=\"#EAEAEA\">
<td width=\"150px\"><img src=\"product.png\" alt=\"\" /></td>
<td>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\">Raja Rajan</td>
</tr>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\"></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #4f595b; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; padding: 0px 20px;\" width=\"300px\" align=\"left\" valign=\"top\">
<table style=\"width: 100%; font-size: 13px;\">
<tbody>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\"><span>KRW</span> *1 Night</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\"><span>KRW</span> 40.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\">Service Fee</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\"><span>KRW</span> 2.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Total</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 42.00</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renters Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table></body>
			</html>","2016-08-30 18:16:01","Reservation Confirmed");INSERT INTO fc_inbox VALUES("15","2","tomcabout@gmail.com","0","<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
			<meta name=\"viewport\" content=\"width=device-width\"/><body><table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img style=\"margin: 15px 5px 0; padding: 0px; border: none;\" src=\"http://192.168.1.251:8081/renters/renters2.1/images/logo/admin_logo.png\" alt=\"\" width=\"200\" /></td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi Muthu Krishnan</td>
</tr>
<tr>
<td height=\"50\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">We\'re excited to tell you that, your Sample Listing is booked now. To help make check-in seamless, we suggest you continue the conversation with your guest Raja Rajan</td>
</tr>
<tr>
<td style=\"color: #000; padding: 10px 20px 10px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">through Renter\'s message system to confirm your guest arrival time, ask any questions you may have, and help them figure out how to best get to your listing.</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 10px; font-weight: bold; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\" valign=\"top\">Itinerary</td>
</tr>
<tr>
<td align=\"center\" valign=\"middle\">
<div style=\"background-color: #f3402e; display: table; border-radius: 5px; color: #ffffff; font-family: Open Sans, Arial, sans-serif; font-size: 13px; text-transform: uppercase; font-weight: bold; padding: 7px 12px; text-align: center; text-decoration: none; width: 140px; margin: auto;\"><a style=\"color: #ffffff; text-decoration: none;\" href=\"http://192.168.1.251:8081/renters/renters2.1/rental/1\"><img src=\"http://192.168.1.251:8081/renters/renters2.1/server/php/rental/Tulips6.jpg\" alt=\"\" width=\"300\" /> Sample Listing</a></div>
</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\" bgcolor=\"#EAEAEA\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th width=\"75\">Time</th> <th width=\"75\">Date</th>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Arrive</td>
<td bgcolor=\"#FFFFFF\">30-Aug-2016</td>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Depart</td>
<td bgcolor=\"#FFFFFF\">31-Aug-2016</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #4f595b; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; padding: 0px 20px;\" width=\"300px\" align=\"left\" valign=\"top\">           
<table style=\"width: 100%; font-size: 13px;\">
<tbody>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\">for1 Night</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\"><span>KRW</span> 40.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Service Fee</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 2.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Total</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 42.00</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renter Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table></body>
			</html>","2016-08-30 18:16:02","Reservation Confirmation");INSERT INTO fc_inbox VALUES("16","2","muthukrishnan@teamtweaks.com","0","<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
			<meta name=\"viewport\" content=\"width=device-width\"/><body><table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img style=\"margin: 15px 5px 0; padding: 0px; border: none;\" src=\"http://192.168.1.251:8081/renters/renters2.1/images/logo/admin_logo.png\" alt=\"logo\" width=\"200\" /></td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi Raja Rajan</td>
</tr>
<tr>
<td height=\"50\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">We\'re excited to tell you that you have booked Sample Listing To help make check-in seamless, we suggest you continue the conversation with Muthu Krishnan</td>
</tr>
<tr>
<td style=\"color: #000; padding: 10px 20px 10px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">through Renters\'s message system to confirm their arrival time, ask any questions you may have, and help them figure out how to best get to your listing.</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 10px; font-weight: bold; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\" valign=\"top\">Itinerary</td>
</tr>
<tr>
<td align=\"center\" valign=\"middle\">
<div style=\"background-color: #f3402e; display: table; border-radius: 5px; color: #ffffff; font-family: Open Sans, Arial, sans-serif; font-size: 13px; text-transform: uppercase; font-weight: bold; padding: 7px 12px; text-align: center; text-decoration: none; width: 140px; margin: auto;\"><a style=\"color: #ffffff; text-decoration: none;\" href=\"http://192.168.1.251:8081/renters/renters2.1/rental/1\"><img src=\"http://192.168.1.251:8081/renters/renters2.1/server/php/rental/Tulips6.jpg\" alt=\"\" width=\"300\" /> Sample Listing</a></div>
</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\" bgcolor=\"#EAEAEA\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th width=\"75\">Time</th> <th width=\"75\">Date</th>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Arrive</td>
<td bgcolor=\"#FFFFFF\">30-Aug-2016</td>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Depart</td>
<td bgcolor=\"#FFFFFF\">31-Aug-2016</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th align=\"left\">Your Green house</th>
</tr>
<tr bgcolor=\"#EAEAEA\">
<td width=\"150px\"><img src=\"http://rc.nextio.co.kr/images/users/\" alt=\"\" width=\"50\" height=\"50\" /></td>
<td>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\">Muthu Krishnan</td>
</tr>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\">9790605724</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold;\" align=\"left\">Payment</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">On the day after the guest checks in, the payout method you supplied will be credited. For details, see your Transaction History.</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold;\" align=\"left\">Cancellation Policy</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">Flexible: Full refund 1 day prior to arrival, except fees</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #4f595b; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; padding: 0px 20px;\" width=\"300px\" align=\"left\" valign=\"top\">                                                        
<table style=\"width: 100%; font-size: 13px;\">
<tbody>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\">for 1 Night</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\"><span>KRW&nbsp;</span>40.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Service Fee</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 2.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Total</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 42.00</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renters Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table></body>","2016-08-30 18:17:57","Notification Mail");INSERT INTO fc_inbox VALUES("17","2","muthukrishnan@teamtweaks.com","0","<body><table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img style=\"margin: 15px 5px 0; padding: 0px; border: none;\" src=\"http://192.168.1.251:8081/renters/renters2.1/images/logo/admin_logo.png\" alt=\"\" width=\"200\" /></td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi Admin</td>
</tr>
<tr>
<td height=\"50\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">We\'re excited to tell you that Raja Rajan just booked Sample Listing with Muthu Krishnan</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 10px; font-weight: bold; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\" valign=\"top\">Itinerary</td>
</tr>
<tr>
<td align=\"center\" valign=\"middle\">
<div style=\"background-color: #f3402e; display: table; border-radius: 5px; color: #ffffff; font-family: Open Sans, Arial, sans-serif; font-size: 13px; text-transform: uppercase; font-weight: bold; padding: 7px 12px; text-align: center; text-decoration: none; width: 140px; margin: auto;\"><a style=\"color: #ffffff; text-decoration: none;\" href=\"http://192.168.1.251:8081/renters/renters2.1/rental/1\"><img src=\"http://192.168.1.251:8081/renters/renters2.1/server/php/rental/Tulips6.jpg\" alt=\"\" /> Sample Listing</a></div>
</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\" bgcolor=\"#EAEAEA\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th width=\"75\">Time</th> <th width=\"75\">Date</th>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Arrive</td>
<td bgcolor=\"#FFFFFF\">30-08-16</td>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Depart</td>
<td bgcolor=\"#FFFFFF\">31-08-16</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th align=\"left\">Guest</th>
</tr>
<tr bgcolor=\"#EAEAEA\">
<td width=\"150px\"><img src=\"product.png\" alt=\"\" /></td>
<td>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\">Raja Rajan</td>
</tr>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\"></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #4f595b; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; padding: 0px 20px;\" width=\"300px\" align=\"left\" valign=\"top\">
<table style=\"width: 100%; font-size: 13px;\">
<tbody>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\"><span>KRW</span> *1 Night</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\"><span>KRW</span> 40.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\">Service Fee</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\"><span>KRW</span> 2.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Total</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 42.00</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renters Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table></body>
			</html>","2016-08-30 18:17:58","Reservation Confirmed");INSERT INTO fc_inbox VALUES("18","2","tomcabout@gmail.com","0","<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
			<meta name=\"viewport\" content=\"width=device-width\"/><body><table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img style=\"margin: 15px 5px 0; padding: 0px; border: none;\" src=\"http://192.168.1.251:8081/renters/renters2.1/images/logo/admin_logo.png\" alt=\"\" width=\"200\" /></td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi Muthu Krishnan</td>
</tr>
<tr>
<td height=\"50\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">We\'re excited to tell you that, your Sample Listing is booked now. To help make check-in seamless, we suggest you continue the conversation with your guest Raja Rajan</td>
</tr>
<tr>
<td style=\"color: #000; padding: 10px 20px 10px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">through Renter\'s message system to confirm your guest arrival time, ask any questions you may have, and help them figure out how to best get to your listing.</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 10px; font-weight: bold; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\" valign=\"top\">Itinerary</td>
</tr>
<tr>
<td align=\"center\" valign=\"middle\">
<div style=\"background-color: #f3402e; display: table; border-radius: 5px; color: #ffffff; font-family: Open Sans, Arial, sans-serif; font-size: 13px; text-transform: uppercase; font-weight: bold; padding: 7px 12px; text-align: center; text-decoration: none; width: 140px; margin: auto;\"><a style=\"color: #ffffff; text-decoration: none;\" href=\"http://192.168.1.251:8081/renters/renters2.1/rental/1\"><img src=\"http://192.168.1.251:8081/renters/renters2.1/server/php/rental/Tulips6.jpg\" alt=\"\" width=\"300\" /> Sample Listing</a></div>
</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\" bgcolor=\"#EAEAEA\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th width=\"75\">Time</th> <th width=\"75\">Date</th>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Arrive</td>
<td bgcolor=\"#FFFFFF\">30-Aug-2016</td>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Depart</td>
<td bgcolor=\"#FFFFFF\">31-Aug-2016</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #4f595b; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; padding: 0px 20px;\" width=\"300px\" align=\"left\" valign=\"top\">           
<table style=\"width: 100%; font-size: 13px;\">
<tbody>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\">for1 Night</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\"><span>KRW</span> 40.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Service Fee</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 2.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Total</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 42.00</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renter Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table></body>
			</html>","2016-08-30 18:17:59","Reservation Confirmation");INSERT INTO fc_inbox VALUES("19","2","muthukrishnan@teamtweaks.com","0","<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
			<meta name=\"viewport\" content=\"width=device-width\"/><body><table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img style=\"margin: 15px 5px 0; padding: 0px; border: none;\" src=\"http://192.168.1.251:8081/renters/renters2.1/images/logo/admin_logo.png\" alt=\"logo\" width=\"200\" /></td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi Raja Rajan</td>
</tr>
<tr>
<td height=\"50\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">We\'re excited to tell you that you have booked Sample Listing To help make check-in seamless, we suggest you continue the conversation with Muthu Krishnan</td>
</tr>
<tr>
<td style=\"color: #000; padding: 10px 20px 10px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">through Renters\'s message system to confirm their arrival time, ask any questions you may have, and help them figure out how to best get to your listing.</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 10px; font-weight: bold; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\" valign=\"top\">Itinerary</td>
</tr>
<tr>
<td align=\"center\" valign=\"middle\">
<div style=\"background-color: #f3402e; display: table; border-radius: 5px; color: #ffffff; font-family: Open Sans, Arial, sans-serif; font-size: 13px; text-transform: uppercase; font-weight: bold; padding: 7px 12px; text-align: center; text-decoration: none; width: 140px; margin: auto;\"><a style=\"color: #ffffff; text-decoration: none;\" href=\"http://192.168.1.251:8081/renters/renters2.1/rental/1\"><img src=\"http://192.168.1.251:8081/renters/renters2.1/server/php/rental/Tulips6.jpg\" alt=\"\" width=\"300\" /> Sample Listing</a></div>
</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\" bgcolor=\"#EAEAEA\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th width=\"75\">Time</th> <th width=\"75\">Date</th>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Arrive</td>
<td bgcolor=\"#FFFFFF\">30-Aug-2016</td>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Depart</td>
<td bgcolor=\"#FFFFFF\">31-Aug-2016</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th align=\"left\">Your Green house</th>
</tr>
<tr bgcolor=\"#EAEAEA\">
<td width=\"150px\"><img src=\"http://rc.nextio.co.kr/images/users/\" alt=\"\" width=\"50\" height=\"50\" /></td>
<td>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\">Muthu Krishnan</td>
</tr>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\">9790605724</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold;\" align=\"left\">Payment</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">On the day after the guest checks in, the payout method you supplied will be credited. For details, see your Transaction History.</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold;\" align=\"left\">Cancellation Policy</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">Flexible: Full refund 1 day prior to arrival, except fees</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #4f595b; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; padding: 0px 20px;\" width=\"300px\" align=\"left\" valign=\"top\">                                                        
<table style=\"width: 100%; font-size: 13px;\">
<tbody>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\">for 1 Night</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\"><span>KRW&nbsp;</span>40.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Service Fee</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 2.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Total</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 42.00</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renters Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table></body>","2016-08-30 18:19:13","Notification Mail");INSERT INTO fc_inbox VALUES("20","2","muthukrishnan@teamtweaks.com","0","<body><table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img style=\"margin: 15px 5px 0; padding: 0px; border: none;\" src=\"http://192.168.1.251:8081/renters/renters2.1/images/logo/admin_logo.png\" alt=\"\" width=\"200\" /></td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi Admin</td>
</tr>
<tr>
<td height=\"50\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">We\'re excited to tell you that Raja Rajan just booked Sample Listing with Muthu Krishnan</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 10px; font-weight: bold; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\" valign=\"top\">Itinerary</td>
</tr>
<tr>
<td align=\"center\" valign=\"middle\">
<div style=\"background-color: #f3402e; display: table; border-radius: 5px; color: #ffffff; font-family: Open Sans, Arial, sans-serif; font-size: 13px; text-transform: uppercase; font-weight: bold; padding: 7px 12px; text-align: center; text-decoration: none; width: 140px; margin: auto;\"><a style=\"color: #ffffff; text-decoration: none;\" href=\"http://192.168.1.251:8081/renters/renters2.1/rental/1\"><img src=\"http://192.168.1.251:8081/renters/renters2.1/server/php/rental/Tulips6.jpg\" alt=\"\" /> Sample Listing</a></div>
</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\" bgcolor=\"#EAEAEA\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th width=\"75\">Time</th> <th width=\"75\">Date</th>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Arrive</td>
<td bgcolor=\"#FFFFFF\">30-08-16</td>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Depart</td>
<td bgcolor=\"#FFFFFF\">31-08-16</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th align=\"left\">Guest</th>
</tr>
<tr bgcolor=\"#EAEAEA\">
<td width=\"150px\"><img src=\"product.png\" alt=\"\" /></td>
<td>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\">Raja Rajan</td>
</tr>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\"></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #4f595b; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; padding: 0px 20px;\" width=\"300px\" align=\"left\" valign=\"top\">
<table style=\"width: 100%; font-size: 13px;\">
<tbody>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\"><span>KRW</span> *1 Night</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\"><span>KRW</span> 40.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\">Service Fee</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\"><span>KRW</span> 2.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Total</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 42.00</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renters Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table></body>
			</html>","2016-08-30 18:19:13","Reservation Confirmed");INSERT INTO fc_inbox VALUES("21","2","tomcabout@gmail.com","0","<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
			<meta name=\"viewport\" content=\"width=device-width\"/><body><table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img style=\"margin: 15px 5px 0; padding: 0px; border: none;\" src=\"http://192.168.1.251:8081/renters/renters2.1/images/logo/admin_logo.png\" alt=\"\" width=\"200\" /></td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi Muthu Krishnan</td>
</tr>
<tr>
<td height=\"50\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">We\'re excited to tell you that, your Sample Listing is booked now. To help make check-in seamless, we suggest you continue the conversation with your guest Raja Rajan</td>
</tr>
<tr>
<td style=\"color: #000; padding: 10px 20px 10px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">through Renter\'s message system to confirm your guest arrival time, ask any questions you may have, and help them figure out how to best get to your listing.</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 10px; font-weight: bold; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\" valign=\"top\">Itinerary</td>
</tr>
<tr>
<td align=\"center\" valign=\"middle\">
<div style=\"background-color: #f3402e; display: table; border-radius: 5px; color: #ffffff; font-family: Open Sans, Arial, sans-serif; font-size: 13px; text-transform: uppercase; font-weight: bold; padding: 7px 12px; text-align: center; text-decoration: none; width: 140px; margin: auto;\"><a style=\"color: #ffffff; text-decoration: none;\" href=\"http://192.168.1.251:8081/renters/renters2.1/rental/1\"><img src=\"http://192.168.1.251:8081/renters/renters2.1/server/php/rental/Tulips6.jpg\" alt=\"\" width=\"300\" /> Sample Listing</a></div>
</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\" bgcolor=\"#EAEAEA\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th width=\"75\">Time</th> <th width=\"75\">Date</th>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Arrive</td>
<td bgcolor=\"#FFFFFF\">30-Aug-2016</td>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Depart</td>
<td bgcolor=\"#FFFFFF\">31-Aug-2016</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #4f595b; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; padding: 0px 20px;\" width=\"300px\" align=\"left\" valign=\"top\">           
<table style=\"width: 100%; font-size: 13px;\">
<tbody>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\">for1 Night</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\"><span>KRW</span> 40.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Service Fee</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 2.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Total</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 42.00</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renter Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table></body>
			</html>","2016-08-30 18:19:15","Reservation Confirmation");INSERT INTO fc_inbox VALUES("22","2","muthukrishnan@teamtweaks.com","0","<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
			<meta name=\"viewport\" content=\"width=device-width\"/><body><table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img style=\"margin: 15px 5px 0; padding: 0px; border: none;\" src=\"http://192.168.1.251:8081/renters/renters2.1/images/logo/admin_logo.png\" alt=\"logo\" width=\"200\" /></td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi Raja Rajan</td>
</tr>
<tr>
<td height=\"50\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">We\'re excited to tell you that you have booked Sample Listing To help make check-in seamless, we suggest you continue the conversation with Muthu Krishnan</td>
</tr>
<tr>
<td style=\"color: #000; padding: 10px 20px 10px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">through Renters\'s message system to confirm their arrival time, ask any questions you may have, and help them figure out how to best get to your listing.</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 10px; font-weight: bold; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\" valign=\"top\">Itinerary</td>
</tr>
<tr>
<td align=\"center\" valign=\"middle\">
<div style=\"background-color: #f3402e; display: table; border-radius: 5px; color: #ffffff; font-family: Open Sans, Arial, sans-serif; font-size: 13px; text-transform: uppercase; font-weight: bold; padding: 7px 12px; text-align: center; text-decoration: none; width: 140px; margin: auto;\"><a style=\"color: #ffffff; text-decoration: none;\" href=\"http://192.168.1.251:8081/renters/renters2.1/rental/1\"><img src=\"http://192.168.1.251:8081/renters/renters2.1/server/php/rental/Tulips6.jpg\" alt=\"\" width=\"300\" /> Sample Listing</a></div>
</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\" bgcolor=\"#EAEAEA\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th width=\"75\">Time</th> <th width=\"75\">Date</th>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Arrive</td>
<td bgcolor=\"#FFFFFF\">13-Sep-2016</td>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Depart</td>
<td bgcolor=\"#FFFFFF\">14-Sep-2016</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th align=\"left\">Your Green house</th>
</tr>
<tr bgcolor=\"#EAEAEA\">
<td width=\"150px\"><img src=\"http://rc.nextio.co.kr/images/users/\" alt=\"\" width=\"50\" height=\"50\" /></td>
<td>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\">Muthu Krishnan</td>
</tr>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\">9790605724</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold;\" align=\"left\">Payment</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">On the day after the guest checks in, the payout method you supplied will be credited. For details, see your Transaction History.</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold;\" align=\"left\">Cancellation Policy</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">Flexible: Full refund 1 day prior to arrival, except fees</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #4f595b; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; padding: 0px 20px;\" width=\"300px\" align=\"left\" valign=\"top\">                                                        
<table style=\"width: 100%; font-size: 13px;\">
<tbody>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\">for 1 Night</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\"><span>KRW&nbsp;</span>30.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Service Fee</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 2.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Total</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 32.00</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renters Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table></body>","2016-08-31 12:16:35","Notification Mail");INSERT INTO fc_inbox VALUES("23","2","muthukrishnan@teamtweaks.com","0","<body><table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img style=\"margin: 15px 5px 0; padding: 0px; border: none;\" src=\"http://192.168.1.251:8081/renters/renters2.1/images/logo/admin_logo.png\" alt=\"\" width=\"200\" /></td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi Admin</td>
</tr>
<tr>
<td height=\"50\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">We\'re excited to tell you that Raja Rajan just booked Sample Listing with Muthu Krishnan</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 10px; font-weight: bold; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\" valign=\"top\">Itinerary</td>
</tr>
<tr>
<td align=\"center\" valign=\"middle\">
<div style=\"background-color: #f3402e; display: table; border-radius: 5px; color: #ffffff; font-family: Open Sans, Arial, sans-serif; font-size: 13px; text-transform: uppercase; font-weight: bold; padding: 7px 12px; text-align: center; text-decoration: none; width: 140px; margin: auto;\"><a style=\"color: #ffffff; text-decoration: none;\" href=\"http://192.168.1.251:8081/renters/renters2.1/rental/1\"><img src=\"http://192.168.1.251:8081/renters/renters2.1/server/php/rental/Tulips6.jpg\" alt=\"\" /> Sample Listing</a></div>
</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\" bgcolor=\"#EAEAEA\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th width=\"75\">Time</th> <th width=\"75\">Date</th>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Arrive</td>
<td bgcolor=\"#FFFFFF\">13-09-16</td>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Depart</td>
<td bgcolor=\"#FFFFFF\">14-09-16</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th align=\"left\">Guest</th>
</tr>
<tr bgcolor=\"#EAEAEA\">
<td width=\"150px\"><img src=\"product.png\" alt=\"\" /></td>
<td>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\">Raja Rajan</td>
</tr>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\">9790605724</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #4f595b; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; padding: 0px 20px;\" width=\"300px\" align=\"left\" valign=\"top\">
<table style=\"width: 100%; font-size: 13px;\">
<tbody>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\"><span>KRW</span> *1 Night</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\"><span>KRW</span> 30.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\">Service Fee</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\"><span>KRW</span> 2.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Total</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 32.00</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renters Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table></body>
			</html>","2016-08-31 12:16:36","Reservation Confirmed");INSERT INTO fc_inbox VALUES("24","2","tomcabout@gmail.com","0","<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
			<meta name=\"viewport\" content=\"width=device-width\"/><body><table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img style=\"margin: 15px 5px 0; padding: 0px; border: none;\" src=\"http://192.168.1.251:8081/renters/renters2.1/images/logo/admin_logo.png\" alt=\"\" width=\"200\" /></td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi Muthu Krishnan</td>
</tr>
<tr>
<td height=\"50\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">We\'re excited to tell you that, your Sample Listing is booked now. To help make check-in seamless, we suggest you continue the conversation with your guest Raja Rajan</td>
</tr>
<tr>
<td style=\"color: #000; padding: 10px 20px 10px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">through Renter\'s message system to confirm your guest arrival time, ask any questions you may have, and help them figure out how to best get to your listing.</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 10px; font-weight: bold; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\" valign=\"top\">Itinerary</td>
</tr>
<tr>
<td align=\"center\" valign=\"middle\">
<div style=\"background-color: #f3402e; display: table; border-radius: 5px; color: #ffffff; font-family: Open Sans, Arial, sans-serif; font-size: 13px; text-transform: uppercase; font-weight: bold; padding: 7px 12px; text-align: center; text-decoration: none; width: 140px; margin: auto;\"><a style=\"color: #ffffff; text-decoration: none;\" href=\"http://192.168.1.251:8081/renters/renters2.1/rental/1\"><img src=\"http://192.168.1.251:8081/renters/renters2.1/server/php/rental/Tulips6.jpg\" alt=\"\" width=\"300\" /> Sample Listing</a></div>
</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\" bgcolor=\"#EAEAEA\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th width=\"75\">Time</th> <th width=\"75\">Date</th>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Arrive</td>
<td bgcolor=\"#FFFFFF\">13-Sep-2016</td>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Depart</td>
<td bgcolor=\"#FFFFFF\">14-Sep-2016</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #4f595b; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; padding: 0px 20px;\" width=\"300px\" align=\"left\" valign=\"top\">           
<table style=\"width: 100%; font-size: 13px;\">
<tbody>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\">for1 Night</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\"><span>KRW</span> 30.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Service Fee</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 2.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Total</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 32.00</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renter Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table></body>
			</html>","2016-08-31 12:16:36","Reservation Confirmation");INSERT INTO fc_inbox VALUES("25","muthukrishnan@teamtweaks.com","muthukrishnan@teamtweaks.com","0","<!DOCTYPE HTML>
							<html>
							<head>
							<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
							<meta name=\"viewport\" content=\"width=device-width\"/><body><table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#ffffff\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #ffffff;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#ffffff\">&nbsp; &nbsp; &nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#ffffff\"><img src=\"http://192.168.1.251:8081/renters/renters2.1/images/logo/admin_logo.png\" alt=\"logo\" width=\"200\" /></td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#ffffff\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #414042;\" align=\"center\" valign=\"middle\"><span style=\"color: #fcdf3f;\">Hi Muthu</span></td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">
<p><span style=\"font-size: x-large;\"><strong> User Raja has posted a review about your listing Sample Listing </strong></span></p>
<p><span style=\"font-size: medium;\"><strong>&nbsp;</strong></span></p>
</td>
</tr>
<tr>
<td>
<p>&nbsp;</p>
</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\"><a href=\"http://rc.nextio.co.kr/site/product/display_review\"> Click Here To View</a></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p><span style=\"color: #000000;\"><strong>The Space For Sure&nbsp;Team</strong></span></p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#ffffff\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#ffffff\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table></body>
							</html>","2016-08-31 15:13:38","From: Renters - Review Has Been Posteds");INSERT INTO fc_inbox VALUES("26","2","muthukrishnan@teamtweaks.com","0","<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
			<meta name=\"viewport\" content=\"width=device-width\"/><body><table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img style=\"margin: 15px 5px 0; padding: 0px; border: none;\" src=\"http://192.168.1.251:8081/renters/renters2.1/images/logo/admin_logo.png\" alt=\"logo\" width=\"200\" /></td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi Raja Rajan</td>
</tr>
<tr>
<td height=\"50\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">We\'re excited to tell you that you have booked Sample Listing To help make check-in seamless, we suggest you continue the conversation with Muthu Krishnan</td>
</tr>
<tr>
<td style=\"color: #000; padding: 10px 20px 10px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">through Renters\'s message system to confirm their arrival time, ask any questions you may have, and help them figure out how to best get to your listing.</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 10px; font-weight: bold; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\" valign=\"top\">Itinerary</td>
</tr>
<tr>
<td align=\"center\" valign=\"middle\">
<div style=\"background-color: #f3402e; display: table; border-radius: 5px; color: #ffffff; font-family: Open Sans, Arial, sans-serif; font-size: 13px; text-transform: uppercase; font-weight: bold; padding: 7px 12px; text-align: center; text-decoration: none; width: 140px; margin: auto;\"><a style=\"color: #ffffff; text-decoration: none;\" href=\"http://192.168.1.251:8081/renters/renters2.1/rental/1\"><img src=\"http://192.168.1.251:8081/renters/renters2.1/server/php/rental/Tulips6.jpg\" alt=\"\" width=\"300\" /> Sample Listing</a></div>
</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\" bgcolor=\"#EAEAEA\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th width=\"75\">Time</th> <th width=\"75\">Date</th>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Arrive</td>
<td bgcolor=\"#FFFFFF\">20-Sep-2016</td>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Depart</td>
<td bgcolor=\"#FFFFFF\">21-Sep-2016</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th align=\"left\">Your Green house</th>
</tr>
<tr bgcolor=\"#EAEAEA\">
<td width=\"150px\"><img src=\"http://rc.nextio.co.kr/images/users/\" alt=\"\" width=\"50\" height=\"50\" /></td>
<td>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\">Muthu Krishnan</td>
</tr>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\">9790605724</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold;\" align=\"left\">Payment</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">On the day after the guest checks in, the payout method you supplied will be credited. For details, see your Transaction History.</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold;\" align=\"left\">Cancellation Policy</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">Flexible: Full refund 1 day prior to arrival, except fees</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #4f595b; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; padding: 0px 20px;\" width=\"300px\" align=\"left\" valign=\"top\">                                                        
<table style=\"width: 100%; font-size: 13px;\">
<tbody>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\">for 1 Night</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\"><span>KRW&nbsp;</span>50.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Service Fee</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 2.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Total</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 52.00</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renters Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table></body>","2016-08-31 19:19:07","Notification Mail");INSERT INTO fc_inbox VALUES("27","2","muthukrishnan@teamtweaks.com","0","<body><table class=\"ui-sortable-handle currentTable\" border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tbody>
<tr>
<td bgcolor=\"#4f595b\" height=\"30\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img style=\"margin: 15px 5px 0; padding: 0px; border: none;\" src=\"http://192.168.1.251:8081/renters/renters2.1/images/logo/admin_logo.png\" alt=\"\" width=\"200\" /></td>
</tr>
<tr>
<td bgcolor=\"#4f595b\" height=\"30\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi Admin</td>
</tr>
<tr>
<td height=\"50\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">We\'re excited to tell you that Raja Rajan just booked Sample Listing with Muthu Krishnan</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 10px; font-weight: bold; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\" valign=\"top\">Itinerary</td>
</tr>
<tr>
<td align=\"center\" valign=\"middle\">
<div style=\"background-color: #f3402e; display: table; border-radius: 5px; color: #ffffff; font-family: Open Sans, Arial, sans-serif; font-size: 13px; text-transform: uppercase; font-weight: bold; padding: 7px 12px; text-align: center; text-decoration: none; width: 140px; margin: auto;\"><a style=\"color: #ffffff; text-decoration: none;\" href=\"http://192.168.1.251:8081/renters/renters2.1/rental/1\"><img src=\"http://192.168.1.251:8081/renters/renters2.1/server/php/rental/Tulips6.jpg\" alt=\"\" /> Sample Listing</a></div>
</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" width=\"600\" cellspacing=\"1\" cellpadding=\"5\" bgcolor=\"#EAEAEA\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th width=\"75\">Time</th>
<th width=\"75\">Date</th>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Arrive</td>
<td bgcolor=\"#FFFFFF\">20-09-16</td>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Depart</td>
<td bgcolor=\"#FFFFFF\">21-09-16</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" width=\"600\" cellspacing=\"1\" cellpadding=\"5\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th align=\"left\">Guest</th>
</tr>
<tr bgcolor=\"#EAEAEA\">
<td width=\"150px\"><img src=\"product.png\" alt=\"\" /></td>
<td>
<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tbody>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\">Raja Rajan</td>
</tr>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\">9790605724</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #4f595b; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; padding: 0px 20px;\" align=\"left\" valign=\"top\" width=\"300px\">
<table style=\"width: 100%; font-size: 13px;\">
<tbody>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\">USD&nbsp;*1 Night</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\">USD&nbsp;50.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\">Service Fee</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\">USD&nbsp;2.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Total</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">USD&nbsp;52.00</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renters Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td bgcolor=\"#4f595b\" height=\"30\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td bgcolor=\"#4f595b\" height=\"50\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table></body>
			</html>","2016-08-31 19:19:08","Reservation Confirmed");INSERT INTO fc_inbox VALUES("28","2","muthukrishnan@teamtweaks.com","0","<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
			<meta name=\"viewport\" content=\"width=device-width\"/><body><table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img style=\"margin: 15px 5px 0; padding: 0px; border: none;\" src=\"http://192.168.1.251:8081/renters/renters2.1/images/logo/admin_logo.png\" alt=\"\" width=\"200\" /></td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi Muthu Krishnan</td>
</tr>
<tr>
<td height=\"50\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">We\'re excited to tell you that, your Sample Listing is booked now. To help make check-in seamless, we suggest you continue the conversation with your guest Raja Rajan</td>
</tr>
<tr>
<td style=\"color: #000; padding: 10px 20px 10px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">through Renter\'s message system to confirm your guest arrival time, ask any questions you may have, and help them figure out how to best get to your listing.</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 10px; font-weight: bold; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\" valign=\"top\">Itinerary</td>
</tr>
<tr>
<td align=\"center\" valign=\"middle\">
<div style=\"background-color: #f3402e; display: table; border-radius: 5px; color: #ffffff; font-family: Open Sans, Arial, sans-serif; font-size: 13px; text-transform: uppercase; font-weight: bold; padding: 7px 12px; text-align: center; text-decoration: none; width: 140px; margin: auto;\"><a style=\"color: #ffffff; text-decoration: none;\" href=\"http://192.168.1.251:8081/renters/renters2.1/rental/1\"><img src=\"http://192.168.1.251:8081/renters/renters2.1/server/php/rental/Tulips6.jpg\" alt=\"\" width=\"300\" /> Sample Listing</a></div>
</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\" bgcolor=\"#EAEAEA\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th width=\"75\">Time</th> <th width=\"75\">Date</th>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Arrive</td>
<td bgcolor=\"#FFFFFF\">20-Sep-2016</td>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Depart</td>
<td bgcolor=\"#FFFFFF\">21-Sep-2016</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #4f595b; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; padding: 0px 20px;\" width=\"300px\" align=\"left\" valign=\"top\">           
<table style=\"width: 100%; font-size: 13px;\">
<tbody>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\">for1 Night</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\"><span>KRW</span> 50.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Service Fee</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 2.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Total</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 52.00</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renter Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table></body>
			</html>","2016-08-31 19:19:09","Reservation Confirmation");INSERT INTO fc_inbox VALUES("29","3","muthukrishnan@teamtweaks.com","0","<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
			<meta name=\"viewport\" content=\"width=device-width\"/><body><table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img style=\"margin: 15px 5px 0; padding: 0px; border: none;\" src=\"http://192.168.1.251:8081/renters/renters2.1/images/logo/admin_logo.png\" alt=\"logo\" width=\"200\" /></td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi vasu s</td>
</tr>
<tr>
<td height=\"50\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">We\'re excited to tell you that you have booked Sample Listing To help make check-in seamless, we suggest you continue the conversation with Muthu Krishnan</td>
</tr>
<tr>
<td style=\"color: #000; padding: 10px 20px 10px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">through Renters\'s message system to confirm their arrival time, ask any questions you may have, and help them figure out how to best get to your listing.</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 10px; font-weight: bold; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\" valign=\"top\">Itinerary</td>
</tr>
<tr>
<td align=\"center\" valign=\"middle\">
<div style=\"background-color: #f3402e; display: table; border-radius: 5px; color: #ffffff; font-family: Open Sans, Arial, sans-serif; font-size: 13px; text-transform: uppercase; font-weight: bold; padding: 7px 12px; text-align: center; text-decoration: none; width: 140px; margin: auto;\"><a style=\"color: #ffffff; text-decoration: none;\" href=\"http://192.168.1.251:8081/renters/renters2.1/rental/1\"><img src=\"http://192.168.1.251:8081/renters/renters2.1/server/php/rental/Tulips6.jpg\" alt=\"\" width=\"300\" /> Sample Listing</a></div>
</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\" bgcolor=\"#EAEAEA\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th width=\"75\">Time</th> <th width=\"75\">Date</th>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Arrive</td>
<td bgcolor=\"#FFFFFF\">21-Sep-2016</td>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Depart</td>
<td bgcolor=\"#FFFFFF\">29-Sep-2016</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th align=\"left\">Your Green house</th>
</tr>
<tr bgcolor=\"#EAEAEA\">
<td width=\"150px\"><img src=\"http://rc.nextio.co.kr/images/users/\" alt=\"\" width=\"50\" height=\"50\" /></td>
<td>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\">Muthu Krishnan</td>
</tr>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\">9790605724</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold;\" align=\"left\">Payment</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">On the day after the guest checks in, the payout method you supplied will be credited. For details, see your Transaction History.</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold;\" align=\"left\">Cancellation Policy</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">Flexible: Full refund 1 day prior to arrival, except fees</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #4f595b; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; padding: 0px 20px;\" width=\"300px\" align=\"left\" valign=\"top\">                                                        
<table style=\"width: 100%; font-size: 13px;\">
<tbody>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\">for 8 Night</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\"><span>KRW&nbsp;</span>400.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Service Fee</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 2.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Total</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 402.00</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renters Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table></body>","2016-09-01 12:14:50","Notification Mail");INSERT INTO fc_inbox VALUES("30","3","muthukrishnan@teamtweaks.com","0","<body><table class=\"ui-sortable-handle currentTable\" border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tbody>
<tr>
<td bgcolor=\"#4f595b\" height=\"30\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img style=\"margin: 15px 5px 0; padding: 0px; border: none;\" src=\"http://192.168.1.251:8081/renters/renters2.1/images/logo/admin_logo.png\" alt=\"\" width=\"200\" /></td>
</tr>
<tr>
<td bgcolor=\"#4f595b\" height=\"30\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi Admin</td>
</tr>
<tr>
<td height=\"50\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">We\'re excited to tell you that vasu s just booked Sample Listing with Muthu Krishnan</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 10px; font-weight: bold; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\" valign=\"top\">Itinerary</td>
</tr>
<tr>
<td align=\"center\" valign=\"middle\">
<div style=\"background-color: #f3402e; display: table; border-radius: 5px; color: #ffffff; font-family: Open Sans, Arial, sans-serif; font-size: 13px; text-transform: uppercase; font-weight: bold; padding: 7px 12px; text-align: center; text-decoration: none; width: 140px; margin: auto;\"><a style=\"color: #ffffff; text-decoration: none;\" href=\"http://192.168.1.251:8081/renters/renters2.1/rental/1\"><img src=\"http://192.168.1.251:8081/renters/renters2.1/server/php/rental/Tulips6.jpg\" alt=\"\" /> Sample Listing</a></div>
</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" width=\"600\" cellspacing=\"1\" cellpadding=\"5\" bgcolor=\"#EAEAEA\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th width=\"75\">Time</th>
<th width=\"75\">Date</th>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Arrive</td>
<td bgcolor=\"#FFFFFF\">21-09-16</td>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Depart</td>
<td bgcolor=\"#FFFFFF\">29-09-16</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" width=\"600\" cellspacing=\"1\" cellpadding=\"5\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th align=\"left\">Guest</th>
</tr>
<tr bgcolor=\"#EAEAEA\">
<td width=\"150px\"><img src=\"product.png\" alt=\"\" /></td>
<td>
<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tbody>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\">vasu s</td>
</tr>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\"></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #4f595b; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; padding: 0px 20px;\" align=\"left\" valign=\"top\" width=\"300px\">
<table style=\"width: 100%; font-size: 13px;\">
<tbody>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\">USD&nbsp;*8 Night</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\">USD&nbsp;400.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\">Service Fee</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\">USD&nbsp;2.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Total</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">USD&nbsp;402.00</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renters Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td bgcolor=\"#4f595b\" height=\"30\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td bgcolor=\"#4f595b\" height=\"50\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table></body>
			</html>","2016-09-01 12:14:52","Reservation Confirmed");INSERT INTO fc_inbox VALUES("31","3","muthukrishnan@teamtweaks.com","0","<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
			<meta name=\"viewport\" content=\"width=device-width\"/><body><table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img style=\"margin: 15px 5px 0; padding: 0px; border: none;\" src=\"http://192.168.1.251:8081/renters/renters2.1/images/logo/admin_logo.png\" alt=\"\" width=\"200\" /></td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi Muthu Krishnan</td>
</tr>
<tr>
<td height=\"50\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">We\'re excited to tell you that, your Sample Listing is booked now. To help make check-in seamless, we suggest you continue the conversation with your guest vasu s</td>
</tr>
<tr>
<td style=\"color: #000; padding: 10px 20px 10px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">through Renter\'s message system to confirm your guest arrival time, ask any questions you may have, and help them figure out how to best get to your listing.</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 10px; font-weight: bold; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\" valign=\"top\">Itinerary</td>
</tr>
<tr>
<td align=\"center\" valign=\"middle\">
<div style=\"background-color: #f3402e; display: table; border-radius: 5px; color: #ffffff; font-family: Open Sans, Arial, sans-serif; font-size: 13px; text-transform: uppercase; font-weight: bold; padding: 7px 12px; text-align: center; text-decoration: none; width: 140px; margin: auto;\"><a style=\"color: #ffffff; text-decoration: none;\" href=\"http://192.168.1.251:8081/renters/renters2.1/rental/1\"><img src=\"http://192.168.1.251:8081/renters/renters2.1/server/php/rental/Tulips6.jpg\" alt=\"\" width=\"300\" /> Sample Listing</a></div>
</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\" bgcolor=\"#EAEAEA\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th width=\"75\">Time</th> <th width=\"75\">Date</th>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Arrive</td>
<td bgcolor=\"#FFFFFF\">21-Sep-2016</td>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Depart</td>
<td bgcolor=\"#FFFFFF\">29-Sep-2016</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #4f595b; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; padding: 0px 20px;\" width=\"300px\" align=\"left\" valign=\"top\">           
<table style=\"width: 100%; font-size: 13px;\">
<tbody>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\">for8 Night</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\"><span>KRW</span> 400.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Service Fee</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 2.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Total</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 402.00</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renter Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table></body>
			</html>","2016-09-01 12:14:52","Reservation Confirmation");INSERT INTO fc_inbox VALUES("32","3","muthukrishnan@teamtweaks.com","0","<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
			<meta name=\"viewport\" content=\"width=device-width\"/><body><table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img style=\"margin: 15px 5px 0; padding: 0px; border: none;\" src=\"http://192.168.1.251:8081/renters/renters2.1/images/logo/admin_logo.png\" alt=\"logo\" width=\"200\" /></td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi vasu s</td>
</tr>
<tr>
<td height=\"50\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">We\'re excited to tell you that you have booked Sample Listing To help make check-in seamless, we suggest you continue the conversation with Muthu Krishnan</td>
</tr>
<tr>
<td style=\"color: #000; padding: 10px 20px 10px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">through Renters\'s message system to confirm their arrival time, ask any questions you may have, and help them figure out how to best get to your listing.</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 10px; font-weight: bold; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\" valign=\"top\">Itinerary</td>
</tr>
<tr>
<td align=\"center\" valign=\"middle\">
<div style=\"background-color: #f3402e; display: table; border-radius: 5px; color: #ffffff; font-family: Open Sans, Arial, sans-serif; font-size: 13px; text-transform: uppercase; font-weight: bold; padding: 7px 12px; text-align: center; text-decoration: none; width: 140px; margin: auto;\"><a style=\"color: #ffffff; text-decoration: none;\" href=\"http://192.168.1.251:8081/renters/renters2.1/rental/1\"><img src=\"http://192.168.1.251:8081/renters/renters2.1/server/php/rental/Tulips6.jpg\" alt=\"\" width=\"300\" /> Sample Listing</a></div>
</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\" bgcolor=\"#EAEAEA\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th width=\"75\">Time</th> <th width=\"75\">Date</th>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Arrive</td>
<td bgcolor=\"#FFFFFF\">21-Sep-2016</td>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Depart</td>
<td bgcolor=\"#FFFFFF\">29-Sep-2016</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th align=\"left\">Your Green house</th>
</tr>
<tr bgcolor=\"#EAEAEA\">
<td width=\"150px\"><img src=\"http://rc.nextio.co.kr/images/users/\" alt=\"\" width=\"50\" height=\"50\" /></td>
<td>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\">Muthu Krishnan</td>
</tr>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\">9790605724</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold;\" align=\"left\">Payment</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">On the day after the guest checks in, the payout method you supplied will be credited. For details, see your Transaction History.</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold;\" align=\"left\">Cancellation Policy</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">Flexible: Full refund 1 day prior to arrival, except fees</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #4f595b; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; padding: 0px 20px;\" width=\"300px\" align=\"left\" valign=\"top\">                                                        
<table style=\"width: 100%; font-size: 13px;\">
<tbody>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\">for 8 Night</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\"><span>KRW&nbsp;</span>400.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Service Fee</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 2.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Total</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 402.00</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renters Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table></body>","2016-09-01 12:14:56","Notification Mail");INSERT INTO fc_inbox VALUES("33","3","muthukrishnan@teamtweaks.com","0","<body><table class=\"ui-sortable-handle currentTable\" border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tbody>
<tr>
<td bgcolor=\"#4f595b\" height=\"30\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img style=\"margin: 15px 5px 0; padding: 0px; border: none;\" src=\"http://192.168.1.251:8081/renters/renters2.1/images/logo/admin_logo.png\" alt=\"\" width=\"200\" /></td>
</tr>
<tr>
<td bgcolor=\"#4f595b\" height=\"30\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi Admin</td>
</tr>
<tr>
<td height=\"50\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">We\'re excited to tell you that vasu s just booked Sample Listing with Muthu Krishnan</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 10px; font-weight: bold; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\" valign=\"top\">Itinerary</td>
</tr>
<tr>
<td align=\"center\" valign=\"middle\">
<div style=\"background-color: #f3402e; display: table; border-radius: 5px; color: #ffffff; font-family: Open Sans, Arial, sans-serif; font-size: 13px; text-transform: uppercase; font-weight: bold; padding: 7px 12px; text-align: center; text-decoration: none; width: 140px; margin: auto;\"><a style=\"color: #ffffff; text-decoration: none;\" href=\"http://192.168.1.251:8081/renters/renters2.1/rental/1\"><img src=\"http://192.168.1.251:8081/renters/renters2.1/server/php/rental/Tulips6.jpg\" alt=\"\" /> Sample Listing</a></div>
</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" width=\"600\" cellspacing=\"1\" cellpadding=\"5\" bgcolor=\"#EAEAEA\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th width=\"75\">Time</th>
<th width=\"75\">Date</th>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Arrive</td>
<td bgcolor=\"#FFFFFF\">21-09-16</td>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Depart</td>
<td bgcolor=\"#FFFFFF\">29-09-16</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" width=\"600\" cellspacing=\"1\" cellpadding=\"5\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th align=\"left\">Guest</th>
</tr>
<tr bgcolor=\"#EAEAEA\">
<td width=\"150px\"><img src=\"product.png\" alt=\"\" /></td>
<td>
<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tbody>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\">vasu s</td>
</tr>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\"></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #4f595b; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; padding: 0px 20px;\" align=\"left\" valign=\"top\" width=\"300px\">
<table style=\"width: 100%; font-size: 13px;\">
<tbody>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\">USD&nbsp;*8 Night</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\">USD&nbsp;400.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\">Service Fee</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\">USD&nbsp;2.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Total</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">USD&nbsp;402.00</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renters Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td bgcolor=\"#4f595b\" height=\"30\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td bgcolor=\"#4f595b\" height=\"50\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table></body>
			</html>","2016-09-01 12:14:56","Reservation Confirmed");INSERT INTO fc_inbox VALUES("34","3","muthukrishnan@teamtweaks.com","0","<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
			<meta name=\"viewport\" content=\"width=device-width\"/><body><table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img style=\"margin: 15px 5px 0; padding: 0px; border: none;\" src=\"http://192.168.1.251:8081/renters/renters2.1/images/logo/admin_logo.png\" alt=\"\" width=\"200\" /></td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi Muthu Krishnan</td>
</tr>
<tr>
<td height=\"50\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">We\'re excited to tell you that, your Sample Listing is booked now. To help make check-in seamless, we suggest you continue the conversation with your guest vasu s</td>
</tr>
<tr>
<td style=\"color: #000; padding: 10px 20px 10px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">through Renter\'s message system to confirm your guest arrival time, ask any questions you may have, and help them figure out how to best get to your listing.</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 10px; font-weight: bold; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\" valign=\"top\">Itinerary</td>
</tr>
<tr>
<td align=\"center\" valign=\"middle\">
<div style=\"background-color: #f3402e; display: table; border-radius: 5px; color: #ffffff; font-family: Open Sans, Arial, sans-serif; font-size: 13px; text-transform: uppercase; font-weight: bold; padding: 7px 12px; text-align: center; text-decoration: none; width: 140px; margin: auto;\"><a style=\"color: #ffffff; text-decoration: none;\" href=\"http://192.168.1.251:8081/renters/renters2.1/rental/1\"><img src=\"http://192.168.1.251:8081/renters/renters2.1/server/php/rental/Tulips6.jpg\" alt=\"\" width=\"300\" /> Sample Listing</a></div>
</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\" bgcolor=\"#EAEAEA\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th width=\"75\">Time</th> <th width=\"75\">Date</th>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Arrive</td>
<td bgcolor=\"#FFFFFF\">21-Sep-2016</td>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Depart</td>
<td bgcolor=\"#FFFFFF\">29-Sep-2016</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #4f595b; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; padding: 0px 20px;\" width=\"300px\" align=\"left\" valign=\"top\">           
<table style=\"width: 100%; font-size: 13px;\">
<tbody>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\">for8 Night</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\"><span>KRW</span> 400.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Service Fee</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 2.00</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Total</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> 402.00</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renter Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table></body>
			</html>","2016-09-01 12:14:57","Reservation Confirmation");CREATE TABLE `fc_inbox_new` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT 'sender id',
  `message` varchar(350) NOT NULL,
  `guide_id` int(11) NOT NULL COMMENT 'receiver id',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;CREATE TABLE `fc_inbox_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rental_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `posted_by` enum('customer','host') NOT NULL,
  `msg_read` enum('no','yes') NOT NULL DEFAULT 'no',
  `convId` int(22) NOT NULL,
  `bookingno` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;INSERT INTO fc_inbox_reply VALUES("1","1","3","1","xds","2016-09-01 12:17:31","customer","no","1472712451","EN1500098");CREATE TABLE `fc_languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `lang_code` varchar(100) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `default_lang` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;INSERT INTO fc_languages VALUES("1","English","en","Active","Default");INSERT INTO fc_languages VALUES("4","dansk","da","Inactive","");INSERT INTO fc_languages VALUES("5","Deutsch","de","Inactive","");INSERT INTO fc_languages VALUES("10","Filipino","fil","Inactive","");INSERT INTO fc_languages VALUES("12","Indonesian","id","Inactive","");INSERT INTO fc_languages VALUES("14","Italiano","it","Inactive","");INSERT INTO fc_languages VALUES("15","Lithuanian","lt","Inactive","");INSERT INTO fc_languages VALUES("16","Nederlands","nl","Inactive","");INSERT INTO fc_languages VALUES("17","norsk","no","Inactive","");INSERT INTO fc_languages VALUES("18","Polski","pl","Inactive","");INSERT INTO fc_languages VALUES("24","Suomi","fi","Inactive","");INSERT INTO fc_languages VALUES("30","srpski (latinica)","sr-latn","Inactive","");INSERT INTO fc_languages VALUES("31","svenska","sv","Inactive","");INSERT INTO fc_languages VALUES("32","Thai","th","Inactive","");INSERT INTO fc_languages VALUES("34","chinese","CN","Inactive","");INSERT INTO fc_languages VALUES("35","French","FR","Inactive","");INSERT INTO fc_languages VALUES("36","o0lp","99","Inactive","");INSERT INTO fc_languages VALUES("37","korean","kr","Active","");CREATE TABLE `fc_languages_known` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language_code` varchar(100) NOT NULL,
  `language_name` varchar(200) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;INSERT INTO fc_languages_known VALUES("1","4096","Bahasa Indonesia","2016-06-14 08:25:26");INSERT INTO fc_languages_known VALUES("2","4194304","Bahasa Malaysia","2014-11-25 16:43:53");INSERT INTO fc_languages_known VALUES("3","32768","Bengali","2014-11-25 16:44:49");INSERT INTO fc_languages_known VALUES("4","16777216","Dansk","2014-11-25 16:44:49");INSERT INTO fc_languages_known VALUES("5","4","Deutsch","2014-11-25 16:45:22");INSERT INTO fc_languages_known VALUES("6","1","English","2014-11-25 16:45:22");INSERT INTO fc_languages_known VALUES("7","64","Espanol","2015-09-30 18:02:05");INSERT INTO fc_languages_known VALUES("8","2","FranÃƒÂ§ais","2015-09-30 18:02:18");INSERT INTO fc_languages_known VALUES("9","512","Hindi","2014-11-25 16:46:26");INSERT INTO fc_languages_known VALUES("10","16","Italiano","2014-11-25 16:46:26");INSERT INTO fc_languages_known VALUES("11","536870912","Magyar","2014-11-25 16:46:54");INSERT INTO fc_languages_known VALUES("12","8192","Nederlands","2014-11-25 16:46:54");INSERT INTO fc_languages_known VALUES("13","67108864","Norsk","2014-11-25 16:47:21");INSERT INTO fc_languages_known VALUES("14","2097152","Polski","2014-11-25 16:47:21");INSERT INTO fc_languages_known VALUES("16","131072","Punjabi","2014-11-25 16:47:59");INSERT INTO fc_languages_known VALUES("17","524288","Sign Language","2014-11-25 16:48:46");INSERT INTO fc_languages_known VALUES("18","134217728","Suomi","2014-11-25 16:48:46");INSERT INTO fc_languages_known VALUES("19","33554432","Svenska","2014-11-25 16:49:12");INSERT INTO fc_languages_known VALUES("20","8388608","Tagalog","2014-11-25 16:49:12");INSERT INTO fc_languages_known VALUES("23","262144","Russian","2015-09-30 18:03:39");CREATE TABLE `fc_list_sub_values` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `list_id` int(20) NOT NULL,
  `list_value_id` varchar(20) NOT NULL,
  `sub_list_value` varchar(250) NOT NULL,
  `image` varchar(250) NOT NULL,
  `products` longtext NOT NULL,
  `product_count` bigint(20) NOT NULL,
  `followers` longtext NOT NULL,
  `followers_count` bigint(20) NOT NULL,
  `sub_list_value_seourl` text NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;INSERT INTO fc_list_sub_values VALUES("1","1","2","cxsacasc","","","0","","0","","Active");INSERT INTO fc_list_sub_values VALUES("2","1","1","Air Conditioning","Chrysanthemum.jpg","","0","","0","","Active");INSERT INTO fc_list_sub_values VALUES("3","1","19","test","","","0","","0","","Active");INSERT INTO fc_list_sub_values VALUES("5","1","36","Cable TV","","","0","","0","","Active");INSERT INTO fc_list_sub_values VALUES("6","1","3","Buzzer/Wireless Internet","","","0","","0","","Active");INSERT INTO fc_list_sub_values VALUES("7","7","38","Cabin","","","0","","0","","Active");INSERT INTO fc_list_sub_values VALUES("8","7","1","Chalet","","","0","","0","","Active");INSERT INTO fc_list_sub_values VALUES("9","7","40","Dorm","","","0","","0","","Active");INSERT INTO fc_list_sub_values VALUES("10","7","38","Loft","","","0","","0","","Active");INSERT INTO fc_list_sub_values VALUES("11","7","39","Other","","","0","","0","","Active");INSERT INTO fc_list_sub_values VALUES("12","7","40","Villa","","","0","","0","","Active");CREATE TABLE `fc_list_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `list_id` int(11) NOT NULL,
  `list_value` varchar(200) NOT NULL,
  `image` varchar(250) NOT NULL,
  `products` longtext NOT NULL,
  `product_count` bigint(20) NOT NULL,
  `followers` longtext NOT NULL,
  `followers_count` bigint(20) NOT NULL,
  `list_value_seourl` text NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8;INSERT INTO fc_list_values VALUES("1","1","Wireless Internet","wireless.png","","0","","1","wirelessinternet","Active");INSERT INTO fc_list_values VALUES("3","1","Kitchen","kitchen.png","","0","","0","kitchen","Active");INSERT INTO fc_list_values VALUES("41","1","Essentials","essential.png","","0","","0","essentials","Active");INSERT INTO fc_list_values VALUES("42","1","Cable TV","cable.png","","0","","0","cabletv","Active");INSERT INTO fc_list_values VALUES("43","4","Air Conditioning","airconditioner.png","","0","","0","airconditioning","Active");INSERT INTO fc_list_values VALUES("44","1","Heating","heating.png","","0","","0","heating","Active");INSERT INTO fc_list_values VALUES("45","1","Internet","internet_(2).png","","0","","0","internet","Active");INSERT INTO fc_list_values VALUES("49","1","Washer","washer.png","","0","","0","washer","Active");INSERT INTO fc_list_values VALUES("50","1","Dryer","dryer.png","","0","","0","dryer","Active");INSERT INTO fc_list_values VALUES("51","1","Breakfast","break.png","","0","","0","breakfast","Active");INSERT INTO fc_list_values VALUES("52","1","Family/Kid Friendly","family.png","","0","","0","familykidfriendly","Active");INSERT INTO fc_list_values VALUES("53","1","Suitable for Events","event.png","","0","","0","suitableforevents","Active");INSERT INTO fc_list_values VALUES("55","1","Wheelchair Accessible","weel.png","","0","","0","wheelchairaccessible","Active");INSERT INTO fc_list_values VALUES("56","1","Elevator in Building","elevator.png","","0","","0","elevatorinbuilding","Active");INSERT INTO fc_list_values VALUES("57","1","Indoor Fireplace","indoor.png","","0","","0","indoorfireplace","Active");INSERT INTO fc_list_values VALUES("58","1","Buzzer/ Wireless Intercom","buzzer.png","","0","","0","buzzerwirelessintercom","Active");INSERT INTO fc_list_values VALUES("59","1","Doorman","doorman.png","","0","","0","doorman","Active");INSERT INTO fc_list_values VALUES("60","1","Pool","pool.png","","0","","0","pool","Active");INSERT INTO fc_list_values VALUES("61","1","Hot Tub","hottub.png","","0","","0","hottub","Active");INSERT INTO fc_list_values VALUES("62","1","Gym","gym.png","","0","","0","gym","Active");INSERT INTO fc_list_values VALUES("63","1","Smoke Detector","smoke.png","","0","","0","smokedetector","Active");INSERT INTO fc_list_values VALUES("64","4","Hot Tub","hottub.png","","0","","0","hottub","Active");INSERT INTO fc_list_values VALUES("65","4","Washer","washer.png","","0","","0","washer","Active");INSERT INTO fc_list_values VALUES("66","4","Pool","pool.png","","0","","0","pool","Active");INSERT INTO fc_list_values VALUES("67","4","Dryer","dryer.png","","0","","0","dryer","Active");INSERT INTO fc_list_values VALUES("68","4","Breakfast","break.png","","0","","0","breakfast","Active");INSERT INTO fc_list_values VALUES("69","4","Free Parking on Premises","Parking.png","","0","","0","freeparkingonpremises","Active");INSERT INTO fc_list_values VALUES("70","4","Gym","gym.png","","0","","0","gym","Active");INSERT INTO fc_list_values VALUES("71","4","Elevator in Building","elevator.png","","0","","0","elevatorinbuilding","Active");INSERT INTO fc_list_values VALUES("72","4","Indoor Fireplace","indoor.png","","0","","0","indoorfireplace","Active");INSERT INTO fc_list_values VALUES("73","4","Buzzer/ Wireless Intercom","buzzer.png","","0","","0","buzzerwirelessintercom","Active");INSERT INTO fc_list_values VALUES("74","4","Doorman","doorman.png","","0","","0","doorman","Active");INSERT INTO fc_list_values VALUES("75","4","Shampoo","internet_(2)1.png","","0","","0","shampoo","Active");INSERT INTO fc_list_values VALUES("82","5","Family/Kid Friendly","family.png","","0","","0","familykidfriendly","Active");INSERT INTO fc_list_values VALUES("83","5","Wheelchair Accessible","weel.png","","0","","0","wheelchairaccessible","Active");INSERT INTO fc_list_values VALUES("84","5","Pets Allowed","Pets_Allowed.png","","0","","0","petsallowed","Active");INSERT INTO fc_list_values VALUES("85","5","Suitable for Events","event.png","","0","","0","suitableforevents","Active");INSERT INTO fc_list_values VALUES("86","5","Smoking Allowed","smoking.png","","0","","0","smokingallowed","Active");INSERT INTO fc_list_values VALUES("90","1","Outdoor Shower","internet_(2)2.png","","0","","0","outdoorshower","Active");INSERT INTO fc_list_values VALUES("92","1","ice","internet_(2)3.png","","0","","0","ice","Active");CREATE TABLE `fc_listing_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `status` enum('Active','InActive') NOT NULL DEFAULT 'Active',
  `type` enum('option','text') NOT NULL,
  `labelname` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;INSERT INTO fc_listing_types VALUES("23","Bedrooms","InActive","option","Bedrooms");INSERT INTO fc_listing_types VALUES("24","Beds","InActive","option","Beds");INSERT INTO fc_listing_types VALUES("26","Bathrooms","Active","option","Bathrooms");INSERT INTO fc_listing_types VALUES("30","minimum_stay","Active","option","minimum stay");INSERT INTO fc_listing_types VALUES("33","accommodates","Active","option","accommodates");INSERT INTO fc_listing_types VALUES("36","New_value","Active","text","New value");CREATE TABLE `fc_listings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rooms_bed` longtext NOT NULL,
  `listing_values` longtext NOT NULL,
  `listings_info` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;INSERT INTO fc_listings VALUES("1","{\"bedrooms\":\"Studio,1,2,3,4,5,6,7,8,9\",\"beds\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16+\",\"bedtype\":\"airbed,futon,pull-out sofa,couch,real bed\",\"bathrooms\":\"Private,Both,Shared\",\"noofbathrooms\":\"1,2,3,4,5\",\"min_stay\":\"1,2,3,4,5,6,7,8,9,10\",\"accommodates\":\"1,2,3,4,5,6,7,8,9,10,10+\",\"can_policy\":\"Flexible,Moderate,Strict\"}","{\"Bedrooms\":\"1,2,3,4,5,6,7,8,9,10,11\",\"Beds\":\"1,2,3,4,5,6,7,8,9,10\",\"Bathrooms\":\"Private,public,both\",\"minimum_stay\":\"1,2,3,4,5,6,7,8,9\",\"accommodates\":\"1,2,3,4,5,6,7,8,9\",\"New_value\":\"\"}","");CREATE TABLE `fc_lists` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `product_id` longtext NOT NULL,
  `followers` longtext NOT NULL,
  `banner` varchar(200) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `contributors` longtext NOT NULL,
  `contributors_invited` longtext NOT NULL,
  `product_count` bigint(20) NOT NULL,
  `followers_count` bigint(20) NOT NULL,
  `whocansee` enum('Everyone','Only me') NOT NULL DEFAULT 'Everyone',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;INSERT INTO fc_lists VALUES("1","Tesr","6",",14","","","0","","","0","0","Everyone");INSERT INTO fc_lists VALUES("2","Myfav","3","17,1","","","0","","","0","0","Everyone");INSERT INTO fc_lists VALUES("3","Like","3",",14","","","0","","","0","0","Everyone");INSERT INTO fc_lists VALUES("4","Demo","3",",1","","","0","","","0","0","Everyone");INSERT INTO fc_lists VALUES("5","Asfda","3","","","","0","","","0","0","Everyone");CREATE TABLE `fc_listspace` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attribute_name` varchar(500) NOT NULL,
  `attribute_description` varchar(250) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `attribute_seourl` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;INSERT INTO fc_listspace VALUES("9","Property Type","","Active","2016-09-16 09:01:34","propertytype");INSERT INTO fc_listspace VALUES("10","Room Type","","Active","2015-07-07 12:21:40","roomtype");CREATE TABLE `fc_listspace_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `listspace_id` int(11) NOT NULL,
  `list_value` varchar(250) NOT NULL,
  `list_description` varchar(250) NOT NULL,
  `other` varchar(200) NOT NULL,
  `image` varchar(250) NOT NULL,
  `products` longtext NOT NULL,
  `product_count` bigint(20) NOT NULL,
  `followers` longtext NOT NULL,
  `followers_count` bigint(20) NOT NULL,
  `list_value_seourl` text NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;INSERT INTO fc_listspace_values VALUES("1","2","demo","","","","","0","","0","demo","Active");INSERT INTO fc_listspace_values VALUES("3","5","demo","","no","","","0","","0","demo","Active");INSERT INTO fc_listspace_values VALUES("4","4","demo","","","","","0","","0","demo","Active");INSERT INTO fc_listspace_values VALUES("5","5","demo 2","","no","","","0","","0","demo2","Active");INSERT INTO fc_listspace_values VALUES("6","8","demo 2","","","","","0","","0","demo2","Active");INSERT INTO fc_listspace_values VALUES("17","11","type","","no","","","0","","0","type","Active");INSERT INTO fc_listspace_values VALUES("29","9","House","House","Yes","apt2.jpg","","0","","0","house","Active");INSERT INTO fc_listspace_values VALUES("30","10","Private Room","","no","Apartment2.png","","0","","0","privateroom","Active");INSERT INTO fc_listspace_values VALUES("31","9","Apartment","","Yes","Apartment3.png","","0","","0","apartment","Active");INSERT INTO fc_listspace_values VALUES("32","9","Bed & Breakfast","","no","images1.jpg","","0","","0","bedbreakfast","Active");INSERT INTO fc_listspace_values VALUES("33","9","Cabin","","no","Apartment5.png","","0","","0","cabin","Active");INSERT INTO fc_listspace_values VALUES("34","10","Common Room","","no","Apartment6.png","","0","","0","commonroom","Active");INSERT INTO fc_listspace_values VALUES("35","10","Shared Both room","","no","Apartment7.png","","0","","0","sharedbothroom","Active");INSERT INTO fc_listspace_values VALUES("40","9","Villa","","Yes","","","0","","0","villa","Active");INSERT INTO fc_listspace_values VALUES("41","9","Budget Hotel","Budget Hotel","Yes","1541535.jpg","","0","","0","budgethotel","Active");INSERT INTO fc_listspace_values VALUES("42","9","Tree House ","Tree House ","Yes","","","0","","0","treehouse","Active");INSERT INTO fc_listspace_values VALUES("43","9","Kitchen","Kitchen","Yes","","","0","","0","kitchen","Active");INSERT INTO fc_listspace_values VALUES("44","9","Slip","Slip","Yes","","","0","","0","slip","Active");INSERT INTO fc_listspace_values VALUES("45","9","Mooring","Mooring","Yes","","","0","","0","mooring","Active");INSERT INTO fc_listspace_values VALUES("46","9","Seawall","Seawall","Yes","","","0","","0","seawall","Active");INSERT INTO fc_listspace_values VALUES("47","10","Standard Room ","Standard Room ","Yes","","","0","","0","standardroom","Active");INSERT INTO fc_listspace_values VALUES("48","10","Executive Room","Executive Room","Yes","","","0","","0","executiveroom","Active");INSERT INTO fc_listspace_values VALUES("49","10","Luxury Room ","Luxury Room ","Yes","","","0","","0","luxuryroom","Active");INSERT INTO fc_listspace_values VALUES("50","10","House","House","Yes","","","0","","0","house","Active");INSERT INTO fc_listspace_values VALUES("51","10","Garage","Garage","Yes","","","0","","0","garage","Active");INSERT INTO fc_listspace_values VALUES("52","10","Single Room","Single Room","Yes","","","0","","0","singleroom","Active");INSERT INTO fc_listspace_values VALUES("53","9","Beach house","house","no","","","0","","0","beachhouse","Active");CREATE TABLE `fc_location` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `location_name` varchar(1000) NOT NULL,
  `location_code` varchar(500) NOT NULL,
  `iso_code2` varchar(500) NOT NULL,
  `iso_code3` varchar(500) NOT NULL,
  `country_tax` float(10,2) NOT NULL,
  `country_ship` decimal(10,2) NOT NULL,
  `seourl` varchar(1000) NOT NULL,
  `currency_type` varchar(500) NOT NULL,
  `currency_symbol` varchar(500) NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  `dateAdded` datetime NOT NULL,
  `meta_title` longblob NOT NULL,
  `meta_keyword` longblob NOT NULL,
  `meta_description` longblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;INSERT INTO fc_location VALUES("1","IN","","","","5.00","15.00","india","INR","Rs","InActive","2013-07-26 04:10:15","","","");INSERT INTO fc_location VALUES("3","USA","","US","USA","1.00","0.00","usa","USD","$","Active","2013-07-26 12:00:00","USA","USA","USA");INSERT INTO fc_location VALUES("6","Uk","","","","10.00","10.00","uk","USD","$","InActive","2013-07-29 13:00:00","","","");INSERT INTO fc_location VALUES("7","Australia","","AU","","10.00","20.00","australia","AUD","$","InActive","2013-08-21 11:00:00","","","");CREATE TABLE `fc_med_message` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `productId` int(25) NOT NULL,
  `bookingNo` varchar(250) NOT NULL,
  `senderId` int(25) NOT NULL,
  `receiverId` int(25) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `message` text CHARACTER SET utf8 NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `msg_read` enum('No','Yes') NOT NULL,
  `status` enum('Pending','Accept','Decline') NOT NULL,
  `point` enum('0','1','2') NOT NULL DEFAULT '0',
  `user_archive_status` enum('No','Yes') NOT NULL,
  `host_archive_status` enum('No','Yes') NOT NULL,
  `special_booking` varchar(50) NOT NULL,
  `b_prd_id` int(11) NOT NULL,
  `b_checkin` datetime NOT NULL,
  `b_checkout` datetime NOT NULL,
  `b_NoofGuest` int(11) NOT NULL,
  `b_numofdates` int(11) NOT NULL,
  `b_serviceFee` decimal(10,2) NOT NULL,
  `b_totalAmt` decimal(10,2) NOT NULL,
  `offer_accept` enum('Pending','Accept','Decline') NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;INSERT INTO fc_med_message VALUES("1","1","EN1500018","2","1","Booking Request : EN1500018","Booking request","2016-08-30 15:30:57","Yes","Accept","0","No","No","","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0","0","0.00","0.00","Decline");INSERT INTO fc_med_message VALUES("2","1","EN1500018","1","2","Booking Request : EN1500018","special offer","2016-08-30 15:33:31","Yes","Accept","2","No","No","EN1500018","1","2016-08-30 00:00:00","2016-08-31 00:00:00","1","1","2.00","42.00","Accept");INSERT INTO fc_med_message VALUES("3","1","EN1500028","3","1","Booking Request : EN1500028","545454566555423435 243544543355345","2016-08-30 17:17:58","Yes","Accept","0","No","No","","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0","0","0.00","0.00","Decline");INSERT INTO fc_med_message VALUES("4","1","EN1500028","1","3","Booking Request : EN1500028","offer","2016-08-30 17:20:44","Yes","Accept","2","No","No","EN1500028","1","2016-09-01 00:00:00","2016-09-03 00:00:00","2","2","2.00","102.00","Accept");INSERT INTO fc_med_message VALUES("5","1","EN1500038","3","1","Booking Request : EN1500038","fasdasds ","2016-08-30 17:22:59","Yes","Accept","0","No","No","","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0","0","0.00","0.00","Decline");INSERT INTO fc_med_message VALUES("6","1","EN1500038","1","3","Booking Request : EN1500038","assd","2016-08-30 17:25:59","Yes","Accept","2","No","No","EN1500038","1","2016-09-06 00:00:00","2016-09-08 00:00:00","2","2","2.00","52.00","Decline");INSERT INTO fc_med_message VALUES("7","1","EN1500038","1","3","Booking Request : EN1500038","sadf","2016-08-30 17:34:58","Yes","Accept","2","No","No","EN1500038","1","2016-09-06 00:00:00","2016-09-08 00:00:00","2","2","2.00","32.00","Accept");INSERT INTO fc_med_message VALUES("8","1","EN1500048","2","1","Booking Request : EN1500048","request","2016-08-30 18:26:48","Yes","Decline","0","No","No","","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0","0","0.00","0.00","Pending");INSERT INTO fc_med_message VALUES("10","1","EN1500058","2","1","Booking Request : EN1500058","booking request","2016-08-31 11:20:28","Yes","Accept","0","No","No","","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0","0","0.00","0.00","Decline");INSERT INTO fc_med_message VALUES("11","1","EN1500058","1","2","Booking Request : EN1500058","special offer","2016-08-31 11:25:43","Yes","Accept","2","No","No","EN1500058","1","2016-09-13 00:00:00","2016-09-14 00:00:00","1","1","2.00","32.00","Accept");INSERT INTO fc_med_message VALUES("12","1","EN1500068","2","1","Booking Request : EN1500068","sms check","2016-08-31 13:11:07","Yes","Accept","0","No","No","","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0","0","0.00","0.00","Pending");INSERT INTO fc_med_message VALUES("13","1","EN1500068","1","2","Booking Request : EN1500068","approved","2016-08-31 13:12:20","Yes","Accept","1","No","No","","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0","0","0.00","0.00","Pending");INSERT INTO fc_med_message VALUES("14","1","EN1500078","2","1","Booking Request : EN1500078","ok","2016-08-31 16:09:11","Yes","Pending","0","No","No","","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0","0","0.00","0.00","Pending");INSERT INTO fc_med_message VALUES("15","1","EN1500078","1","2","Booking Request : EN1500078","ok","2016-08-31 16:10:04","No","Pending","2","No","No","EN1500078","1","2016-09-15 00:00:00","2016-09-17 00:00:00","1","2","2.00","31.68","Pending");INSERT INTO fc_med_message VALUES("16","1","EN1500088","2","1","Booking Request : EN1500088","request","2016-08-31 19:16:06","Yes","Accept","0","No","No","","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0","0","0.00","0.00","Pending");INSERT INTO fc_med_message VALUES("17","1","EN1500088","1","2","Booking Request : EN1500088","approved","2016-08-31 19:16:20","No","Accept","1","No","No","","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0","0","0.00","0.00","Pending");INSERT INTO fc_med_message VALUES("18","1","EN1500098","3","1","Booking Request : EN1500098","dfgzd","2016-09-01 12:13:30","Yes","Accept","0","No","No","","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0","0","0.00","0.00","Pending");INSERT INTO fc_med_message VALUES("19","1","EN1500098","1","3","Booking Request : EN1500098","dfg","2016-09-01 12:13:42","Yes","Accept","1","No","No","","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0","0","0.00","0.00","Pending");INSERT INTO fc_med_message VALUES("20","1","EN1500098","3","1","Booking Request : EN1500098","xds","2016-09-01 12:17:31","Yes","Accept","0","No","No","","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0","0","0.00","0.00","Pending");INSERT INTO fc_med_message VALUES("21","14","EN1500108","4","3","Booking Request : EN1500108","sddffds","2016-09-08 18:32:25","No","Pending","0","No","No","","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0","0","0.00","0.00","Pending");INSERT INTO fc_med_message VALUES("22","1","EN1500118","2","1","Booking Request : EN1500118","reuest","2016-09-16 15:37:15","Yes","Pending","0","No","No","","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0","0","0.00","0.00","Pending");INSERT INTO fc_med_message VALUES("23","1","EN1500118","1","2","Booking Request : EN1500118","offer","2016-09-16 15:39:20","Yes","Pending","2","No","No","EN1500118","1","2016-10-17 00:00:00","2016-10-20 00:00:00","1","3","133.80","267.60","Pending");INSERT INTO fc_med_message VALUES("24","1","EN1500118","1","2","Booking Request : EN1500118","offer","2016-09-16 15:39:47","Yes","Pending","2","No","No","EN1500118","1","2016-10-17 00:00:00","2016-10-20 00:00:00","1","3","133.80","284.33","Pending");INSERT INTO fc_med_message VALUES("25","1","EN1500118","1","2","Booking Request : EN1500118","offer","2016-09-16 15:40:25","Yes","Pending","2","No","No","EN1500118","1","2016-10-17 00:00:00","2016-10-20 00:00:00","1","3","179.02","312.82","Pending");INSERT INTO fc_med_message VALUES("26","1","EN1500118","1","2","Booking Request : EN1500118","offer","2016-09-16 15:47:42","Yes","Pending","2","No","No","EN1500118","1","2016-10-17 00:00:00","2016-10-20 00:00:00","1","3","2.68","136.48","Pending");INSERT INTO fc_med_message VALUES("30","1","EN1500118","1","2","Booking Request : EN1500118","offer","2016-09-16 16:12:45","No","Pending","2","No","No","EN1500118","1","2016-10-17 00:00:00","2016-10-20 00:00:00","1","3","2.68","136.48","Pending");INSERT INTO fc_med_message VALUES("31","1","EN1500118","1","2","Booking Request : EN1500118","offer","2016-09-16 16:13:19","No","Pending","2","No","No","EN1500118","1","2016-10-17 00:00:00","2016-10-20 00:00:00","1","3","2.68","136.48","Pending");CREATE TABLE `fc_neighborhood` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `seourl` varchar(250) NOT NULL,
  `status` enum('InActive','Active') NOT NULL,
  `category` varchar(1000) NOT NULL,
  `description` longblob NOT NULL,
  `meta_title` varchar(1000) NOT NULL,
  `meta_keyword` varchar(1000) NOT NULL,
  `meta_description` blob NOT NULL,
  `citylogo` varchar(1000) NOT NULL,
  `citythumb` varchar(1000) NOT NULL,
  `neighborhoods` varchar(1000) NOT NULL,
  `tags` varchar(1000) NOT NULL,
  `short_description` varchar(1000) NOT NULL,
  `featured` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;INSERT INTO fc_neighborhood VALUES("2","El Born","el-born","Active","Dining,Shopping","<p>rwerwerwe rwe wer werwer</p>","","","","54647.jpg","24260521.jpg","872","fghfgh","fgdfgdfgdgf
","0");INSERT INTO fc_neighborhood VALUES("3","El Raval","el-raval","Active","Nightlife,Shopping","<p>Bold resistance to change.dfgdfg dfgdfgd fgdfgdfg dfgdfgdfg dfg dfgdfgdfgdfgdgf dfg dfg dfg</p>","","","","1234url.jpg","827789021.jpg","872","tegs,tewewerwer,werwerew,werwerwer,werwer,w,erwer,werwe,wexcvx,v,fghfghfgh","Bold resistance to change.","1");INSERT INTO fc_neighborhood VALUES("4","Grace Cathedral","grace-cathedral","Active","Dining,Shopping","<p>Separated from many of Barcelona&rsquo;s well-known sights and attractions by  large roads and parks, Eixample&rsquo;s &ldquo;New Left&rdquo; keeps to itself, quietly  mixing office buildings and residential side streets. After nightfall,  most of the locals head home or to a gathering spot elsewhere in  l&rsquo;Eixample. Visitors who take the time to venture to the New Left often  stumble upon unexpectedly delightful sights, like the colorful Parc de  Joan Mir&oacute;.</p>","","","","213url.jpg","54648.jpg","871","sdfsdf,sdfsdfsdf,sdf,sdfsd","Separated from many of BarcelonaÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¾Ãƒâ€šÃ‚Â¢s well-known sights and attractions by large roads and parks, EixampleÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¾Ãƒâ€šÃ‚Â¢s ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã¢â‚¬Â¦ÃƒÂ¢Ã¢â€šÂ¬Ã…â€œNew LeftÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â keeps to itself","1");CREATE TABLE `fc_newsletter` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `news_title` varchar(5000) NOT NULL,
  `news_descrip` blob NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  `dateAdded` datetime NOT NULL,
  `news_image` varchar(500) NOT NULL,
  `news_subject` varchar(1000) NOT NULL,
  `sender_name` varchar(500) NOT NULL,
  `sender_email` varchar(500) NOT NULL,
  `news_seourl` varchar(1000) NOT NULL,
  `typeVal` enum('1','2') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;INSERT INTO fc_newsletter VALUES("33","Reservation Confirmed to Admin","<table class=\"ui-sortable-handle currentTable\" border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tbody>
<tr>
<td bgcolor=\"#4f595b\" height=\"30\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img style=\"margin: 15px 5px 0; padding: 0px; border: none;\" src=\"{base_url()}images/logo/{$logo}\" alt=\"{$meta_title}\" width=\"200\" /></td>
</tr>
<tr>
<td bgcolor=\"#4f595b\" height=\"30\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi Admin</td>
</tr>
<tr>
<td height=\"50\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">We\'re excited to tell you that {$first_name} {$last_name} just booked {$rental_name} with {$renter_fname} {$renter_lname}</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 10px; font-weight: bold; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\" valign=\"top\">Itinerary</td>
</tr>
<tr>
<td align=\"center\" valign=\"middle\">
<div style=\"background-color: #f3402e; display: table; border-radius: 5px; color: #ffffff; font-family: Open Sans, Arial, sans-serif; font-size: 13px; text-transform: uppercase; font-weight: bold; padding: 7px 12px; text-align: center; text-decoration: none; width: 140px; margin: auto;\"><a style=\"color: #ffffff; text-decoration: none;\" href=\"{base_url()}rental/{$prd_id}\"><img src=\"{$rental_image}\" alt=\"\" /> {$rental_name}</a></div>
</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" width=\"600\" cellspacing=\"1\" cellpadding=\"5\" bgcolor=\"#EAEAEA\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th width=\"75\">Time</th>
<th width=\"75\">Date</th>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Arrive</td>
<td bgcolor=\"#FFFFFF\">{$checkin}</td>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Depart</td>
<td bgcolor=\"#FFFFFF\">{$checkout}</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" width=\"600\" cellspacing=\"1\" cellpadding=\"5\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th align=\"left\">Guest</th>
</tr>
<tr bgcolor=\"#EAEAEA\">
<td width=\"150px\"><img src=\"product.png\" alt=\"\" /></td>
<td>
<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tbody>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\">{$first_name} {$last_name}</td>
</tr>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\">{$ph_no}</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #4f595b; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; padding: 0px 20px;\" align=\"left\" valign=\"top\" width=\"300px\">
<table style=\"width: 100%; font-size: 13px;\">
<tbody>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\">USD&nbsp;{$price}*{$noofnights} Night</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\">USD&nbsp;{$amount}</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\">Service Fee</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\">USD&nbsp;{$serviceFee}</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Total</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">USD&nbsp;{$netamount}</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renters Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td bgcolor=\"#4f595b\" height=\"30\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td bgcolor=\"#4f595b\" height=\"50\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>","Active","2016-08-31 06:24:32","","Reservation Confirmed","Renters","muthukrishnan@teamtweaks.com","","1");INSERT INTO fc_newsletter VALUES("16","Reservation request to host","<table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img src=\"{base_url()}images/logo/{$logo}\" alt=\"logo\" width=\"200\" />&nbsp; &nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Great news! You have a reservation request from {$travellername}.</td>
</tr>
<tr>
<td height=\"40\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 10px; font-weight: bold; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\" valign=\"top\">{$travellername} would like to stay at {$product_name} from {$checkindate} through {$checkoutdate}</td>
</tr>
<tr>
<td height=\"40\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 10px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">
<h4>Based on your rate of <span>KRW</span> {$price} per night along with Renters fees, your potential payout for this reservation is <span>KRW&nbsp;</span>{$totalprice}.</h4>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td align=\"center\" valign=\"middle\">
<div style=\"background-color: #f3402e; display: table; border-radius: 5px; color: #ffffff; font-family: Open Sans, Arial, sans-serif; font-size: 13px; text-transform: uppercase; font-weight: bold; padding: 7px 12px; text-align: center; text-decoration: none; width: 140px; margin: auto;\"><a style=\"color: #ffffff; text-decoration: none;\" href=\"{base_url()}inbox\">Accept /  Decline</a></div>
</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<p style=\"margin: 0px; padding: 8px 10px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; background: #f1f1f1;\">Reservation Request</p>
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\" bgcolor=\"#EAEAEA\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th width=\"75\">Time</th> <th width=\"75\">Date</th>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Arrive</td>
<td bgcolor=\"#FFFFFF\">{$checkindate}</td>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Depart</td>
<td bgcolor=\"#FFFFFF\">{$checkoutdate}</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr style=\"margin-top: 19px; display: block; padding: 0px 20px;\">
<td style=\"color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 12px;\" align=\"left\" valign=\"middle\"><span>{$travellername}</span>\'s reservation request will expire after 24 hours if you don\'t officially accept or decline it.</td>
</tr>
<tr style=\"margin-top: 19px; display: block; padding: 0px 20px;\">
<td style=\"color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 12px;\" align=\"left\" valign=\"middle\">We encourage you to respond as quickly as possible so your guest can begin to plan their adventure!</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\" valign=\"middle\"><a style=\"color: #0094aa; text-decoration: none;\" href=\"#\">(Remember: Not responding to this booking will result in your listing being ranked lower.)</a></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td height=\"50\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renters Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>","Active","2013-11-05 00:00:00","","Reservation request to host","Renters","muthukrishnan@teamtweaks.com","","1");INSERT INTO fc_newsletter VALUES("45","Review Added Notification ","<table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#ffffff\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #ffffff;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#ffffff\">&nbsp; &nbsp; &nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#ffffff\"><img src=\"{base_url()}images/logo/{$logo}\" alt=\"logo\" width=\"200\" /></td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#ffffff\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #414042;\" align=\"center\" valign=\"middle\"><span style=\"color: #fcdf3f;\">Hi Admin</span></td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">
<p><span style=\"font-size: x-large;\"><strong> User {$user_name} has posted a review about the listing {$product_name} </strong></span></p>
<p><span style=\"font-size: medium;\"><strong>&nbsp;</strong></span></p>
</td>
</tr>
<tr>
<td>
<p>&nbsp;</p>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p><span style=\"color: #000000;\"><strong> {$sitename}</strong></span></p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#ffffff\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#ffffff\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>","Active","2016-05-30 10:09:38","","Review Notifications","Renters","muthukrishnan@teamtweaks.com","","1");INSERT INTO fc_newsletter VALUES("19","Reservation request to host","<table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img src=\"{base_url()}images/logo/{$logo}\" alt=\"logo\" width=\"200\" /></td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Great news! You have a reservation request from {$travellername}.</td>
</tr>
<tr>
<td height=\"40\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 10px; font-weight: bold; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\" valign=\"top\">{$travellername} would like to stay at {$productname} from {$checkindate} through {$checkoutdate}</td>
</tr>
<tr>
<td height=\"40\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 10px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">Based on your rate of <span>KRW</span> {$price} per night along with associated fees, your potential payout for this reservation is <span>KRW</span> {$totalprice}.</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td align=\"center\" valign=\"middle\">
<div style=\"background-color: #f3402e; display: table; border-radius: 5px; color: #ffffff; font-family: Open Sans, Arial, sans-serif; font-size: 13px; text-transform: uppercase; font-weight: bold; padding: 7px 12px; text-align: center; text-decoration: none; width: 200px; margin: auto;\"><a style=\"color: #ffffff; text-decoration: none;\" href=\"{base_url()}listing-reservation/\">Accept</a> /  <a style=\"color: #ffffff; text-decoration: none;\" href=\"{base_url()}listing-reservation/\">Decline</a></div>
</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<p style=\"margin: 0px; padding: 8px 10px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; background: #f1f1f1;\">Reservation Request</p>
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\" bgcolor=\"#EAEAEA\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th width=\"75\">Time</th> <th width=\"75\">Date</th>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Arrive</td>
<td bgcolor=\"#FFFFFF\">{$checkindate}</td>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Depart</td>
<td bgcolor=\"#FFFFFF\">{$checkoutdate}</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr style=\"margin-top: 19px; display: block; padding: 0px 20px;\">
<td style=\"color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 12px;\" align=\"left\" valign=\"middle\">{$travellername}\'s reservation request will expire after 24 hours if you don\'t officially accept or decline it.</td>
</tr>
<tr style=\"margin-top: 19px; display: block; padding: 0px 20px;\">
<td style=\"color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 12px;\" align=\"left\" valign=\"middle\">We encourage you to respond as quickly as possible so your guest can begin to plan their adventure!</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\" valign=\"middle\"><a style=\"color: #0094aa; text-decoration: none;\" href=\"#\">(Remember: Not responding to this booking will result in your listing being ranked lower.)</a></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<th style=\"color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 12px; padding: 0 20px;\" align=\"center\" valign=\"middle\">&nbsp;</th>
</tr>
<tr>
<td height=\"50\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renters Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>","Active","2014-12-24 00:00:00","","Reservation request to host","Renters","muthukrishnan@teamtweaks.com","","1");INSERT INTO fc_newsletter VALUES("5","Forgot Password","<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"640\" bgcolor=\"#7da2c1\">
<tbody>
<tr>
<td style=\"padding: 40px;\">
<table style=\"border: #1d4567 1px solid; font-family: Arial, Helvetica, sans-serif;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"610\">
<tbody>
<tr>
<td><a href=\"{base_url()}\"><img style=\"margin: 15px 5px 0; padding: 0px; border: none;\" src=\"{base_url()}images/logo/{$logo}\" alt=\"{$meta_title}\" /></a></td>
</tr>
<tr>
<td valign=\"top\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#FFFFFF\">
<tbody>
<tr>
<td colspan=\"2\">
<h3 style=\"padding: 10px 15px; margin: 0px; color: #0d487a;\">Here\'s Your New Password</h3>
<p style=\"padding: 0px 15px 10px 15px; font-size: 12px; margin: 0px;\">Have you forgetten your password? Don\'t worry. We already reset your password.</p>
</td>
</tr>
<tr>
<td style=\"font-size: 12px; padding: 10px 15px;\" width=\"50%\" valign=\"top\">
<p><strong>New Password :</strong> {$pwd}</p>
<p>You can login using above password and change your password immediately.</p>
<p>&nbsp;</p>
<p>Thanks,</p>
<div class=\"p \"><span>Sent with&nbsp;<img src=\"{base_url()}images/heart.png\" alt=\"&hearts;\" width=\"12\" height=\"10\" /></span><span>&nbsp;from {$email_title} HQ</span></div>
<p>&nbsp;</p>
</td>
<td style=\"font-size: 12px; padding: 10px 15px;\" width=\"50%\" valign=\"top\">
<p>&nbsp;</p>
<p>&nbsp;</p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>","Active","2013-10-02 00:00:00","","Forgot Passwords","Renters","muthukrishnan@teamtweaks.com","","2");INSERT INTO fc_newsletter VALUES("6","send mail subcribers list","<div style=\"width: 600px; background: #FFFFFF; margin: 0 auto; border-radius: 10px; box-shadow: 0 0 5px #ccc; border: 1px solid #DA7CAF;\">
<div style=\"background: #f7f7f7; padding: 10px; border-radius: 10px 10px 0 0; text-align: center;\"><a href=\"{base_url()}\" target=\"_blank\"><img style=\"margin: 5px 20px 0px 0px;\" src=\"{base_url()}images/logo/{$logo_image}\" border=\"0\" alt=\"{$title}\" width=\"205\" /></a>&nbsp;</div>
<div style=\"background: #fff; padding: 10px; width: 580px;\">
<div style=\"font-family: Myriad Pro; font-size: 24px; color: #da7caf; padding-bottom: 15px; font-weight: bold;\">{$news_subject}</div>
<div style=\"font-family: Myriad Pro; font-size: 16px; color: #000; padding-bottom: 15px; line-height: 24px; text-align: justify;\">{$news_descrip}</div>
<div style=\"font-family: Myriad Pro; font-size: 16px; color: #000; padding-bottom: 15px; line-height: 24px; text-align: justify;\">If you have any questions please email <a style=\"color: #5ea008; text-decoration: none;\" href=\"/cdn-cgi/l/email-protection#c2b9e6b6aaabb1efe4a5b6f9a1adaca4aba5efe4a5b6f9abb6a7afeae5a7afa3abaee5ebbf\">{$email}</a></div>
<div style=\"font-family: Myriad Pro; font-size: 18px; color: #000; padding-bottom: 15px; line-height: 28px;\">Sincerely , <br /> Management</div>
</div>
</div>","Active","2013-10-30 00:00:00","","send mail subcribers list","Renters","muthukrishnan@teamtweaks.com","","2");INSERT INTO fc_newsletter VALUES("29","Notification Mail","<table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img style=\"margin: 15px 5px 0; padding: 0px; border: none;\" src=\"{base_url()}images/logo/{$logo}\" alt=\"logo\" width=\"200\" /></td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi {$first_name} {$last_name}</td>
</tr>
<tr>
<td height=\"50\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">We\'re excited to tell you that you have booked {$rental_name} To help make check-in seamless, we suggest you continue the conversation with {$renter_fname} {$renter_lname}</td>
</tr>
<tr>
<td style=\"color: #000; padding: 10px 20px 10px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">through Renters\'s message system to confirm their arrival time, ask any questions you may have, and help them figure out how to best get to your listing.</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 10px; font-weight: bold; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\" valign=\"top\">Itinerary</td>
</tr>
<tr>
<td align=\"center\" valign=\"middle\">
<div style=\"background-color: #f3402e; display: table; border-radius: 5px; color: #ffffff; font-family: Open Sans, Arial, sans-serif; font-size: 13px; text-transform: uppercase; font-weight: bold; padding: 7px 12px; text-align: center; text-decoration: none; width: 140px; margin: auto;\"><a style=\"color: #ffffff; text-decoration: none;\" href=\"{base_url()}rental/{$prd_id}\"><img src=\"{$rental_image}\" alt=\"\" width=\"300\" /> {$rental_name}</a></div>
</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\" bgcolor=\"#EAEAEA\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th width=\"75\">Time</th> <th width=\"75\">Date</th>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Arrive</td>
<td bgcolor=\"#FFFFFF\">{$chkIn}</td>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Depart</td>
<td bgcolor=\"#FFFFFF\">{$chkOut}</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th align=\"left\">Your Green house</th>
</tr>
<tr bgcolor=\"#EAEAEA\">
<td width=\"150px\"><img src=\"http://rc.nextio.co.kr/images/users/{$image}\" alt=\"\" width=\"50\" height=\"50\" /></td>
<td>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\">{$renter_fname} {$renter_lname}</td>
</tr>
<tr>
<td style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; padding: 5px 0px;\">{$ph_no}</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold;\" align=\"left\">Payment</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">On the day after the guest checks in, the payout method you supplied will be credited. For details, see your Transaction History.</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold;\" align=\"left\">Cancellation Policy</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">Flexible: Full refund 1 day prior to arrival, except fees</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #4f595b; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; padding: 0px 20px;\" width=\"300px\" align=\"left\" valign=\"top\">{$service}                                                       
<table style=\"width: 100%; font-size: 13px;\">
<tbody>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\">for {$noofnights} Night</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\"><span>KRW&nbsp;</span>{$amount}</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Service Fee</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> {$serviceFee}</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Total</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> {$netamount}</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renters Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>","Active","2014-12-29 00:00:00","","Notification Mail","Renters","muthukrishnan@teamtweaks.com","","1");INSERT INTO fc_newsletter VALUES("32","Listing Email Host ","<table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img src=\"{base_url()}images/logo/{$logo}\" alt=\"logo\" width=\"200\" />&nbsp;&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi {$hostname}</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">&nbsp;You have created a new listing with your Renters account on {$propertydate} at {$propertytime}.</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\">&nbsp;List name : {$propertyname}</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\">Link : <a href=\"{base_url()}rental/{$propertyid}\"> {base_url()}rental/{$propertyid}</a></td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\">Price :USD {$propertyprice}</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\">If this was you, you can ignore this email.</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\">If this wasn\'t you, let us know. Notifying us is important because it helps us make sure no one &nbsp; is accessing your account without your knowledge.</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>&nbsp;Thanks!</p>
<p>&nbsp;The Renters Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>","Active","2016-05-31 11:00:07","","Host listed new property ","Renters","muthukrishnan@teamtweaks.com","","1");INSERT INTO fc_newsletter VALUES("35","Registration Confirmation","<div style=\"display: inline-block; background: none repeat scroll 0px 0px #f7f7f7; border: medium none; box-shadow: 0px 0px 2px 0px #cccccc; color: #565a5c; line-height: 21px; width: 560px; padding: 20px 50px;\">
<div style=\"display: inline-block; text-align: center; width: 100%;\"><img style=\"width: 149px;\" src=\"{base_url()}images/logo/{$logo}\" alt=\"\" /></div>
<div style=\"display: inline-block; font-size: 13px; width: 100%; margin: 0; padding: 0; font-family: Helvetica,Arial,sans-serif;\"><span>Hi</span><label style=\"padding: 0 0 0 2px;\">{$username},</label>
<div style=\"display: inline-block; width: 100%; margin: 0px; font-family: Helvetica,Arial,sans-serif; font-size: 14px; padding: 9px 0px 6px;\">Welcome to Renters! In order to get started, you need to confirm your email address.</div>
<div class=\"p \" style=\"margin: 0; padding: 0;\">
<div class=\"btn btn-primary space1\" style=\"margin: 0;\"><a href=\"{$cfmurl}\"> Confirm Email</a>&nbsp; &nbsp;&nbsp;</div>
</div>
<div class=\"p \" style=\"padding: 0px; font-family: Helvetica,Arial,sans-serif; font-size: 14px; margin: 1em 0px 3em;\">Thanks, &nbsp;&nbsp;<br style=\"margin: 0; padding: 0;\" />The {$email_title} Team</div>
</div>
</div>","Active","2014-12-31 00:00:00","","Registration Confirmation","Renters","muthukrishnan@teamtweaks.com","","1");INSERT INTO fc_newsletter VALUES("18","Verification Confirmation","<div style=\"display: inline-block; background: none repeat scroll 0px 0px #f7f7f7; border: medium none; box-shadow: 0px 0px 2px 0px #cccccc; color: #565a5c; line-height: 21px; width: 560px; padding: 20px 50px;\">
<div style=\"display: inline-block; text-align: center; width: 100%;\"><img style=\"width: 149px;\" src=\"{base_url()}images/logo/{$logo}\" alt=\"\" />&nbsp;&nbsp;</div>
<div style=\"display: inline-block; font-size: 13px; width: 100%; margin: 0; padding: 0; font-family: Helvetica,Arial,sans-serif;\"><span>Hi</span><label style=\"padding: 0 0 0 2px;\">{$username},</label>
<div style=\"display: inline-block; width: 100%; margin: 0px; font-family: Helvetica,Arial,sans-serif; font-size: 14px; padding: 9px 0px 6px;\">Thanks for choosing to verify your ID. Our Renters team will contact you soon.</div>
<div class=\"p \" style=\"padding: 0px; font-family: Helvetica,Arial,sans-serif; font-size: 14px; margin: 1em 0px 3em;\">Thanks,<br style=\"margin: 0; padding: 0;\" />The {$email_title} Team</div>
</div>
</div>","Active","2014-12-18 00:00:00","","Verification Confirmation","Renters","muthukrishnan@teamtweaks.com","","1");INSERT INTO fc_newsletter VALUES("44","Review Listed","<table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#ffffff\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #ffffff;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#ffffff\">&nbsp; &nbsp; &nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#ffffff\"><img src=\"{base_url()}images/logo/{$logo}\" alt=\"logo\" width=\"200\" /></td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#ffffff\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #414042;\" align=\"center\" valign=\"middle\"><span style=\"color: #fcdf3f;\">Hi {$host_name}</span></td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">
<p><span style=\"font-size: x-large;\"><strong> User {$user_name} has posted a review about your listing {$product_name} </strong></span></p>
<p><span style=\"font-size: medium;\"><strong>&nbsp;</strong></span></p>
</td>
</tr>
<tr>
<td>
<p>&nbsp;</p>
</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\"><a href=\"http://rc.nextio.co.kr/site/product/display_review\"> Click Here To View</a></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p><span style=\"color: #000000;\"><strong>The Space For Sure&nbsp;Team</strong></span></p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#ffffff\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#ffffff\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>","Active","2016-05-30 10:10:19","","Review Has Been Posteds","Renters","muthukrishnan@teamtweaks.com","","1");INSERT INTO fc_newsletter VALUES("30","Host Approve Reservation","<table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img src=\"{base_url()}images/logo/{$logo}\" alt=\"logo\" width=\"200px\" />&nbsp; &nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi {$hostname},</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<th style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">You have accepted {$travelername} reservation request for {$propertyname}. </th>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renters Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>","Active","2014-12-30 00:00:00","","Host Approve Reservation","Renters","muthukrishnan@teamtweaks.com","","1");INSERT INTO fc_newsletter VALUES("20","Reservation request copy to travellers","<table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp; &nbsp; &nbsp;&nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img src=\"{base_url()}images/logo/{$logo}\" alt=\"logo\" width=\"200\" /></td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi {$travellername}</td>
</tr>
<tr>
<td height=\"40\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 10px; font-weight: bold; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\" valign=\"top\">Your reservation request for {$productname} has been submitted.</td>
</tr>
<tr>
<td height=\"40\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">Your potential host has 24 hours to respond to your request, but most of our hosts reply more quickly than that! Once {$hostname} accepts or declines your reservation, we\'ll let you know.</td>
</tr>
<tr>
<td style=\"color: #000; padding: 10px 20px 10px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">We have authorized your payment method for <span>KRW</span> {$totalprice}, the full amount of the reservation. If your request is declined or expires, you will not be charged.</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td align=\"center\" valign=\"middle\">
<div style=\"background-color: #f3402e; display: table; border-radius: 5px; color: #ffffff; font-family: Open Sans, Arial, sans-serif; font-size: 13px; text-transform: uppercase; font-weight: bold; padding: 7px 12px; text-align: center; text-decoration: none; width: 140px; margin: auto;\"><a style=\"color: #ffffff; text-decoration: none;\" href=\"{base_url()}rental/{$prd_id}\"><img src=\"{base_url()}server/php/rental/{$prd_image}\" alt=\"\" width=\"300\" /> ({$productname})</a></div>
</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<p style=\"margin: 0px; padding: 8px 10px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; background: #f1f1f1;\">Reservation Request</p>
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\" bgcolor=\"#EAEAEA\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th width=\"75\">Time</th> <th width=\"75\">Date</th>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Arrive</td>
<td bgcolor=\"#FFFFFF\">{$checkindate}</td>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Depart</td>
<td bgcolor=\"#FFFFFF\">{$checkoutdate}</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td height=\"0\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renters Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>","Active","2014-12-24 00:00:00","","Reservation Request","Renters","muthukrishnan@teamtweaks.com","","1");INSERT INTO fc_newsletter VALUES("21","After Host List Property","<table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img src=\"{base_url()}images/logo/{$logo}\" alt=\"logo\" /></td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi {$host_name}</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">You have created a new listing with your Renters account on {$cdate} at {$ctime}. &nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\">List name : {$propertyname}</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\">Link :<a href=\"{base_url()}rental/{$propertyid}\"> {base_url()}rental/{$propertyid}</a></td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\">Price : <span>USD</span> {$price}</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\">If this was you, you can ignore this email.</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\">If this wasn\'t you, let us know. Notifying us is important because it helps us make sure no one is accessing your account without your knowledge.</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renters Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>","Active","2016-05-31 10:59:54","","After Host List Property","Renters","muthukrishnan@teamtweaks.com","","1");INSERT INTO fc_newsletter VALUES("26","Listing Payment Success  By Host","<table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img src=\"{base_url()}images/logo/{$logo}\" alt=\"logo\" />&nbsp; &nbsp; &nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi {$travelername},</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<th style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\"> You have Paid the {$prdname}  for <span>KRW</span> {$amount}. </th>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renter Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>","Active","2014-12-26 00:00:00","","Listing Payment Success  By Host","Renters","muthukrishnan@teamtweaks.com","","1");INSERT INTO fc_newsletter VALUES("22","After Admin List Property","<table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"border: 0px solid #f5fafb; width: 600px; background-color: #ecfafd;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img src=\"{base_url()}images/logo/{$logo}\" alt=\"logo\" /></td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" align=\"center\" valign=\"middle\">HI ADMIN</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\">You have created a new listing with your Renters account on {$cdate} at {$ctime}.</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td align=\"left\">List name : {$propertyname}</td>
</tr>
<tr>
<td align=\"left\">Link : <a href=\"{base_url()}rental/{$propertyid}\">{base_url()}rental/{$propertyid}</a></td>
</tr>
<tr>
<td align=\"left\">Price : USD {$price}</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td align=\"left\">If this was you, you can ignore this email. &nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td align=\"left\">If this wasn\'t you, let us know. Notifying us is important because it helps us make sure no one is accessing your account without your knowledge.</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renters Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;<br /><br /></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>","Active","2016-05-31 10:59:22","","After Admin List Property","Renter","muthukrishnan@teamtweaks.com","","1");INSERT INTO fc_newsletter VALUES("23","Host Approve Reservation","<table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp; &nbsp;&nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img src=\"{base_url()}images/logo/{$logo}\" alt=\"logo\" width=\"200\" /></td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi {$travelername},</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<th style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">Host Accepted your reservation request for {$propertyname}.Please make your payment at <a href=\"{base_url()}trips/upcoming\">&nbsp;your trip dashboard</a> in Renter website. Enjoy your holiday.</th>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renter Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>","Active","2014-12-24 00:00:00","","Your reservation has been approved","Renters","muthukrishnan@teamtweaks.com","","1");INSERT INTO fc_newsletter VALUES("24","Host Decline Reservation","<table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img src=\"{base_url()}images/logo/{$logo}\" alt=\"logo\" width=\"200\" /></td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi {$travelername},</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<th style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\"><span>The {$propertyname} h</span>ost have declined your reservation. Kindly find alternative accomodation at <a href=\"{base_url()}\">{base_url()}</a>. We look forward for your next booking.&nbsp;</th>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renter  Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>","Active","2014-12-24 00:00:00","","Reservation request rejected","Renters","muthukrishnan@teamtweaks.com","","1");INSERT INTO fc_newsletter VALUES("25","guide decline by user","<table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img src=\"{base_url()}images/logo/{$logo}\" alt=\"logo\" />&nbsp; &nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi {$travelername},</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<th style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\"> Sorry, Your reservation request is denied by {$hostname} for {$propertyname}. </th>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\">Soon, We will contact you with the appropriate payment.</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renter Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>","Active","2014-12-24 00:00:00","","guide decline by user","Renters","muthukrishnan@teamtweaks.com","","1");INSERT INTO fc_newsletter VALUES("27","Listing Payment Success  By Admin","<table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img src=\"{base_url()}images/logo/{$logo}\" alt=\"logo\" />&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp; &nbsp; &nbsp;&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi Admin,</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<th style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\"> {$hostname} have Paid the {$prdname}  for <span>KRW</span> {$amount}. </th>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renter Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>","Active","2014-12-26 00:00:00","","Listing Payment Success  By Admin","Renters","muthukrishnan@teamtweaks.com","","1");INSERT INTO fc_newsletter VALUES("28","Contact Us - Reply","<table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img src=\"{base_url()}images/logo/{$logo}\" alt=\"logo\" /></td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td><span>&nbsp; &nbsp; &nbsp; Hi</span><label>{$username}</label></td>
</tr>
<tr>
<th style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\"> {$body_message} </th>
</tr>
<tr>
<td>&nbsp; &nbsp; &nbsp;&nbsp;</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renters Team &nbsp;</p>
</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>","Active","2014-12-26 00:00:00","","Contact Us - Replys","Renters","muthukrishnan@teamtweaks.com","","1");INSERT INTO fc_newsletter VALUES("31","Listing Email Admin","<table class=\"ui-sortable-handle currentTable\" border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tbody>
<tr>
<td bgcolor=\"#4f595b\" height=\"30\">&nbsp; &nbsp;&nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img src=\"{base_url()}images/logo/{$logo}\" alt=\"logo\" width=\"200\" /></td>
</tr>
<tr>
<td bgcolor=\"#4f595b\" height=\"30\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi Admin,</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<th style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">{$travelername} have created the new list.</th>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\">Host name : {$travelername}</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\">List name : {$propertyname}</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\">Link : <a href=\"{base_url()}rental/{$propertyid}\">{base_url()}rental/{$propertyid}</a></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\">Price : USD&nbsp;{$propertyprice}</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renters Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td bgcolor=\"#4f595b\" height=\"30\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td bgcolor=\"#4f595b\" height=\"50\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>","Active","2016-08-30 12:53:54","","Listing Email Admin","Renters","muthukrishnan@teamtweaks.com","","1");INSERT INTO fc_newsletter VALUES("34","Notification Mail Host","<table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img style=\"margin: 15px 5px 0; padding: 0px; border: none;\" src=\"{base_url()}images/logo/{$logo}\" alt=\"{$meta_title}\" width=\"200\" /></td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" style=\"color: #ffffff; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi {$renter_fname} {$renter_lname}</td>
</tr>
<tr>
<td height=\"50\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">We\'re excited to tell you that, your {$rental_name} is booked now. To help make check-in seamless, we suggest you continue the conversation with your guest {$first_name} {$last_name}</td>
</tr>
<tr>
<td style=\"color: #000; padding: 10px 20px 10px 20px; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\">through Renter\'s message system to confirm your guest arrival time, ask any questions you may have, and help them figure out how to best get to your listing.</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style=\"color: #000; padding: 0px 10px; font-weight: bold; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"center\" valign=\"top\">Itinerary</td>
</tr>
<tr>
<td align=\"center\" valign=\"middle\">
<div style=\"background-color: #f3402e; display: table; border-radius: 5px; color: #ffffff; font-family: Open Sans, Arial, sans-serif; font-size: 13px; text-transform: uppercase; font-weight: bold; padding: 7px 12px; text-align: center; text-decoration: none; width: 140px; margin: auto;\"><a style=\"color: #ffffff; text-decoration: none;\" href=\"{base_url()}rental/{$prd_id}\"><img src=\"{$rental_image}\" alt=\"\" width=\"300\" /> {$rental_name}</a></div>
</td>
</tr>
<tr>
<td align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
<tbody>
<tr style=\"padding: 10px; float: left;\">
<td align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"600\" bgcolor=\"#EAEAEA\">
<tbody style=\"font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\">
<tr>
<th width=\"75\">Time</th> <th width=\"75\">Date</th>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Arrive</td>
<td bgcolor=\"#FFFFFF\">{$checkin}</td>
</tr>
<tr align=\"center\">
<td bgcolor=\"#FFFFFF\">Depart</td>
<td bgcolor=\"#FFFFFF\">{$checkout}</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"color: #4f595b; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 20px; padding: 0px 20px;\" width=\"300px\" align=\"left\" valign=\"top\">{$service}           
<table style=\"width: 100%; font-size: 13px;\">
<tbody>
<tr>
<td style=\"border-bottom: 1px solid #bbb;\">for{$noofnights} Night</td>
<td style=\"border-bottom: 1px solid #bbb;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 5px 0px;\"><span>KRW</span> {$amount}</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Service Fee</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> {$serviceFee}</td>
</tr>
<tr>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">Total</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\">&nbsp;</td>
<td style=\"border-bottom: 1px solid #bbb; padding: 10px 0px;\"><span>KRW</span> {$netamount}</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td style=\"padding: 0px 20px; color: #444444; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 13px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renter Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>","Active","2014-12-30 00:00:00","","Reservation Confirmation","Green House","tomcabout@gmail.com","","1");INSERT INTO fc_newsletter VALUES("47","Host payment conformation","<table class=\"ui-sortable-handle currentTable\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"border: 0px solid #f5fafb; width: 600px; background-color: #ecfafd;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tbody>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"left\" bgcolor=\"#4f595b\"><img src=\"{base_url()}images/logo/{$logo}\" alt=\"logo\" /></td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td class=\"editable\" align=\"center\" valign=\"middle\">HI ADMIN</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\">An host has paid the amount for the property<br /></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td align=\"left\"></td>
</tr>
<tr>
<td align=\"left\"></td>
</tr>
<tr>
<td align=\"left\"></td>
</tr>
<tr>
<td></td>
</tr>
<tr>
<td></td>
</tr>
<tr>
<td align=\"left\"></td>
</tr>
<tr>
<td></td>
</tr>
<tr>
<td align=\"left\"></td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renters Team</p>
</td>
</tr>
<tr>
<td height=\"30\">&nbsp;</td>
</tr>
<tr>
<td height=\"30\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr>
<td height=\"50\" bgcolor=\"#4f595b\">&nbsp;<br /><br /></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>","Active","2016-06-07 12:17:10","","Host payment conformation","Renters","muthukrishnan@teamtweaks.com","","1");INSERT INTO fc_newsletter VALUES("48","Booking Declined by other booking","<table class=\"ui-sortable-handle currentTable\" border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" bgcolor=\"#4f595b\">
<tbody>
<tr>
<td>
<table class=\"devicewidth\" style=\"background-color: #f8f8f8;\" border=\"0\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tbody>
<tr style=\"height: 30px;\">
<td style=\"height: 30px;\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr style=\"height: 54px;\">
<td style=\"height: 54px;\" align=\"left\" bgcolor=\"#4f595b\"><img src=\"{base_url()}images/logo/{$logo}\" alt=\"logo\" />&nbsp; &nbsp;</td>
</tr>
<tr style=\"height: 30px;\">
<td style=\"height: 30px;\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr style=\"height: 37px;\">
<td class=\"editable\" style=\"color: #ffffff; font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; text-transform: uppercase; padding: 8px 20px; height: 37px; background-color: #4bbeff;\" align=\"center\" valign=\"middle\">Hi {$username},</td>
</tr>
<tr style=\"height: 30px;\">
<td style=\"height: 30px;\">&nbsp;</td>
</tr>
<tr style=\"height: 30px;\">
<th style=\"color: #000000; padding: 0px 20px; font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 13px; height: 30px;\" align=\"center\">Sorry, Your reservation request {$Bookingno} for {$product_title} was denied by confirming the other booking on the same date.</th>
</tr>
<tr style=\"height: 47px;\">
<td style=\"height: 47px;\">&nbsp;</td>
</tr>
<tr style=\"height: 15px;\">
<td style=\"color: #000000; padding: 0px 20px; font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 13px; height: 15px;\" align=\"center\">Kinldy go with another dates on the same property.</td>
</tr>
<tr style=\"height: 30px;\">
<td style=\"height: 30px;\">&nbsp;</td>
</tr>
<tr style=\"height: 105px;\">
<td style=\"padding: 0px 20px; color: #444444; font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 13px; height: 105px;\" align=\"left\" valign=\"middle\">
<p>Thanks!</p>
<p>The Renter Team</p>
</td>
</tr>
<tr style=\"height: 30px;\">
<td style=\"height: 30px;\">&nbsp;</td>
</tr>
<tr style=\"height: 30px;\">
<td style=\"height: 30px;\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr style=\"height: 47px;\">
<td style=\"height: 47px;\" align=\"center\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
<tr style=\"height: 50px;\">
<td style=\"height: 50px;\" bgcolor=\"#4f595b\">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>","Active","2016-08-31 06:35:39","","Booking Declined","","","","1");CREATE TABLE `fc_notes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `notes` mediumtext CHARACTER SET utf8 NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;INSERT INTO fc_notes VALUES("1","6","14","","2016-09-01 10:58:40");INSERT INTO fc_notes VALUES("2","3","1","sdsdfa","2016-09-01 18:03:20");INSERT INTO fc_notes VALUES("3","3","17","","2016-09-01 18:03:41");INSERT INTO fc_notes VALUES("4","3","14","","2016-09-01 18:06:46");CREATE TABLE `fc_notifications` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `activity` mediumtext COLLATE utf8_bin NOT NULL,
  `activity_id` bigint(20) NOT NULL,
  `activity_ip` mediumtext COLLATE utf8_bin NOT NULL,
  `comment_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;CREATE TABLE `fc_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(100) NOT NULL,
  `sell_id` bigint(20) NOT NULL,
  `product_id` int(100) NOT NULL,
  `price` varchar(500) NOT NULL,
  `quantity` varchar(500) NOT NULL,
  `is_coupon_used` enum('No','Yes') NOT NULL,
  `session_id` varchar(200) NOT NULL,
  `coupon_id` varchar(200) NOT NULL,
  `discountAmount` varchar(500) NOT NULL,
  `couponCode` varchar(255) NOT NULL,
  `coupontype` varchar(500) NOT NULL,
  `shippingid` int(16) NOT NULL,
  `indtotal` varchar(500) NOT NULL,
  `sumtotal` decimal(10,2) NOT NULL,
  `total` varchar(100) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `shippingcost` varchar(500) NOT NULL,
  `shippingcountry` varchar(500) NOT NULL,
  `shippingcity` varchar(500) NOT NULL,
  `shippingstate` varchar(500) NOT NULL,
  `paidVoucherStatus` enum('Not Verified','Verified') NOT NULL,
  `paypal_transaction_id` varchar(500) NOT NULL,
  `dealCodeNumber` varchar(500) NOT NULL,
  `inserttime` varchar(65) NOT NULL,
  `status` enum('Pending','Paid') NOT NULL,
  `shipping_date` date NOT NULL,
  `tracking_id` varchar(100) NOT NULL,
  `shipping_status` varchar(100) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `attribute_values` int(11) NOT NULL,
  `product_shipping_cost` decimal(10,2) NOT NULL,
  `product_tax_cost` decimal(10,2) NOT NULL,
  `note` blob NOT NULL,
  `order_gift` enum('0','1') NOT NULL DEFAULT '0',
  `payer_email` varchar(500) NOT NULL,
  `received_status` enum('Not received yet','Product received','Need refund') NOT NULL,
  `review_status` enum('Not open','Opened','Closed') NOT NULL,
  `EnquiryId` int(100) NOT NULL,
  `shippingname` varchar(120) NOT NULL,
  `shippingemail` varchar(120) NOT NULL,
  `shippingmobileno` varchar(120) NOT NULL,
  `shippingaddress` varchar(120) NOT NULL,
  `coupon_code` varchar(150) NOT NULL,
  `discount` int(11) NOT NULL,
  `total_amt` int(11) NOT NULL,
  `discount_type` int(11) NOT NULL,
  `dval` int(11) NOT NULL,
  `errmsg` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;INSERT INTO fc_payment VALUES("1","2016-08-30 17:29:15","2016-08-30 17:29:15","3","1","1","102.00","","No","","","","","","0","50.00","102.00","102.00","0.00","","","","","Not Verified","60007252568","1231213291","1472558355","Paid","0000-00-00","","Processed","Authrozie Credit Payment","0","0.00","0.00","","0","","Not received yet","Not open","2","","","","","","0","0","0","0","");INSERT INTO fc_payment VALUES("2","2016-08-30 17:39:15","2016-08-30 17:40:16","3","1","1","32.00","","No","","","","","","0","50.00","32.00","32.00","2.00","","","","","Not Verified","4FD49540B23609404","1150961753","1472558955","Paid","0000-00-00","","Processed","Paypal","0","0.00","0.00","","0","mathuajithkumar@casperon.in","Not received yet","Not open","3","","","","","","0","0","0","0","");INSERT INTO fc_payment VALUES("7","2016-08-30 18:19:11","2016-08-30 18:19:12","2","1","1","39.90","","Yes","","","","","","0","50.00","39.90","39.90","0.00","","","","","Not Verified","60007253572","1762700722","1472561351","Paid","0000-00-00","","Processed","Authrozie Credit Payment","0","0.00","0.00","","0","","Not received yet","Not open","1","","","","","TEST5","40","42","1","2","");INSERT INTO fc_payment VALUES("8","2016-08-31 12:15:56","2016-08-31 12:16:34","2","1","1","32.00","","No","","","","","","0","50.00","32.00","32.00","0.00","","","","","Not Verified","60007274991","2060779704","1472625956","Paid","0000-00-00","","Processed","Authrozie Credit Payment","0","0.00","0.00","","0","","Not received yet","Not open","5","","","","","","0","0","0","0","");INSERT INTO fc_payment VALUES("9","2016-08-31 19:17:24","2016-08-31 19:17:25","2","1","1","52.00","","No","","","","","","0","50.00","52.00","52.00","0.00","","","","","Not Verified","60007292140","1355105664","1472651244","Paid","0000-00-00","","Processed","Authrozie Credit Payment","0","0.00","0.00","","0","","Not received yet","Not open","8","","","","","","0","0","0","0","");INSERT INTO fc_payment VALUES("10","2016-09-01 12:13:58","2016-09-01 12:14:50","3","1","1","402.00","","No","","","","","","0","50.00","402.00","402.00","2.00","","","","","Not Verified","69781439A09537820","1974809415","1472712238","Paid","0000-00-00","","Processed","Paypal","0","0.00","0.00","","0","mathuajithkumar@gmail.com","Not received yet","Not open","9","","","","","","0","0","0","0","");CREATE TABLE `fc_payment_gateway` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gateway_name` varchar(200) NOT NULL,
  `settings` text NOT NULL,
  `status` enum('Enable','Disable') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;INSERT INTO fc_payment_gateway VALUES("1","Paypal IPN","a:2:{s:4:\"mode\";s:7:\"sandbox\";s:14:\"merchant_email\";s:35:\"vinubusiness1-facilitator@gmail.com\";}","Enable");INSERT INTO fc_payment_gateway VALUES("3","Stripe","a:3:{s:4:\"mode\";s:7:\"sandbox\";s:10:\"secret_key\";s:32:\"sk_test_MQSQGKl7uUImfiIjfcA5mtS2\";s:15:\"publishable_key\";s:32:\"pk_test_D0EGvAFR9stcHL57p1AXt2tc\";}","Enable");INSERT INTO fc_payment_gateway VALUES("4","Credit Card","a:3:{s:4:\"mode\";s:7:\"sandbox\";s:12:\"merchantcode\";s:9:\"3um6xA6Y4\";s:11:\"merchantkey\";s:16:\"3LTjyhC22T3g346P\";}","Enable");CREATE TABLE `fc_payment_host` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `bookingId` varchar(100) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `host_id` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `txn_id` varchar(200) NOT NULL,
  `txt_date` varchar(150) NOT NULL,
  `txn_type` varchar(255) NOT NULL,
  `payment_status` enum('paid','pending') NOT NULL,
  `payment_type` varchar(50) CHARACTER SET utf8 NOT NULL,
  `paypal_txn_id` varchar(50) CHARACTER SET utf8 NOT NULL,
  `paypal_email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;INSERT INTO fc_payment_host VALUES("1","","1","1","5","txn_18o7IyGiApLBrHhJXPq5j0Uo","30-08-2016","Stripe","paid","CreditCard","","","2016-08-30 13:41:40");INSERT INTO fc_payment_host VALUES("4","","2","1","5","60007252637","30-08-2016","Stripe","paid","CreditCard","","","2016-08-30 17:32:50");INSERT INTO fc_payment_host VALUES("5","","3","5","5","60007545716","07-09-2016","Stripe","paid","CreditCard","","","2016-09-07 16:08:47");CREATE TABLE `fc_prefooter` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `footer_title` varchar(500) CHARACTER SET utf8 NOT NULL,
  `short_desc_count` int(10) NOT NULL,
  `short_description` text CHARACTER SET utf8 NOT NULL,
  `footer_link` varchar(500) CHARACTER SET utf8 NOT NULL,
  `image` varchar(250) CHARACTER SET utf8 NOT NULL,
  `status` enum('Active','Inactive') CHARACTER SET utf8 NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lang` varchar(255) CHARACTER SET utf8 NOT NULL,
  `toId` int(12) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;INSERT INTO fc_prefooter VALUES("2","WHY LIST YOUR BUSINESS WITH US?","3","Free Advertising and exposure//It\'s Super easy!//Get more clients!","http://192.168.1.251:8081/renters/renters2.1/","pr31.png","Active","2016-08-04 12:06:26","en","2");INSERT INTO fc_prefooter VALUES("3","LIST YOUR SPACE","3","Write a brief Description//Take Photos//Start Makin Money!","http://192.168.1.251:8081/renters/renters2.1/","pr211.png","Active","2016-08-04 12:06:18","en","3");INSERT INTO fc_prefooter VALUES("4","GUEST 확인","3"," 상쾌한 에 대한 더 많은 친구를 얻을//더 많은 휴식 과 멋진 즐길 수//당신의 돈 에 대한 가치","http://192.168.1.251:8081/renters/renters2.1/","pr1111.png","Active","2016-08-04 12:02:59","kr","1");INSERT INTO fc_prefooter VALUES("6","당신의 공간 을 나열","3","간단한 설명 을 쓰기//사진을 찍다// 가는데 돈 을 시작합니다 !","http://192.168.1.251:8081/renters/renters2.1/","pr2111.png","Active","2016-08-04 12:12:05","kr","3");CREATE TABLE `fc_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seller_product_id` bigint(20) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_title` varchar(1000) NOT NULL,
  `seourl` varchar(500) NOT NULL,
  `meta_title` longblob NOT NULL,
  `meta_keyword` longblob NOT NULL,
  `meta_description` longblob NOT NULL,
  `excerpt` varchar(500) NOT NULL,
  `category_id` varchar(500) NOT NULL,
  `price` decimal(20,2) NOT NULL,
  `std_price` decimal(10,0) NOT NULL,
  `price_range` varchar(100) NOT NULL,
  `sale_price` decimal(20,2) NOT NULL,
  `image` longtext NOT NULL,
  `description` longblob NOT NULL,
  `weight` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `max_quantity` int(11) NOT NULL DEFAULT '1',
  `purchasedCount` int(11) NOT NULL,
  `shipping_type` enum('Shippable','Not Shippable') NOT NULL,
  `shipping_cost` decimal(6,2) NOT NULL,
  `taxable_type` enum('Taxable','Not Taxable') NOT NULL,
  `tax_cost` decimal(6,2) NOT NULL,
  `sku` varchar(100) NOT NULL,
  `option` longtext NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `likes` bigint(20) NOT NULL DEFAULT '0',
  `list_name` longtext NOT NULL,
  `sub_list` longtext NOT NULL,
  `list_value` longtext NOT NULL,
  `comment_count` bigint(20) NOT NULL,
  `ship_immediate` enum('false','true') NOT NULL,
  `status` enum('Publish','UnPublish') NOT NULL,
  `order` int(100) NOT NULL,
  `contact_count` int(100) NOT NULL,
  `currency` varchar(10) NOT NULL DEFAULT 'USD',
  `home_type` varchar(1000) NOT NULL,
  `other` varchar(250) NOT NULL,
  `room_type` varchar(1000) DEFAULT NULL,
  `accommodates` varchar(100) NOT NULL DEFAULT '1',
  `bedrooms` varchar(1000) NOT NULL,
  `beds` varchar(1000) NOT NULL,
  `bed_type` varchar(1000) NOT NULL,
  `bathrooms` varchar(1000) NOT NULL,
  `noofbathrooms` varchar(11) NOT NULL,
  `city` varchar(1000) NOT NULL,
  `listings` varchar(250) NOT NULL,
  `price_perweek` decimal(20,2) NOT NULL,
  `price_permonth` decimal(20,2) NOT NULL,
  `desc_title` varchar(50) NOT NULL,
  `space` varchar(250) NOT NULL,
  `guest_access` varchar(250) NOT NULL,
  `interact_guest` varchar(250) NOT NULL,
  `neighbor_overview` varchar(250) NOT NULL,
  `neighbor_around` varchar(250) NOT NULL,
  `other_thingnote` varchar(250) NOT NULL,
  `house_rules` longblob NOT NULL,
  `featured` enum('Featured','UnFeatured') NOT NULL DEFAULT 'UnFeatured',
  `member_pakage` int(11) NOT NULL,
  `package_status` varchar(50) NOT NULL,
  `datefrom` date NOT NULL,
  `dateto` date NOT NULL,
  `neighborhood` varchar(1000) NOT NULL,
  `mobile_verification_code` varchar(500) NOT NULL,
  `is_verified` varchar(500) NOT NULL,
  `calendar_checked` enum('','always','sometimes','onetime') NOT NULL,
  `minimum_stay` int(100) NOT NULL,
  `security_deposit` varchar(100) NOT NULL,
  `extra_people` int(20) NOT NULL,
  `cancellation_policy` varchar(200) NOT NULL,
  `minimum_price` varchar(200) NOT NULL,
  `maximum_price` varchar(200) NOT NULL,
  `through` varchar(500) NOT NULL,
  `video_url` varchar(250) NOT NULL,
  `user_status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `host_property_status` enum('yes','no') NOT NULL DEFAULT 'yes',
  `featured_on` datetime NOT NULL,
  `instantbook` enum('yes','no') NOT NULL DEFAULT 'no',
  `payment` enum('Pending','Paid') NOT NULL DEFAULT 'Pending',
  `payment1` enum('Pending','Paid') NOT NULL DEFAULT 'Pending',
  `convertedPrice` decimal(10,2) NOT NULL,
  `convertedMprice` decimal(10,2) NOT NULL,
  `ConvertedWprice` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `seller_product_id` (`seller_product_id`),
  KEY `user_id` (`user_id`),
  KEY `seller_product_id_2` (`seller_product_id`),
  KEY `user_id_2` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;INSERT INTO fc_product VALUES("1","0","2016-08-30 11:09:59","0000-00-00 00:00:00","","Sample Listing","sample-listing","","","","","","50.00","50","","0.00","","Sample Listing Sample Listing Sample Listing Sample Listing Sample Listing Sample Listing Sample Listing Sample Listing Sample Listing Sample Listing Sample Listing Sample Listing Sample Listing Sample Listing Sample Listing Sample Listing Sample Listing Sample Listing Sample Listing Sample Listing Sample Listing Sample Listing Sample Listing Sample Listing Sample Listing Sample Listing Sample Listing Sample Listing Sample Listing Sample Listing Sample Listing Sample Listing Sample Listing Sample Listing Sample Listing Sample Listing Sample Listing ","","0","1","0","Shippable","0.00","Taxable","0.00","","","1","0",",1,41,50,52,61,63,65,66","","","0","false","Publish","0","0","INR","Bed & Breakfast","","Shared Both room","2","","","","","","","{\"Bedrooms\":\"\",\"Beds\":\"\",\"Bathrooms\":\"Private\",\"minimum_stay\":\"1\",\"accommodates\":\"2\"}","0.00","0.00","","","","","","","","","Featured","0","","0000-00-00","0000-00-00","","","","always","1","50","0","Flexible","","","","","Inactive","yes","2016-08-30 03:28:42","no","Paid","Pending","0.75","0.00","0.00");INSERT INTO fc_product VALUES("2","0","2016-08-30 12:14:07","2016-08-30 05:39:49","","Listing From Admin Panel","listing-from-admin-panel","Listing From Admin Panel","<p>Listing From Admin Panel</p>","<p>Listing From Admin Panel</p>","","","25.00","0","21-100","0.00","","<p>Listing From Admin Panel&nbsp;Listing From Admin Panel&nbsp;Listing From Admin Panel&nbsp;Listing From Admin Panel&nbsp;Listing From Admin Panel&nbsp;Listing From Admin Panel&nbsp;Listing From Admin Panel&nbsp;Listing From Admin Panel&nbsp;Listing From Admin Panel&nbsp;Listing From Admin Panel&nbsp;Listing From Admin Panel&nbsp;Listing From Admin Panel&nbsp;Listing From Admin Panel&nbsp;Listing From Admin Panel&nbsp;Listing From Admin Panel&nbsp;Listing From Admin Panel&nbsp;Listing From Admin Panel&nbsp;Listing From Admin Panel&nbsp;Listing From Admin Panel&nbsp;Listing From Admin Panel&nbsp;Listing From Admin Panel&nbsp;Listing From Admin Panel&nbsp;</p>","","0","1","0","Shippable","0.00","Taxable","0.00","","","1","0","3,44,64,67,70","","","0","false","UnPublish","0","0","USD","Apartment","","Private Room","1","","","","","","","{\"Bedrooms\":\"\",\"Beds\":\"\",\"Bathrooms\":\"Private\",\"minimum_stay\":\"1\",\"accommodates\":\"1\"}","75.00","100.00","","<p>St Marrys Road Mandaveli&nbsp;St Marrys Road Mandaveli&nbsp;St Marrys Road Mandaveli&nbsp;St Marrys Road Mandaveli&nbsp;St Marrys Road Mandaveli&nbsp;St Marrys Road Mandaveli&nbsp;St Marrys Road Mandaveli&nbsp;St Marrys Road Mandaveli&nbsp;St Marr","","","","","<p>St Marrys Road Mandaveli&nbsp;St Marrys Road Mandaveli&nbsp;St Marrys Road Mandaveli&nbsp;St Marrys Road Mandaveli&nbsp;St Marrys Road Mandaveli&nbsp;St Marrys Road Mandaveli&nbsp;St Marrys Road Mandaveli&nbsp;St Marrys Road Mandaveli&nbsp;St Marr","<p>St Marrys Road Mandaveli&nbsp;St Marrys Road Mandaveli&nbsp;St Marrys Road Mandaveli&nbsp;St Marrys Road Mandaveli&nbsp;St Marrys Road Mandaveli&nbsp;St Marrys Road Mandaveli&nbsp;St Marrys Road Mandaveli&nbsp;St Marrys Road Mandaveli&nbsp;St Marrys Road Mandaveli&nbsp;St Marrys Road Mandaveli&nbsp;St Marrys Road Mandaveli&nbsp;St Marrys Road Mandaveli&nbsp;St Marrys Road Mandaveli&nbsp;St Marrys Road Mandaveli&nbsp;St Marrys Road Mandaveli&nbsp;St Marrys Road Mandaveli&nbsp;St Marrys Road Mandaveli&nbsp;</p>","Featured","0","","1970-01-01","1970-01-01","","","","always","1","50","0","Flexible","","","","","Inactive","yes","2016-08-30 03:28:43","no","Paid","Pending","0.00","0.00","0.00");INSERT INTO fc_product VALUES("3","0","2016-08-30 15:21:15","2016-08-30 05:54:10","","sasas","sasas","","","","","","50.00","0","21-100","0.00","","","","0","1","0","Shippable","0.00","Taxable","0.00","","","5","0",",53,56","","","0","false","Publish","0","0","USD","Bed & Breakfast","","Private Room","4","","","","","","","{\"Bedrooms\":\"\",\"Beds\":\"\",\"Bathrooms\":\"\",\"minimum_stay\":\"\",\"accommodates\":\"4\"}","50.00","0.00","","","","","","","","","UnFeatured","0","","1970-01-01","1970-01-01","","","","always","0","50","0","Flexible","","","","","Inactive","yes","0000-00-00 00:00:00","no","Paid","Pending","0.00","0.00","0.00");INSERT INTO fc_product VALUES("4","0","2016-08-30 15:21:24","0000-00-00 00:00:00","","","","","","","","","0.00","0","","0.00","","","","0","1","0","Shippable","0.00","Taxable","0.00","","","5","0","","","","0","false","UnPublish","0","0","USD","Villa","","Private Room","5","","","","","","","{\"Bedrooms\":\"\",\"Beds\":\"\",\"Bathrooms\":\"Private\",\"minimum_stay\":\"7\",\"accommodates\":\"5\"}","0.00","0.00","","","","","","","","","UnFeatured","0","","0000-00-00","0000-00-00","","","","","7","","0","","","","","","Inactive","yes","0000-00-00 00:00:00","no","Pending","Pending","0.00","0.00","0.00");INSERT INTO fc_product VALUES("11","0","2016-08-30 18:55:17","0000-00-00 00:00:00","","new luxury house","","","","","","","0.00","0","","0.00","","","","0","1","0","Shippable","0.00","Taxable","0.00","","","4","0","","","","0","false","Publish","0","0","USD","","","","","","","","","","","{\"Bedrooms\":\"\",\"Beds\":\"\",\"Bathrooms\":\"\",\"accommodates\":\"\"}","0.00","0.00","","","","","","","","","UnFeatured","0","","0000-00-00","0000-00-00","","","","","0","","0","","","","","","Inactive","yes","0000-00-00 00:00:00","no","Pending","Pending","0.00","0.00","0.00");INSERT INTO fc_product VALUES("12","0","2016-08-30 19:01:45","0000-00-00 00:00:00","","new property","","","","","","","400.00","0","","0.00","","","","0","1","0","Shippable","0.00","Taxable","0.00","","","4","0","","","","0","false","Publish","0","0","USD","House","","Private Room","2","","","","","","","{\"Bedrooms\":\"\",\"Beds\":\"\",\"Bathrooms\":\"Private\",\"minimum_stay\":\"2\",\"accommodates\":\"2\"}","22.00","22.00","","","","","","","","","UnFeatured","0","","0000-00-00","0000-00-00","","","","","2","","0","","","","","","Inactive","yes","0000-00-00 00:00:00","no","Pending","Pending","0.00","0.00","0.00");INSERT INTO fc_product VALUES("14","0","2016-08-31 15:11:49","0000-00-00 00:00:00","","testing one","","","","","","","200.00","200","","0.00","","","","0","1","0","Shippable","0.00","Taxable","0.00","","","3","0",",1,41","","","0","false","Publish","0","0","USD","House","","Common Room","2","","","","","","","{\"Bedrooms\":\"\",\"Beds\":\"\",\"Bathrooms\":\"Private\",\"minimum_stay\":\"2\",\"accommodates\":\"2\"}","0.00","0.00","","","","","","","","","UnFeatured","0","","0000-00-00","0000-00-00","","","","always","2","20","0","Flexible","","","","","Inactive","yes","0000-00-00 00:00:00","no","Pending","Pending","200.00","0.00","0.00");INSERT INTO fc_product VALUES("15","0","2016-08-31 17:43:56","0000-00-00 00:00:00","","asdsdafsdafdf","","","","","","","0.00","0","","0.00","","","","0","1","0","Shippable","0.00","Taxable","0.00","","","3","0","","","","0","false","Publish","0","0","USD","","","","1","","","","","","","{\"Bedrooms\":\"\",\"Beds\":\"\",\"Bathrooms\":\"Private\",\"sample\":\"\"}","0.00","0.00","","","","","","","","","UnFeatured","0","","0000-00-00","0000-00-00","","","","","0","","0","","","","","","Inactive","yes","0000-00-00 00:00:00","no","Pending","Pending","0.00","0.00","0.00");INSERT INTO fc_product VALUES("16","0","2016-08-31 17:46:26","0000-00-00 00:00:00","","asdsdafsdafdf","","","","","","","0.00","0","","0.00","","","","0","1","0","Shippable","0.00","Taxable","0.00","","","4","0","","","","0","false","Publish","0","0","USD","","","","","","","","","","","{\"Bedrooms\":\"\",\"Beds\":\"\",\"Bathrooms\":\"\",\"accommodates\":\"\"}","0.00","0.00","","","","","","","","","UnFeatured","0","","0000-00-00","0000-00-00","","","","","0","","0","","","","","","Inactive","yes","0000-00-00 00:00:00","no","Pending","Pending","0.00","0.00","0.00");INSERT INTO fc_product VALUES("17","0","2016-08-31 17:51:04","0000-00-00 00:00:00","","test product","test-product","","","","","","200.00","200","","0.00","","demo","","0","1","0","Shippable","0.00","Taxable","0.00","","","6","0",",45,49,50,51","","","0","false","Publish","0","0","INR","Cabin","","Common Room","5","","","","","","","{\"Bedrooms\":\"\",\"Beds\":\"\",\"Bathrooms\":\"\",\"minimum_stay\":\"\",\"accommodates\":\"5\"}","0.00","0.00","","","","","","","","","UnFeatured","0","","0000-00-00","0000-00-00","","","","always","0","40","0","Flexible","","","","","Inactive","yes","0000-00-00 00:00:00","no","Pending","Pending","0.00","0.00","0.00");INSERT INTO fc_product VALUES("18","0","2016-08-31 17:58:25","0000-00-00 00:00:00","","","","","","","","","200.00","200","","0.00","","","","0","1","0","Shippable","0.00","Taxable","0.00","","","6","0","","","","0","false","Publish","0","0","INR","Bed & Breakfast","","Common Room","6","","","","","","","{\"Bedrooms\":\"\",\"Beds\":\"\",\"Bathrooms\":\"\",\"minimum_stay\":\"\",\"accommodates\":\"6\"}","500.00","600.00","","","","","","","","","UnFeatured","0","","0000-00-00","0000-00-00","","","","","0","","0","","","","","","Inactive","yes","0000-00-00 00:00:00","no","Pending","Pending","2.97","8.90","7.42");INSERT INTO fc_product VALUES("19","0","2016-09-01 15:40:55","0000-00-00 00:00:00","","Stayhere","","","","","","","5000.00","0","","0.00","","","","0","1","0","Shippable","0.00","Taxable","0.00","","","4","0","","","","0","false","Publish","0","0","USD","","","","1","","","","","","","","3000.00","0.00","","","","","","","","","UnFeatured","0","","0000-00-00","0000-00-00","","","","","0","","0","","","","","","Inactive","yes","0000-00-00 00:00:00","no","Pending","Pending","0.00","0.00","0.00");INSERT INTO fc_product VALUES("20","0","2016-09-01 15:51:46","0000-00-00 00:00:00","","honey moon","","","","","","","0.00","0","","0.00","","","","0","1","0","Shippable","0.00","Taxable","0.00","","","4","0","","","","0","false","Publish","0","0","USD","","","","","","","","","","","{\"Bedrooms\":\"\",\"Beds\":\"\",\"Bathrooms\":\"\",\"minimum_stay\":\"\",\"accommodates\":\"\"}","0.00","0.00","","","","","","","","","UnFeatured","0","","0000-00-00","0000-00-00","","","","","0","","0","","","","","","Inactive","yes","0000-00-00 00:00:00","no","Pending","Pending","0.00","0.00","0.00");INSERT INTO fc_product VALUES("21","0","2016-09-06 15:49:32","0000-00-00 00:00:00","","AAAA","","","","","","","200.00","0","","0.00","","","","0","1","0","Shippable","0.00","Taxable","0.00","","","5","0","","","","0","false","Publish","0","0","USD","","","","1","","","","","","","","22.00","22.00","","","","","","","","","UnFeatured","0","","0000-00-00","0000-00-00","","","","","0","","0","","","","","","Inactive","yes","0000-00-00 00:00:00","no","Pending","Pending","0.00","0.00","0.00");INSERT INTO fc_product VALUES("22","0","2016-09-07 12:13:14","0000-00-00 00:00:00","","","","","","","","","0.00","0","","0.00","","","","0","1","0","Shippable","0.00","Taxable","0.00","","","5","0","","","","0","false","Publish","0","0","USD","Bed & Breakfast","","Common Room","5","","","","","","","{\"Bedrooms\":\"\",\"Beds\":\"\",\"Bathrooms\":\"\",\"minimum_stay\":\"\",\"accommodates\":\"5\",\"sample\":\"\"}","0.00","0.00","","","","","","","","","UnFeatured","0","","0000-00-00","0000-00-00","","","","","0","","0","","","","","","Inactive","yes","0000-00-00 00:00:00","no","Pending","Pending","0.00","0.00","0.00");INSERT INTO fc_product VALUES("23","0","2016-09-08 13:45:59","0000-00-00 00:00:00","","","","","","","","","0.00","0","","0.00","","","","0","1","0","Shippable","0.00","Taxable","0.00","","","5","0","","","","0","false","UnPublish","0","0","USD","Bed & Breakfast","","Private Room","4","","","","","","","{\"Bedrooms\":\"\",\"Beds\":\"\",\"Bathrooms\":\"Private\",\"minimum_stay\":\"2\",\"accommodates\":\"4\",\"New_value\":\"\"}","0.00","0.00","","","","","","","","","UnFeatured","0","","0000-00-00","0000-00-00","","","","","2","","0","","","","","","Inactive","yes","0000-00-00 00:00:00","no","Pending","Pending","0.00","0.00","0.00");INSERT INTO fc_product VALUES("24","0","2016-09-13 11:24:02","0000-00-00 00:00:00","","","","","","","","","0.00","0","","0.00","","","","0","1","0","Shippable","0.00","Taxable","0.00","","","6","0","","","","0","false","UnPublish","0","0","USD","Cabin","","Common Room","4","","","","","","","{\"Bedrooms\":\"\",\"Beds\":\"\",\"Bathrooms\":\"\",\"minimum_stay\":\"\",\"accommodates\":\"4\",\"New_value\":\"\"}","0.00","0.00","","","","","","","","","UnFeatured","0","","0000-00-00","0000-00-00","","","","","0","","0","","","","","","Inactive","yes","0000-00-00 00:00:00","no","Pending","Pending","0.00","0.00","0.00");INSERT INTO fc_product VALUES("25","0","2016-09-13 19:52:26","0000-00-00 00:00:00","","asdf","","","","","","","343.00","0","","0.00","","","","0","1","0","Shippable","0.00","Taxable","0.00","","","4","0","","","","0","false","Publish","0","0","USD","Bed & Breakfast","","Common Room","9","","","","","","","{\"Bedrooms\":\"\",\"Beds\":\"\",\"Bathrooms\":\"public\",\"minimum_stay\":\"3\",\"accommodates\":\"9\",\"New_value\":\"344\"}","343.00","34343.00","","","","","","","","","UnFeatured","0","","0000-00-00","0000-00-00","","","","","3","","0","","","","","","Inactive","yes","0000-00-00 00:00:00","no","Pending","Pending","0.00","0.00","0.00");INSERT INTO fc_product VALUES("26","0","2016-09-16 10:56:23","0000-00-00 00:00:00","","","","","","","","","0.00","0","","0.00","","","","0","1","0","Shippable","0.00","Taxable","0.00","","","7","0","","","","0","false","UnPublish","0","0","USD","Bed & Breakfast","","Private Room","3","","","","","","","{\"Bedrooms\":\"\",\"Beds\":\"\",\"Bathrooms\":\"\",\"minimum_stay\":\"\",\"accommodates\":\"3\",\"New_value\":\"\"}","0.00","0.00","","","","","","","","","UnFeatured","0","","0000-00-00","0000-00-00","","","","","0","","0","","","","","","Inactive","yes","0000-00-00 00:00:00","no","Pending","Pending","0.00","0.00","0.00");CREATE TABLE `fc_product_address` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(1000) NOT NULL,
  `country` varchar(1000) NOT NULL,
  `state` varchar(1000) NOT NULL,
  `city` varchar(1000) NOT NULL,
  `post_code` varchar(1000) NOT NULL,
  `property_name` varchar(1000) NOT NULL,
  `holding_no` varchar(1000) NOT NULL,
  `no_of_star` varchar(1000) NOT NULL,
  `address` text NOT NULL,
  `latitude` varchar(1000) NOT NULL,
  `longitude` varchar(1000) NOT NULL,
  `apt` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`(255)),
  KEY `product_id_2` (`product_id`(255))
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;INSERT INTO fc_product_address VALUES("1","88","India","Tamil Nadu","Chennai","600094","","","","Nungambakkam","13.0595365","80.2424792","Nungambakkam");INSERT INTO fc_product_address VALUES("2","130","","","","","","","","","","","");INSERT INTO fc_product_address VALUES("3","131","","","","","","","","","","","0");INSERT INTO fc_product_address VALUES("4","132","","","","","","","","","","","");INSERT INTO fc_product_address VALUES("5","133","","","","","","","","","","","");INSERT INTO fc_product_address VALUES("6","134","","","","","","","","","","","");INSERT INTO fc_product_address VALUES("7","135","","","","","","","","","","","");INSERT INTO fc_product_address VALUES("8","136","","","","","","","","","","","");INSERT INTO fc_product_address VALUES("9","137","","","","","","","","","","","");INSERT INTO fc_product_address VALUES("10","138","","","","","","","","","","","");INSERT INTO fc_product_address VALUES("11","139","","","","","","","","","","","");INSERT INTO fc_product_address VALUES("12","140","","","","","","","","","","","");INSERT INTO fc_product_address VALUES("13","177","","","","","","","","","","","");INSERT INTO fc_product_address VALUES("14","180","India","Tamil Nadu","Chennai","600006","","","","chennai","13.0826802","80.2707184","");INSERT INTO fc_product_address VALUES("15","182","","","","","","","","","","","");INSERT INTO fc_product_address VALUES("16","183","","","","","","","","","","","");INSERT INTO fc_product_address VALUES("17","191","","","","","","","","","","","");INSERT INTO fc_product_address VALUES("18","192","","","","","","","","","","","");INSERT INTO fc_product_address VALUES("19","2","India","Tamil Nadu","Chennai","600028","","","","St Marrys Road Mandaveli Chennai","13.0295717","80.2613908","St Marrys Road Mandaveli");INSERT INTO fc_product_address VALUES("26","11","","","","","","","","","","","");INSERT INTO fc_product_address VALUES("27","12","","","","","","","","","","","");INSERT INTO fc_product_address VALUES("29","14","","","","","","","","","","","");INSERT INTO fc_product_address VALUES("30","15","","","","","","","","","","","");INSERT INTO fc_product_address VALUES("31","16","","","","","","","","","","","");INSERT INTO fc_product_address VALUES("32","19","","","","","","","","","","","");INSERT INTO fc_product_address VALUES("33","20","","","","","","","","","","","");INSERT INTO fc_product_address VALUES("34","21","","","","","","","","","","","");INSERT INTO fc_product_address VALUES("35","25","","","","","","","","","","","");CREATE TABLE `fc_product_address_new` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productId` int(11) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `street` varchar(500) NOT NULL,
  `area` varchar(500) NOT NULL,
  `location` varchar(500) NOT NULL,
  `city` varchar(500) NOT NULL,
  `state` varchar(500) NOT NULL,
  `country` varchar(500) NOT NULL,
  `lang` float(20,17) NOT NULL,
  `lat` float(20,17) NOT NULL,
  `zip` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `productId` (`productId`),
  KEY `productId_2` (`productId`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;INSERT INTO fc_product_address_new VALUES("1","1","India Cements Coromandel Tower, Karpagam Avenue, Raja Annamalai Puram, Chennai, Tamil Nadu, India","Karpagam Avenue","","","Chennai","Tamil Nadu","India","80.26767730712890000","13.02151679992675800","600028");INSERT INTO fc_product_address_new VALUES("2","2","St Marrys Road Mandaveli Chennai","0","","","Chennai","Tamil Nadu","India","80.26139068603516000","13.02957153320312500","600028");INSERT INTO fc_product_address_new VALUES("3","3","chennai","","","","Chennai","Tamil Nadu","India","80.27072143554688000","13.08267974853515600","");INSERT INTO fc_product_address_new VALUES("4","4","Chennai, Tamil Nadu, India","saidapet","","","Chennai","Tamil Nadu","India","80.21949768066406000","13.02235984802246100","");INSERT INTO fc_product_address_new VALUES("5","2","St Marrys Road Mandaveli Chennai","0","","","Chennai","Tamil Nadu","India","80.26139068603516000","13.02957153320312500","600028");INSERT INTO fc_product_address_new VALUES("6","17","Chennai, Tamil Nadu, India","","","","Chennai","Tamil Nadu","India","80.27072143554688000","13.08267974853515600","");INSERT INTO fc_product_address_new VALUES("7","18","Chennai, Tamil Nadu, India","","","","","","","0.00000000000000000","0.00000000000000000","");INSERT INTO fc_product_address_new VALUES("8","14","Chennai, Tamil Nadu, India","Velachery Bypass Road","","","Chennai","Tamil Nadu","India","80.21784973144531000","12.98392581939697300","606601");INSERT INTO fc_product_address_new VALUES("9","22","Chicago, IL, United States","","","","","","","0.00000000000000000","0.00000000000000000","");INSERT INTO fc_product_address_new VALUES("10","23","Chennai, Tamil Nadu, India","","","","","","","0.00000000000000000","0.00000000000000000","");INSERT INTO fc_product_address_new VALUES("11","24","New York, NY, United States","","","","","","","0.00000000000000000","0.00000000000000000","");INSERT INTO fc_product_address_new VALUES("12","26","Chennai, Tamil Nadu, India","","","","","","","0.00000000000000000","0.00000000000000000","");CREATE TABLE `fc_product_attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attr_name` varchar(500) NOT NULL,
  `attr_seourl` varchar(500) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;CREATE TABLE `fc_product_booking` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(1000) NOT NULL,
  `datefrom` date NOT NULL,
  `dateto` date NOT NULL,
  `expiredate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `price` float(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`(767)),
  KEY `product_id_2` (`product_id`(767)),
  KEY `product_id_3` (`product_id`(767))
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;INSERT INTO fc_product_booking VALUES("1","1","0000-00-00","0000-00-00","2016-08-30 11:09:59","0.00");INSERT INTO fc_product_booking VALUES("2","2","0000-00-00","0000-00-00","2016-08-30 12:14:07","0.00");INSERT INTO fc_product_booking VALUES("3","3","0000-00-00","0000-00-00","2016-08-30 15:21:15","0.00");INSERT INTO fc_product_booking VALUES("4","4","0000-00-00","0000-00-00","2016-08-30 15:21:24","0.00");INSERT INTO fc_product_booking VALUES("11","11","0000-00-00","0000-00-00","2016-08-30 18:55:17","0.00");INSERT INTO fc_product_booking VALUES("12","12","0000-00-00","0000-00-00","2016-08-30 19:01:45","0.00");INSERT INTO fc_product_booking VALUES("14","14","0000-00-00","0000-00-00","2016-08-31 15:11:49","0.00");INSERT INTO fc_product_booking VALUES("15","15","0000-00-00","0000-00-00","2016-08-31 17:43:57","0.00");INSERT INTO fc_product_booking VALUES("16","16","0000-00-00","0000-00-00","2016-08-31 17:46:26","0.00");INSERT INTO fc_product_booking VALUES("17","17","0000-00-00","0000-00-00","2016-08-31 17:51:04","0.00");INSERT INTO fc_product_booking VALUES("18","18","0000-00-00","0000-00-00","2016-08-31 17:58:25","0.00");INSERT INTO fc_product_booking VALUES("19","19","0000-00-00","0000-00-00","2016-09-01 15:40:55","0.00");INSERT INTO fc_product_booking VALUES("20","20","0000-00-00","0000-00-00","2016-09-01 15:51:46","0.00");INSERT INTO fc_product_booking VALUES("21","21","0000-00-00","0000-00-00","2016-09-06 15:49:32","0.00");INSERT INTO fc_product_booking VALUES("22","22","0000-00-00","0000-00-00","2016-09-07 12:13:14","0.00");INSERT INTO fc_product_booking VALUES("23","23","0000-00-00","0000-00-00","2016-09-08 13:45:59","0.00");INSERT INTO fc_product_booking VALUES("24","24","0000-00-00","0000-00-00","2016-09-13 11:24:02","0.00");INSERT INTO fc_product_booking VALUES("25","25","0000-00-00","0000-00-00","2016-09-13 19:52:26","0.00");INSERT INTO fc_product_booking VALUES("26","26","0000-00-00","0000-00-00","2016-09-16 10:56:23","0.00");CREATE TABLE `fc_product_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;CREATE TABLE `fc_product_comments` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `user_id` int(200) NOT NULL,
  `product_id` int(200) NOT NULL,
  `comments` longblob NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  `dateAdded` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;CREATE TABLE `fc_product_deal_price` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `deal_amount` varchar(100) NOT NULL,
  `product_id` int(10) NOT NULL,
  `deal_start_date` date NOT NULL,
  `deal_end_date` date NOT NULL,
  `deal_status` enum('','Active','Inactive') NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;CREATE TABLE `fc_rental_photos` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(1000) NOT NULL,
  `imgPriority` varchar(1000) NOT NULL,
  `imgtitle` varchar(1000) NOT NULL,
  `product_image` varchar(1000) NOT NULL,
  `caption` varchar(200) NOT NULL,
  `cover` varchar(120) NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  `mproduct_image` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`(767)),
  KEY `product_id_2` (`product_id`(767))
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;INSERT INTO fc_rental_photos VALUES("1","1","","","Tulips6.jpg","","Cover","Active","");INSERT INTO fc_rental_photos VALUES("2","2","","","Chrysanthemum11.jpg","","Cover","Active","");INSERT INTO fc_rental_photos VALUES("15","4","","","Tulips7.jpg","","Cover","Active","");INSERT INTO fc_rental_photos VALUES("16","4","","","Tulips8.jpg","","","Active","");INSERT INTO fc_rental_photos VALUES("30","14","","","Desert15.jpg","","Cover","Active","");INSERT INTO fc_rental_photos VALUES("31","14","","","Hydrangeas15.jpg","","Cover","Active","");INSERT INTO fc_rental_photos VALUES("32","14","","","Tulips13.jpg","","","Active","");INSERT INTO fc_rental_photos VALUES("33","14","","","Chrysanthemum12.jpg","","","Active","");INSERT INTO fc_rental_photos VALUES("34","14","","","Jellyfish29.jpg","","","Active","");INSERT INTO fc_rental_photos VALUES("35","14","","","Koala18.jpg","","","Active","");INSERT INTO fc_rental_photos VALUES("36","14","","","Desert16.jpg","","","Active","");INSERT INTO fc_rental_photos VALUES("37","14","","","Hydrangeas16.jpg","","","Active","");INSERT INTO fc_rental_photos VALUES("38","14","","","Tulips14.jpg","","","Active","");INSERT INTO fc_rental_photos VALUES("39","14","","","Tulips15.jpg","","","Active","");INSERT INTO fc_rental_photos VALUES("40","0","","","Desert17.jpg","","Cover","Active","");INSERT INTO fc_rental_photos VALUES("41","14","","","Desert18.jpg","","","Active","");INSERT INTO fc_rental_photos VALUES("42","14","","","Hydrangeas17.jpg","","","Active","");INSERT INTO fc_rental_photos VALUES("43","14","","","Desert19.jpg","","","Active","");INSERT INTO fc_rental_photos VALUES("44","14","","","Hydrangeas18.jpg","","","Active","");INSERT INTO fc_rental_photos VALUES("45","15","","","Desert20.jpg","","Cover","Active","");INSERT INTO fc_rental_photos VALUES("46","15","","","Hydrangeas19.jpg","","Cover","Active","");INSERT INTO fc_rental_photos VALUES("47","15","","","Desert21.jpg","","","Active","");INSERT INTO fc_rental_photos VALUES("48","15","","","Hydrangeas20.jpg","","","Active","");INSERT INTO fc_rental_photos VALUES("49","16","","","Desert22.jpg","","Cover","Active","");INSERT INTO fc_rental_photos VALUES("50","17","","","3-fixtures1.jpg","","Cover","Active","");INSERT INTO fc_rental_photos VALUES("51","21","","","images2.jpg","","Cover","Active","");INSERT INTO fc_rental_photos VALUES("52","3","","","Penguins15.jpg","","Cover","Active","");INSERT INTO fc_rental_photos VALUES("53","25","","","download.jpg","","Cover","Active","");INSERT INTO fc_rental_photos VALUES("54","25","","","Download_(12).jpeg","","Cover","Active","");INSERT INTO fc_rental_photos VALUES("55","25","","","Download_(13).jpeg","","Cover","Active","");INSERT INTO fc_rental_photos VALUES("56","25","","","ChicagoSkyline12.jpg","","Cover","Active","");CREATE TABLE `fc_rentalsenquiry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `prd_id` int(11) NOT NULL,
  `checkin` datetime NOT NULL,
  `checkout` datetime NOT NULL,
  `Enquiry` longtext NOT NULL,
  `subTotal` int(12) NOT NULL,
  `caltophone` varchar(20) NOT NULL,
  `enquiry_timezone` varchar(100) NOT NULL,
  `NoofGuest` int(11) NOT NULL,
  `renter_id` int(100) NOT NULL,
  `numofdates` int(100) NOT NULL,
  `serviceFee` decimal(10,2) NOT NULL,
  `totalAmt` decimal(10,2) NOT NULL,
  `discount_amount` decimal(10,2) NOT NULL,
  `phone_no` int(100) NOT NULL,
  `booking_status` varchar(50) NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `approval` enum('Pending','Decline','Accept') NOT NULL,
  `Bookingno` varchar(250) CHARACTER SET utf8 NOT NULL,
  `stripe_charge_token` varchar(255) CHARACTER SET utf8 NOT NULL,
  `cancelled` enum('No','Yes') NOT NULL DEFAULT 'No',
  `message` text NOT NULL,
  `cancellation_policy` varchar(50) NOT NULL,
  `offer` varchar(50) NOT NULL,
  `offer_approval` enum('Pending','Accept','Decline') NOT NULL DEFAULT 'Accept',
  `b_prd_id` int(11) NOT NULL,
  `b_checkin` datetime NOT NULL,
  `b_checkout` datetime NOT NULL,
  `b_NoofGuest` int(11) NOT NULL,
  `b_numofdates` int(11) NOT NULL,
  `b_serviceFee` decimal(10,2) NOT NULL,
  `b_totalAmt` decimal(10,2) NOT NULL,
  `instantbook_status` enum('No','Yes') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `prd_id` (`prd_id`),
  KEY `renter_id` (`renter_id`),
  KEY `b_prd_id` (`b_prd_id`),
  KEY `user_id_2` (`user_id`),
  KEY `prd_id_2` (`prd_id`),
  KEY `renter_id_2` (`renter_id`),
  KEY `b_prd_id_2` (`b_prd_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;INSERT INTO fc_rentalsenquiry VALUES("1","2","1","2016-08-30 00:00:00","2016-08-31 00:00:00","0","40","","","1","1","1","2.00","42.00","2.10","0","Booked","2016-08-30 15:30:47","Accept","EN1500018","","No","","0","","Pending","1","2016-08-30 00:00:00","2016-08-31 00:00:00","1","1","2.00","52.00","No");INSERT INTO fc_rentalsenquiry VALUES("2","3","1","2016-09-01 00:00:00","2016-09-03 00:00:00","0","100","","","2","1","2","2.00","102.00","0.00","0","Booked","2016-08-30 17:15:55","Accept","EN1500028","","No","","0","","Pending","1","2016-09-01 00:00:00","2016-09-05 00:00:00","2","4","2.00","202.00","No");INSERT INTO fc_rentalsenquiry VALUES("3","3","1","2016-09-06 00:00:00","2016-09-08 00:00:00","0","30","","","2","1","2","2.00","32.00","0.00","0","Booked","2016-08-30 17:22:50","Accept","EN1500038","","No","","0","","Pending","1","2016-09-06 00:00:00","2016-09-08 00:00:00","2","2","2.00","102.00","No");INSERT INTO fc_rentalsenquiry VALUES("4","2","1","2016-09-13 00:00:00","2016-09-14 00:00:00","0","50","0","0","1","1","1","2.00","52.00","0.00","0","Pending","2016-08-30 18:26:42","Decline","EN1500048","","No","","0","","Accept","1","2016-09-13 00:00:00","2016-09-14 00:00:00","1","1","2.00","52.00","No");INSERT INTO fc_rentalsenquiry VALUES("5","2","1","2016-09-13 00:00:00","2016-09-14 00:00:00","0","30","","","1","1","1","2.00","32.00","0.00","0","Booked","2016-08-31 11:11:55","Accept","EN1500058","","No","","0","","Pending","1","2016-09-13 00:00:00","2016-09-14 00:00:00","1","1","2.00","52.00","No");INSERT INTO fc_rentalsenquiry VALUES("6","2","1","2016-09-15 00:00:00","2016-09-16 00:00:00","0","50","0","0","1","1","1","2.00","52.00","0.00","0","Pending","2016-08-31 13:11:00","Accept","EN1500068","","No","approved","0","","Accept","1","2016-09-15 00:00:00","2016-09-16 00:00:00","1","1","2.00","52.00","No");INSERT INTO fc_rentalsenquiry VALUES("7","2","1","2016-09-15 00:00:00","2016-09-17 00:00:00","0","100","","","1","1","2","2.00","31.68","0.00","0","Pending","2016-08-31 16:09:07","Pending","EN1500078","","No","","0","","Pending","1","2016-09-15 00:00:00","2016-09-17 00:00:00","1","2","2.00","102.00","No");INSERT INTO fc_rentalsenquiry VALUES("8","2","1","2016-09-20 00:00:00","2016-09-09 00:00:00","0","50","0","0","1","1","1","2.00","52.00","0.00","0","Booked","2016-08-31 19:16:00","Accept","EN1500088","","No","approved","0","","Accept","1","2016-09-20 00:00:00","2016-09-21 00:00:00","1","1","2.00","52.00","No");INSERT INTO fc_rentalsenquiry VALUES("9","3","1","2016-09-21 00:00:00","2016-09-08 00:00:00","0","400","0","0","1","1","8","2.00","402.00","0.00","0","Booked","2016-09-01 12:13:27","Accept","EN1500098","","No","dfg","0","","Accept","1","2016-09-21 00:00:00","2016-09-29 00:00:00","1","8","2.00","402.00","No");INSERT INTO fc_rentalsenquiry VALUES("10","4","14","2016-09-08 00:00:00","2016-09-10 00:00:00","0","400","0","0","1","3","2","2.00","402.00","0.00","0","Pending","2016-09-08 18:32:19","Pending","EN1500108","","No","","0","","Accept","14","2016-09-08 00:00:00","2016-09-10 00:00:00","1","2","2.00","402.00","No");INSERT INTO fc_rentalsenquiry VALUES("11","2","1","2016-10-17 00:00:00","2016-10-20 00:00:00","0","150","","","1","1","3","2.68","283.80","0.00","0","Pending","2016-09-16 15:37:07","Pending","EN1500118","","No","","0","","Pending","1","2016-10-17 00:00:00","2016-10-20 00:00:00","1","3","133.80","283.80","No");CREATE TABLE `fc_requirements` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `id_verified` varchar(100) NOT NULL,
  `ph_verified` varchar(100) NOT NULL,
  `profile_picture` varchar(100) NOT NULL,
  `trip_description` varchar(1000) NOT NULL,
  `verify_code` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;CREATE TABLE `fc_response_time` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `product_id` int(10) NOT NULL,
  `response_time` varchar(250) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;CREATE TABLE `fc_review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rateVal` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `review` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `email` varchar(500) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `product_id` int(100) NOT NULL,
  `bookingno` varchar(250) NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_type` varchar(1000) NOT NULL,
  `owner_reply` varchar(1000) NOT NULL,
  `user_id` varchar(1000) NOT NULL,
  `reviewer_id` varchar(1000) NOT NULL,
  `review_for` enum('accuracy','communication','cleanliness','location','check_in','value') NOT NULL,
  `accuracy` int(200) NOT NULL,
  `communication` int(200) NOT NULL,
  `cleanliness` int(200) NOT NULL,
  `location` int(200) NOT NULL,
  `checkin` int(200) NOT NULL,
  `value` int(200) NOT NULL,
  `total_review` int(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`(767)),
  KEY `product_id_2` (`product_id`),
  KEY `user_id_2` (`user_id`(767))
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;INSERT INTO fc_review VALUES("1","0","","my review","muthukrishnan@casperon.in","Active","1","EN1500018","2016-08-31 15:13:25","","","1","2","accuracy","0","0","0","0","0","0","3");CREATE TABLE `fc_review_comments` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `deal_code` mediumtext NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `commentor_id` bigint(20) NOT NULL,
  `comment` blob NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment_from` enum('user','seller','admin') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;CREATE TABLE `fc_saved_neighborhoods` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `neighborhood` varchar(1000) NOT NULL,
  `user_id` int(100) NOT NULL,
  `url` varchar(1000) NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;CREATE TABLE `fc_shipping_address` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `full_name` varchar(200) NOT NULL,
  `nick_name` varchar(200) NOT NULL,
  `address1` varchar(500) NOT NULL,
  `address2` varchar(500) NOT NULL,
  `city` varchar(200) NOT NULL,
  `state` varchar(200) NOT NULL,
  `country` varchar(100) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `phone` bigint(9) NOT NULL,
  `primary` enum('Yes','No') NOT NULL DEFAULT 'No',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;CREATE TABLE `fc_shopping_carts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `sell_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `discountAmount` decimal(10,2) NOT NULL,
  `indtotal` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `is_coupon_used` enum('Yes','No') NOT NULL DEFAULT 'No',
  `couponID` int(200) NOT NULL,
  `couponCode` varchar(100) NOT NULL,
  `coupontype` varchar(100) NOT NULL,
  `cate_id` varchar(100) NOT NULL,
  `shipping_cost` decimal(10,2) NOT NULL,
  `product_shipping_cost` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `product_tax_cost` decimal(10,2) NOT NULL,
  `attribute_values` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;CREATE TABLE `fc_slider` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `status` enum('Active','InActive') NOT NULL,
  `slider_name` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `slider_title` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `slider_link` varchar(1000) NOT NULL,
  `slider_desc` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `image` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;INSERT INTO fc_slider VALUES("3","Active"," í…ŒìŠ¤íŠ¸ í…ŒìŠ¤íŠ¸"," í…ŒìŠ¤íŠ¸","www.google.com"," í…ŒìŠ¤íŠ¸","us-hi-lahaina-0011.jpg");INSERT INTO fc_slider VALUES("5","Active"," í…ŒìŠ¤íŠ¸"," í…ŒìŠ¤íŠ¸","","í…ŒìŠ¤íŠ¸  í…ŒìŠ¤íŠ¸ í…ŒìŠ¤íŠ¸ í…ŒìŠ¤íŠ¸ í…ŒìŠ¤íŠ¸ í…ŒìŠ¤íŠ¸
","euromast-50-jaar2.jpg");INSERT INTO fc_slider VALUES("7","Active","ìŠ¬ë¼ì´ë”","ìŠ¬ë¼ì´ë”","http://airbnbv2.zoplay.com/rental/Stanley ","ìŠ¬ë¼ì´ë”
","image.jpg");INSERT INTO fc_slider VALUES("9","Active","Aaa","Aaa","www.google.com","zfdf","wat-arun.jpg");CREATE TABLE `fc_state_tax` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `state_name` varchar(500) NOT NULL,
  `state_code` varchar(500) NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  `dateAdded` datetime NOT NULL,
  `state_tax` float(10,2) NOT NULL,
  `country_id` int(100) NOT NULL,
  `country_code` varchar(500) NOT NULL,
  `country_name` varchar(500) NOT NULL,
  `seourl` varchar(500) NOT NULL,
  `meta_title` longblob NOT NULL,
  `meta_keyword` longblob NOT NULL,
  `meta_description` longblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;INSERT INTO fc_state_tax VALUES("2","Alaska","AK","InActive","2013-07-29 13:00:00","2.00","3","","Afghanistan","alaska","","","");INSERT INTO fc_state_tax VALUES("3","American Samoa","AS","Active","2013-07-29 13:00:00","1.00","3","","USA","","","","");INSERT INTO fc_state_tax VALUES("4","Arizona","AZ","Active","2013-07-29 13:00:00","1.00","3","","USA","arizona","","","");INSERT INTO fc_state_tax VALUES("5","Armed Forces Africa","AF","Active","2013-07-29 13:00:00","1.00","3","","USA","armed-forces-africa","","","");INSERT INTO fc_state_tax VALUES("6","Armed Forces Americas","AA","Active","2013-07-29 13:00:00","1.00","3","US","USA","armed-forces-americas","","","");INSERT INTO fc_state_tax VALUES("8","tamilnadu","TN","Active","2013-07-31 06:00:00","1.00","1","","India","tamilnadu","","","");CREATE TABLE `fc_states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `countryid` int(11) NOT NULL,
  `state_code` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL,
  `contid` varchar(50) NOT NULL,
  `seourl` varchar(250) NOT NULL,
  `status` enum('InActive','Active') NOT NULL,
  `featured` enum('0','1') NOT NULL,
  `description` longblob NOT NULL,
  `meta_title` varchar(1000) NOT NULL,
  `meta_keyword` varchar(1000) NOT NULL,
  `meta_description` blob NOT NULL,
  `statelogo` varchar(1000) NOT NULL,
  `statethumb` varchar(1000) NOT NULL,
  `latitude` varchar(250) NOT NULL,
  `longitude` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=875 DEFAULT CHARSET=utf8;INSERT INTO fc_states VALUES("3","215","AS","American Samoa","NA","american-samoa","Active","","","","","","","","","");INSERT INTO fc_states VALUES("4","215","AZ","Arizona","NA","arizona","Active","","","","","","","","34.0489281","-111.0937311");INSERT INTO fc_states VALUES("5","215","AR","Arkansas","NA","arkansas","Active","","","","","","","","","");INSERT INTO fc_states VALUES("6","215","AF","Armed Forces Africa","NA","armed-forces-africa","Active","","","","","","","","15.6169796","32.5547559");INSERT INTO fc_states VALUES("7","215","AA","Armed Forces Americas","NA","armed-forces-americas","Active","","","","","","","","","");INSERT INTO fc_states VALUES("8","215","AC","Armed Forces Canada","NA","armed-forces-canada","Active","","","","","","","","","");INSERT INTO fc_states VALUES("9","215","AE","Armed Forces Europe","NA","armed-forces-europe","Active","","","","","","","","","");INSERT INTO fc_states VALUES("10","215","AM","Armed Forces Middle East","NA","armed-forces-middle-east","Active","","","","","","","","","");INSERT INTO fc_states VALUES("11","215","AP","Armed Forces Pacific","NA","armed-forces-pacific","Active","","","","","","","","","");INSERT INTO fc_states VALUES("12","215","CA","demo","NA","california","Active","","","","","","","","36.778261","-119.4179324");INSERT INTO fc_states VALUES("13","215","CO","Colorado","NA","colorado","Active","","","","","","","","","");INSERT INTO fc_states VALUES("14","215","CT","Connecticut","NA","connecticut","Active","","","","","","","","","");INSERT INTO fc_states VALUES("15","215","DE","Delaware","NA","delaware","Active","","","","","","","","","");INSERT INTO fc_states VALUES("16","215","DC","District of Columbia","NA","district-of-columbia","Active","","","","","","","","","");INSERT INTO fc_states VALUES("17","215","FM","Federated States Of Micronesia","NA","federated-states-of-micronesia","Active","","","","","","","","","");INSERT INTO fc_states VALUES("18","215","FL","Florida","NA","florida","Active","1","<p><strong>Traveling to Florida</strong></p>
<p>Florida vacation rentals and Florida vacation homes have always been extremely popular with tourists from across the globe. When it comes to visiting the US, this is usually the first place that people think of. It is bordered by the Atlantic Ocean and is the 8<sup>th</sup> biggest city in terms of its population. The climate throughout the state varies as it is so large, include both subtropical and tropical, depending where about in the state people are staying.</p>
<p>&nbsp;</p>
<p><strong>Things to do in Florida</strong></p>
<p>After booking into Florida vacation rentals and Florida vacation homes, there are certainly plenty of places to go with families, friends, or just as a couple. The Miami Zoo is certainly top on many peoples shortlist, simply because it has so much to offer visitors at such a reasonable price. In fact, many people in the US consider this to be the best of all the Zoos on a nationwide basis. The great thing that certainly can be said about this Zoo is that the local climate allows the Zoo keepers to replicate the climates of Africa and Australia, which means that they can keep an extremely wide range of different animals here, making it extremely interesting and varied for visitors.</p>
<p>&nbsp;</p>
<p>After checking into a vacation rental property in Florida, another option might be to visit the Seaquarium which is located here. This is located right next to the tourist area in the city of Miami and offers people an insight into the local sea life, how it has changed and how it will continue to change. This tends to be an extremely great day out for families, as they have the opportunity for their children to actually have fun, but learn a lot along the way at the same time, which is certainly ideal.</p>
<p>&nbsp;</p>
<p>Of course, a trip to Florida would certainly not be complete without a trip to the beach. Miami is certainly one of the favourite locations when it comes to hitting the beach, as it offers some of the best beaches in the world. There is no doubt that this is true, as thousands of people visit them every single day. Of course, they tend to get a lot busier during the summer months and there is always plenty going on in terms of sports and other activities.</p>
<p>&nbsp;</p>
<p><strong>Accommodations in Florida</strong></p>
<p>The accommodations in Florida range a great deal to try and suit different budgets where ever possible. For instance, there are budget motels, but also top quality villas are the same time. The Acqualina Resort and Spa is one of those top quality facilities that incorporate the great villas and excellent facilities and tend to be for those people that have a larger budget.</p>
<p>&nbsp;</p>
<p><strong>Weather in Florida</strong></p>
<p>The weather in Florida is certainly what attracts many people to the area and is something that has helped to make this a popular tourist destination. During the summer months, expect temperatures to hit the likes of 38 &deg;C on many occasions, which helps to make this feel like a some what tropical holiday.</p>","","","","","","","");INSERT INTO fc_states VALUES("19","215","GA","Georgia","NA","georgia","Active","","","","","","","","","");INSERT INTO fc_states VALUES("20","215","GU","Guam","NA","guam","Active","","","","","","","","","");INSERT INTO fc_states VALUES("21","215","HI","Hawaii","NA","hawaii","Active","","","","","","","","","");INSERT INTO fc_states VALUES("22","215","ID","Idaho","NA","idaho","Active","","","","","","","","","");INSERT INTO fc_states VALUES("23","215","IL","Illinois","NA","illinois","Active","","","","","","","","","");INSERT INTO fc_states VALUES("24","215","IN","Indiana","NA","indiana","Active","","","","","","","","","");INSERT INTO fc_states VALUES("25","215","IA","Iowa","NA","iowa","Active","","","","","","","","","");INSERT INTO fc_states VALUES("26","215","KS","Kansas","NA","kansas","Active","","","","","","","","","");INSERT INTO fc_states VALUES("27","215","KY","Kentucky","NA","kentucky","Active","","","","","","","","","");INSERT INTO fc_states VALUES("28","215","LA","Louisiana","NA","louisiana","Active","","","","","","","","","");INSERT INTO fc_states VALUES("29","215","ME","Maine","NA","maine","Active","","","","","","","","","");INSERT INTO fc_states VALUES("30","215","MH","Marshall Islands","NA","marshall-islands","Active","","","","","","","","","");INSERT INTO fc_states VALUES("31","215","MD","Maryland","NA","maryland","Active","","","","","","","","","");INSERT INTO fc_states VALUES("32","215","MA","Massachusetts","NA","massachusetts","Active","","","","","","","","","");INSERT INTO fc_states VALUES("33","215","MI","Michigan","NA","michigan","Active","","","","","","","","","");INSERT INTO fc_states VALUES("34","215","MN","Minnesota","NA","minnesota","Active","","","","","","","","","");INSERT INTO fc_states VALUES("35","215","MS","Mississippi","NA","mississippi","Active","","","","","","","","","");INSERT INTO fc_states VALUES("36","215","MO","Missouri","NA","missouri","Active","","","","","","","","","");INSERT INTO fc_states VALUES("37","215","MT","Montana","NA","montana","Active","","","","","","","","","");INSERT INTO fc_states VALUES("38","215","NE","Nebraska","NA","nebraska","Active","","","","","","","","","");INSERT INTO fc_states VALUES("39","215","NV","Nevada","NA","nevada","Active","","","","","","","","","");INSERT INTO fc_states VALUES("40","215","NH","New Hampshire","NA","new-hampshire","Active","","","","","","","","","");INSERT INTO fc_states VALUES("41","215","NJ","New Jersey","NA","new-jersey","Active","","","","","","","","40.0583238","-74.4056612");INSERT INTO fc_states VALUES("42","215","NM","New Mexico","NA","new-mexico","Active","","","","","","","","","");INSERT INTO fc_states VALUES("43","215","NY","New York","NA","new-york","Active","","","","","","","","","");INSERT INTO fc_states VALUES("44","215","NC","North Carolina","NA","north-carolina","Active","","","","","","","","","");INSERT INTO fc_states VALUES("45","215","ND","North Dakota","NA","north-dakota","Active","","","","","","","","","");INSERT INTO fc_states VALUES("46","215","MP","Northern Mariana Islands","NA","northern-mariana-islands","Active","","","","","","","","","");INSERT INTO fc_states VALUES("47","215","OH","Ohio","NA","ohio","Active","","","","","","","","","");INSERT INTO fc_states VALUES("48","215","OK","Oklahoma","NA","oklahoma","Active","","","","","","","","","");INSERT INTO fc_states VALUES("49","215","OR","Oregon","NA","oregon","Active","","","","","","","","","");INSERT INTO fc_states VALUES("50","215","PW","Palau","NA","palau","Active","","","","","","","","","");INSERT INTO fc_states VALUES("51","215","PA","Pennsylvania","NA","pennsylvania","Active","","","","","","","","","");INSERT INTO fc_states VALUES("52","215","PR","Puerto Rico","NA","puerto-rico","Active","","","","","","","","","");INSERT INTO fc_states VALUES("53","215","RI","Rhode Island","NA","rhode-island","Active","","","","","","","","","");INSERT INTO fc_states VALUES("54","215","SC","South Carolina","NA","south-carolina","Active","","","","","","","","","");INSERT INTO fc_states VALUES("55","215","SD","South Dakota","NA","south-dakota","Active","","","","","","","","","");INSERT INTO fc_states VALUES("56","215","TN","Tennessee","NA","tennessee","Active","","","","","","","","","");INSERT INTO fc_states VALUES("57","215","TX","Texas","NA","texas","Active","1","","","","","","","","");INSERT INTO fc_states VALUES("58","215","UT","Utah","NA","utah","Active","","","","","","","","","");INSERT INTO fc_states VALUES("59","215","VT","Vermont","NA","vermont","Active","","","","","","","","","");INSERT INTO fc_states VALUES("60","215","VI","Virgin Islands","NA","virgin-islands","Active","","","","","","","","","");INSERT INTO fc_states VALUES("61","215","VA","Virginia","NA","virginia","Active","","","","","","","","","");INSERT INTO fc_states VALUES("62","215","WA","Washington","NA","washington","Active","","","","","","","","","");INSERT INTO fc_states VALUES("63","215","WV","West Virginia","NA","west-virginia","Active","","","","","","","","","");INSERT INTO fc_states VALUES("64","215","WI","Wisconsin","NA","wisconsin","Active","","","","","","","","","");INSERT INTO fc_states VALUES("65","215","WY","Wyoming","NA","wyoming","Active","","","","","","","","","");INSERT INTO fc_states VALUES("66","38","AB","Alberta","NA","alberta","Active","","","","","","","","","");INSERT INTO fc_states VALUES("67","38","BC","British Columbia","NA","british-columbia","Active","","","","","","","","","");INSERT INTO fc_states VALUES("68","38","MB","Manitoba","NA","manitoba","Active","","","","","","","","","");INSERT INTO fc_states VALUES("69","38","NF","Newfoundland","NA","newfoundland","Active","","","","","","","","","");INSERT INTO fc_states VALUES("70","38","NB","New Brunswick","NA","new-brunswick","Active","","","","","","","","","");INSERT INTO fc_states VALUES("71","38","NS","Nova Scotia","NA","nova-scotia","Active","","","","","","","","","");INSERT INTO fc_states VALUES("72","38","NT","Northwest Territories","NA","northwest-territories","Active","","","","","","","","","");INSERT INTO fc_states VALUES("73","38","NU","Nunavut","NA","nunavut","Active","","","","","","","","","");INSERT INTO fc_states VALUES("74","38","ON","Ontario","NA","ontario","Active","","","","","","","","","");INSERT INTO fc_states VALUES("75","38","PE","Prince Edward Island","NA","prince-edward-island","Active","","","","","","","","","");INSERT INTO fc_states VALUES("76","38","QC","Quebec","NA","quebec","Active","","","","","","","","","");INSERT INTO fc_states VALUES("77","38","SK","Saskatchewan","NA","saskatchewan","Active","","","","","","","","","");INSERT INTO fc_states VALUES("78","38","YT","Yukon Territory","NA","yukon-territory","Active","","","","","","","","","");INSERT INTO fc_states VALUES("182","13","NSW","New South Wales","OC","new-south-wales","Active","","","","","","","","","");INSERT INTO fc_states VALUES("183","13","VIC","Victoria","OC","victoria","Active","","","","","","","","","");INSERT INTO fc_states VALUES("184","13","QLD","Queensland","OC","queensland","Active","","","","","","","","","");INSERT INTO fc_states VALUES("185","13","NT","Northern Territory","OC","northern-territory","Active","","","","","","","","","");INSERT INTO fc_states VALUES("186","13","WA","Western Australia","OC","western-australia","Active","","","","","","","","","");INSERT INTO fc_states VALUES("187","13","SA","South Australia","OC","south-australia","Active","","","","","","","","","");INSERT INTO fc_states VALUES("188","13","TAS","Tasmania","OC","tasmania","Active","","","","","","","","","");INSERT INTO fc_states VALUES("189","13","ACT","Australian Capital Territory","OC","australian-capital-territory","Active","","","","","","","","","");INSERT INTO fc_states VALUES("420","105","AG","Agrigento","EU","agrigento","Active","","","","","","","","","");INSERT INTO fc_states VALUES("421","105","AL","Alessandria","EU","alessandria","Active","","","","","","","","","");INSERT INTO fc_states VALUES("422","105","AN","Ancona","EU","ancona","Active","","","","","","","","","");INSERT INTO fc_states VALUES("423","105","AO","Aosta","EU","aosta","Active","","","","","","","","","");INSERT INTO fc_states VALUES("424","105","AR","Arezzo","EU","arezzo","Active","","","","","","","","","");INSERT INTO fc_states VALUES("425","105","AP","Ascoli Piceno","EU","ascoli-piceno","Active","","","","","","","","","");INSERT INTO fc_states VALUES("426","105","AT","Asti","EU","asti","Active","","","","","","","","","");INSERT INTO fc_states VALUES("427","105","AV","Avellino","EU","avellino","Active","","","","","","","","","");INSERT INTO fc_states VALUES("428","105","BA","Bari","EU","bari","Active","","","","","","","","","");INSERT INTO fc_states VALUES("429","105","BL","Belluno","EU","belluno","Active","","","","","","","","","");INSERT INTO fc_states VALUES("430","105","BN","Benevento","EU","benevento","Active","","","","","","","","","");INSERT INTO fc_states VALUES("431","105","BG","Bergamo","EU","bergamo","Active","","","","","","","","","");INSERT INTO fc_states VALUES("432","105","BI","Biella","EU","biella","Active","","","","","","","","","");INSERT INTO fc_states VALUES("433","105","BO","Bologna","EU","bologna","Active","","","","","","","","","");INSERT INTO fc_states VALUES("434","105","BZ","Bolzano","EU","bolzano","Active","","","","","","","","","");INSERT INTO fc_states VALUES("435","105","BS","Brescia","EU","brescia","Active","","","","","","","","","");INSERT INTO fc_states VALUES("436","105","BR","Brindisi","EU","brindisi","Active","","","","","","","","","");INSERT INTO fc_states VALUES("437","105","CA","Cagliari","EU","cagliari","Active","","","","","","","","","");INSERT INTO fc_states VALUES("438","105","CL","Caltanissetta","EU","caltanissetta","Active","","","","","","","","","");INSERT INTO fc_states VALUES("439","105","CB","Campobasso","EU","campobasso","Active","","","","","","","","","");INSERT INTO fc_states VALUES("440","105","CE","Caserta","EU","caserta","Active","","","","","","","","","");INSERT INTO fc_states VALUES("441","105","CT","Catania","EU","catania","Active","","","","","","","","","");INSERT INTO fc_states VALUES("442","105","CZ","Catanzaro","EU","catanzaro","Active","","","","","","","","","");INSERT INTO fc_states VALUES("443","105","CH","Chieti","EU","chieti","Active","","","","","","","","","");INSERT INTO fc_states VALUES("444","105","CO","Como","EU","como","Active","","","","","","","","","");INSERT INTO fc_states VALUES("445","105","CS","Cosenza","EU","cosenza","Active","","","","","","","","","");INSERT INTO fc_states VALUES("446","105","CR","Cremona","EU","cremona","Active","","","","","","","","","");INSERT INTO fc_states VALUES("447","105","KR","Crotone","EU","crotone","Active","","","","","","","","","");INSERT INTO fc_states VALUES("448","105","CN","Cuneo","EU","cuneo","Active","","","","","","","","","");INSERT INTO fc_states VALUES("449","105","EN","Enna","EU","enna","Active","","","","","","","","","");INSERT INTO fc_states VALUES("450","105","FE","Ferrara","EU","ferrara","Active","","","","","","","","","");INSERT INTO fc_states VALUES("451","105","FI","Firenze","EU","firenze","Active","","","","","","","","","");INSERT INTO fc_states VALUES("452","105","FG","Foggia","EU","foggia","Active","","","","","","","","","");INSERT INTO fc_states VALUES("453","105","FO","ForlÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢","EU","forlÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬","Active","","","","","","","","","");INSERT INTO fc_states VALUES("454","105","FR","Frosinone","EU","frosinone","Active","","","","","","","","","");INSERT INTO fc_states VALUES("455","105","GE","Genova","EU","genova","Active","","","","","","","","","");INSERT INTO fc_states VALUES("456","105","GO","Gorizia","EU","gorizia","Active","","","","","","","","","");INSERT INTO fc_states VALUES("457","105","GR","Grosseto","EU","grosseto","Active","","","","","","","","","");INSERT INTO fc_states VALUES("458","105","IM","Imperia","EU","imperia","Active","","","","","","","","","");INSERT INTO fc_states VALUES("459","105","IS","Isernia","EU","isernia","Active","","","","","","","","","");INSERT INTO fc_states VALUES("460","105","AQ","Aquila","EU","aquila","Active","","","","","","","","","");INSERT INTO fc_states VALUES("461","105","SP","La Spezia","EU","la-spezia","Active","","","","","","","","","");INSERT INTO fc_states VALUES("462","105","LT","Latina","EU","latina","Active","","","","","","","","","");INSERT INTO fc_states VALUES("463","105","LE","Lecce","EU","lecce","Active","","","","","","","","","");INSERT INTO fc_states VALUES("464","105","LC","Lecco","EU","lecco","Active","","","","","","","","","");INSERT INTO fc_states VALUES("465","105","LI","Livorno","EU","livorno","Active","","","","","","","","","");INSERT INTO fc_states VALUES("466","105","LO","Lodi","EU","lodi","Active","","","","","","","","","");INSERT INTO fc_states VALUES("467","105","LU","Lucca","EU","lucca","Active","","","","","","","","","");INSERT INTO fc_states VALUES("468","105","MC","Macerata","EU","macerata","Active","","","","","","","","","");INSERT INTO fc_states VALUES("469","105","MN","Mantova","EU","mantova","Active","","","","","","","","","");INSERT INTO fc_states VALUES("470","105","MS","Massa-Carrara","EU","massacarrara","Active","","","","","","","","","");INSERT INTO fc_states VALUES("471","105","MT","Matera","EU","matera","Active","","","","","","","","","");INSERT INTO fc_states VALUES("472","105","ME","Messina","EU","messina","Active","","","","","","","","","");INSERT INTO fc_states VALUES("473","105","MI","Milano","EU","milano","Active","","","","","","","","","");INSERT INTO fc_states VALUES("474","105","MO","Modena","EU","modena","Active","","","","","","","","","");INSERT INTO fc_states VALUES("475","105","NA","Napoli","EU","napoli","Active","","","","","","","","","");INSERT INTO fc_states VALUES("476","105","NO","Novara","EU","novara","Active","","","","","","","","","");INSERT INTO fc_states VALUES("477","105","NU","Nuoro","EU","nuoro","Active","","","","","","","","","");INSERT INTO fc_states VALUES("478","105","OR","Oristano","EU","oristano","Active","","","","","","","","","");INSERT INTO fc_states VALUES("479","105","PD","Padova","EU","padova","Active","","","","","","","","","");INSERT INTO fc_states VALUES("480","105","PA","Palermo","EU","palermo","Active","","","","","","","","","");INSERT INTO fc_states VALUES("481","105","PR","Parma","EU","parma","Active","","","","","","","","","");INSERT INTO fc_states VALUES("482","105","PG","Perugia","EU","perugia","Active","","","","","","","","","");INSERT INTO fc_states VALUES("483","105","PV","Pavia","EU","pavia","Active","","","","","","","","","");INSERT INTO fc_states VALUES("484","105","PS","Pesaro e Urbino","EU","pesaro-e-urbino","Active","","","","","","","","","");INSERT INTO fc_states VALUES("485","105","PE","Pescara","EU","pescara","Active","","","","","","","","","");INSERT INTO fc_states VALUES("486","105","PC","Piacenza","EU","piacenza","Active","","","","","","","","","");INSERT INTO fc_states VALUES("487","105","PI","Pisa","EU","pisa","Active","","","","","","","","","");INSERT INTO fc_states VALUES("488","105","PT","Pistoia","EU","pistoia","Active","","","","","","","","","");INSERT INTO fc_states VALUES("489","105","PN","Pordenone","EU","pordenone","Active","","","","","","","","","");INSERT INTO fc_states VALUES("490","105","PZ","Potenza","EU","potenza","Active","","","","","","","","","");INSERT INTO fc_states VALUES("491","105","PO","Prato","EU","prato","Active","","","","","","","","","");INSERT INTO fc_states VALUES("492","105","RG","Ragusa","EU","ragusa","Active","","","","","","","","","");INSERT INTO fc_states VALUES("493","105","RA","Ravenna","EU","ravenna","Active","","","","","","","","","");INSERT INTO fc_states VALUES("494","105","RC","Reggio di Calabria","EU","reggio-di-calabria","Active","","","","","","","","","");INSERT INTO fc_states VALUES("495","105","RE","Reggio Emilia","EU","reggio-emilia","Active","","","","","","","","","");INSERT INTO fc_states VALUES("496","105","RI","Rieti","EU","rieti","Active","","","","","","","","","");INSERT INTO fc_states VALUES("497","105","RN","Rimini","EU","rimini","Active","","","","","","","","","");INSERT INTO fc_states VALUES("498","105","RM","Roma","EU","roma","Active","","","","","","","","","");INSERT INTO fc_states VALUES("499","105","RO","Rovigo","EU","rovigo","Active","","","","","","","","","");INSERT INTO fc_states VALUES("500","105","SA","Salerno","EU","salerno","Active","","","","","","","","","");INSERT INTO fc_states VALUES("501","105","SS","Sassari","EU","sassari","Active","","","","","","","","","");INSERT INTO fc_states VALUES("502","105","SV","Savona","EU","savona","Active","","","","","","","","","");INSERT INTO fc_states VALUES("503","105","SI","Siena","EU","siena","Active","","","","","","","","","");INSERT INTO fc_states VALUES("504","105","SR","Siracusa","EU","siracusa","Active","","","","","","","","","");INSERT INTO fc_states VALUES("505","105","SO","Sondrio","EU","sondrio","Active","","","","","","","","","");INSERT INTO fc_states VALUES("506","105","TA","Taranto","EU","taranto","Active","","","","","","","","","");INSERT INTO fc_states VALUES("507","105","TE","Teramo","EU","teramo","Active","","","","","","","","","");INSERT INTO fc_states VALUES("508","105","TR","Terni","EU","terni","Active","","","","","","","","","");INSERT INTO fc_states VALUES("509","105","TO","Torino","EU","torino","Active","","","","","","","","","");INSERT INTO fc_states VALUES("510","105","TP","Trapani","EU","trapani","Active","","","","","","","","","");INSERT INTO fc_states VALUES("511","105","TN","Trento","EU","trento","Active","","","","","","","","","");INSERT INTO fc_states VALUES("512","105","TV","Treviso","EU","treviso","Active","","","","","","","","","");INSERT INTO fc_states VALUES("513","105","TS","Trieste","EU","trieste","Active","","","","","","","","","");INSERT INTO fc_states VALUES("514","105","UD","Udine","EU","udine","Active","","","","","","","","","");INSERT INTO fc_states VALUES("515","105","VA","Varese","EU","varese","Active","","","","","","","","","");INSERT INTO fc_states VALUES("516","105","VE","Venezia","EU","venezia","Active","","","","","","","","","");INSERT INTO fc_states VALUES("517","105","VB","Verbania","EU","verbania","Active","","","","","","","","","");INSERT INTO fc_states VALUES("518","105","VC","Vercelli","EU","vercelli","Active","","","","","","","","","");INSERT INTO fc_states VALUES("519","105","VR","Verona","EU","verona","Active","","","","","","","","","");INSERT INTO fc_states VALUES("520","105","VV","Vibo Valentia","EU","vibo-valentia","Active","","","","","","","","","");INSERT INTO fc_states VALUES("521","105","VI","Vicenza","EU","vicenza","Active","","","","","","","","","");INSERT INTO fc_states VALUES("522","105","VT","Viterbo","EU","viterbo","Active","","","","","","","","","");INSERT INTO fc_states VALUES("787","222","AVON","Avon","EU","avon","Active","","","","","","","","","");INSERT INTO fc_states VALUES("788","222","BEDS","Bedfordshire","EU","bedfordshire","Active","","","","","","","","","");INSERT INTO fc_states VALUES("789","222","BERK","Berkshire","EU","berkshire","Active","","","","","","","","","");INSERT INTO fc_states VALUES("790","222","BIRM","Birmingham","EU","birmingham","Active","","","","","","","","","");INSERT INTO fc_states VALUES("791","222","BORD","Borders","EU","borders","Active","","","","","","","","","");INSERT INTO fc_states VALUES("792","222","BUCK","Buckinghamshire","EU","buckinghamshire","Active","","","","","","","","","");INSERT INTO fc_states VALUES("793","222","CAMB","Cambridgeshire","EU","cambridgeshire","Active","","","","","","","","","");INSERT INTO fc_states VALUES("794","222","CENT","Central","EU","central","Active","","","","","","","","","");INSERT INTO fc_states VALUES("795","222","CHES","Cheshire","EU","cheshire","Active","","","","","","","","","");INSERT INTO fc_states VALUES("796","222","CLEV","Cleveland","EU","cleveland","Active","","","","","","","","","");INSERT INTO fc_states VALUES("797","222","CLWY","Clwyd","EU","clwyd","Active","","","","","","","","","");INSERT INTO fc_states VALUES("798","222","CORN","Cornwall","EU","cornwall","Active","","","","","","","","","");INSERT INTO fc_states VALUES("799","222","CUMB","Cumbria","EU","cumbria","Active","","","","","","","","","");INSERT INTO fc_states VALUES("800","222","DERB","Derbyshire","EU","derbyshire","Active","","","","","","","","","");INSERT INTO fc_states VALUES("801","222","DEVO","Devon","EU","devon","Active","","","","","","","","","");INSERT INTO fc_states VALUES("802","222","DORS","Dorset","EU","dorset","Active","","","","","","","","","");INSERT INTO fc_states VALUES("803","222","DUMF","Dumfries & Galloway","EU","dumfries-&-galloway","Active","","","","","","","","","");INSERT INTO fc_states VALUES("804","222","DURH","Durham","EU","durham","Active","","","","","","","","","");INSERT INTO fc_states VALUES("805","222","DYFE","Dyfed","EU","dyfed","Active","","","","","","","","","");INSERT INTO fc_states VALUES("806","222","ESUS","East Sussex","EU","east-sussex","Active","","","","","","","","","");INSERT INTO fc_states VALUES("807","222","ESSE","Essex","EU","essex","Active","","","","","","","","","");INSERT INTO fc_states VALUES("808","222","FIFE","Fife","EU","fife","Active","","","","","","","","","");INSERT INTO fc_states VALUES("809","222","GLAM","Glamorgan","EU","glamorgan","Active","","","","","","","","","");INSERT INTO fc_states VALUES("810","222","GLOU","Gloucestershire","EU","gloucestershire","Active","","","","","","","","","");INSERT INTO fc_states VALUES("811","222","GRAM","Grampian","EU","grampian","Active","","","","","","","","","");INSERT INTO fc_states VALUES("812","222","GWEN","Gwent","EU","gwent","Active","","","","","","","","","");INSERT INTO fc_states VALUES("813","222","GWYN","Gwynedd","EU","gwynedd","Active","","","","","","","","","");INSERT INTO fc_states VALUES("814","222","HAMP","Hampshire","EU","hampshire","Active","","","","","","","","","");INSERT INTO fc_states VALUES("815","222","HERE","Hereford & Worcester","EU","hereford-&-worcester","Active","","","","","","","","","");INSERT INTO fc_states VALUES("816","222","HERT","Hertfordshire","EU","hertfordshire","Active","","","","","","","","","");INSERT INTO fc_states VALUES("817","222","HUMB","Humberside","EU","humberside","Active","","","","","","","","","");INSERT INTO fc_states VALUES("818","222","KENT","Kent","EU","kent","Active","","","","","","","","","");INSERT INTO fc_states VALUES("819","222","LANC","Lancashire","EU","lancashire","Active","","","","","","","","","");INSERT INTO fc_states VALUES("820","222","LEIC","Leicestershire","EU","leicestershire","Active","","","","","","","","","");INSERT INTO fc_states VALUES("821","222","LINC","Lincolnshire","EU","lincolnshire","Active","","","","","","","","","");INSERT INTO fc_states VALUES("822","222","LOND","London","EU","london","Active","","","","","","","","","");INSERT INTO fc_states VALUES("823","222","LOTH","Lothian","EU","lothian","Active","","","","","","","","","");INSERT INTO fc_states VALUES("824","222","MANC","Manchester","EU","manchester","Active","","","","","","","","","");INSERT INTO fc_states VALUES("825","222","MERS","Merseyside","EU","merseyside","Active","","","","","","","","","");INSERT INTO fc_states VALUES("826","222","NORF","Norfolk","EU","norfolk","Active","","","","","","","","","");INSERT INTO fc_states VALUES("827","222","NYOR","North Yorkshire","EU","north-yorkshire","Active","","","","","","","","","");INSERT INTO fc_states VALUES("828","222","NWHI","North west Highlands","EU","north-west-highlands","Active","","","","","","","","","");INSERT INTO fc_states VALUES("829","222","NHAM","Northamptonshire","EU","northamptonshire","Active","","","","","","","","","");INSERT INTO fc_states VALUES("830","222","NUMB","Northumberland","EU","northumberland","Active","","","","","","","","","");INSERT INTO fc_states VALUES("831","222","NOTT","Nottinghamshire","EU","nottinghamshire","Active","","","","","","","","","");INSERT INTO fc_states VALUES("832","222","OXFO","Oxfordshire","EU","oxfordshire","Active","","","","","","","","","");INSERT INTO fc_states VALUES("833","222","POWY","Powys","EU","powys","Active","","","","","","","","","");INSERT INTO fc_states VALUES("834","222","SHRO","Shropshire","EU","shropshire","Active","0","","","","","","","","");INSERT INTO fc_states VALUES("835","222","SOME","Somerset","EU","somerset","Active","0","","","","","","","","");INSERT INTO fc_states VALUES("836","222","SYOR","South Yorkshire","EU","south-yorkshire","Active","0","","","","","","","","");INSERT INTO fc_states VALUES("837","222","STAF","Staffordshire","EU","staffordshire","Active","0","","","","","","","","");INSERT INTO fc_states VALUES("838","222","STRA","Strathclyde","EU","strathclyde","Active","0","","","","","","","","");INSERT INTO fc_states VALUES("839","222","SUFF","Suffolk","EU","suffolk","Active","0","","","","","","","","");INSERT INTO fc_states VALUES("840","222","SURR","Surrey","EU","surrey","Active","0","","","","","","","","");INSERT INTO fc_states VALUES("841","222","WSUS","West Sussex","EU","west-sussex","Active","0","","","","","","","","");INSERT INTO fc_states VALUES("842","222","TAYS","Tayside","EU","tayside","Active","0","","","","","","","","");INSERT INTO fc_states VALUES("843","222","TYWE","Tyne & Wear","EU","tyne-&-wear","Active","0","","","","","","","","");INSERT INTO fc_states VALUES("844","222","WARW","Warwickshire","EU","warwickshire","Active","0","","","","","","","","");INSERT INTO fc_states VALUES("845","222","WISL","West Isles","EU","west-isles","Active","0","","","","","","","","");INSERT INTO fc_states VALUES("846","222","WYOR","West Yorkshire","EU","west-yorkshire","Active","0","","","","","","","","");INSERT INTO fc_states VALUES("847","222","WILT","Wiltshire","EU","wiltshire","Active","0","","","","","","","","");INSERT INTO fc_states VALUES("859","51","NRW","North Rhine-Westphalia","","north-rhine-westphalia","Active","0","","North Rhine-Westphalia","North Rhine-Westphalia","North Rhine-Westphalia","","","","");INSERT INTO fc_states VALUES("860","95","TN","Tamil Nadu","","","Active","0","","","","","","","11.12712","78.65689");INSERT INTO fc_states VALUES("861","95","MI","Mumbai","","mumbai","Active","0","","","","","","","19.07598","72.87766");INSERT INTO fc_states VALUES("862","215","CA06","California","","california","Active","0","","","","","","","36.77826","-119.41793");INSERT INTO fc_states VALUES("863","95","75002","Maharastra","","maharastra","Active","0","","","","","","","19.75148","75.71389");INSERT INTO fc_states VALUES("864","51","1","Bayern","","bayern","Active","0","","","","","","","48.79045","11.49789");INSERT INTO fc_states VALUES("865","145","SWK","Sarawak","","sarawak","Active","0","","","","","","","1.55328","110.35921");INSERT INTO fc_states VALUES("866","70","0123","south england","","south-england","Active","0","","","","","","","52.35552","-1.17432");INSERT INTO fc_states VALUES("867","95","12","Karnataka","","karnataka","Active","0","","","","","","","15.31728","75.71389");INSERT INTO fc_states VALUES("868","189","sn","dakar","","dakar","Active","0","","","","","","","14.76450","-17.36603");INSERT INTO fc_states VALUES("869","95","Haryana","Haryana","","haryana","Active","0","","","","","","","37.77264","-122.40992");INSERT INTO fc_states VALUES("870","95","Delhi-NCR","Delhi-NCR","","delhi-ncr","Active","0","","","","","","","28.68381","77.41038");INSERT INTO fc_states VALUES("871","153","Norway","Buskerud","","buskerud","Active","0","","","","","","","37.77264","-122.40992");INSERT INTO fc_states VALUES("872","51","51145","koln","","koln","Active","0","","","","","","","50.93753","6.96028");INSERT INTO fc_states VALUES("873","207","Bursa","Bursa","","bursa","Active","0","","","","","","","40.18853","29.06096");INSERT INTO fc_states VALUES("874","0","","chennai","","chennai","Active","0","","chennai","chennai","coolest place in India","","","13.08268","80.27072");CREATE TABLE `fc_subadmin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `name` varchar(250) NOT NULL,
  `admin_name` varchar(24) NOT NULL,
  `admin_password` varchar(500) NOT NULL,
  `email` varchar(5000) NOT NULL,
  `admin_type` enum('super','sub') NOT NULL DEFAULT 'super',
  `password_reset_count` int(10) NOT NULL,
  `privileges` text NOT NULL,
  `last_login_date` datetime NOT NULL,
  `last_logout_date` datetime NOT NULL,
  `last_login_ip` varchar(16) NOT NULL,
  `is_verified` enum('No','Yes') NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;CREATE TABLE `fc_subproducts` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `attr_id` int(11) NOT NULL,
  `attr_price` decimal(10,2) NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;CREATE TABLE `fc_subscribers_list` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `subscrip_mail` varchar(500) NOT NULL,
  `active` int(255) NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  `dateAdded` date NOT NULL,
  `verification_mail` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;CREATE TABLE `fc_testimonials` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `title` varchar(1000) NOT NULL,
  `description` longblob NOT NULL,
  `dateAdded` datetime NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;CREATE TABLE `fc_transaction` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `payment_cycle` varchar(500) NOT NULL,
  `txn_type` varchar(500) NOT NULL,
  `last_name` varchar(500) NOT NULL,
  `next_payment_date` varchar(500) NOT NULL,
  `residence_country` varchar(500) NOT NULL,
  `initial_payment_amount` varchar(500) NOT NULL,
  `currency_code` varchar(500) NOT NULL,
  `time_created` varchar(500) NOT NULL,
  `verify_sign` varchar(750) NOT NULL,
  `period_type` varchar(500) NOT NULL,
  `payer_status` varchar(500) NOT NULL,
  `test_ipn` varchar(500) NOT NULL,
  `tax` varchar(500) NOT NULL,
  `payer_email` varchar(500) NOT NULL,
  `first_name` varchar(500) NOT NULL,
  `receiver_email` varchar(500) NOT NULL,
  `payer_id` varchar(500) NOT NULL,
  `product_type` varchar(500) NOT NULL,
  `shipping` varchar(500) NOT NULL,
  `amount_per_cycle` varchar(500) NOT NULL,
  `profile_status` varchar(500) NOT NULL,
  `charset` varchar(500) NOT NULL,
  `notify_version` varchar(500) NOT NULL,
  `amount` varchar(500) NOT NULL,
  `outstanding_balance` varchar(500) NOT NULL,
  `recurring_payment_id` varchar(500) NOT NULL,
  `product_name` varchar(500) NOT NULL,
  `custom_values` varchar(500) NOT NULL,
  `ipn_track_id` varchar(500) NOT NULL,
  `tran_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;CREATE TABLE `fc_user_activity` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `activity_name` varchar(200) NOT NULL,
  `activity_id` int(200) NOT NULL,
  `user_id` int(200) NOT NULL,
  `activity_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `activity_ip` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;CREATE TABLE `fc_user_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seller_product_id` bigint(20) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `product_name` varchar(100) NOT NULL,
  `seourl` varchar(500) NOT NULL,
  `meta_title` longblob NOT NULL,
  `meta_keyword` longblob NOT NULL,
  `meta_description` longblob NOT NULL,
  `excerpt` varchar(500) NOT NULL,
  `category_id` varchar(500) NOT NULL,
  `image` longtext NOT NULL,
  `description` longtext NOT NULL,
  `status` enum('Publish','UnPublish') NOT NULL DEFAULT 'Publish',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `likes` bigint(20) NOT NULL DEFAULT '0',
  `list_name` longtext NOT NULL,
  `list_value` longtext NOT NULL,
  `web_link` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;CREATE TABLE `fc_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `loginUserType` enum('normal','twitter','facebook','google','linkedin') NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `group` enum('User','Seller') NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `is_verified` enum('No','Yes') NOT NULL DEFAULT 'No',
  `id_verified` enum('No','Yes') NOT NULL DEFAULT 'No',
  `ph_verified` enum('No','Yes') NOT NULL DEFAULT 'No',
  `is_brand` enum('no','yes') NOT NULL DEFAULT 'no',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `last_login_date` datetime NOT NULL,
  `last_logout_date` datetime NOT NULL,
  `last_login_ip` varchar(50) NOT NULL,
  `thumbnail` varchar(100) NOT NULL,
  `address` varchar(50) NOT NULL,
  `address2` varchar(500) NOT NULL,
  `city` varchar(50) NOT NULL,
  `district` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(20) NOT NULL,
  `postal_code` int(11) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `country_code` varchar(50) NOT NULL,
  `ph_country` varchar(70) NOT NULL,
  `s_address` varchar(100) NOT NULL,
  `s_city` varchar(50) NOT NULL,
  `s_district` varchar(50) NOT NULL,
  `s_state` varchar(50) NOT NULL,
  `s_country` varchar(20) NOT NULL,
  `s_postal_code` int(11) NOT NULL,
  `s_phone_no` varchar(20) NOT NULL,
  `brand_name` varchar(100) NOT NULL,
  `brand_description` text NOT NULL,
  `commision` int(11) NOT NULL,
  `web_url` varchar(50) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `bank_no` varchar(100) NOT NULL,
  `bank_code` varchar(100) NOT NULL,
  `request_status` enum('Not Requested','Pending','Approved','Rejected') NOT NULL DEFAULT 'Not Requested',
  `verify_code` varchar(10) NOT NULL,
  `mobile_verification_code` varchar(50) DEFAULT NULL,
  `feature_product` int(100) NOT NULL,
  `followers_count` int(11) NOT NULL,
  `following_count` int(11) NOT NULL,
  `followers` varchar(200) NOT NULL,
  `following` varchar(200) NOT NULL,
  `twitter` varchar(50) NOT NULL,
  `facebook` varchar(50) NOT NULL,
  `google` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `about` varchar(200) NOT NULL,
  `age` enum('','13 to 17','18 to 24','25 to 34','35 to 44','45 to 54','55+') NOT NULL,
  `gender` enum('Male','Female','Unspecified') NOT NULL DEFAULT 'Unspecified',
  `language` varchar(10) NOT NULL DEFAULT 'en',
  `visibility` enum('Everyone','Only you') NOT NULL,
  `display_lists` enum('Yes','No') NOT NULL,
  `email_notifications` longtext NOT NULL,
  `notifications` longtext NOT NULL,
  `updates` enum('1','0') NOT NULL,
  `products` int(11) NOT NULL,
  `lists` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `location` mediumtext NOT NULL,
  `following_user_lists` longtext NOT NULL,
  `following_giftguide_lists` longtext NOT NULL,
  `api_id` bigint(20) NOT NULL,
  `own_products` longtext NOT NULL,
  `own_count` bigint(20) NOT NULL,
  `referId` int(11) NOT NULL,
  `want_count` bigint(20) NOT NULL,
  `refund_amount` decimal(20,2) NOT NULL DEFAULT '0.00',
  `paypal_email` varchar(500) NOT NULL,
  `contact_count` int(100) NOT NULL,
  `firstname` varchar(1000) NOT NULL,
  `lastname` varchar(1000) NOT NULL,
  `image` varchar(1000) NOT NULL,
  `description` longtext NOT NULL,
  `response_rate` int(100) NOT NULL,
  `cardType` varchar(255) NOT NULL,
  `cardNumber` int(20) NOT NULL,
  `CCExpDay` int(4) NOT NULL,
  `CCExpMnth` int(4) NOT NULL,
  `cvv` varchar(255) NOT NULL,
  `dob_date` int(100) NOT NULL,
  `dob_month` int(100) NOT NULL,
  `dob_year` int(100) NOT NULL,
  `school` varchar(1000) NOT NULL,
  `work` varchar(1000) NOT NULL,
  `timezone` varchar(1000) NOT NULL,
  `member_pakage` varchar(1000) NOT NULL,
  `member_purchase_date` date NOT NULL,
  `package_status` enum('Pending','Paid') NOT NULL DEFAULT 'Pending',
  `expired_date` date NOT NULL,
  `package_exp_date` date NOT NULL,
  `social_recommend` enum('yes','no') NOT NULL DEFAULT 'no',
  `search_by_profile` enum('yes','no') NOT NULL DEFAULT 'no',
  `emergency_name` varchar(250) NOT NULL,
  `emergency_phone` varchar(250) NOT NULL,
  `emergency_email` varchar(250) NOT NULL,
  `emergency_relationship` varchar(250) NOT NULL,
  `languages_known` text NOT NULL,
  `accname` varchar(15) NOT NULL,
  `accno` varchar(250) NOT NULL,
  `routing_no` varchar(50) NOT NULL,
  `bankname` varchar(25) NOT NULL,
  `swift_code` varchar(255) NOT NULL,
  `Acccountry` varchar(25) NOT NULL,
  `swiftcode` varchar(55) NOT NULL,
  `subscriber` enum('Yes','No','delete') NOT NULL,
  `login_hit` int(11) NOT NULL,
  `through` varchar(500) NOT NULL,
  `mobile_key` varchar(255) NOT NULL,
  `user_currency` varchar(255) NOT NULL,
  `ios_key` varchar(255) NOT NULL,
  `mobile_notification` enum('Yes','No') NOT NULL DEFAULT 'No',
  `host_status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;INSERT INTO fc_users VALUES("1","normal","","Muthu","Seller","muthukrishnan@teamtweaks.com","e10adc3949ba59abbe56e057f20f883e","Active","Yes","Yes","Yes","no","2016-08-30 11:07:11","0000-00-00 00:00:00","2016-09-16 02:53:27","2016-09-13 04:19:30","192.168.1.52","","","","","","","","0","9514271661","+91","0","","","","","","0","","","","0","","","","","Not Requested","p4IM5Tuxfo","820293","0","0","0","","","","","","0000-00-00","","","Unspecified","en","Everyone","Yes","cool_destination,fun_news,upcoming_reservation,new_review,new_reference,reference_request,review_reminder,calendar_reminder","message_another_person,guest_reservation,reservation_request","1","5","0","0","","","","0","","0","0","0","0.00","","0","Muthu","Krishnan","","","0","","0","0","0","","0","0","0","","","","","0000-00-00","Pending","2016-09-14","0000-00-00","no","no","","","","","","","","","","","","","Yes","1","","","","","No","Inactive");INSERT INTO fc_users VALUES("2","normal","","Raja","User","muthukrishnan@casperon.in","e10adc3949ba59abbe56e057f20f883e","Active","No","No","Yes","no","2016-08-30 11:07:44","2016-08-30 05:38:50","2016-09-16 03:35:28","2016-08-30 05:37:06","192.168.1.52","","","","","","","","0","9790605724","+91","0","","Chennai","","","","0","","","","0","","","","","Approved","cHLygtSiJG","235988","0","0","0","","","","","","1989-09-22","","","Male","en","Everyone","Yes","cool_destination,fun_news,upcoming_reservation,new_review,new_reference,reference_request,review_reminder,calendar_reminder","message_another_person,guest_reservation,reservation_request","1","0","0","0","","","","0","","0","0","0","0.00","","0","Raja","Rajan","","","0","","0","0","0","","22","9","1989","","","America/Regina","","0000-00-00","Pending","2016-09-14","0000-00-00","no","no","","","","","","","","","","","","","Yes","1","","","","","No","Inactive");INSERT INTO fc_users VALUES("3","normal","","","Seller","vasudevan@casperon.in","e10adc3949ba59abbe56e057f20f883e","Active","No","No","No","no","2016-08-30 01:21:44","2016-08-30 01:21:44","2016-09-08 06:29:14","2016-08-31 07:01:44","192.168.1.56","","","","","","","","0","","","","","","","","","0","","","","0","","","","","Approved","","","0","0","0","","","","","","0000-00-00","","","Male","en","Everyone","Yes","","","1","0","0","0","","","","0","","0","0","0","0.00","vasudevan@casperon.in","0","vasu","s","Hydrangeas3.jpg","","0","","0","0","0","","1","1","2001","","","","","2016-08-30","Paid","0000-00-00","0000-00-00","no","no","","","","","","vasudevan","12345678","","icici bank","","","","Yes","1","","","","","No","Inactive");INSERT INTO fc_users VALUES("4","normal","","deva","User","vasuit11@gmail.com","e10adc3949ba59abbe56e057f20f883e","Active","No","No","No","no","2016-08-30 01:28:42","2016-08-30 05:53:10","2016-09-08 06:30:36","2016-08-30 01:38:54","192.168.1.56","","","","","","","","0","","","","","","","","","0","","","","0","","","","","Approved","","","0","0","0","","","","","","0000-00-00","","","Male","en","Everyone","Yes","","","1","0","0","0","","","","0","","0","0","0","0.00","","0","deva","s","Hydrangeas2.jpg","","0","","0","0","0","","1","1","2001","","","Asia/Kolkata","","0000-00-00","Pending","0000-00-00","0000-00-00","no","no","","","","","","","","","","","","","Yes","2","","","","","No","Inactive");INSERT INTO fc_users VALUES("5","normal","","host","Seller","hostsite123@gmail.com","e10adc3949ba59abbe56e057f20f883e","Active","No","No","No","no","2016-08-30 03:21:03","0000-00-00 00:00:00","2016-09-09 12:09:03","2016-09-09 12:09:17","192.168.1.58","","","","","","","","0","8608372592","+91","0","","","","","","0","","","","0","","","","","Not Requested","CzjKlFY5iH","165664","0","0","0","","","","","","0000-00-00","","","Unspecified","en","Everyone","Yes","cool_destination,fun_news,upcoming_reservation,new_review,new_reference,reference_request,review_reminder,calendar_reminder","message_another_person,guest_reservation,reservation_request","1","2","0","0","","","","0","","0","0","0","0.00","","0","host","site","","","0","","0","0","0","","0","0","0","","","","","0000-00-00","Pending","2016-09-14","0000-00-00","no","no","","","","","","","","","","","","","Yes","1","","","","","No","Inactive");INSERT INTO fc_users VALUES("6","normal","","samuel","Seller","samuelyesudasan@casperon.in","e10adc3949ba59abbe56e057f20f883e","Active","No","No","No","no","2016-08-31 05:50:39","0000-00-00 00:00:00","2016-09-13 11:23:47","2016-08-31 06:52:10","192.168.1.167","","","","","","","","0","","","","","","","","","0","","","","0","","","","","Not Requested","8tClh3jXiY","","0","0","0","","","","","","0000-00-00","","","Unspecified","en","Everyone","Yes","cool_destination,fun_news,upcoming_reservation,new_review,new_reference,reference_request,review_reminder,calendar_reminder","message_another_person,guest_reservation,reservation_request","1","0","0","0","","","","0","","0","0","0","0.00","","0","samuel","j","","","0","","0","0","0","","0","0","0","","","","","0000-00-00","Pending","2016-09-15","0000-00-00","no","no","","","","","","","","","","","","","Yes","1","","","","","No","Inactive");INSERT INTO fc_users VALUES("7","normal","","oyanu","Seller","oyanu123@gmail.com","e10adc3949ba59abbe56e057f20f883e","Active","No","No","No","no","2016-09-16 10:56:03","0000-00-00 00:00:00","2016-09-16 10:56:04","0000-00-00 00:00:00","192.168.1.49","","","","","","","","0","","","","","","","","","0","","","","0","","","","","Not Requested","BaVf2yErcz","","0","0","0","","","","","","0000-00-00","","","Unspecified","en","Everyone","Yes","cool_destination,fun_news,upcoming_reservation,new_review,new_reference,reference_request,review_reminder,calendar_reminder","message_another_person,guest_reservation,reservation_request","1","0","0","0","","","","0","","0","0","0","0.00","","0","oyanu","admin","","","0","","0","0","0","","0","0","0","","","","","0000-00-00","Pending","2016-10-01","0000-00-00","no","no","","","","","","","","","","","","","Yes","0","","","","","No","Inactive");CREATE TABLE `fc_vendor_payment_table` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `transaction_id` mediumtext COLLATE utf8_bin NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `payment_type` mediumtext COLLATE utf8_bin NOT NULL,
  `amount` float(20,2) NOT NULL,
  `status` enum('pending','success','failed') COLLATE utf8_bin NOT NULL,
  `vendor_id` bigint(20) NOT NULL,
  `bookingId` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;CREATE TABLE `fc_wants` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `product_id` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;CREATE TABLE `schedule` (
  `id` int(11) DEFAULT NULL,
  `data` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;INSERT INTO schedule VALUES("1","{\"2016-09-01\":{\"available\":\"1\",\"bind\":0,\"info\":\"\",\"notes\":\"\",\"price\":\"\",\"promo\":\"\",\"status\":\"booked\"},\"2016-09-02\":{\"available\":\"1\",\"bind\":0,\"info\":\"\",\"notes\":\"\",\"price\":\"\",\"promo\":\"\",\"status\":\"booked\"},\"2016-09-03\":{\"available\":\"1\",\"bind\":0,\"info\":\"\",\"notes\":\"\",\"price\":\"\",\"promo\":\"\",\"status\":\"booked\"},\"2016-09-06\":{\"available\":\"1\",\"bind\":0,\"info\":\"\",\"notes\":\"\",\"price\":\"\",\"promo\":\"\",\"status\":\"booked\"},\"2016-09-07\":{\"available\":\"1\",\"bind\":0,\"info\":\"\",\"notes\":\"\",\"price\":\"\",\"promo\":\"\",\"status\":\"booked\"},\"2016-09-08\":{\"available\":\"1\",\"bind\":0,\"info\":\"\",\"notes\":\"\",\"price\":\"\",\"promo\":\"\",\"status\":\"booked\"},\"2016-08-30\":{\"available\":\"1\",\"bind\":0,\"info\":\"\",\"notes\":\"\",\"price\":\"\",\"promo\":\"\",\"status\":\"booked\"},\"2016-08-31\":{\"available\":\"1\",\"bind\":0,\"info\":\"\",\"notes\":\"\",\"price\":\"\",\"promo\":\"\",\"status\":\"booked\"},\"2016-09-13\":{\"available\":\"1\",\"bind\":0,\"info\":\"\",\"notes\":\"\",\"price\":\"\",\"promo\":\"\",\"status\":\"booked\"},\"2016-09-14\":{\"available\":\"1\",\"bind\":0,\"info\":\"\",\"notes\":\"\",\"price\":\"\",\"promo\":\"\",\"status\":\"booked\"},\"2016-09-20\":{\"available\":\"1\",\"bind\":0,\"info\":\"\",\"notes\":\"\",\"price\":\"\",\"promo\":\"\",\"status\":\"booked\"},\"2016-09-21\":{\"available\":\"1\",\"bind\":0,\"info\":\"\",\"notes\":\"\",\"price\":\"\",\"promo\":\"\",\"status\":\"booked\"},\"2016-09-22\":{\"available\":\"1\",\"bind\":0,\"info\":\"\",\"notes\":\"\",\"price\":\"\",\"promo\":\"\",\"status\":\"booked\"},\"2016-09-23\":{\"available\":\"1\",\"bind\":0,\"info\":\"\",\"notes\":\"\",\"price\":\"\",\"promo\":\"\",\"status\":\"booked\"},\"2016-09-24\":{\"available\":\"1\",\"bind\":0,\"info\":\"\",\"notes\":\"\",\"price\":\"\",\"promo\":\"\",\"status\":\"booked\"},\"2016-09-25\":{\"available\":\"1\",\"bind\":0,\"info\":\"\",\"notes\":\"\",\"price\":\"\",\"promo\":\"\",\"status\":\"booked\"},\"2016-09-26\":{\"available\":\"1\",\"bind\":0,\"info\":\"\",\"notes\":\"\",\"price\":\"\",\"promo\":\"\",\"status\":\"booked\"},\"2016-09-27\":{\"available\":\"1\",\"bind\":0,\"info\":\"\",\"notes\":\"\",\"price\":\"\",\"promo\":\"\",\"status\":\"booked\"},\"2016-09-28\":{\"available\":\"1\",\"bind\":0,\"info\":\"\",\"notes\":\"\",\"price\":\"\",\"promo\":\"\",\"status\":\"booked\"}}");INSERT INTO schedule VALUES("2","");INSERT INTO schedule VALUES("3","");INSERT INTO schedule VALUES("4","");INSERT INTO schedule VALUES("11","");INSERT INTO schedule VALUES("12","");INSERT INTO schedule VALUES("14","{\"1970-01-01\":{\"available\":\"1\",\"bind\":0,\"info\":\"\",\"notes\":\"\",\"price\":\"200\",\"promo\":\"\",\"status\":\"available\"}}");INSERT INTO schedule VALUES("15","");INSERT INTO schedule VALUES("16","");INSERT INTO schedule VALUES("17","{\"1970-01-01\":{\"available\":\"1\",\"bind\":0,\"info\":\"\",\"notes\":\"\",\"price\":\"200\",\"promo\":\"\",\"status\":\"available\"}}");INSERT INTO schedule VALUES("18","{\"1970-01-01\":{\"available\":\"1\",\"bind\":0,\"info\":\"\",\"notes\":\"\",\"price\":\"200\",\"promo\":\"\",\"status\":\"available\"}}");INSERT INTO schedule VALUES("19","");INSERT INTO schedule VALUES("20","");INSERT INTO schedule VALUES("21","");INSERT INTO schedule VALUES("22","");INSERT INTO schedule VALUES("23","");INSERT INTO schedule VALUES("24","");INSERT INTO schedule VALUES("25","");INSERT INTO schedule VALUES("26","");