<?php

class Categoria extends Validator
{   
    // Declaraion de propiedades
    private $codi_cate = null;
    private $nomb_cate = null;
    private $esta_cate = null;

    // Encapsulamiento de codigo de categoria
    public function setCodiCate($value)
    {
        //validando de que el valor sea un id
        if ($this->validateId($value)) {
            //seteando valor a la variable codigo
            $this->codi_cate = $value;
            //retornar true
            return true;
        } else {
            //retornar respuesta falso
            return false;
        }
    }

    public function getCodiCate($value)
    {
        //retornar el valor del codigo de categoria
        return $this->codi_cate;
    }
    //Encapsulamiento de nombre de categoria
    public function setNombCate($value)
    {
        //validando de que el valor sea alfabetico y que sea mayor a uno y menor a cien
        if ($this->validateAlphabetic($value, 1, 100)) {
            //seteando valor a la variable de nombre de categoria
            $this->nomb_cate = $value;
            //retornando respuesta true
            return true;
        } else {
            //retornando respuesta false
            return false;
        }
    }

    public function getNombCate()
    {
        return $this->nomb_cate;
    }
    //Encapsulamiento de estado de categoria
    public function setEstaCate($value)
    {
        $this->esta_cate = $value;
        return true;
    }

    public function getEstaCate($value)
    {
        return $this->esta_cate;
    }

    //FUNCIONES DEL CRUD
    //Funcion para crear categoria
    public function createCategoria()
    {
        $sql    = "INSERT INTO categoria(nomb_cate, esta_cate) VALUES (?, 1)";
        $params = array($this->nomb_cate);
        return Database::executeRow($sql, $params);
    }
    //Funcion para obtener lista de registros de la tabla categoria sin json
    public function getCategoriasN($codiCasa)
    {
        $sql    = "SELECT c.codi_cate, c.nomb_cate FROM presupuesto_detalle as pd INNER JOIN presupuesto as p ON p.codi_pres=pd.codi_pres INNER JOIN categoria as c ON c.codi_cate=pd.codi_cate WHERE c.esta_cate=1 AND p.codi_casa=? ORDER BY c.codi_cate";
        $params = array($codiCasa);
        return Database::getRows($sql, $params);
    }
    //Funcion para obtener lista de registros en la tabla categoria
    public function getCategorias()
    {
        $sql    = "SELECT codi_cate, nomb_cate, esta_cate FROM categoria WHERE esta_cate=1 ORDER BY codi_cate";
        $params = array(null);
        return Database::getRowsAjax($sql, $params);
    }

    //Funcion para modificar tanto el nombre o el estado un registro de la tabla categoria
    public function updateCategoria()
    {
        $sql    = "UPDATE categoria SET nomb_cate = ?, esta_cate = ? WHERE codi_cate = ?";
        $params = array($this->nomb_cate, $this->esta_cate, $this->codi_cate);
        return Database::executeRow($sql, $params);
    }
}