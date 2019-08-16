<?php

class Acreditacion extends Validator {
	// Declaraion de propiedades
	private $codi_acre = null;
	private $tipo_acre = null;
	private $esta_acre = null;

	// Encapsulamiento de codigo de categoria
	public function setCodiAcre($value) {
		//validando de que el valor sea un id
		if ($this->validateId($value)) {
			//seteando valor a la variable codigo
			$this->codi_acre = $value;
			//retornar true
			return true;
		} else {
			//retornar respuesta falso
			return false;
		}
	}

	public function getCodiAcre($value) {
		//retornar el valor del codigo de categoria
		return $this->codi_acre;
	}
	//Encapsulamiento de nombre de categoria
	public function setTipoAcre($value) {
		//validando de que el valor sea alfabetico y que sea mayor a uno y menor a cien
		if ($this->validateAlphanumeric($value, 1, 250)) {
			//seteando valor a la variable de nombre de categoria
			$this->tipo_acre = $value;
			//retornando respuesta true
			return true;
		} else {
			//retornando respuesta false
			return false;
		}
	}

	public function getTipoAcre() {
		return $this->tipo_acre;
	}
	//Encapsulamiento de estado de categoria
	public function setEstaAcre($value) {
		$this->esta_acre = $value;
		return true;
	}

	public function getEstaAcre($value) {
		return $this->esta_acre;
	}
	//FUNCIONES DEL CRUD
	//Funcion para crear categoria
	public function createAcreditacion() {
		$sql = "INSERT INTO acreditacion(tipo_acre, esta_acre) VALUES (?, 1)";
		$params = array($this->tipo_acre);
		return Database::executeRow($sql, $params);
	}
	public function updateAcreditacion() {
		$sql = "UPDATE acreditacion SET tipo_acre = ? WHERE codi_acre = ?";
		$params = array($this->tipo_acre, $this->codi_acre);
		return Database::executeRow($sql, $params);
	}
	public function deleteAcreditacion() {
		$sql = "UPDATE acreditacion SET esta_acre = 0 WHERE codi_acre = ?";
		$params = array($this->codi_acre);
		return Database::executeRow($sql, $params);
	}
	//Funcion para obtener lista de registros de la tabla categoria sin json
	public function getAcreditacionN() {
		$sql = "SELECT codi_acre, tipo_acre, esta_acre FROM acreditacion WHERE esta_acre=1 ORDER BY codi_acre";
		$params = array(null);
		return Database::getRows($sql, $params);
	}
	public function getAcreditacion() {
		$sql = "SELECT codi_acre, tipo_acre, esta_acre FROM acreditacion WHERE esta_acre=1 ORDER BY codi_acre";
		$params = array(null);
		return Database::getRowsAjax($sql, $params);
	}
}