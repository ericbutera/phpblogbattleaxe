<?php
ob_start();
error_reporting( E_ALL | E_STRICT );
ini_set('memory_limit', -1);
date_default_timezone_set('GMT');

/*
 * Determine the root, library, tests, and models directories
 */
$cwd            = dirname(__FILE__);
$root           = realpath($cwd . '/../');

/*
$library        = $root . '/library';
$tests          = $root . '/tests';
$domain         = $root . '/domain';
$controllers    = $root . '/domain/controllers';

$path = array(
    $domain,
    $library,
    $tests,
    get_include_path()
);
set_include_path(implode(PATH_SEPARATOR, $path));
*/

require_once $root .'/library/baxe/Autoload.php';
$loader = new baxe_Autoload($root);
$loader->register();
