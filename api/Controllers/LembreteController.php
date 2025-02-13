<?php

namespace Docarley\Lembretemvc\Controllers;

use Docarley\Lembretemvc\Core\Controller;

class LembreteController extends Controller{

    public function index(){
        $lembreteModel = $this->model("Lembrete");

        if (!$lembreteModel) {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao carregar o modelo Lembrete"], JSON_UNESCAPED_UNICODE);
            return;
        }

        $lembretes = $lembreteModel->buscarTodos();
        
        if (isset($lembretes["error"])) {
            http_response_code(500);
        } else {
            http_response_code(200);
        }

        echo json_encode($lembretes, JSON_UNESCAPED_UNICODE);
    }

    public function getLembrete(int $id){
        $lembreteBuscado = $this->model("Lembrete");
        $resultado=$lembreteBuscado->buscarPorId($id);
        if (isset($resultado["error"])) {
            http_response_code(500);
            echo json_encode($resultado,JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(200);
            echo json_encode($resultado,true);
        }
    }


    public function store(){
       $dadosLembrete = $this->getRequestBody();
       $novoLembrete = $this->model("Lembrete");

       if (isset($dadosLembrete->titulo) && isset($dadosLembrete->corpo)) {
        $novoLembrete->setTitulo($dadosLembrete->titulo);
        $novoLembrete->setCorpo($dadosLembrete->corpo);
    }

    $resultado = $novoLembrete->inserir();

    if (isset($resultado["error"])) {
        http_response_code(500);
        echo json_encode($resultado,JSON_UNESCAPED_UNICODE);
    } else {
        http_response_code(200);
        echo json_encode($resultado,true);
    }

    }

    public function delete($id){
       
        $lembrete = $this->model("Lembrete");      
        $resultado = $lembrete->excluir($id);
        if (isset($resultado["error"])) {
            http_response_code(500);
            echo json_encode($resultado,JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(200);
            echo json_encode($resultado,true);
        }  
    }

}