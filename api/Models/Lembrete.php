<?php
 
namespace Docarley\Lembretemvc\Models;

use Docarley\Lembretemvc\Core\Model;

use \Pdo;
class Lembrete{
 
    private ?int $id;
    private ?string $titulo;
    private ?string $corpo;
 
 
    public function __construct(){
 
    }
 
    /**
     * Get the value of titulo
     */
    public function getTitulo()
    {
        return $this->titulo;
    }
 
    /**
     * Get the value of corpo
     */
    public function getCorpo()
    {
        return $this->corpo;
    }
 
    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId(int $id = null)
    {
        $this->id = $id;
 
        return $this;
    }
 
    /**
     * Set the value of titulo
     *
     * @return  self
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
 
        return $this;
    }
    /**
     * Set the value of corpo
     *
     * @return  self
     */
    public function setCorpo($corpo)
    {
        $this->corpo = $corpo;
 
        return $this;
    }
 
    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    public function inserir(){
        if (isset($this->titulo) && isset($this->corpo)) {
 
            try {
                $sql ="INSERT INTO lembrete (tituloLembrete,corpoLembrete) VALUES (:titulo,:corpo)";
                $stmt=Model::getConn()->prepare($sql);
                $stmt->bindValue(':titulo', $this->getTitulo());
                $stmt->bindValue(':corpo', $this->getCorpo());
                $stmt->execute();
                $this->setId(Model::getConn()->lastInsertId());   
                return (array) $this;
                
            } catch (\Throwable $th) {
                $array['error'] = "Erro: " . $th->getMessage();
                return $array;
            }
        } else {
            $array['error'] = 'Erro: Valores nulos ou inválidos!';
            return $array;
        }
    }
    public function buscarPorId($id) {
        $id = filter_var($id, FILTER_VALIDATE_INT) ? $id : 0;
        if (isset($id) && $id) {
            $sql = "SELECT * FROM lembrete WHERE idLembrete=:id";
            $stmt = Model::getConn()->prepare($sql);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $dadosDoLembrete = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->setId($dadosDoLembrete['idLembrete']);
                $this->setTitulo($dadosDoLembrete['tituloLembrete']);
                $this->setCorpo($dadosDoLembrete['corpoLembrete']);
                return (array) $this;
            } else {
                $array['error'] = 'Erro: Não há lembretes com este id!';
                return $array;
            }
        } else {
            $array['error'] = 'Erro: Valores nulos ou inválidos!';
            return $array;
        }
    }

    public function buscarTodos() {
        try {
            $sql = "SELECT * FROM lembrete";
            $stmt = Model::getConn()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            return ['error' => "Erro: " . $th->getMessage()];
        }
    }

    public function excluir($id){
        $resultado = $this->buscarPorId($id);
        if(!isset($resultado['error'])){
              try {
                $sql = "DELETE FROM Lembrete WHERE idLembrete=:id";
                $stmt = Model::getConn()->prepare($sql);                    
                $stmt->bindValue(":id", $id);
                $stmt->execute();
                return $resultado;
            } catch (\Throwable $th) {
                $array['error'] = "Erro: " . $th->getMessage();
                return $array;
            }
        }
        return $resultado;
    }
}