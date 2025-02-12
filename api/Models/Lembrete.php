<?php
 
namespace Docarley\Lembretemvc\Models;

use Docarley\Lembretemvc\Core\Model;
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
}