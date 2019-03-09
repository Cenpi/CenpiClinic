<?php

$loader = new \Phalcon\Loader();

$loader->registerNamespaces([
    "PHPMailer\PHPMailer" => $config->application->libraryDir . 'PHPMailer/'
]);

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs(
    [
        $config->application->controllersDir,
        $config->application->modelsDir
    ]
)->register();
