<?php

class Contacto extends Validator
{
	// Declaraion de propiedades
	private $codi_cont = null;
	private $codi_prof = null;
	private $nomb_cont = null;
	private $apel_cont = null;
	private $carg_cont = null;
	private $empr_cont = null;
	private $dire_cont = null;
	private $corr_cont = null;
	private $tele_fijo_cont = null;
	private $tele_celu_cont = null;
	private $obse_cont = null;
	private $codi_etiq = null;
	private $esta_cont = null;

	public function setCodiCont($value)
	{
		if ($this->validateId($value)) {
			$this->codi_cont = $value;
			return true;
		} else {
			return false;
		}
	}
	public function getCodiCont($value)
	{
		return $this->codi_cont;
	}
	public function setCodiProf($value)
	{
		if ($this->validateId($value)) {
			$this->codi_prof = $value;
			return true;
		} else {
			return false;
		}
	}
	public function getCodiProf($value)
	{
		return $this->codi_prof;
	}
	public function setNombCont($value)
	{
		if ($this->validateAlphanumeric($value, 1, 250)) {
			$this->nomb_cont = $value;
			return true;
		} else {
			return false;
		}
	}
	public function getNombCont()
	{
		return $this->nomb_cont;
	}
	public function setApelCont($value)
	{
		if ($this->validateAlphanumeric($value, 1, 250)) {
			$this->apel_cont = $value;
			return true;
		} else {
			return false;
		}
	}
	public function getApelCont()
	{
		return $this->apel_cont;
	}
	public function setCargCont($value)
	{
		if ($this->validateAlphanumeric($value, 0, 100)) {
			$this->carg_cont = $value;
			return true;
		} else {
			return false;
		}
	}
	public function getCargCont()
	{
		return $this->carg_cont;
	}
	public function setEmprCont($value)
	{
		if ($this->validateAlphanumeric($value, 0, 250)) {
			$this->empr_cont = $value;
			return true;
		} else {
			return false;
		}
	}
	public function getEmprCont()
	{
		return $this->empr_cont;
	}
	public function setDireCont($value)
	{
		if ($this->validateAlphanumeric($value, 0, 400)) {
			$this->dire_cont = $value;
			return true;
		} else {
			return false;
		}
	}
	public function getDireCont()
	{
		return $this->dire_cont;
	}
	public function setCorrCont($value)
	{
		if ($this->validateEmail($value)) {
			$this->corr_cont = $value;
			return true;
		} else {
			return false;
		}
	}
	public function getCorrCont()
	{
		return $this->corr_cont;
	}
	public function setTeleFijoCont($value)
	{
		if (strlen($value) > 0) {
			if ($this->validateTelefono($value)) {
				$this->tele_fijo_cont = $value;
				return true;
			} else {
				return false;
			}
		} else {
			$this->tele_fijo_cont = $value;
			return true;
		}
	}
	public function getTeleFijoCont()
	{
		return $this->tele_fijo_cont;
	}
	public function setTeleCeluCont($value)
	{
		if (strlen($value) > 0) {
			if ($this->validateTelefono($value)) {
				$this->tele_celu_cont = $value;
				return true;
			} else {
				return false;
			}
		} else {
			$this->tele_celu_cont = $value;
			return true;
		}
	}
	public function getTeleCeluCont()
	{
		return $this->tele_celu_cont;
	}
	public function setObseCont($value)
	{
		if (strlen($value) > 0) {
			if ($this->validateAlphanumeric($value, 1, 500)) {
				$this->obse_cont = $value;
				return true;
			} else {
				return false;
			}
		} else {
			$this->obse_cont = $value;
			return true;
		}
	}
	public function getObseCont()
	{
		return $this->obse_cont;
	}
	public function setCodiEtiq($value)
	{
		if ($this->validateId($value)) {
			$this->codi_etiq = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getCodiEtiq($value)
	{
		return $this->codi_etiq;
	}
	//Encapsulamiento de estado de categoria
	public function setEstaCont($value)
	{
		$this->esta_cont = $value;
		return true;
	}

	public function getEstaCont($value)
	{
		return $this->esta_cont;
	}
	//FUNCIONES DEL CRUD
	//Funcion para crear categoria
	public function createContacto()
	{
		$sql = "INSERT INTO contacto(codi_prof, nomb_cont, apel_cont, carg_cont, empr_cont, dire_cont, corr_cont, tele_fijo_cont, tele_celu_cont) VALUES (?,?,?,?,?,?,?,?,?)";
		$params = array($this->codi_prof, $this->nomb_cont, $this->apel_cont, $this->carg_cont, $this->empr_cont, $this->dire_cont, $this->corr_cont, $this->tele_fijo_cont, $this->tele_celu_cont);
		return Database::executeRow($sql, $params);
	}
	public function updateContacto()
	{
		$sql = "UPDATE contacto SET codi_prof = ?, nomb_cont = ?, apel_cont = ?, carg_cont = ?, empr_cont = ?, dire_cont = ?, corr_cont = ?, tele_fijo_cont = ?, tele_celu_cont = ?, obse_cont = ? WHERE codi_cont = ?";
		$params = array($this->codi_prof, $this->nomb_cont, $this->apel_cont, $this->carg_cont, $this->empr_cont, $this->dire_cont, $this->corr_cont, $this->tele_fijo_cont, $this->tele_celu_cont, $this->obse_cont, $this->codi_cont);
		return Database::executeRow($sql, $params);
	}
	public function deleteContacto()
	{
		$sql = "UPDATE contacto SET esta_cont = 0 WHERE codi_cont = ?";
		$params = array($this->codi_cont);
		return Database::executeRow($sql, $params);
	}
	//Funcion para obtener lista de registros de la tabla categoria sin json
	public function getContactoN($codi)
	{
		$sql = "SELECT co.codi_cont, CONCAT(co.nomb_cont, ' ', co.apel_cont) as nomb_cont FROM contacto as co INNER JOIN intermedia_contacto_etiqueta as ice ON ice.codi_cont=co.codi_cont WHERE ice.codi_etiq=? AND co.esta_cont=1";
		$params = array($codi);
		return Database::getRows($sql, $params);
	}
	public function getContactoR($codi, $even)
	{
		$sql = "SELECT co.codi_cont, CONCAT(co.nomb_cont, ' ', co.apel_cont) as nomb_cont 
		FROM contacto as co 
		INNER JOIN intermedia_contacto_etiqueta as ice ON ice.codi_cont=co.codi_cont 
		WHERE ice.codi_etiq=? AND co.esta_cont=1 AND co.codi_cont NOT IN(
		SELECT ev.codi_cont FROM evento_detalle as ev WHERE ev.codi_even=? AND ev.codi_etiq=? AND esta_even_deta=1 OR ev.codi_even=? AND esta_even_deta=1)";
		$params = array($codi, $even, $codi, $even);
		return Database::getRows($sql, $params);
	}
	public function getContacto()
	{
		$sql = "SELECT co.codi_cont, co.codi_prof, pr.nomb_prof, co.nomb_cont, co.apel_cont, co.carg_cont, co.empr_cont, co.dire_cont, co.corr_cont, co.tele_fijo_cont, co.tele_celu_cont, co.obse_cont  FROM contacto as co INNER JOIN profesion as pr ON pr.codi_prof=co.codi_prof WHERE co.esta_cont=1";
		$params = array(null);
		return Database::getRowsAjax($sql, $params);
	}
	public function getContactosEtiqueta($etiqueta, $codigos)
	{
		$sql = "SELECT CONCAT(co.nomb_cont, ' ', co.apel_cont) as nombre, co.carg_cont, co.empr_cont, co.dire_cont FROM contacto as co INNER JOIN intermedia_contacto_etiqueta as ice ON ice.codi_cont=co.codi_cont WHERE co.esta_cont=1 AND ice.codi_etiq = ? " . $codigos;
		$params = array($etiqueta);
		return Database::getRows($sql, $params);
	}
}
