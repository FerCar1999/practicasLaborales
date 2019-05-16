<?php

class Horario extends Validator
{   
    // Declaraion de propiedades
    private $codi_hora = null;
    private $codi_dia  = null;
    private $codi_casa = null;
    private $hora_inic = null;
    private $hora_fin  = null;
    private $esta_cate = null;

    // Encapsulamiento de codigo de categoria
    public function setCodiHora($value)
    {
        //validando de que el valor sea un id
        if ($this->validateId($value)) {
            //seteando valor a la variable codigo
            $this->codi_hora = $value;
            //retornar true
            return true;
        } else {
            //retornar respuesta falso
            return false;
        }
    }

    public function getCodiHora($value)
    {
        //retornar el valor del codigo de categoria
        return $this->codi_hora;
    }
    public function setCodiDia($value)
    {
        //validando de que el valor sea un id
        if ($this->validateId($value)) {
            //seteando valor a la variable codigo
            $this->codi_dia = $value;
            //retornar true
            return true;
        } else {
            //retornar respuesta falso
            return false;
        }
    }

    public function getCodiDia($value)
    {
        //retornar el valor del codigo de categoria
        return $this->codi_dia;
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
        return $this->codi_caca;
    }
    //Encapsulamiento de nombre de categoria
    public function setHoraInic($value)
    {
        //validando de que el valor sea alfabetico y que sea mayor a uno y menor a cien
        if ($this->validateHour($value)) {
            //seteando valor a la variable de nombre de categoria
            $this->hora_inic = $value;
            //retornando respuesta true
            return true;
        } else {
            //retornando respuesta false
            return false;
        }
    }

    public function getHoraInic()
    {
        return $this->hora_inic;
    }
    //Encapsulamiento de nombre de categoria
    public function setHoraFin($value)
    {
        //validando de que el valor sea alfabetico y que sea mayor a uno y menor a cien
        if ($this->validateHour($value)) {
            //seteando valor a la variable de nombre de categoria
            $this->hora_fin = $value;
            //retornando respuesta true
            return true;
        } else {
            //retornando respuesta false
            return false;
        }
    }

    public function getHoraFin()
    {
        return $this->hora_fin;
    }
    //Encapsulamiento de estado de categoria
    public function setEstaHora($value)
    {
        $this->esta_hora = $value;
        return true;
    }

    public function getEstaHora($value)
    {
        return $this->esta_hora;
    }

    //FUNCIONES DEL CRUD
    //Funcion para crear categoria
    public function createHorario()
    {
        $sql    = "INSERT INTO horario(codi_dia, codi_casa, hora_inic, hora_fin, esta_hora) VALUES (?,?,?,?,1)";
        $params = array($this->codi_dia, $this->codi_casa, $this->hora_inic, $this->hora_fin);
        return Database::executeRow($sql, $params);
    }
    //Funcion para obtener lista de registros de la tabla categoria sin json
    public function getHorariosN()
    {
        $sql    = "SELECT codi_hora, hora_inic, hora_fin FROM horario WHERE esta_hora=1 AND codi_casa = ? AND codi_dia = ? ORDER BY hora_inic";
        $params = array($this->codi_casa, $this->codi_dia);
        return Database::getRows($sql, $params);
    }
    //Funcion para obtener lista de registros en la tabla categoria
    public function getHorarios()
    {
        $sql    = "SELECT codi_hora,codi_dia,CASE codi_dia WHEN 1 THEN 'Lunes' WHEN 2 THEN 'Martes' WHEN 3 THEN 'Miercoles' WHEN 4 THEN 'Jueves' WHEN 5 THEN 'Viernes' WHEN 6 THEN 'Sabado' WHEN 7 THEN 'Domingo' END 'dia', hora_inic, hora_fin FROM horario WHERE esta_hora=1 AND codi_casa = ? ORDER BY codi_dia";
        $params = array($this->codi_casa);
        return Database::getRowsAjax($sql, $params);
    }

    //Funcion para modificar tanto el nombre o el estado un registro de la tabla categoria
    public function updateHorario()
    {
        $sql    = "UPDATE horario SET hora_inic = ?, hora_fin = ? WHERE codi_hora = ?";
        $params = array($this->hora_inic, $this->hora_fin, $this->codi_hora);
        return Database::executeRow($sql, $params);
    }
    public function deleteHorario()
    {
        $sql    = "UPDATE horario SET esta_hora = ? WHERE codi_hora = ?";
        $params = array($this->esta_hora, $this->codi_hora);
        return Database::executeRow($sql, $params);
    }
    //Funcion para saber si se puede ingresar ese horario en ese dia
    public function verificarHorarioDia()
    {
        $sql = "SELECT COUNT(codi_hora) as cant FROM horario WHERE codi_dia = ? AND codi_casa = ? AND esta_hora = 1 AND ? <(SELECT MAX(hf.hora_fin) FROM horario as hf WHERE hf.esta_hora=1 AND hf.codi_casa = ? AND hf.codi_dia = ?)";
        $params = array($this->codi_dia, $this->codi_casa, $this->hora_inic, $this->codi_casa, $this->codi_dia);
        return Database::getRow($sql, $params);
    }
}