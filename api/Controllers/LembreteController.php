<?php

namespace Docarley\Lembretemvc\Controllers;

use Docarley\Lembretemvc\Core\Controller;

class LembreteController extends Controller{

    public function index(){
        echo json_encode(["Message"=>"Todos os Lembretes"],JSON_UNESCAPED_UNICODE);
    }

    public function getLembretes(int $id){
        echo json_encode(["Testando"=>"id passado" . $id],JSON_UNESCAPED_UNICODE);
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

}