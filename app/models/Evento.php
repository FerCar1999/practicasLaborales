<?php

class Evento extends Validator {
	// Declaraion de propiedades
	private $codi_even = null;
	private $nomb_even = null;
	private $desc_even = null;
	private $fech_even = null;
	private $foto_even = null;
	private $esta_even = null;

	// Encapsulamiento de codigo de categoria
	public function setCodiEven($value) {
		//validando de que el valor sea un id
		if ($this->validateId($value)) {
			//seteando valor a la variable codigo
			$this->codi_even = $value;
			//retornar true
			return true;
		} else {
			//retornar respuesta falso
			return false;
		}
	}

	public function getCodiEven($value) {
		//retornar el valor del codigo de categoria
		return $this->codi_even;
	}
	//Encapsulamiento de nombre de categoria
	public function setNombEven($value) {
		//validando de que el valor sea alfabetico y que sea mayor a uno y menor a cien
		if ($this->validateAlphanumeric($value, 1, 250)) {
			//seteando valor a la variable de nombre de categoria
			$this->nomb_even = $value;
			//retornando respuesta true
			return true;
		} else {
			//retornando respuesta false
			return false;
		}
	}

	public function getNombEven() {
		return $this->nomb_even;
	}
	public function setDescEven($value) {
		//validando de que el valor sea alfabetico y que sea mayor a uno y menor a cien
		if ($this->validateAlphanumeric($value, 1, 500)) {
			//seteando valor a la variable de nombre de categoria
			$this->desc_even = $value;
			//retornando respuesta true
			return true;
		} else {
			//retornando respuesta false
			return false;
		}
	}

	public function getDescEven() {
		return $this->desc_even;
	}
	public function setFechEven($value) {
		//validando de que el valor sea alfabetico y que sea mayor a uno y menor a cien
		if ($this->validateDate($value)) {
			//seteando valor a la variable de nombre de categoria
			$this->fech_even = $value;
			//retornando respuesta true
			return true;
		} else {
			//retornando respuesta false
			return false;
		}
	}

	public function getFechEven() {
		return $this->fech_even;
	}
	public function setImagen($file)
    {
        if ($this->validateImage($file, $this->foto_even, "../../web/eventos/", 3840, 2160)) {
            $this->foto_even = $this->getImageName();
            return true;
        } else {
            return false;
        }
    }
    public function getImagen()
    {
        return $this->foto_even;
	}
	public function unsetImagen()
    {
        if (unlink("../../web/eventos/" . $this->foto_even)) {
            $this->foto_even = null;
            return true;
        } else {
            return false;
        }
    }
	//Encapsulamiento de estado de categoria
	public function setEstaEven($value) {
		$this->esta_even = $value;
		return true;
	}

	public function getEstaEven($value) {
		return $this->esta_even;
	}
	//FUNCIONES DEL CRUD
	//Funcion para crear categoria
	public function createEvento($usua, $corr) {
		$sql = "INSERT INTO evento(nomb_even, desc_even, fech_even, foto_even, codi_usua, corr_even) VALUES (?,?,?,?,?,?)";
		$params = array($this->nomb_even, $this->desc_even, $this->fech_even, $this->foto_even,$usua, $corr);
		return Database::executeRow($sql, $params);
	}
	public function updateEvento($corr) {
		$sql = "UPDATE evento SET nomb_even = ?, desc_even = ?, fech_even = ?, corr_even=? WHERE codi_even = ?";
		$params = array($this->nomb_even, $this->desc_even, $this->fech_even, $corr, $this->codi_even);
		return Database::executeRow($sql, $params);
	}
	public function deleteEvento() {
		$sql = "UPDATE evento SET esta_even = 0 WHERE codi_even = ?";
		$params = array($this->codi_even);
		return Database::executeRow($sql, $params);
	}
	//Funcion para obtener lista de registros de la tabla categoria sin json\
	public function getEvento() {
		$sql = "SELECT codi_even, nomb_even, desc_even, fech_even, esta_even FROM evento WHERE esta_even=1 ";
		$params = array(null);
		return Database::getRowsAjax($sql, $params);
	}
	public function getEventoAhora($fecha) {
		$sql = "SELECT codi_even, nomb_even FROM evento WHERE esta_even=1 AND fech_even=?";
		$params = array($fecha);
		return Database::getRows($sql, $params);
	}
}