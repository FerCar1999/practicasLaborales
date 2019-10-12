<?php

class Docente extends Validator
{
	// Declaraion de propiedades
	private $codi_doce = null;
	private $codi_casa = null;
	private $nomb_doce = null;
	private $apel_doce = null;
	private $esta_doce = null;

	// Encapsulamiento de codigo de categoria
	public function setCodiDoce($value)
	{
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

	public function getCodiDoce($value)
	{
		//retornar el valor del codigo de categoria
		return $this->codi_doce;
	}

	public function setCodiCasa($value)
	{
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

	public function getCodiCasa($value)
	{
		//retornar el valor del codigo de categoria
		return $this->codi_casa;
	}
	//Encapsulamiento de nombre de categoria
	public function setNombDoce($value)
	{
		//validando de que el valor sea alfabetico y que sea mayor a uno y menor a cien
		if ($this->validateAlphanumeric($value, 1, 100)) {
			//seteando valor a la variable de nombre de categoria
			$this->nomb_doce = $value;
			//retornando respuesta true
			return true;
		} else {
			//retornando respuesta false
			return false;
		}
	}

	public function getNombDoce()
	{
		return $this->nomb_doce;
	}

	public function setApelDoce($value)
	{
		//validando de que el valor sea alfabetico y que sea mayor a uno y menor a cien
		if ($this->validateAlphanumeric($value, 1, 100)) {
			//seteando valor a la variable de nombre de categoria
			$this->apel_doce = $value;
			//retornando respuesta true
			return true;
		} else {
			//retornando respuesta false
			return false;
		}
	}

	public function getApelDoce()
	{
		return $this->apel_doce;
	}
	//Encapsulamiento de estado de categoria
	public function setEstaDoce($value)
	{
		$this->esta_doce = $value;
		return true;
	}

	public function getEstaDoce($value)
	{
		return $this->esta_doce;
	}

	//FUNCIONES DEL CRUD
	//Funcion para crear categoria
	public function createDocente()
	{
		$sql = "INSERT INTO docente(codi_casa,nomb_doce,apel_doce,esta_doce) VALUES (?,?,?,1)";
		$params = array($this->codi_casa, $this->nomb_doce, $this->apel_doce);
		return Database::executeRow($sql, $params);
	}
	//Funcion para obtener lista de registros de la tabla categoria sin json
	public function getDocentesN()
	{
		$sql = "SELECT codi_doce, nomb_doce, apel_doce FROM docente WHERE esta_doce = 1 AND codi_casa = ? ORDER BY codi_doce";
		$params = array($this->codi_casa);
		return Database::getRows($sql, $params);
	}
	//Funcion para obtener lista de registros en la tabla categoria
	public function getDocentes()
	{
		$sql = "SELECT d.codi_doce, d.nomb_doce, d.apel_doce,iad.codi_inte_acre_doce, a.codi_acre, idp.codi_inte_doce_prof ,p.codi_prof FROM intermedia_acreditacion_docente as iad INNER JOIN acreditacion as a ON a.codi_acre=iad.codi_acre INNER JOIN docente as d ON d.codi_doce=iad.codi_doce INNER JOIN intermedia_docente_profesion as idp ON idp.codi_doce = d.codi_doce INNER JOIN profesion as p ON p.codi_prof=idp.codi_prof WHERE esta_doce=1 AND codi_casa=? ORDER BY codi_doce";
		$params = array($this->codi_casa);
		return Database::getRowsAjax($sql, $params);
	}

	//Funcion para modificar tanto el nombre o el estado un registro de la tabla categoria
	public function updateDocente()
	{
		$sql = "UPDATE docente SET nomb_doce = ?, apel_doce = ? WHERE codi_doce = ?";
		$params = array($this->nomb_doce, $this->apel_doce, $this->codi_doce);
		return Database::executeRow($sql, $params);
	}
	public function deleteDocente()
	{
		$sql = "UPDATE docente SET esta_doce = 0 WHERE codi_doce = ?";
		$params = array($this->codi_doce);
		return Database::executeRow($sql, $params);
	}
	public function obtenerListaMaestros($codiCurs)
	{
		$sql = "SELECT DISTINCT d.nomb_doce, d.apel_doce from intermedia_horario_docente as ihd INNER JOIN intermedia_curso_salon as ics ON ihd.codi_inte_curs_salo= ics.codi_inte_curs_salo INNER JOIN docente as d ON ihd.codi_doce = d.codi_doce WHERE ics.codi_curs=?";
		$params = array($codiCurs);
		return Database::getRows($sql, $params);
	}
	public function reporteDocenteEspecifico($fechaInic, $fechaFin)
	{
		$sql = "SELECT sa.nomb_salo,CONCAT(time_format(ho.hora_inic, '%r'), ' - ', time_format(ho.hora_fin, '%r')) AS hora, 
        ho.codi_dia, cu.nomb_curs, CONCAT(doc.nomb_doce,' ',doc.apel_doce) AS nomb_doce, TIMESTAMPDIFF(DAY, CURDATE(), cu.fech_fin)  as finalizacion
        FROM intermedia_horario_docente AS ihd
        INNER JOIN intermedia_curso_salon AS ics ON ics.codi_inte_curs_salo=ihd.codi_inte_curs_salo
        INNER JOIN horario AS ho ON ho.codi_hora=ihd.codi_hora
        INNER JOIN docente AS doc ON doc.codi_doce=ihd.codi_doce
        INNER JOIN curso AS cu ON cu.codi_curs=ics.codi_curs
        INNER JOIN salon AS sa ON sa.codi_salo=ics.codi_salo
		WHERE doc.codi_doce = ? AND cu.fech_inic BETWEEN ? AND ?
		ORDER BY ho.codi_dia, ho.hora_inic ASC";
		$params = array($this->codi_doce, $fechaInic, $fechaFin);
		return Database::getRows($sql, $params);
	}
	public function reporteDocenteCompleto($fechaInic, $fechaFin)
	{
		$sql = "SELECT sa.nomb_salo,CONCAT(time_format(ho.hora_inic, '%r'), ' - ', time_format(ho.hora_fin, '%r')) AS hora, 
        ho.codi_dia, cu.nomb_curs, CONCAT(doc.nomb_doce,' ',doc.apel_doce) AS nomb_doce, TIMESTAMPDIFF(DAY, CURDATE(), cu.fech_fin) as finalizacion 
        FROM intermedia_horario_docente AS ihd
        INNER JOIN intermedia_curso_salon AS ics ON ics.codi_inte_curs_salo=ihd.codi_inte_curs_salo
        INNER JOIN horario AS ho ON ho.codi_hora=ihd.codi_hora
        INNER JOIN docente AS doc ON doc.codi_doce=ihd.codi_doce
        INNER JOIN curso AS cu ON cu.codi_curs=ics.codi_curs
        INNER JOIN salon AS sa ON sa.codi_salo=ics.codi_salo
		WHERE cu.fech_inic BETWEEN ? AND ?
		ORDER BY doc.nomb_doce,ho.codi_dia, ho.hora_inic ASC";
		$params = array($fechaInic, $fechaFin);
		return Database::getRows($sql, $params);
	}
}
