<?php

class IntermediaDocenteProfesion extends Validator {
	// Declaraion de propiedades
	private $codi_inte_doce_prof = null;
	private $codi_prof = null;
	private $codi_doce = null;
	private $esta_inte_doce_prof = null;

	// Encapsulamiento de codigo de categoria
	public function setCodiInteDoceProf($value) {
		//validando de que el valor sea un id
		if ($this->validateId($value)) {
			//seteando valor a la variable codigo
			$this->codi_inte_doce_prof = $value;
			//retornar true
			return true;
		} else {
			//retornar respuesta falso
			return false;
		}
	}

	public function getCodiInteDoceProf($value) {
		//retornar el valor del codigo de categoria
		return $this->codi_inte_doce_prof;
	}
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
	// Encapsulamiento de codigo de categoria
	public function setCodiDoce($value) {
		//validando de que el valor sea un id
		if ($this->validateId($value)) {
			//seteando valor a la variable codigo
			$this->codi_doce = $value;
			//retornar true
			return true;
		} else {
			//retornar respuesta falso
			return false;
		}
	}

	public function getCodiDoce($value) {
		//retornar el valor del codigo de categoria
		return $this->codi_doce;
	}
	// Encapsulamiento de codigo de categoria
	public function setEstaInteDoceProf($value) {
		//validando de que el valor sea un id
		if ($this->validateId($value)) {
			//seteando valor a la variable codigo
			$this->esta_inte_doce_prof = $value;
			//retornar true
			return true;
		} else {
			//retornar respuesta falso
			return false;
		}
	}

	public function getEstaInteDoceProf($value) {
		//retornar el valor del codigo de categoria
		return $this->esta_inte_doce_prof;
	}
	//FUNCIONES DEL CRUD
	//Funcion para crear categoria
	public function createIntermediaDocenteProfesion() {
		$sql = "INSERT INTO intermedia_docente_profesion(codi_prof, codi_doce, esta_inte_doce_prof) VALUES (?, ?, 1)";
		$params = array($this->codi_prof, $this->codi_doce);
		return Database::executeRow($sql, $params);
	}
	public function updateIntermediaDocenteProfesion() {
		$sql = "UPDATE intermedia_docente_profesion SET codi_prof = ?, codi_doce = ? WHERE codi_inte_doce_prof = ?";
		$params = array($this->codi_prf, $this->codi_doce, $this->codi_inte_doce_prof);
		return Database::executeRow($sql, $params);
	}
	public function deleteIntermediaDocenteProfesion() {
		$sql = "UPDATE intermedia_docente_profesion SET esta_inte_doce_prof = 0 WHERE codi_inte_doce_prof = ?";
		$params = array($this->codi_inte_doce_prof);
		return Database::executeRow($sql, $params);
	}
	//Funcion para obtener lista de registros de la tabla categoria sin json
	public function getIntermediaDocenteProfesionN() {
		$sql = "SELECT codi_cate, nomb_cate FROM categoria WHERE esta_cate=1 ORDER BY codi_cate";
		$params = array(null);
		return Database::getRows($sql, $params);
	}
}