<?php

class ContactoEtiqueta extends Validator
{
    // Declaraion de propiedades
    private $codi_inte_cont_etiq = null;
    private $codi_cont = null;
    private $codi_etiq = null;
    private $esta_inte_cont_etiq = null;

    // Encapsulamiento de codigo de categoria
    public function setCodiInteContEtiq($value)
    {
        //validando de que el valor sea un id
        if ($this->validateId($value)) {
            //seteando valor a la variable codigo
            $this->codi_inte_cont_etiq = $value;
            //retornar true
            return true;
        } else {
            //retornar respuesta falso
            return false;
        }
    }

    public function getCodiInteContEtiq($value)
    {
        //retornar el valor del codigo de categoria
        return $this->codi_inte_cont_etiq;
    }
    // Encapsulamiento de codigo de categoria
    public function setCodiCont($value)
    {
        //validando de que el valor sea un id
        if ($this->validateId($value)) {
            //seteando valor a la variable codigo
            $this->codi_cont = $value;
            //retornar true
            return true;
        } else {
            //retornar respuesta falso
            return false;
        }
    }

    public function getCodiCont($value)
    {
        //retornar el valor del codigo de categoria
        return $this->codi_cont;
    }
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

    //Encapsulamiento de estado de categoria
    public function setInteContEtiq($value)
    {
        $this->esta_inte_cont_etiq = $value;
        return true;
    }

    public function getInteContEtiq($value)
    {
        return $this->esta_inte_cont_etiq;
    }
    //FUNCIONES DEL CRUD
    //Funcion para crear categoria
    public function createContactoEtiqueta()
    {
        $sql = "INSERT INTO intermedia_contacto_etiqueta(codi_cont, codi_etiq) VALUES (?,?)";
        $params = array($this->codi_cont,$this->codi_etiq);
        return Database::executeRow($sql, $params);
    }
    public function deleteContactoEtiqueta()
    {
        $sql = "DELETE FROM intermedia_contacto_etiqueta WHERE codi_cont = ?";
        $params = array($this->codi_cont);
        return Database::executeRow($sql, $params);
    }
    //Funcion para obtener lista de registros de la tabla categoria sin json
    public function getEtiquetasContacto($codi)
    {
        $sql = "SELECT codi_etiq FROM intermedia_contacto_etiqueta WHERE esta_inte_cont_etiq=1 AND codi_cont=?";
        $params = array($codi);
        return Database::getRows($sql, $params);
    }
}
