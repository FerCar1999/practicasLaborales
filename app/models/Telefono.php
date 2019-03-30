<?php

class Telefono extends Validator
{   
    // Declaraion de propiedades
    private $codi_tele = null;
    private $codi_casa = null;
    private $codi_tipo_tele = null;
    private $nume_tele = null;
    private $esta_tele = null;

    // Encapsulamiento de codigo de categoria
    public function setCodiTele($value)
    {
        //validando de que el valor sea un id
        if ($this->validateId($value)) {
            //seteando valor a la variable codigo
            $this->codi_tele = $value;
            //retornar true
            return true;
        } else {
            //retornar respuesta falso
            return false;
        }
    }

    public function getCodiTele($value)
    {
        //retornar el valor del codigo de categoria
        return $this->codi_tele;
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
    public function setCodiTipoTele($value)
    {
        //validando de que el valor sea alfabetico y que sea mayor a uno y menor a cien
        if ($this->validateId($value)) {
            //seteando valor a la variable de nombre de categoria
            $this->codi_tipo_tele = $value;
            //retornando respuesta true
            return true;
        } else {
            //retornando respuesta false
            return false;
        }
    }

    public function getCodiTipoTele()
    {
        return $this->codi_tipo_tele;
    }

    public function setNumeTele($value)
    {
        //validando de que el valor sea alfabetico y que sea mayor a uno y menor a cien
        if ($this->validateTelefono($value)) {
            //seteando valor a la variable de nombre de categoria
            $this->nume_tele = $value;
            //retornando respuesta true
            return true;
        } else {
            //retornando respuesta false
            return false;
        }
    }

    public function getNumeTele()
    {
        return $this->nume_tele;
    }
    //Encapsulamiento de estado de categoria
    public function setEstaTele($value)
    {
        $this->esta_tele = $value;
        return true;
    }

    public function getEstaTele($value)
    {
        return $this->esta_tele;
    }

    //FUNCIONES DEL CRUD
    //Funcion para crear categoria
    public function createTelefono()
    {
        $sql    = "INSERT INTO telefono(codi_casa,codi_tipo_tele,nume_tele,esta_tele) VALUES (?,?,?,1)";
        $params = array($this->codi_casa,$this->codi_tipo_tele,$this->nume_tele);
        return Database::executeRow($sql, $params);
    }
    //Funcion para obtener lista de registros en la tabla categoria
    public function getTelefonos()
    {
        $sql    = "SELECT t.codi_tele, t.codi_tipo_tele, tt.nomb_tipo_tele,t.nume_tele FROM telefono as t INNER JOIN tipo_telefono as tt USING(codi_tipo_tele) WHERE t.esta_tele=1 AND t.codi_casa=? ORDER BY t.codi_tele";
        $params = array($this->codi_casa);
        return Database::getRowsAjax($sql, $params);
    }

    //Funcion para modificar tanto el nombre o el estado un registro de la tabla categoria
    public function updateTelefono()
    {
        $sql    = "UPDATE telefono SET codi_tipo_tele = ?, nume_tele = ? WHERE codi_tele = ?";
        $params = array($this->codi_tipo_tele, $this->nume_tele, $this->codi_tele);
        return Database::executeRow($sql, $params);
    }
    public function deleteTelefono()
    {
        $sql    = "UPDATE telefono SET esta_tele = 0 WHERE codi_tele = ?";
        $params = array($this->codi_tele);
        return Database::executeRow($sql, $params);
    }
}