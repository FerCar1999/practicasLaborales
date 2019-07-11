<?php

class IntermediaAcreditacionDocente extends Validator {
	// Declaraion de propiedades
	private $codi_inte_acre_doce = null;
	private $codi_acre = null;
    private $codi_doce = null;
    private $esta_inte_acre_doce = null;

	// Encapsulamiento de codigo de categoria
	public function setCodiInteAcreDoce($value) {
		//validando de que el valor sea un id
		if ($this->validateId($value)) {
			//seteando valor a la variable codigo
			$this->codi_inte_acre_doce = $value;
			//retornar true
			return true;
		} else {
			//retornar respuesta falso
			return false;
		}
	}

	public function getCodiInteAcreDoce($value) {
		//retornar el valor del codigo de categoria
		return $this->codi_inte_acre_doce;
    }
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
	public function setEstaInteAcreDoce($value) {
		//validando de que el valor sea un id
		if ($this->validateId($value)) {
			//seteando valor a la variable codigo
			$this->esta_inte_acre_doce = $value;
			//retornar true
			return true;
		} else {
			//retornar respuesta falso
			return false;
		}
	}

	public function getEstaInteAcreDoce($value) {
		//retornar el valor del codigo de categoria
		return $this->esta_inte_acre_doce;
	}
	//FUNCIONES DEL CRUD
	//Funcion para crear categoria
	public function createIntermediaAcreditacionDocente() {
		$sql = "INSERT INTO intermedia_acreditacion_docente(codi_acre, codi_doce, esta_inte_acre_doce) VALUES (?, ?, 1)";
		$params = array($this->codi_acre, $this->codi_doce);
		return Database::executeRow($sql, $params);
	}
	public function updateIntermediaAcreditacionDocente()
    {
        $sql    = "UPDATE intermedia_acreditacion_docente SET codi_acre = ?, codi_doce = ? WHERE codi_inte_acre_doce = ?";
        $params = array($this->codi_acre, $this->codi_doce, $this->codi_inte_acre_doce);
        return Database::executeRow($sql, $params);
    }
    public function deleteIntermediaAcreditacionDocente()
    {
        $sql    = "UPDATE intermedia_acreditacion_docente SET esta_inte_acre_doce = 0 WHERE codi_inte_acre_doce = ?";
        $params = array($this->codi_inte_acre_doce);
        return Database::executeRow($sql, $params);
    }
    //Funcion para obtener lista de registros de la tabla categoria sin json
    public function getIntermediaAcreditacionDocenteN()
    {
        $sql    = "SELECT codi_cate, nomb_cate FROM categoria WHERE esta_cate=1 ORDER BY codi_cate";
        $params = array(null);
        return Database::getRows($sql, $params);
    }
}