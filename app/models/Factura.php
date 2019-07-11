<?php

class Factura extends Validator
{
    // Declaraion de propiedades
    private $codi_fact = null;
    private $nume_fact = null;
    private $fech_emis_fact = null;
    private $fech_ingr = null;
    private $cant_fact = null;
    private $arch_fact = null;
    private $esta_fact = null;

    // Encapsulamiento
    public function setCodiFact($value)
    {
        if ($this->validateId($value)) {
            $this->codi_fact = $value;
            return true;

        } else {
            return false;
        }
    }
    public function getCodiFact($value)
    {
        return $this->codi_fact;
    }
    public function setNumeFact($value)
    {
            $this->nume_fact = $value;
            return true;
    }
    public function getNumeFact($value)
    {
        return $this->nume_fact;
    }
    public function setFechEmisFact($value)
    {
            $this->fech_emis_fact = $value;
            return true;
    }
    public function getFechEmisFact($value)
    {
        return $this->fech_emis_fact;
    }
    public function setFechIngr($value)
    {
            $this->fech_ingr = $value;
            return true;
    }
    public function getFechIngr($value)
    {
        return $this->fech_ingr;
    }

    public function setCantFact($value)
    {
        if ($value > 0) {
            $this->cant_fact = $value;
            return true;
        } else {
            return false;
        }
    }
    public function getCantFact()
    {
        return $this->cant_fact;
    }
    public function setArchFact($file)
    {
        if ($this->validateFile($file, $this->arch_fact, "../../web/facturas/")) {
            $this->arch_fact = $this->getImageName();
            return true;
        } else {
            return false;
        }
    }
    public function getArchFact()
    {
        return $this->arch_fact;
    }
    public function unsetArchFact()
    {
        if (unlink("../../web/facturas/" . $this->arch_fact)) {
            $this->arch_fact = null;
            return true;
        } else {
            return false;
        }
    }
    public function setEstaFact($value)
    {
        if ($this->validateId($value)) {
            $this->esta_fact = $value;
            return true;

        } else {
            return false;
        }
    }
    public function getEstaFact($value)
    {
        return $this->esta_fact;
    }
    // Funciones para CRUD
    public function addFactura()
    {
        $sql = "INSERT INTO factura(nume_fact, fech_emis_fact, fech_ingr, arch_fact, cant_fact, esta_fact) VALUES (?,?,?,?,?,0)";
        $params = array($this->nume_fact, $this->fech_emis_fact, $this->fech_ingr, $this->arch_fact, $this->cant_fact);
        Database::executeRow($sql, $params);
        return Database::getLastRowId();
    }
    public function updateFactura()
    {
        # code...
    }
    public function deleteFactura()
    {
        # code...
    }
    //Funcion para obtener Egresos de cada casa por mes y año
    public function getListaFacturaPendientesDeQuedan($codiCasa)
    {
        $sql="SELECT DISTINCT f.codi_fact, f.nume_fact, f.fech_emis_fact, f.arch_fact, f.cant_fact FROM factura_detalle as fd INNER JOIN factura as f ON f.codi_fact=fd.codi_fact INNER JOIN curso as c ON c.codi_curs = fd.codi_curs WHERE c.codi_casa = ? AND f.esta_fact=1";
        $params = array($codiCasa);
        return Database::getRowsAjax($sql, $params);
    }
    public function getCursosPendientesFactura($fechaActual, $codiCasa)
	{
		$sql = "SELECT codi_curs ,nomb_curs FROM curso WHERE TIMESTAMPDIFF(DAY,fech_fin,?)<=20 AND codi_casa=? AND esta_curs=3";
		$params = array($fechaActual, $codiCasa);
		return Database::getRows($sql, $params);
	}
}
