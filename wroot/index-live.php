<?php
require '/home/www-data/eric/lib/generated/battleaxe.php';
require '/home/www-data/eric/lib/generated/domain.php';
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
