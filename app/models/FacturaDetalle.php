<?php

class FacturaDetalle extends Validator {
	// Declaraion de propiedades
	private $codi_fact_deta = null;
	private $codi_fact = null;
	private $codi_curs = null;
	private $esta_fact_deta = null;

	// Encapsulamiento
	public function setCodiFactDeta($value) {
		if ($this->validateId($value)) {
			$this->codi_fact_deta = $value;
			return true;

		} else {
			return false;
		}
	}
	public function getCodiFactDeta($value) {
		return $this->codi_fact_deta;
	}
	public function setCodiFact($value) {
		if ($this->validateId($value)) {
			$this->codi_fact = $value;
			return true;

		} else {
			return false;
		}
	}
	public function getCodiFact($value) {
		return $this->codi_fact;
	}
	public function setCodiCurs($value) {
		if ($this->validateId($value)) {
			$this->codi_curs = $value;
			return true;
		} else {
			return false;
		}
	}
	public function getCodiCurs($value) {
		return $this->codi_curs;
	}
	public function setEstaFactDeta($value) {
		$this->esta_fact_deta = $value;
		return true;
	}
	public function getEstaFactDeta($value) {
		return $this->esta_fact_deta;
	}

	// Funciones para CRUD
	//Funcion para agregar un nuevo egreso
	public function cambiandoEstadoDeLaFactura() {
		$sql = "UPDATE factura SET esta_fact = 1 WHERE codi_fact = ?";
		$params = array($this->codi_fact);
		return Database::executeRow($sql, $params);
	}
	public function addFacturaDetalle() {
		$sql = "INSERT INTO factura_detalle(codi_fact, codi_curs, esta_fact_deta) VALUES(?,?,1)";
		$params = array($this->codi_fact, $this->codi_curs);
		return Database::executeRow($sql, $params);
	}
	public function updateFacturaDetalle() {
		$sql = "UPDATE factura_detalle SET codi_curs =? WHERE codi_fact_deta = ?";
		$params = array($this->codi_curs, $this->codi_fact_deta);
		return Database::executeRow($sql, $params);
	}
	//Funcion para obtener el total de egresos en el mes y año para la casa logeada
	public function obtenerCursosDeFactura() {
		$sql = "SELECT c.codi_curs, c.nomb_curs FROM factura_detalle as fd INNER JOIN curso as c ON c.codi_curs= fd.codi_curs WHERE fd.esta_fact_deta = 1 AND fd.codi_fact=?";
		$params = array($this->codi_fact);
		return Database::getRow($sql, $params);
	}
	public function modificarEstadoCurso() {
		$sql = "UPDATE curso SET esta_curs = 5 WHERE codi_curs = ?";
		$params = array($this->codi_curs);
		return Database::executeRow($sql, $params);
	}
}
