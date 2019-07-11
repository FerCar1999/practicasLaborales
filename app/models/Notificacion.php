<?php

class Notificacion extends Validator {
	// Declaraion de propiedades
	private $codi_noti = null;
	private $codi_casa = null;
	private $codi_emis = null;
	private $acci_noti = null;
	private $esta_noti = null;

	// Encapsulamiento de codigo de categoria
	public function setCodiNoti($value) {
		//validando de que el valor sea un id
		if ($this->validateId($value)) {
			//seteando valor a la variable codigo
			$this->codi_noti = $value;
			//retornar true
			return true;
		} else {
			//retornar respuesta falso
			return false;
		}
	}
	public function getCodiNoti($value) {
		//retornar el valor del codigo de categoria
		return $this->codi_noti;
	}
	// Encapsulamiento de codigo de categoria
	public function setCodiCasa($value) {
		//validando de que el valor sea un id
		if ($this->validateId($value)) {
			//seteando valor a la variable codigo
			$this->codi_casa = $value;
			//retornar true
			return true;
		} else {
			//retornar respuesta falso
			return false;
		}
	}

	public function getCodiCasa($value) {
		//retornar el valor del codigo de categoria
		return $this->codi_casa;
	}
	public function setCodiEmis($value) {
		//validando de que el valor sea un id
		if ($this->validateId($value)) {
			//seteando valor a la variable codigo
			$this->codi_emis = $value;
			//retornar true
			return true;
		} else {
			//retornar respuesta falso
			return false;
		}
	}

	public function getCodiEmis($value) {
		//retornar el valor del codigo de categoria
		return $this->codi_emis;
	}
	//Encapsulamiento de nombre de categoria
	public function setAcciNoti($value) {
		//validando de que el valor sea alfabetico y que sea mayor a uno y menor a cien
		if ($this->validateAlphanumeric($value, 1, 400)) {
			//seteando valor a la variable de nombre de categoria
			$this->acci_noti = $value;
			//retornando respuesta true
			return true;
		} else {
			//retornando respuesta false
			return false;
		}
	}

	public function getAcciNoti() {
		return $this->acci_noti;
	}
	//Encapsulamiento de estado de categoria
	public function setEstaNoti($value) {
		$this->esta_noti = $value;
		return true;
	}

	public function getEstaNoti($value) {
		return $this->esta_noti;
	}

	//FUNCIONES DEL CRUD
	//Funcion para crear categoria
	public function createNotificacion() {
		$sql = "INSERT INTO notificacion(codi_casa, codi_emis, acci_noti, esta_noti) VALUES (?, ?, ?, 1)";
		$params = array($this->codi_casa, $this->codi_emis, $this->acci_noti);
		return Database::executeRow($sql, $params);
	}
	//funcion para mostrar los cursos que estan a 5 dias de finalizar
	public function getCursosFinalizarPronto($fechaActual)
	{
		$sql = "SELECT nomb_curs FROM curso WHERE TIMESTAMPDIFF(DAY, ?,fech_fin)<=5 AND codi_casa=? AND esta_curs=1";
		$params = array($fechaActual, $this->codi_casa);
		return Database::getRows($sql, $params);
	}
	public function getCursosFinalizadosInforme($fechaActual)
	{
		$sql = "SELECT codi_curs ,nomb_curs FROM curso WHERE TIMESTAMPDIFF(DAY, ?,fech_fin)=0 AND codi_casa=? AND esta_curs=2";
		$params = array($fechaActual, $this->codi_casa);
		return Database::getRows($sql, $params);
	}
	public function getCursosPendientesFactura($fechaActual)
	{
		$sql = "SELECT codi_curs ,nomb_curs FROM curso WHERE TIMESTAMPDIFF(DAY,fech_fin,?)<=20 AND codi_casa=? AND esta_curs=3";
		$params = array($fechaActual, $this->codi_casa);
		return Database::getRows($sql, $params);
	}
	//Funcion para obtener lista de notificaciones
	public function getNotificacionesN() {
		$sql = "SELECT codi_noti,  FROM categoria WHERE esta_cate=1 ORDER BY codi_cate";
		$params = array(null);
		return Database::getRows($sql, $params);
	}
}