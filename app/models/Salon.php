<?php

class Salon extends Validator
{   
    // Declaraion de propiedades
    private $codi_salo = null;
    private $codi_casa = null;
    private $nomb_salo = null;
    private $esta_doce = null;

    // Encapsulamiento de codigo de categoria
    public function setCodiSalo($value)
    {
        //validando de que el valor sea un id
        if ($this->validateId($value)) {
            //seteando valor a la variable codigo
            $this->codi_salo = $value;
            //retornar true
            return true;
        } else {
            //retornar respuesta falso
            return false;
        }
    }

    public function getCodiSalo($value)
    {
        //retornar el valor del codigo de categoria
        return $this->codi_salo;
    }

    public function setCodiCasa($value)
    {
        //validando de que el valor sea un id
        if ($this->validateId($value)) {
            //seteando valor a la variable codigo
            $this->codi_casa = $value;
            //retornar true
            return true;
        } else {
            //retornar respuesta falso
            return false;
        }
    }

    public function getCodiCasa($value)
    {
        //retornar el valor del codigo de categoria
        return $this->codi_casa;
    }
    //Encapsulamiento de nombre de categoria
    public function setNombSalo($value)
    {
        //validando de que el valor sea alfabetico y que sea mayor a uno y menor a cien
        if ($this->validateAlphanumeric($value, 1, 100)) {
            //seteando valor a la variable de nombre de categoria
            $this->nomb_salo = $value;
            //retornando respuesta true
            return true;
        } else {
            //retornando respuesta false
            return false;
        }
    }

    public function getNombSalo()
    {
        return $this->nomb_salo;
    }

    //Encapsulamiento de estado de categoria
    public function setEstaSalo($value)
    {
        $this->esta_salo = $value;
        return true;
    }

    public function getEstaSalo($value)
    {
        return $this->esta_salo;
    }

    //FUNCIONES DEL CRUD
    //Funcion para crear categoria
    public function createSalon()
    {
        $sql    = "INSERT INTO salon(codi_casa,nomb_salo,esta_salo) VALUES (?,?,1)";
        $params = array($this->codi_casa,$this->nomb_salo);
        return Database::executeRow($sql, $params);
    }
    //Funcion para obtener lista de registros de la tabla categoria sin json
    public function getSalonesN()
    {
        $sql    = "SELECT codi_salo, nomb_salo FROM salon WHERE esta_salo = 1 AND codi_casa = ? ORDER BY codi_salo";
        $params = array($this->codi_casa);
        return Database::getRows($sql, $params);
    }
    //Funcion para obtener lista de registros en la tabla categoria
    public function getSalones()
    {
        $sql    = "SELECT codi_salo, nomb_salo FROM salon WHERE esta_salo=1 AND codi_casa=? ORDER BY codi_salo";
        $params = array($this->codi_casa);
        return Database::getRowsAjax($sql, $params);
    }

    //Funcion para modificar tanto el nombre o el estado un registro de la tabla categoria
    public function updateSalon()
    {
        $sql    = "UPDATE salon SET nomb_salo = ? WHERE codi_salo = ?";
        $params = array($this->nomb_salo, $this->codi_salo);
        return Database::executeRow($sql, $params);
    }
    public function deleteSalon()
    {
        $sql    = "UPDATE salon SET esta_salo = 0 WHERE codi_salo = ?";
        $params = array($this->codi_salo);
        return Database::executeRow($sql, $params);
    }
}