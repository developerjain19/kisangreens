<?php
defined('BASEPATH') or exit('No direct script access allowed');


$active_group = 'local';
$query_builder = TRUE;

$db['local'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',
	'username' => 'root',
	'password' => '',
	'database' => 'kisan_greens',
	'dbdriver' => 'mysqli',
	'dbprefix' => 'tbl_',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',
	'username' => 'aadarmim_Muskan',
	'password' => 'Muskan@2022',
	'database' => 'aadargld_kisangreens',
	'dbdriver' => 'mysqli',
	'dbprefix' => 'tbl_',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
