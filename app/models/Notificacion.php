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
	public function getCursosFinalizarPronto($fechActual) {
		$sql = "SELECT nomb_curs, fech_fin FROM curso WHERE TIMESTAMPDIFF(DAY,?,fech_fin)<=5 AND codi_casa=?  AND esta_curs=1";
		$params = array($fechActual, $this->codi_casa);
		return Database::getRows($sql, $params);
	}
	public function getCursosFinalizadosInforme($fechaActual) {
		$sql = "SELECT codi_curs ,nomb_curs, fech_fin FROM curso WHERE  codi_casa=? AND esta_curs=2";
		$params = array($this->codi_casa);
		return Database::getRows($sql, $params);
	}
	public function getCursosFinalizadosInformeEncargado($fechaActual, $estado) {
		$sql = "SELECT codi_curs ,nomb_curs, fech_fin FROM curso WHERE  codi_casa=? AND codi_cate=? AND esta_curs=2";
		$params = array($this->codi_casa, $estado);
		return Database::getRows($sql, $params);
	}
	public function getCursosFinalizadosInformeAprovacion() {
		$sql = "SELECT c.codi_curs ,c.nomb_curs, c.fech_info, u.nomb_usua, u.apel_usua FROM curso as c INNER JOIN usuario as u ON u.codi_usua=c.usua_info WHERE c.codi_casa=? AND c.esta_curs=3";
		$params = array($this->codi_casa);
		return Database::getRows($sql, $params);
	}
	public function getCursosPendientesFactura($fechaActual) {
		$sql = "SELECT codi_curs ,nomb_curs, fech_info FROM curso WHERE TIMESTAMPDIFF(DAY,fech_info,?)<=20 AND codi_casa=? AND esta_curs=4";
		$params = array($fechaActual, $this->codi_casa);
		return Database::getRows($sql, $params);
	}
	public function getFacturasPendientesDeQuedan() {
		$sql = "SELECT DISTINCT qm.codi_qued, qm.nume_qued FROM quedan_detalle as qd INNER JOIN quedan_maestro as qm ON qm.codi_qued=qd.codi_qued INNER JOIN factura as f ON f.codi_fact=qd.codi_fact INNER JOIN factura_detalle as fd ON fd.codi_fact=f.codi_fact INNER JOIN curso as c ON c.codi_curs=fd.codi_curs WHERE c.codi_casa=? AND qm.esta_qued=1";
		$params = array($this->codi_casa);
		return Database::getRows($sql, $params);
	}
	public function getQuedanPendientesDeAbonar($fechaActual) {
		$sql = "SELECT codi_qued, nume_qued WHERE quedan_maestro TIMESTAMPDIFF(DAY, fech_ing, ?) AND esta_qued=1";
		$params = array($fechaActual);
		return Database::getRows($sql, $params);
	}
	public function getOtrasNotificaciones() {
		$sql = "SELECT codi_noti, acci_noti FROM notificaciones WHERE codi_casa=?";
		$params = array($this->codi_casa);
		return Database::getRows($sql, $params);
	}
	public function obtenerIdAdministradorCasa() {
		$sql = "SELECT nomb_usua, apel_usua, corre_usua FROM usuario WHERE codi_casa=? AND codi_tipo_usua=1";
		$params = array($this->codi_casa);
		return Database::getRow($sql, $params);
	}
	public function obtenerInfoUsuariosCasa() {
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