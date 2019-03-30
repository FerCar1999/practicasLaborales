<?php

class IntermediaHorarioDocente extends Validator
{
    // Declaraion de propiedades
    private $codi_inte_hora_doce = null;
    private $codi_inte_curs_salo = null;
    private $codi_hora = null;
    private $codi_doce = null;
    private $esta_inte_hora_doce = null;

    // Encapsulamiento
    public function setCodiInteHoraDoce($value)
    {
        if ($this->validateId($value)) {
            $this->codi_inte_hora_doce = $value;
            return true;

        } else {
            return false;
        }
    }
    public function getCodiInteHoraDoce($value)
    {
        return $this->codi_inte_hora_doce;
    }
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
    public function setCodiHora($value)
    {
        if ($this->validateId($value)) {
            $this->codi_hora = $value;
            return true;

        } else {
            return false;
        }
    }
    public function getCodiHora($value)
    {
        return $this->codi_hora;
    }
    public function setCodiDoce($value)
    {
        if ($this->validateId($value)) {
            $this->codi_doce = $value;
            return true;
        } else {
            return false;
        }
    }
    public function getCodiDoce($value)
    {
        return $this->codi_doce;
    }
    public function setEstaInteHoraDoce($value)
    {
        $this->esta_inte_hora_doce = $value;
        return true;
    }
    public function getEstaInteHoraDoce()
    {
        return $this->esta_inte_hora_doce;
    }
    //funcion para verificar la existencia de 
    public function verificarHorarioCurso()
    {
        $sql = "SELECT COALESCE(SELECT codi_inte_curs_salo from intermedia_curso_salon WHERE codi_curs = ? AND codi_salo=?, 0) as codi_inte_curs_salo";
        $params = array($this->codi_curs, $this->codi_salo);
        return Database::getRow($sql, $params);
    }
    public function createIntermediaHorarioDocente()
    {
        $sql    = "INSERT INTO intermedia_horario_docente(codi_inte_curs_salo, codi_hora, codi_doce, esta_inte_hora_doce) VALUES (?,?,?,?)";
        $params = array($this->codi_inte_curs_salo, $this->codi_hora, $this->codi_doce, 1);
        return Database::executeRow($sql, $params);
    }
    public function updateIntermediaCursoSalon()
    {
        $sql="UPDATE intermedia_horario_docente SET codi_hora = ?, codi_salo = ? WHERE codi_inte_hora_doce = ?";
        $params=array($this->codi_hora, $this->codi_salo, $this->codi_inte_hora_doce);
        return Database::executeRow($sql, $params);
    }
    public function deleteIntermediaHorarioDocente()
    {
        $sql = "UPDATE intermedia_horario_docente SET esta_inte_hora_doce = ? WHERE codi_inte_hora_doce = ?";
        $params = array(0, $this->codi_inte_hora_doce);
        return Database::executeRow($sql, $params);
    }
}
