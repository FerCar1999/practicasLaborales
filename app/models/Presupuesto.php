<?php

class Presupuesto extends Validator
{
    // Declaraion de propiedades
    private $codi_pres = null;
    private $codi_casa = null;
    private $codi_usua = null;
    private $cant_pres = null;
    private $fech_pres = null;

    // Encapsulamiento
    public function setCodiPres($value)
    {
        if ($this->validateId($value)) {
            $this->codi_pres = $value;
            return true;

        } else {
            return false;
        }
    }
    public function getCodiPres($value)
    {
        return $this->codi_pres;
    }
    public function setCodiCasa($value)
    {
        if ($this->validateId($value)) {
            $this->codi_casa = $value;
            return true;
        } else {
            return false;
        }
    }
    public function getCodiCasa($value)
    {
        return $this->codi_casa;
    }
    public function setCodiUsua($value)
    {
        if ($this->validateId($value)) {
            $this->codi_usua = $value;
            return true;
        } else {
            return false;
        }
    }
    public function getCodiUsua($value)
    {
        return $this->codi_usua;
    }

    public function setCantPres($value)
    {
        if ($value > 0) {
            $this->cant_pres = $value;
            return true;
        } else {
            return false;
        }
    }
    public function getCantPres()
    {
        return $this->cant_pres;
    }
    public function setFechPres($value)
    {
        $this->fech_pres = $value;
        return true;
    }
    public function getFechPres()
    {
        return $this->fech_pres;
    }
    // Funciones para CRUD
    // Crear casa

    public function agregarIngreso()
    {
        $sql    = "INSERT INTO presupuesto(codi_casa, codi_usua, cant_pres, fech_pres) VALUES(?,?,?,?)";
        $params = array($this->codi_casa, $this->codi_usua, $this->cant_pres, $this->fech_pres);
        return Database::executeRow($sql, $params);
    }
    //Funcion para verificar si se puede cambiar la cantidad agregada al presupuesto
    public function verificarUpdatePresupuesto()
    {
        $sql = "SELECT (?-SUM(cant_pres_deta)) as 'nuevaCantidad' FROM presupuesto_detalle WHERE codi_pres = ? ";
        $params = array($this->cant_pres, $this->codi_pres);
        return Database::getRow($sql, $params);
    }
    public function updateIngreso()
    {
        $sql    = "UPDATE presupuesto SET cant_pres = ? WHERE codi_pres=?";
        $params = array($this->cant_pres, $this->codi_pres);
        return Database::executeRow($sql, $params);
    }
    public function verificarPresupuestoMes($mes, $anio)
    {
        $sql =" SELECT COUNT(*) FROM presupuesto WHERE MONTH(fech_pres) = ? AND YEAR(fech_pres) = ?";
        $params = array($mes, $anio);
        return Database::getRow($sql, $params);
    }
    public function obtenerCasasSinPresupuestoMes($mes, $anio)
    {
        $sql = "SELECT c.codi_casa, c.nomb_casa FROM casa as c WHERE c.esta_casa=1 AND c.codi_casa NOT IN(SELECT p.codi_casa FROM presupuesto as p WHERE MONTH(p.fech_pres)=? AND YEAR(p.fech_pres) = ?)";
        $params = array($mes, $anio);
        return Database::getRows($sql, $params);
    }
    // Obtener presupuestos de casas
    public function getPresupuestoCasas($mes, $anio)
    {
        $sql    = "SELECT p.codi_pres, c.nomb_casa, p.cant_pres, p.cant_pres- COALESCE((SELECT SUM(pda.cant_pres_deta) FROM presupuesto_detalle as pda WHERE MONTH(pda.fech_pres_deta) = ? AND YEAR(pda.fech_pres_deta) = ? AND pda.codi_casa = p.codi_casa),0) as 'cant_rest' FROM presupuesto as p INNER JOIN casa as c USING(codi_casa) WHERE MONTH(p.fech_pres) = ? AND YEAR(p.fech_pres) = ?";
        $params = array($mes, $anio, $mes, $anio);
        return Database::getRowsAjax($sql, $params);
    }
    //Funcion para obtener lo que le quedo al mes anterior y sumarlo al nuevo mes
    public function residuoMesAnterior($mes, $anio)
    {
        $sql = "SELECT ((SELECT cant_pres FROM presupuesto WHERE MONTH(fech_pres) = ? AND YEAR(fech_pres) = ? AND codi_casa = ?)-(SELECT cant_pres_deta FROM presupuesto_detalle WHERE MONTH(fech_pres_deta) = ? AND YEAR(fech_pres_deta) = ? AND codi_casa=?)) AS 'restanteMes' ";
        $params = array($mes, $anio, $this->codi_casa, $mes, $anio, $this->codi_casa);
        return Database::getRow();
    }
    public function obtenerCantidadEgreso()
    {
        $sql = "SELECT SUM(cant_pres_deta) as 'cant_pres_deta' FROM presupuesto_detalle WHERE codi_pres = ?";
        $params = array($this->codi_pres);
        $data = Database::getRow($sql, $params);
        if ($data) {
            return $data['cant_pres_deta'];
        } else {
            return 0;
        }
        
    }
    public function deleteIngreso()
    {
        $sql="DELETE FROM presupuesto WHERE codi_pres = ?";
        $params = array($this->codi_pres);
        return Database::executeRow($sql, $params);
    }
}
