<?php

require 'vendor/autoload.php';

ini_set('error_reporting', 1);
ini_set('display_errors', 1);
error_reporting(E_ALL);

$lMain = new ConfigGenerator\ConfigGenerator();
echo $lMain->run();

require 'vendor/autoload.php';