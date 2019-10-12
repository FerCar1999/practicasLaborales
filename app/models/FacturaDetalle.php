<?php

class FacturaDetalle extends Validator
{
	// Declaraion de propiedades
	private $codi_fact_deta = null;
	private $codi_fact = null;
	private $codi_curs = null;
	private $esta_fact_deta = null;

	// Encapsulamiento
	public function setCodiFactDeta($value)
	{
		if ($this->validateId($value)) {
			$this->codi_fact_deta = $value;
			return true;
		} else {
			return false;
		}
	}
	public function getCodiFactDeta($value)
	{
		return $this->codi_fact_deta;
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
	public function setEstaFactDeta($value)
	{
		$this->esta_fact_deta = $value;
		return true;
	}
	public function getEstaFactDeta($value)
	{
		return $this->esta_fact_deta;
	}

	// Funciones para CRUD
	//Funcion para agregar un nuevo egreso
	public function cambiandoEstadoDeLaFactura($estado)
	{
		$sql = "UPDATE factura SET esta_fact = ? WHERE codi_fact = ?";
		$params = array($estado, $this->codi_fact);
		return Database::executeRow($sql, $params);
	}
	public function cambiandoEstadoDelCurso($fecha)
	{
		$sql = "UPDATE curso SET esta_curs=3, fech_info=?, usua_info=? WHERE codi_curs=?";
		$params = array($fecha, $_SESSION['codi_usua'], $this->codi_curs);
		return Database::executeRow($sql, $params);
	}
	public function addFacturaDetalle()
	{
		$sql = "INSERT INTO factura_detalle(codi_fact, codi_curs, esta_fact_deta) VALUES(?,?,1)";
		$params = array($this->codi_fact, $this->codi_curs);
		return Database::executeRow($sql, $params);
	}
	public function updateFacturaDetalle()
	{
		$sql = "UPDATE factura_detalle SET codi_curs =? WHERE codi_fact_deta = ?";
		$params = array($this->codi_curs, $this->codi_fact_deta);
		return Database::executeRow($sql, $params);
	}
	//Funcion para obtener el total de egresos en el mes y año para la casa logeada
	public function obtenerCursosDeFactura()
	{
		$sql = "SELECT c.codi_curs, c.nomb_curs FROM factura_detalle as fd INNER JOIN curso as c ON c.codi_curs= fd.codi_curs WHERE fd.esta_fact_deta = 1 AND fd.codi_fact=?";
		$params = array($this->codi_fact);
		return Database::getRow($sql, $params);
	}
	public function modificarEstadoCurso()
	{
		$sql = "UPDATE curso SET esta_curs = 5 WHERE codi_curs = ?";
		$params = array($this->codi_curs);
		return Database::executeRow($sql, $params);
	}
	public function getReporteFactura()
	{
		$sql = "SELECT f.nume_fact, f.fech_emis_fact, f.cant_fact, f.esta_fact, c.corr_curs, c.nomb_curs, CONCAT(ca.nomb_cate, ' (', ca.corr_cate, ')') as nomb_cate 
		FROM factura_detalle AS fd
		INNER JOIN factura AS f ON f.codi_fact=fd.codi_fact
		INNER JOIN curso AS c ON c.codi_curs=fd.codi_curs
		INNER JOIN categoria as ca ON ca.codi_cate=c.codi_cate
		WHERE f.codi_fact=?";
		$params = array($this->codi_fact);
		return Database::getRows($sql, $params);
	}
	public function getReporteCategoria($categoria, $inicio, $final, $casa)
	{
		$sql = "SELECT f.nume_fact, f.fech_emis_fact, f.cant_fact, f.esta_fact, c.corr_curs, c.nomb_curs, CONCAT(ca.nomb_cate, ' (', ca.corr_cate, ')') as nomb_cate 
		FROM factura_detalle AS fd
		INNER JOIN factura AS f ON f.codi_fact=fd.codi_fact
		INNER JOIN curso AS c ON c.codi_curs=fd.codi_curs
		INNER JOIN categoria as ca ON ca.codi_cate=c.codi_cate
		WHERE ca.codi_cate=? AND c.codi_casa =? AND f.fech_emis_fact BETWEEN ? AND ?";
		$params = array($categoria, $casa, $inicio, $final);
		return Database::getRows($sql, $params);
	}
	public function getReporteFecha($inicio, $final, $casa)
	{
		$sql = "SELECT f.nume_fact, f.fech_emis_fact, f.cant_fact, f.esta_fact, c.corr_curs, c.nomb_curs, CONCAT(ca.nomb_cate, ' (', ca.corr_cate, ')') as nomb_cate 
		FROM factura_detalle AS fd
		INNER JOIN factura AS f ON f.codi_fact=fd.codi_fact
		INNER JOIN curso AS c ON c.codi_curs=fd.codi_curs
		INNER JOIN categoria as ca ON ca.codi_cate=c.codi_cate
		WHERE c.codi_casa =? AND f.fech_emis_fact BETWEEN ? AND ?";
		$params = array($casa, $inicio, $final);
		return Database::getRows($sql, $params);
	}
}
