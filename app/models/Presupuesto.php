<?php

class Presupuesto extends Validator {
	// Declaraion de propiedades
	private $codi_pres = null;
	private $codi_casa = null;
	private $codi_usua = null;
	private $cant_pres = null;
	private $fech_pres = null;

	// Encapsulamiento
	public function setCodiPres($value) {
		if ($this->validateId($value)) {
			$this->codi_pres = $value;
			return true;

		} else {
			return false;
		}
	}
	public function getCodiPres($value) {
		return $this->codi_pres;
	}
	public function setCodiCasa($value) {
		if ($this->validateId($value)) {
			$this->codi_casa = $value;
			return true;
		} else {
			return false;
		}
	}
	public function getCodiCasa($value) {
		return $this->codi_casa;
	}
	public function setCodiUsua($value) {
		if ($this->validateId($value)) {
			$this->codi_usua = $value;
			return true;
		} else {
			return false;
		}
	}
	public function getCodiUsua($value) {
		return $this->codi_usua;
	}

	public function setCantPres($value) {
		if ($value > 0) {
			$this->cant_pres = $value;
			return true;
		} else {
			return false;
		}
	}
	public function getCantPres() {
		return $this->cant_pres;
	}
	public function setFechPres($value) {
		if ($this->validateDate($value)) {
			$this->fech_pres=$value;
			return true;
		} else {
			return false;
		}
	}
	public function getFechPres() {
		return $this->fech_pres;
	}
	// Funciones para CRUD
	// Crear casa

	public function addPresupuesto() {
		$sql = "INSERT INTO presupuesto(codi_casa, codi_usua, cant_pres, fech_pres) VALUES(?,?,?,?)";
		$params = array($this->codi_casa, $this->codi_usua, $this->cant_pres, $this->fech_pres);
		return Database::executeRow($sql, $params);
	}
	public function updatePresupuesto() {
		$sql = "UPDATE presupuesto SET cant_pres = ? WHERE codi_pres=?";
		$params = array($this->cant_pres, $this->codi_pres);
		return Database::executeRow($sql, $params);
	}
	public function obtenerCasasSinPresupuesto($anio) {
		$sql = "SELECT c.codi_casa, c.nomb_casa FROM casa as c WHERE c.esta_casa=1 AND c.codi_casa NOT IN(SELECT p.codi_casa FROM presupuesto as p WHERE YEAR(p.fech_pres) = ?)";
		$params = array($anio);
		return Database::getRows($sql, $params);
	}
	// Obtener presupuestos de casas
	public function getPresupuestoCasas($anio) {
		$sql = "SELECT p.codi_pres, c.codi_casa, c.nomb_casa, p.cant_pres, (p.cant_pres - SUM(pd.cant_pres_deta)) as cant_rest FROM presupuesto_detalle as pd INNER JOIN presupuesto as p on p.codi_pres=pd.codi_pres INNER JOIN casa as c ON c.codi_casa=p.codi_casa WHERE YEAR(p.fech_pres)=? GROUP BY codi_pres";
		$params = array($anio);
		return Database::getRowsAjax($sql, $params);
	}
	public function obtenerCantidadSubPresupuesto() {
		$sql = "SELECT SUM(cant_pres_deta) as 'cant_pres_deta' FROM presupuesto_detalle WHERE codi_pres = ?";
		$params = array($this->codi_pres);
		$data = Database::getRow($sql, $params);
		if ($data) {
			return $data['cant_pres_deta'];
		} else {
			return 0;
		}
	}
	public function deletePresupuesto() {
		$sql = "DELETE FROM presupuesto WHERE codi_pres = ?";
		$params = array($this->codi_pres);
		return Database::executeRow($sql, $params);
	}

	public function obtenerIdAdministradorCasa() {
		$sql = "SELECT nomb_usua, apel_usua, corre_usua FROM usuario WHERE codi_casa=? AND codi_tipo_usua=1 OR codi_casa=? AND codi_tipo_usua=2";
		$params = array($this->codi_casa,$this->codi_casa);
		return Database::getRows($sql, $params);
	}
	public function obtenerCorreoEmisor($codi) {
		$sql = "SELECT corre_usua FROM usuario WHERE codi_usua=?";
		$params = array($codi);
		return Database::getRow($sql, $params);
	}
}
