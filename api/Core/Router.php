<?php

namespace Docarley\Lembretemvc\Core;

class Router{

    private $controller;

    private $method;

    private $controllerMethod;

    private $params = [];

    function __construct(){
        
        $url = $this->parseURL();

        print_r($url);
        print_r($GLOBALS['api-base']);

        if(file_exists($GLOBALS['api-base']. ucfirst($url[2]) ."Controller.php")){
            $this->controller = $url[2];
            print_r($url[2]);
            unset($url[2]);

        }elseif(empty($url[2])){
            echo "Bem vindo à Lembrete API MVC - Versão 1.0.0 ";
            exit;

        }else{
            http_response_code(404);
            echo json_encode(["erro" => "Recurso não encontrado"],JSON_UNESCAPED_UNICODE);
            exit;
        }

        require_once "../App/Controllers/" . ucfirst($this->controller) . ".php";

        $this->controller = new $this->controller;

        $this->method = $_SERVER["REQUEST_METHOD"];

        switch($this->method){
            case "GET":

                if(isset($url[2])){
                    $this->controllerMethod = "find";
                    $this->params = [$url[2]];
                }else{
                    $this->controllerMethod = "index";
                }
                
                break;

            case "POST":
                $this->controllerMethod = "store";
                break;

            case "PUT":
                $this->controllerMethod = "update";
                if(isset($url[2]) && is_numeric($url[2])){
                    $this->params = [$url[2]];
                }else{
                    http_response_code(400);
                    echo json_encode(["erro" => "É necessário informar um id"]);
                    exit;
                }
                break;

            case "DELETE":
                $this->controllerMethod = "delete";
                if(isset($url[2]) && is_numeric($url[2])){
                    $this->params = [$url[2]];
                }else{
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

    private function parseURL(){
        return explode("/", $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
    }

}