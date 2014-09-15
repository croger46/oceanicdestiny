<?php

/*
 * Baseline
 * by Johnathan Tiong (c) 2014
 * ---------------------------
 * v1.0 - 30th august, 2014
 */

// you can change this to your local timezone
date_default_timezone_set('Australia/Sydney');

session_start();

// error logging
ini_set('log_errors', 1);
ini_set('error_log', 'error.log');

error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT); // comment out to stop error reporting to browser

// critical, required files!
define('ROOT',dirname(__FILE__));

require(ROOT.'/vendor/autoload.php');
(@include_once(ROOT.'/config.php')) or die("config.php required, please copy default.config.php to config.php and edit as required");

// RedBeanPHP
R::setup($settings['db']['type'].':host='.$settings['db']['host'].';dbname='.$settings['db']['name'], $settings['db']['user'], $settings['db']['pass']);

// Mustache Templating Engine
$m = new Mustache_Engine([
  'loader' => new Mustache_Loader_FilesystemLoader(ROOT.'/app/views'),
  'partials_loader' => new Mustache_Loader_FilesystemLoader(ROOT.'/app/views/partials')
]);

$base = new Baseline();

// Routing
include(ROOT.'/routes/routes.php');

R::close();

?>