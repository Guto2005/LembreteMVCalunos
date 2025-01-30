<?php

require_once __DIR__ . "/vendor/autoload.php";

use Docarley\Lembretemvc\Core\Router;

header("Content-type: application/json");
var_dump($_GET);



$router = new Router();



