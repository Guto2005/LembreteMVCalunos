<?php

namespace Docarley\Lembretemvc\Core;
use PDO;
class Model {
 
    private static $conexao;

    public static function getConn(){

        if(!isset(self::$conexao)){
            self::$conexao = new PDO('mysql:host='.$GLOBALS['db_servidor'].';dbname='.$GLOBALS['db_database'],$GLOBALS['db_usuario'],$GLOBALS['db_pwd'] );
        }

        return self::$conexao;
    }

}