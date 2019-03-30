<?php

class TipoTelefono extends Validator
{   
    // Declaraion de propiedades
    private $codi_tipo_tele = null;
    private $nomb_tipo_tele = null;
    private $esta_tipo_tele = null;

    // Encapsulamiento de codigo de categoria
    public function setCodiTipoTele($value)
    {
        //validando de que el valor sea un id
        if ($this->validateId($value)) {
            //seteando valor a la variable codigo
            $this->codi_tipo_tele = $value;
            //retornar true
            return true;
        } else {
            //retornar respuesta falso
            return false;
        }
    }

    public function getCodiTipoTele($value)
    {
        //retornar el valor del codigo de categoria
        return $this->codi_tipo_tele;
    }
    //Encapsulamiento de nombre de categoria
    public function setNombTipoTele($value)
    {
        //validando de que el valor sea alfabetico y que sea mayor a uno y menor a cien
        if ($this->validateAlphanumeric($value, 1, 100)) {
            //seteando valor a la variable de nombre de categoria
            $this->nomb_tipo_tele = $value;
            //retornando respuesta true
            return true;
        } else {
            //retornando respuesta false
            return false;
        }
    }

    public function getNombTipoTele()
    {
        return $this->nomb_tipo_tele;
    }

    //Encapsulamiento de estado de categoria
    public function setEstaTipoTele($value)
    {
        $this->esta_tipo_tele = $value;
        return true;
    }

    public function getEstaTipoTele($value)
    {
        return $this->esta_tipo_tele;
    }

    //FUNCIONES DEL CRUD
    //Funcion para crear categoria
    public function createTipoTelefono()
    {
        $sql    = "INSERT INTO tipo_telefono(nomb_tipo_tele,esta_tipo_tele) VALUES (?,1)";
        $params = array($this->nomb_tipo_tele);
        return Database::executeRow($sql, $params);
    }
    //Funcion para obtener lista de registros de la tabla categoria sin json
    public function getTipoTelefonoN()
    {
        $sql    = "SELECT codi_tipo_tele, nomb_tipo_tele FROM tipo_telefono WHERE esta_tipo_tele = 1 ORDER BY codi_tipo_tele";
        $params = array(null);
        return Database::getRows($sql, $params);
    }
    //Funcion para modificar tanto el nombre o el estado un registro de la tabla categoria
    public function updateTipoTelefono()
    {
        $sql    = "UPDATE tipo_telefono SET nomb_tipo_tele = ? WHERE codi_tipo_tele = ?";
        $params = array($this->nomb_tipo_tele, $this->codi_tipo_tele);
        return Database::executeRow($sql, $params);
    }
    public function deleteTipoTelefono()
    {
        $sql    = "UPDATE tipo_telefono SET esta_tipo_tele = 0 WHERE codi_tipo_tele = ?";
        $params = array($this->codi_tipo_tele);
        return Database::executeRow($sql, $params);
    }
}