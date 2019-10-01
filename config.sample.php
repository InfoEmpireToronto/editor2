<?php
$config['DBUG'] = TRUE;

$config['dbServer'] = 'localhost';
$config['db'] = 'editor2';
$config['dbUser'] = '';
$config['dbPass'] = '';

$config['importOnLaunch'] = FALSE;
$config['client'] = 0;

$config['enable_categories'] = FALSE;

$config['SiteURL'] = 'http://localhost';
$config['AppLocation'] = '/editor/';
$config['AppURL'] = $config['SiteURL'].$config['AppLocation'];

$config['login'] = 'admin';
$config['password'] = 'admin';

$config['sitemap'] = '../sitemap.xml';
$config['articlePrefix'] = 'blog-';


if($config['DBUG'])
{
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
}

?>