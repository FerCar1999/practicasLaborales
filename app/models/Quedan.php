<?php

class Quedan extends Validator
{
    // Declaraion de propiedades
    private $codi_qued = null;
    private $nume_qued = null;
    private $fech_emis = null;
    private $fech_abon = null;
    private $cant_fact = null;
    private $fech_ing = null;
    private $arch_qued = null;
    private $esta_qued = null;

    // Encapsulamiento
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
    public function setNumeQued($value)
    {
        if (is_numeric($value) && $value>0) {
            $this->nume_qued = $value;
            return true;
        } else {
            return false;
        }
    }
    public function getNumeQued($value)
    {
        return $this->nume_qued;
    }
    public function setFechEmis($value)
    {
            $this->fech_emis = $value;
            return true;
    }
    public function getFechEmis($value)
    {
        return $this->fech_emis;
    }
    public function setFechAbon($value)
    {
            $this->fech_abon = $value;
            return true;
    }
    public function getFechAbon($value)
    {
        return $this->fech_abon;
    }
    public function setCantFact($value)
    {
        if ($this->validateId($value)) {
            $this->cant_fact = $value;
            return true;
        } else {
            return false;
        }
    }
    public function getCantFact($value)
    {
        return $this->cant_fact;
    }

    public function setFechIngr($value)
    {
            $this->fech_ing = $value;
            return true;
    }
    public function getFechIngr()
    {
        return $this->fech_ing;
    }
    public function setArchQued($file)
    {
        if ($this->validateFile($file, $this->arch_qued, "../../web/quedan/")) {
            $this->arch_qued = $this->getImageName();
            return true;
        } else {
            return false;
        }
    }
    public function getArchQued()
    {
        return $this->arch_qued;
    }
    public function unsetArchQued()
    {
        if (unlink("../../web/quedan/" . $this->arch_qued)) {
            $this->arch_qued = null;
            return true;
        } else {
            return false;
        }
    }
    public function setEstaQued($value)
    {
        $this->esta_qued = $value;
        return true;
    }
    public function getEstaQued()
    {
        return $this->esta_qued;
    }
    // Funciones para CRUD
    //Funcion para agregar un nuevo egreso
    public function addQuedan()
    {
        $sql    = "INSERT INTO quedan_maestro(nume_qued, fech_emis, cant_fact, arch_qued, fech_ing, esta_qued) VALUES(?,?,?,?,?,1)";
        $params = array($this->nume_qued, $this->fech_emis, $this->cant_fact, $this->arch_qued, $this->fech_ing);
        return Database::executeRow($sql, $params);
    }
    public function updateQuedan()
    {
        $sql = "UPDATE quedan_maestro SET nume_qued=?, fech_emis = ?, cant_fact = ? WHERE codi_qued=?";
        $params = array($this->nume_qued, $this->fech_emis, $this->cant_fact, $this->codi_qued);
        return Database::executeRow($sql, $params);
    }
    public function updateQuedanArchivo()
    {
        $sql = "UPDATE quedan_maestro SET arch_qued=? WHERE codi_qued=?";
        $params = array($this->$arch_qued, $this->codi_qued);
        return Database::executeRow($sql, $params);
    }
    public function deleteQuedan()
    {
        $sql = "UPDATE quedan_maestro SET esta_qued=0 WHERE codi_qued=?";
        $params = array($this->codi_qued);
        return Database::executeRow($sql, $params);
    }
    public function abonarQuedan()
    {
        $sql = "UPDATE quedan_maestro SET fech_abon = ? WHERE codi_qued=?";
        $params = array($this->fech_abon,$this->codi_qued);
        return Database::executeRow($sql, $params);
    }
    //Funcion para obtener Egresos de cada casa por mes y año
    public function getListaQuedanCasa($codiCasa)
    {
        $sql="SELECT qm.codi_qued, qm.nume_qued, qm.fech_emis, qm.cant_fact, qm.arch_qued, qm.esta_qued FROM quedan_detalle as qd INNER JOIN quedan_maestro as qm ON qm.codi_qued = qd.codi_qued INNER JOIN factura as f ON f.codi_fact=qd.codi_fact INNER JOIN factura_detalle as fd ON fd.codi_fact=f.codi_fact INNER JOIN curso as c ON c.codi_curs=fd.codi_curs WHERE c.codi_casa = ? AND qm.esta_qued!=0 GROUP BY qm.codi_qued";
        $params = array($codiCasa);
        return Database::getRowsAjax($sql, $params);
    }
    public function getListaQuedanCasaEncargada($codiCasa)
    {
        $sql="SELECT qm.codi_qued, qm.nume_qued, qm.fech_emis, qm.cant_fact, qm.arch_qued, qm.esta_qued FROM quedan_detalle as qd INNER JOIN quedan_maestro as qm ON qm.codi_qued = qd.codi_qued INNER JOIN factura as f ON f.codi_fact=qd.codi_fact INNER JOIN factura_detalle as fd ON fd.codi_fact=f.codi_fact INNER JOIN curso as c ON c.codi_curs=fd.codi_curs WHERE qm.esta_qued=1 OR qm.esta_qued=2 OR qm.esta_qued= 3 AND c.codi_casa=? GROUP BY qm.codi_qued";
        $params = array($codiCasa);
        return Database::getRowsAjax($sql, $params);
    }
    public function getFacturasPendientesQuedan()
	{
		$sql = "SELECT DISTINCT f.codi_fact ,f.nume_fact FROM factura_detalle as fd INNER JOIN factura as f ON f.codi_fact=fd.codi_fact INNER JOIN curso as c ON c.codi_curs = fd.codi_curs INNER JOIN casa as ca ON ca.codi_casa = c.codi_casa WHERE f.esta_fact= 1";
		$params = array(null);
		return Database::getRows($sql, $params);
    }
    public function obtenerCasasAbono()
    {
        $sql ="SELECT c.codi_casa FROM quedan_detalle as qd INNER JOIN factura as f ON f.codi_fact= qd.codi_fact INNER JOIN factura_detalle as fd ON fd.codi_fact = f.codi_fact INNER JOIN curso as c On c.codi_curs = fd.codi_curs WHERE qd.codi_qued = ?";
        $params = array($this->codi_qued);
        return Database::getRows($sql, $params);
    }
    public function obtenerIdQuedan()
    {
        $sql = "SELECT nume_qued FROM quedan_maestro WHERE codi_qued=?";
        $params = array($this->codi_qued);
        return Database::getRow($sql, $params);
    }
    public function updateEstadoQuedan($estado)
    {
        $sql = "UPDATE quedan_maestro SET esta_qued = ? WHERE codi_qued = ?";
        $params = array($estado,$this->codi_qued);
        Database::executeRow($sql, $params);
    }
    public function agregarNotificacion($emisor, $receptor, $numeroQuedan)
    {
        $sql = "INSERT INTO notificaciones(codi_casa, codi_emis, acci_noti, esta_noti) VALUES(?,?,?,1)";
        $params = array($receptor, $emisor, $numeroQuedan);
        return Database::executeRow($sql, $params);
    }
    public function obtenerInfoCasaQuedan() {
		$sql = "SELECT u.nomb_usua, u.apel_usua, u.corre_usua, qm.nume_qued, f.nume_fact FROM quedan_detalle as qd INNER JOIN quedan_maestro as qm on qm.codi_qued=qd.codi_qued INNER JOIN factura as f ON f.codi_fact=qd.codi_fact INNER JOIN factura_detalle AS fd ON f.codi_fact=fd.codi_fact INNER JOIN curso as c ON c.codi_curs=fd.codi_curs INNER JOIN usuario as u ON u.codi_casa=c.codi_casa WHERE qd.codi_qued=? AND u.codi_tipo_usua=1";
		$params = array($this->codi_qued);
		return Database::getRows($sql, $params);
    }
    public function obtenerInfoCasaQuedanAbono() {
		$sql = "SELECT u.nomb_usua, u.apel_usua, u.corre_usua, qm.nume_qued FROM quedan_detalle as qd INNER JOIN quedan_maestro as qm on qm.codi_qued=qd.codi_qued INNER JOIN factura as f ON f.codi_fact=qd.codi_fact INNER JOIN factura_detalle AS fd ON f.codi_fact=fd.codi_fact INNER JOIN curso as c ON c.codi_curs=fd.codi_curs INNER JOIN usuario as u ON u.codi_casa=c.codi_casa WHERE qd.codi_qued=? AND u.codi_tipo_usua=1";
		$params = array($this->codi_qued);
		return Database::getRow($sql, $params);
    }
    public function obtenerCorreoEmisor($codi) {
		$sql = "SELECT corre_usua FROM usuario WHERE codi_usua=?";
		$params = array($codi);
		return Database::getRow($sql, $params);
	}
}
