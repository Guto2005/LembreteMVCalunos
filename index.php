<?php

require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/api/config/config.php";

use Docarley\Lembretemvc\Core\Router;

header("Content-type: application/json");
var_dump($_GET);



$router = new Router();



