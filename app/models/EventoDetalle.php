<?php

class EventoDetalle extends Validator {
	// Declaraion de propiedades
	private $codi_even_deta = null;
	private $codi_even = null;
	private $codi_cont = null;
	private $codi_etiq = null;
	private $codi_usua = null;
	private $asis_even_deta = null;
	private $esta_even_deta = null;

	// Encapsulamiento de codigo de categoria
	public function setCodiEvenDeta($value) {
		//validando de que el valor sea un id
		if ($this->validateId($value)) {
			//seteando valor a la variable codigo
			$this->codi_even_deta = $value;
			//retornar true
			return true;
		} else {
			//retornar respuesta falso
			return false;
		}
	}

	public function getCodiEvenDeta() {
		//retornar el valor del codigo de categoria
		return $this->codi_even_deta;
	}
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

	public function getCodiEven() {
		//retornar el valor del codigo de categoria
		return $this->codi_even;
	}
	public function setCodiEtiq($value) {
		//validando de que el valor sea un id
		if ($this->validateId($value)) {
			//seteando valor a la variable codigo
			$this->codi_etiq = $value;
			//retornar true
			return true;
		} else {
			//retornar respuesta falso
			return false;
		}
	}

	public function getCodiEtiq() {
		//retornar el valor del codigo de categoria
		return $this->codi_etiq;
	}
	public function setCodiUsua($value) {
		//validando de que el valor sea un id
		if ($this->validateId($value)) {
			//seteando valor a la variable codigo
			$this->codi_usua = $value;
			//retornar true
			return true;
		} else {
			//retornar respuesta falso
			return false;
		}
	}

	public function getCodiUsua() {
		//retornar el valor del codigo de categoria
		return $this->codi_usua;
	}
	public function setCodiCont($value) {
		//validando de que el valor sea un id
		if ($this->validateId($value)) {
			//seteando valor a la variable codigo
			$this->codi_cont = $value;
			//retornar true
			return true;
		} else {
			//retornar respuesta falso
			return false;
		}
	}

	public function getCodiCont($value) {
		//retornar el valor del codigo de categoria
		return $this->codi_cont;
	}
	//Encapsulamiento de estado de categoria
	public function setAsisEvenDeta($value) {
		$this->asis_even_deta = $value;
		return true;
	}

	public function getAsisEvenDeta($value) {
		return $this->asis_even_deta;
	}
	public function setEstaEvenDeta($value) {
		$this->esta_even_deta = $value;
		return true;
	}

	public function getEstaEvenDeta($value) {
		return $this->esta_even_deta;
	}
	//FUNCIONES DEL CRUD
	//Funcion para crear categoria
	public function createEventoDetalle($token) {
		$sql = "INSERT INTO evento_detalle(codi_even, codi_cont, codi_etiq, toke_conf) VALUES (?, ?, ?, ?)";
		$params = array($this->codi_even, $this->codi_cont, $this->codi_etiq, $token);
		return Database::executeRow($sql, $params);
	}
	public function deleteEventoDetalle() {
		$sql = "UPDATE evento_detalle SET esta_even_deta = 0 WHERE codi_even_deta = ?";
		$params = array($this->codi_even_deta);
		return Database::executeRow($sql, $params);
	}
	//Funcion para obtener lista de registros de la tabla categoria sin json
	public function getEventoDetalle() {
		$sql = "SELECT ed.codi_even_deta, CONCAT(co.nomb_cont,' ',co.apel_cont) as nomb_cont, CONCAT(co.tele_fijo_cont, ' o ', co.tele_celu_cont) as tele_cont, co.empr_cont, et.nomb_etiq, ed.conf_even_deta, ed.asis_even_deta FROM evento_detalle as ed INNER JOIN contacto as co ON co.codi_cont= ed.codi_cont INNER JOIN etiqueta as et ON et.codi_etiq= ed.codi_etiq WHERE ed.esta_even_deta=1 AND ed.codi_even=?";
		$params = array($this->codi_even);
		return Database::getRowsAjax($sql, $params);
	}
	public function getEventoDetalleN() {
		$sql = "SELECT CONCAT(co.nomb_cont,' ',co.apel_cont) as nomb_cont, co.empr_cont, ed.conf_even_deta, ed.asis_even_deta, et.nomb_etiq FROM evento_detalle as ed INNER JOIN contacto as co ON co.codi_cont= ed.codi_cont INNER JOIN etiqueta as et ON et.codi_etiq= ed.codi_etiq WHERE ed.esta_even_deta=1 AND ed.codi_even=? AND ed.codi_etiq=?";
		$params = array($this->codi_even, $this->codi_etiq);
		return Database::getRows($sql, $params);
	}
	public function updateEstadoEvento() {
		$sql = "UPDATE evento SET esta_even=1 WHERE codi_even=?";
		$params = array($this->codi_even);
		return Database::executeRow($sql, $params);
	}
	public function updateAsistenciaEvento() {
		$sql = "UPDATE evento_detalle SET asis_even_deta=1, codi_usua=? WHERE codi_even_deta=?";
		$params = array($this->codi_usua, $this->codi_even_deta);
		return Database::executeRow($sql, $params);
	}
	public function confirmarAsistenciaEvento($token) {
		$sql = "UPDATE evento_detalle SET conf_even_deta=1 WHERE toke_conf=?";
		$params = array($token);
		return Database::executeRow($sql, $params);
	}
	public function infoEvento()
	{
		$sql = "SELECT nomb_even, foto_even, corr_even FROM evento WHERE codi_even=?";
		$params= array($this->codi_even);
		return Database::getRow($sql, $params);
	}
	public function infoContacto()
	{
		$sql = "SELECT pr.nomb_prof ,CONCAT(co.nomb_cont, ' ' , co.apel_cont) as nomb_cont, co.corr_cont, ed.toke_conf FROM evento_detalle as ed INNER JOIN contacto as co ON co.codi_cont=ed.codi_cont INNER JOIN profesion AS pr ON pr.codi_prof=co.codi_prof WHERE ed.codi_even=? AND ed.esta_asis_corr=0 AND ed.asis_even_deta=0";
		$params= array($this->codi_even);
		return Database::getRows($sql, $params);
	}
	public function obtenerConfirmacion($token)
	{
		$sql = "SELECT conf_even_deta FROM evento_detalle WHERE toke_conf=?";
		$params= array($token);
		return Database::getRow($sql, $params);
	}
	public function existenciaToken($token)
	{
		$sql = "SELECT COUNT(*) as existe FROM evento_detalle WHERE toke_conf=?";
		$params= array($token);
		return Database::getRow($sql, $params);
	}
	public function infoEventoDetalle($token)
	{
		$sql = "SELECT codi_even FROM evento_detalle WHERE toke_conf=?";
		$params= array($token);
		return Database::getRow($sql, $params);
	}
	public function getInfoUsuario($token)
	{
		$sql = "SELECT CONCAT(us.nomb_usua, ' ', us.apel_usua) AS nomb_usua, us.corre_usua, e.nomb_even, CONCAT(c.nomb_cont, ' ', c.apel_cont) AS nomb_cont 
		FROM evento as e 
		INNER JOIN usuario as us ON us.codi_usua=e.codi_usua 
		INNER JOIN evento_detalle AS ed ON ed.codi_even=e.codi_even
		INNER JOIN contacto AS c ON c.codi_cont=ed.codi_cont WHERE ed.toke_conf=?";
		$params= array($token);
		return Database::getRow($sql, $params);
	}
	public function getInfoUsuarioConfirmacion($token)
	{
		$sql = "SELECT e.nomb_even, CONCAT(co.nomb_cont, ' ', co.apel_cont) as nomb_cont, co.corr_cont, e.corr_even FROM evento_detalle as ed INNER JOIN evento as e ON e.codi_even=ed.codi_even INNER JOIN contacto as co ON co.codi_cont=ed.codi_cont WHERE toke_conf=?";
		$params= array($token);
		return Database::getRow($sql, $params);
	}
	public function modificarEstadoAsistenciaEnviada()
	{
		$sql = "UPDATE evento_detalle SET esta_asis_corr = 1 WHERE codi_even =?";
		$params= array($this->codi_even);
		return Database::executeRow($sql, $params);
	}
	public function confirmarAsistenciaEventoSinToken() {
		$sql = "UPDATE evento_detalle SET conf_even_deta=1 WHERE codi_even_deta=?";
		$params = array($this->codi_even_deta);
		return Database::executeRow($sql, $params);
	}
}