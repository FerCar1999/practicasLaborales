<?php

class QuedanDetalle extends Validator
{
    // Declaraion de propiedades
    private $codi_qued_deta = null;
    private $codi_qued = null;
    private $codi_fact = null;
    private $esta_qued_deta = null;

    // Encapsulamiento
    public function setCodiQuedDeta($value)
    {
        if ($this->validateId($value)) {
            $this->codi_qued_deta = $value;
            return true;

        } else {
            return false;
        }
    }
    public function getCodiQuedDeta($value)
    {
        return $this->codi_qued_deta;
    }
    public function setCodiQued($value)
    {
        if ($this->validateId($value)) {
            $this->codi_qued = $value;
            return true;

        } else {
            return false;
        }
    }
    public function getCodiQued($value)
    {
        return $this->codi_qued;
    }
    public function setCodiFact($value)
    {
        if ($this->validateId($value)) {
            $this->codi_fact = $value;
            return true;
        } else {
            return false;
        }
    }
    public function getCodiFact($value)
    {
        return $this->codi_fact;
    }
    public function setEstaQuedDeta($value)
    {
            $this->esta_qued_deta = $value;
            return true;
    }
    public function getEstaQuedDeta($value)
    {
        return $this->esta_qued_deta;
    }
    // Funciones para CRUD
    // Crear casa
    public function addQuedanDetalle()
    {
        $sql    = "INSERT INTO quedan_detalle(codi_qued, codi_fact, esta_qued_deta) VALUES(?,?,1)";
        $params = array($this->codi_qued, $this->codi_fact);
        return Database::executeRow($sql, $params);
    }
    //Funcion para modificar el egreso ingresado
    public function updateFactura($estado)
    {
        $sql    = "UPDATE factura SET esta_fact=? WHERE codi_fact=?";
        $params = array($estado,$this->codi_fact);
        return Database::executeRow($sql, $params);
    }
    //Funcion para modificar el archivo agregado con el egreso
    public function deleteQuedanDetalle()
    {
        $sql    = "UPDATE quedan_detalle SET esta_qued_deta=0 WHERE codi_qued_deta=?";
        $params = array($this->codi_qued_deta);
        return Database::executeRow($sql, $params);
    }
    public function updateEstadoQuedan()
    {
        $sql    = "UPDATE quedan_maestro SET esta_qued=1 WHERE codi_qued=?";
        $params = array($this->codi_qued);
        return Database::executeRow($sql, $params);
    }
    //Funcion para obtener Egresos de cada casa por mes y año
    public function getQuedanDetalle()
    {
        $sql="SELECT qd.codi_fact, f.nume_fact FROM presupuesto_detalle WHERE codi_casa = ? AND MONTH(fech_pres_deta)=? AND YEAR(fech_pres_deta)=?";
        $params = array($this->codi_casa, $mes, $anio);
        return Database::getRowsAjax($sql, $params);
    }
    public function getCantidadDeQuedanRestantes()
    {
        $sql ="SELECT qm.cant_fact-COUNT(qd.codi_fact) as cant FROM quedan_detalle as qd INNER JOIN quedan_maestro as qm ON qm.codi_qued=qd.codi_qued WHERE qm.codi_qued=?";
        $params = array($this->codi_qued);
        return Database::getRow($sql, $params);
    }
    public function getMontoQuedan()
    {
        $sql = "SELECT SUM(f.cant_fact) as mont FROM factura as f INNER JOIN quedan_detalle as qd ON qd.codi_fact= f.codi_fact WHERE qd.codi_qued = ?";
        $params = array($this->codi_qued);
        return Database::getRow($sql, $params);
    }
        public function obtenerInfoCasaQuedan() {
		$sql = "SELECT u.nomb_usua, u.apel_usua, u.corre_usua, qm.nume_qued, f.nume_fact FROM quedan_detalle as qd INNER JOIN quedan_maestro as qm on qm.codi_qued=qd.codi_qued INNER JOIN factura as f ON f.codi_fact=qd.codi_fact INNER JOIN factura_detalle AS fd ON f.codi_fact=fd.codi_fact INNER JOIN curso as c ON c.codi_curs=fd.codi_curs INNER JOIN usuario as u ON u.codi_casa=c.codi_casa WHERE qd.codi_qued=? AND u.codi_tipo_usua=1";
		$params = array($this->codi_qued);
		return Database::getRows($sql, $params);
    }
    public function obtenerCorreoEmisor($codi) {
		$sql = "SELECT corre_usua FROM usuario WHERE codi_usua=?";
		$params = array($codi);
		return Database::getRow($sql, $params);
	}
}