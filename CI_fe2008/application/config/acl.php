<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| ACL
| -------------------------------------------------------------------
| This file specifies the configuration of the ACL (Access Control List).
|
| Here we can configure the mode of the ACL system, to operate with
| a database or explicit (with arrays).
| Please take care with the order of the definition, first the roles,
| second the resources and last the rules. It's very important mantain 
| this order because if you don't have roles and resources you can define
| rules.
|
| -------------------------------------------------------------------
| Instructions
| -------------------------------------------------------------------

---------------------------------------------------------------------
EXPLICIT MODE:
---------------------------------------------------------------------
Those lines you can use if you try to work in "explicit" mode:

	$type="explicit"; 		//type of ACL config
	$default="users/login"; //default forward path
	$public_functions=array('publica','movil','wap'); //Define the public functions 
	$default_rol='Visitors';
	
	//Define the roles 
	// * (name => array(name,parent_id))
	$data['roles'] = array(
						1 =>array('name'=>'Visitors','parent'=>0),
						2 =>array('name'=>'Users','parent'=>1),
						3 =>array('name'=>'Administrators','parent'=>2),
						4 =>array('name'=>'Gods','parent'=>3)
						);
	
	//Define the resources 
	// * (id => array(controller,function)
	$data['resources'] = array(
						1 =>array('welcome','test'),
						2 =>array('users','all'),
						3 =>array('resources','all'),
						4 =>array('rules','all'),
						5 =>array('roles','all'),
						6 =>array('users','login')
						);
						
	//Define the rules
	// * array(resource_id,allow/denied,role_id,forward)
	$data['rules'] = array(
						array(6,'allow',1,'default'),
					  	array(2,'allow',3,'default'),
						array(3,'allow',3,'default'),
						array(4,'allow',3,'default'),
						array(5,'allow',3,'default'),
						array(1,'allow',1,'default'),
						);
						
	//Define the users
	// * array(first_name,last_name,nick,role_id,password)
	$data['users'] = array(
						array('first_name','last_name','nick',2,'password'),
						array('Christian','Andrade','cadwmaster',4,'clave01'),
						array('Rodrigo','Alvarez','ralvarez',3,'clave01')
						);

---------------------------------------------------------------------
DATABASE MODE:
---------------------------------------------------------------------

Those lines you can use if you try to work in "database" mode:

	$type="database";					//type of ACL config
	$default="users/login"; 			//default forward path
	$public_functions=array('publica','movil','wap'); //Define the public functions 
	$default_rol='Visitors';
	
	$data['db_users'] = 	array(	'table_name'=>'usuarios',
									'data'=>array(	'user'=>'nick',
													'password'=>'password',
													'last_login'=>'last_login',
													'counter'=>'counter',
													'active'=>'active',
													'role_id' =>'role_id' ));
						
	$data['db_roles'] = 	array(	'table_name'=>'roles',
									'data'=>array(	'name'=>'name',
													'parent'=>'parent'));

	$data['db_resources'] = array(	'table_name'=>'resources',
									'data'=>array(	'name'=>'name',
													'controller'=>'controller',
													'function'=>'function'));

	$data['db_rules'] = 	array(	'table_name'=>'rules',
									'data'=>array(	'name'=>'name',
													'resource_id'=>'resource_id',
													'role_id'=>'role_id',
													'permission'=>'permission',
													'forward'=>'forward',
													'order'=>'order'));
	
---------------------------------------------------------------------
MYSQL SCRIPT:
---------------------------------------------------------------------

DROP TABLE IF EXISTS `resources`;
CREATE TABLE  `resources` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(200) NOT NULL,
  `controller` varchar(200) NOT NULL,
  `function` varchar(400) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `resources` WRITE;
INSERT INTO `resources` VALUES  (1,'users_all','users','all'),
 (2,'resources_all','resources','all'),
 (3,'roles_all','roles','all'),
 (4,'rules_all','rules','all'),
 (5,'welcome_test','welcome','test');
UNLOCK TABLES;

DROP TABLE IF EXISTS `roles`;
CREATE TABLE  `roles` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(64) NOT NULL,
  `parent` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `roles` WRITE;
INSERT INTO `roles` VALUES  (1,'Visitors',NULL),
 (2,'Users',1),
 (3,'Writers',2),
 (4,'Administrators',3),
 (5,'Gods',4);
UNLOCK TABLES;

DROP TABLE IF EXISTS `rules`;
CREATE TABLE  `rules` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(256) character set latin1 NOT NULL COMMENT 'Rule description',
  `resource_id` int(11) NOT NULL,
  `role_id` int(10) unsigned NOT NULL default '0',
  `order` int(10) unsigned default NULL,
  `permission` enum('Deny','Allow') collate utf8_unicode_ci NOT NULL default 'Deny',
  `forward` varchar(64) collate utf8_unicode_ci NOT NULL,
  `message` varchar(512) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_role_rule` (`role_id`),
  KEY `fk_resource_rule` (`resource_id`),
  CONSTRAINT `fk_resource_rule` FOREIGN KEY (`resource_id`) REFERENCES `resources` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `users`;
CREATE TABLE  `users` (
  `id` int(11) NOT NULL auto_increment,
  `role_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `nick` varchar(50) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime default NULL,
  `password` varchar(50) NOT NULL,
  `counter` int(11) NOT NULL default '0',
  `active` int(1) NOT NULL default '0',
  `last_login` datetime default NULL,
  `sex` varchar(1) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_role` (`role_id`),
  CONSTRAINT `fk_roles_users` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

*/


$type="database";
$default="usuarios/login"; 			
$public_functions=array('publica','movil','wap');
$default_rol='Visitantes';

$data['db_users'] = 	array(	'table_name'=>'users',
									'data'=>array(	'user'=>'nick',
													'password'=>'password',
													'last_login'=>'last_login',
													'active'=>'active',
													'role_id' =>'role_id' ));
						
$data['db_roles'] = 	array(	'table_name'=>'roles',
								'data'=>array(	'name'=>'name',
												'parent'=>'parent'));

$data['db_resources'] = array(	'table_name'=>'resources',
								'data'=>array(	'name'=>'name',
												'controller'=>'controller',
												'function'=>'function'));

$data['db_rules'] = 	array(	'table_name'=>'rules',
								'data'=>array(	'name'=>'name',
												'resource_id'=>'resource_id',
												'role_id'=>'role_id',
												'permission'=>'permission',
												'forward'=>'forward',
												'order'=>'order'));




/* End of file cizendacl.php */
/* Location: ./system/application/config/cizendacl.php */