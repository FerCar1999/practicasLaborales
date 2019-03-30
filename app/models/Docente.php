<?php

class Docente extends Validator
{   
    // Declaraion de propiedades
    private $codi_doce = null;
    private $codi_casa = null;
    private $nomb_doce = null;
    private $apel_doce = null;
    private $esta_doce = null;

    // Encapsulamiento de codigo de categoria
    public function setCodiDoce($value)
    {
        //validando de que el valor sea un id
        if ($this->validateId($value)) {
            //seteando valor a la variable codigo
            $this->codi_doce = $value;
            //retornar true
            return true;
        } else {
            //retornar respuesta falso
            return false;
        }
    }

    public function getCodiDoce($value)
    {
        //retornar el valor del codigo de categoria
        return $this->codi_doce;
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
    public function setNombDoce($value)
    {
        //validando de que el valor sea alfabetico y que sea mayor a uno y menor a cien
        if ($this->validateAlphabetic($value, 1, 100)) {
            //seteando valor a la variable de nombre de categoria
            $this->nomb_doce = $value;
            //retornando respuesta true
            return true;
        } else {
            //retornando respuesta false
            return false;
        }
    }

    public function getNombDoce()
    {
        return $this->nomb_doce;
    }

    public function setApelDoce($value)
    {
        //validando de que el valor sea alfabetico y que sea mayor a uno y menor a cien
        if ($this->validateAlphabetic($value, 1, 100)) {
            //seteando valor a la variable de nombre de categoria
            $this->apel_doce = $value;
            //retornando respuesta true
            return true;
        } else {
            //retornando respuesta false
            return false;
        }
    }

    public function getApelDoce()
    {
        return $this->apel_doce;
    }
    //Encapsulamiento de estado de categoria
    public function setEstaDoce($value)
    {
        $this->esta_doce = $value;
        return true;
    }

    public function getEstaDoce($value)
    {
        return $this->esta_doce;
    }

    //FUNCIONES DEL CRUD
    //Funcion para crear categoria
    public function createDocente()
    {
        $sql    = "INSERT INTO docente(codi_casa,nomb_doce,apel_doce,esta_doce) VALUES (?,?,?,1)";
        $params = array($this->codi_casa,$this->nomb_doce,$this->apel_doce);
        return Database::executeRow($sql, $params);
    }
    //Funcion para obtener lista de registros de la tabla categoria sin json
    public function getDocentesN()
    {
        $sql    = "SELECT codi_doce, nomb_doce, apel_doce FROM docente WHERE esta_doce = 1 AND codi_casa = ? ORDER BY codi_doce";
        $params = array($this->codi_casa);
        return Database::getRows($sql, $params);
    }
    //Funcion para obtener lista de registros en la tabla categoria
    public function getDocentes()
    {
        $sql    = "SELECT codi_doce, nomb_doce, apel_doce FROM docente WHERE esta_doce=1 AND codi_casa=? ORDER BY codi_doce";
        $params = array($this->codi_casa);
        return Database::getRowsAjax($sql, $params);
    }

    //Funcion para modificar tanto el nombre o el estado un registro de la tabla categoria
    public function updateDocente()
    {
        $sql    = "UPDATE docente SET nomb_doce = ?, apel_doce = ? WHERE codi_doce = ?";
        $params = array($this->nomb_doce, $this->apel_doce, $this->codi_doce);
        return Database::executeRow($sql, $params);
    }
    public function deleteDocente()
    {
        $sql    = "UPDATE docente SET esta_doce = 0 WHERE codi_doce = ?";
        $params = array($this->codi_doce);
        return Database::executeRow($sql, $params);
    }
}