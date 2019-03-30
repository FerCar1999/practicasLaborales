<?php

class IntermediaCursoSalon extends Validator
{
    // Declaraion de propiedades
    private $codi_inte_curs_salo = null;
    private $codi_curs = null;
    private $codi_salo = null;
    private $esta_inte_curs_salo = null;

    // Encapsulamiento
    public function setCodiInteCursSalo($value)
    {
        if ($this->validateId($value)) {
            $this->codi_inte_curs_salo = $value;
            return true;

        } else {
            return false;
        }
    }
    public function getCodiInteCursSalo($value)
    {
        return $this->codi_inte_curs_salo;
    }
    public function setCodiCurs($value)
    {
        if ($this->validateId($value)) {
            $this->codi_curs = $value;
            return true;

        } else {
            return false;
        }
    }
    public function getCodiCurs($value)
    {
        return $this->codi_curs;
    }
    public function setCodiSalo($value)
    {
        if ($this->validateId($value)) {
            $this->codi_salo = $value;
            return true;
        } else {
            return false;
        }
    }
    public function getCodiSalo($value)
    {
        return $this->codi_salo;
    }
    public function setEstaInteCursSalo($value)
    {
        $this->esta_inte_curs_salo = $value;
        return true;
    }
    public function getEstaInteCursSalo()
    {
        return $this->esta_inte_curs_salo;
    }
    //funcion para verificar la existencia de 
    public function verificarExistenciaSalonCurso()
    {
        $sql = "SELECT COALESCE(SELECT codi_inte_curs_salo from intermedia_curso_salon WHERE codi_curs = ? AND codi_salo=?, 0) as codi_inte_curs_salo";
        $params = array($this->codi_curs, $this->codi_salo);
        return Database::getRow($sql, $params);
    }
    public function createIntermediaCursoSalon()
    {
        $sql    = "INSERT INTO intermedia_curso_salon(codi_curs, codi_salo, esta_inte_curs_salo) VALUES (?,?,?)";
        $params = array($this->codi_curs, $this->codi_salo, 1);
        return Database::executeRow($sql, $params);
    }
    public function updateIntermediaCursoSalon()
    {
        $sql="UPDATE intermedia_curso_salon SET codi_salo = ? WHERE codi_inte_curs_salo = ?";
        $params=array($this->codi_salo, $this->codi_inte_curs_salo);
        return Database::executeRow($sql, $params);
    }
    public function obtenerIdUltimo()
    {
        return Database::getLastRowId();
    }
}
