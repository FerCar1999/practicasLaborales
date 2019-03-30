<?php

class TipoUsuario extends Validator
{   
    // Declaraion de propiedades
    private $codi_tipo_usua = null;
    private $nomb_tipo_usua = null;
    private $esta_tipo_usua = null;

    // Encapsulamiento de codigo de categoria
    public function setCodiTipoUsua($value)
    {
        //validando de que el valor sea un id
        if ($this->validateId($value)) {
            //seteando valor a la variable codigo
            $this->codi_tipo_usua = $value;
            //retornar true
            return true;
        } else {
            //retornar respuesta falso
            return false;
        }
    }

    public function getCodiTipoUsua($value)
    {
        //retornar el valor del codigo de categoria
        return $this->codi_tipo_usua;
    }

    //Encapsulamiento de nombre de categoria
    public function setNombTipoUsua($value)
    {
        //validando de que el valor sea alfabetico y que sea mayor a uno y menor a cien
        if ($this->validateAlphabetic($value, 1, 100)) {
            //seteando valor a la variable de nombre de categoria
            $this->nomb_tipo_usua = $value;
            //retornando respuesta true
            return true;
        } else {
            //retornando respuesta false
            return false;
        }
    }

    public function getNombTipoUsua()
    {
        return $this->nomb_tipo_usua;
    }
    //Encapsulamiento de estado de categoria
    public function setEstaTipoUsua($value)
    {
        $this->esta_tipo_usua = $value;
        return true;
    }

    public function getEstaDoce($value)
    {
        return $this->esta_tipo_usua;
    }

    //FUNCIONES DEL CRUD
    //Funcion para obtener lista de registros de la tabla categoria sin json
    public function getTipoUsuarioN()
    {
        $sql    = "SELECT codi_tipo_usua,nomb_tipo_usua FROM tipo_usuario WHERE esta_tipo_usua = 1 ORDER BY codi_tipo_usua";
        $params = array(null);
        return Database::getRows($sql, $params);
    }
}