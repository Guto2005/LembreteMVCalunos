<?php

namespace Docarley\Lembretemvc\Core;

class Controller{

    public function model($model){
        // require_once $GLOBALS['api-base'] . "/Model/" . $model . ".php";
        $newModel = "\Docarley\Lembretemvc\Models\\" . $model;
        return new $newModel;
    }

    protected function getRequestBody(){
        $json = file_get_contents("php://input");
        $obj = json_decode($json);
    
        return $obj;
      }

}