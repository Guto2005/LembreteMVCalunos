<?php

namespace Docarley\Lembretemvc\Model;
class Lembrete{

    private ?int $id;
    private string $titulo;
    private string $corpo;


    public function __construct(int $pId = null, string $pTitulo, string $pCorpo){
        $this->setId($pId);
        $this->setTitulo($pTitulo);
        $this->setCorpo($pCorpo);
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
}