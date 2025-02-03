<?php

namespace Docarley\Lembretemvc\Controllers;

use Docarley\Lembretemvc\Core\Controller;

class LembreteController extends Controller{

    public function index(){
        echo json_encode(["Message"=>"Hello"],JSON_UNESCAPED_UNICODE);
    }

    public function getAll(int $id){
        echo json_encode(["TODOS"=>"oiaaaaaaaaaaaaaaaaaa" . $id],JSON_UNESCAPED_UNICODE);
    }

}