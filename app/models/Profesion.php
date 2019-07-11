<?php

class Profesion extends Validator {
	// Declaraion de propiedades
	private $codi_prof = null;
	private $nomb_prof = null;
	private $esta_prof = null;

	// Encapsulamiento de codigo de categoria
	public function setCodiProf($value) {
		//validando de que el valor sea un id
		if ($this->validateId($value)) {
			//seteando valor a la variable codigo
			$this->codi_prof = $value;
			//retornar true
			return true;
		} else {
			//retornar respuesta falso
			return false;
		}
	}

	public function getCodiProf($value) {
		//retornar el valor del codigo de categoria
		return $this->codi_prof;
	}
	//Encapsulamiento de nombre de categoria
	public function setNombProf($value) {
		//validando de que el valor sea alfabetico y que sea mayor a uno y menor a cien
		if ($this->validateAlphabetic($value, 1, 150)) {
			//seteando valor a la variable de nombre de categoria
			$this->nomb_prof = $value;
			//retornando respuesta true
			return true;
		} else {
			//retornando respuesta false
			return false;
		}
	}

	public function getNombProf() {
		return $this->nomb_prof;
	}
	//Encapsulamiento de estado de categoria
	public function setEstaProf($value) {
		$this->esta_prof = $value;
		return true;
	}

	public function getEstaProf($value) {
		return $this->esta_prof;
	}
	//FUNCIONES DEL CRUD
	//Funcion para crear categoria
	public function createProfesion() {
		$sql = "INSERT INTO profesion(nomb_prof, esta_prof) VALUES (?, 1)";
		$params = array($this->nomb_prof);
		return Database::executeRow($sql, $params);
	}
	public function updateProfesion() {
		$sql = "UPDATE profesion SET nomb_prof = ? WHERE codi_prof = ?";
		$params = array($this->nomb_prof, $this->codi_prof);
		return Database::executeRow($sql, $params);
	}
	public function deleteProfesion() {
		$sql = "UPDATE profesion SET esta_prof = 0 WHERE codi_prof = ?";
		$params = array($this->codi_prof);
		return Database::executeRow($sql, $params);
	}
	//Funcion para obtener lista de registros de la tabla categoria sin json
	public function getProfesionN() {
		$sql = "SELECT codi_prof, nomb_prof FROM profesion WHERE esta_prof=1 ORDER BY nomb_prof";
		$params = array(null);
		return Database::getRows($sql, $params);
	}
	public function getProfesion() {
		$sql = "SELECT codi_prof, nomb_prof, esta_prof FROM profesion WHERE esta_prof=1 ORDER BY nomb_prof";
		$params = array(null);
		return Database::getRowsAjax($sql, $params);
	}
}