<?php

class Etiqueta extends Validator
{   
    // Declaraion de propiedades
    private $codi_etiq = null;
    private $nomb_etiq = null;
    private $esta_etiq = null;

    // Encapsulamiento de codigo de categoria
    public function setCodiEtiq($value)
    {
        //validando de que el valor sea un id
        if ($this->validateId($value)) {
            //seteando valor a la variable codigo
            $this->codi_etiq = $value;
            //retornar true
            return true;
        } else {
            //retornar respuesta falso
            return false;
        }
    }

    public function getCodiEtiq($value)
    {
        //retornar el valor del codigo de categoria
        return $this->codi_etiq;
    }
    //Encapsulamiento de nombre de categoria
    public function setNombEtiq($value)
    {
        //validando de que el valor sea alfabetico y que sea mayor a uno y menor a cien
        if ($this->validateAlphanumeric($value, 1, 100)) {
            //seteando valor a la variable de nombre de categoria
            $this->nomb_etiq = $value;
            //retornando respuesta true
            return true;
        } else {
            //retornando respuesta false
            return false;
        }
    }

    public function getNombEtiq()
    {
        return $this->nomb_etiq;
    }
    //Encapsulamiento de estado de categoria
    public function setEstaEtiq($value)
    {
        $this->esta_etiq = $value;
        return true;
    }

    public function getEstaEtiq()
    {
        return $this->esta_etiq;
    }

    //FUNCIONES DEL CRUD
    //Funcion para crear categoria
    public function createEtiqueta()
    {
        $sql    = "INSERT INTO etiqueta(nomb_etiq) VALUES (?)";
        $params = array($this->nomb_etiq);
        return Database::executeRow($sql, $params);
    }
    //Funcion para obtener lista de registros de la tabla categoria sin json
    public function getEtiquetasT()
    {
        $sql    = "SELECT codi_etiq, nomb_etiq FROM etiqueta WHERE esta_etiq=1";
        $params = array(null);
        return Database::getRows($sql, $params);
    }
    public function getEtiquetasN($codi)
    {
        $sql    = "SELECT codi_etiq, nomb_etiq FROM etiqueta WHERE esta_etiq=1 AND codi_etiq!=?";
        $params = array($codi);
        return Database::getRows($sql, $params);
    }
    //Funcion para obtener lista de registros en la tabla categoria
    public function getEtiquetas()
    {
        $sql    = "SELECT codi_etiq, nomb_etiq, esta_etiq FROM etiqueta WHERE esta_etiq=1";
        $params = array(null);
        return Database::getRowsAjax($sql, $params);
    }
    //Funcion para modificar tanto el nombre o el estado un registro de la tabla categoria
    public function updateEtiqueta()
    {
        $sql    = "UPDATE etiqueta SET nomb_etiq = ? WHERE codi_etiq = ?";
        $params = array($this->nomb_etiq, $this->codi_etiq);
        return Database::executeRow($sql, $params);
    }
    public function deleteEtiqueta()
    {
        $sql    = "UPDATE etiqueta SET esta_etiq = 0 WHERE codi_etiq = ?";
        $params = array($this->codi_etiq);
        return Database::executeRow($sql, $params);
    }
    public function updateContactosEtiqueta($nuevEtiq)
    {
        $sql    = "UPDATE contacto SET codi_etiq = ? WHERE codi_etiq = ?";
        $params = array($nuevEtiq, $this->codi_etiq);
        return Database::executeRow($sql, $params);
    }
}