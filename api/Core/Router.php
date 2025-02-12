<?php

namespace Docarley\Lembretemvc\Core;
class Router
{


    private $controller;

    private $method;

    private $controllerMethod;

    private $params = [];

    function __construct()
    {


        $url = $this->parseURL();

        // print_r($url);
        // print_r($GLOBALS['api-base'] . ucfirst($url[2]) . "Controller.php");

        if (file_exists($GLOBALS['api-base'] . ucfirst($url[2]) . "Controller.php")) {
            $this->controller = ucfirst($url[2]) . "Controller";                   
            unset($url[2]);
        } elseif (empty($url[2])) {
            echo "Bem vindo à Lembrete API MVC - Versão 1.0.0 ";
            exit;
        } else {
            http_response_code(404);
            echo json_encode(["erro" => "Recurso não encontrado"], JSON_UNESCAPED_UNICODE);
            exit;
        }
        $this->controller = "\Docarley\Lembretemvc\Controllers\\" . $this->controller;       

        $this->controller = new $this->controller;

        $this->method = $_SERVER["REQUEST_METHOD"];

        switch ($this->method) {
            case "GET":

                if (isset($url[4])) {
                    $this->controllerMethod = "getLembretes";                 
                    $this->params = [$url[4]]; 
                } else {
                    $this->controllerMethod = "index";
                }
                break;

            case "POST":
                $this->controllerMethod = "store";
                break;

            case "PUT":
                $this->controllerMethod = "update";
                if (isset($url[4]) && is_numeric($url[4])) {
                    $this->params = [$url[4]];
                } else {
                    http_response_code(400);
                    echo json_encode(["erro" => "É necessário informar um id"]);
                    exit;
                }
                break;

            case "DELETE":
                $this->controllerMethod = "delete";
                if (isset($url[4]) && is_numeric($url[4])) {
                    $this->params = [$url[4]];
                } else {
                    http_response_code(400);
                    echo json_encode(["erro" => "É necessário informar um id"]);
                    exit;
                }
                break;

            default:
                echo "Método não suportado";
                exit;
        }

        call_user_func_array([$this->controller, $this->controllerMethod], $this->params);
    }

    private function parseURL()
    {
        return explode("/", $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
    }
}
