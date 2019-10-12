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
        $params = array($this->codi_casa, $this->nomb_salo);
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
    public function reporteHorarioSalon()
    {
        $sql = "SELECT sa.nomb_salo,CONCAT(time_format(ho.hora_inic, '%r'), ' - ', time_format(ho.hora_fin, '%r')) AS hora, 
        ho.codi_dia, cu.nomb_curs, CONCAT(doc.nomb_doce,' ',doc.apel_doce) AS nomb_doce 
        FROM intermedia_horario_docente AS ihd
        INNER JOIN intermedia_curso_salon AS ics ON ics.codi_inte_curs_salo=ihd.codi_inte_curs_salo
        INNER JOIN horario AS ho ON ho.codi_hora=ihd.codi_hora
        INNER JOIN docente AS doc ON doc.codi_doce=ihd.codi_doce
        INNER JOIN curso AS cu ON cu.codi_curs=ics.codi_curs
        INNER JOIN salon AS sa ON sa.codi_salo=ics.codi_salo
        WHERE sa.codi_salo = ?";
        $params = array($this->codi_salo);
        return Database::getRows($sql, $params);
    }
    public function reporteHorarioSalonCompleto()
    {
        $sql = "SELECT sa.nomb_salo,CONCAT(time_format(ho.hora_inic, '%r'), ' - ', time_format(ho.hora_fin, '%r')) AS hora, 
        ho.codi_dia, cu.nomb_curs, CONCAT(doc.nomb_doce,' ',doc.apel_doce) AS nomb_doce 
        FROM intermedia_horario_docente AS ihd
        INNER JOIN intermedia_curso_salon AS ics ON ics.codi_inte_curs_salo=ihd.codi_inte_curs_salo
        INNER JOIN horario AS ho ON ho.codi_hora=ihd.codi_hora
        INNER JOIN docente AS doc ON doc.codi_doce=ihd.codi_doce
        INNER JOIN curso AS cu ON cu.codi_curs=ics.codi_curs
        INNER JOIN salon AS sa ON sa.codi_salo=ics.codi_salo
        ORDER BY sa.nomb_salo,ho.codi_dia,time_format(ho.hora_inic, '%r') DESC";
        $params = array(null);
        return Database::getRows($sql, $params);
    }
}
