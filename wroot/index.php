<?php
//
// development mode
//

require_once '../lib/library/baxe/Autoload.php';
$loader = new baxe_Autoload( dirname(dirname(__FILE__))."/lib" );
$loader->register();
$config = new baxe_Config($_SERVER['APPCONFIGFILE'], $_SERVER['APPSTATE']);
baxe_App::setInstance(new baxe_App_Web($config))
    ->run(isset($_GET['baxeroute']) ? $_GET['baxeroute'] : "/");


/*
require '/home/eric/Sites/ericbuteraphp/lib/generated/battleaxe.php'; // all in one package
require '/home/eric/Sites/ericbuteraphp/lib/generated/domain.php'; // all in one domain
//require_once '/home/eric/web/ericbutera/lib/library/baxe/battleaxe.php';
if (!$loader = apc_fetch('loader')) {
    $basePath = dirname(dirname(__FILE__))."/lib";
    $loader = new baxe_Autoload($basePath);
    apc_store('loader', $loader);
}
$loader->registerApplication();
if (!$app = apc_fetch('app')) {
    $config = new baxe_Config($_SERVER['APPCONFIGFILE'], $_SERVER['APPSTATE']);
    $app = new baxe_App_Web($config);
    apc_store('app', $app);
}

baxe_App::setInstance($app)
    ->run(isset($_GET['baxeroute']) ? $_GET['baxeroute'] : "/");
*/
