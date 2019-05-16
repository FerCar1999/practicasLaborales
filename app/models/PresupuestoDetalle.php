<?php

class PresupuestoDetalle extends Validator
{
    // Declaraion de propiedades
    private $codi_pres_deta = null;
    private $codi_pres = null;
    private $codi_casa = null;
    private $codi_usua = null;
    private $cant_pres_deta = null;
    private $arch_pres_deta = null;
    private $fech_pres_deta = null;

    // Encapsulamiento
    public function setCodiPresDeta($value)
    {
        if ($this->validateId($value)) {
            $this->codi_pres_deta = $value;
            return true;

        } else {
            return false;
        }
    }
    public function getCodiPresDeta($value)
    {
        return $this->codi_pres_deta;
    }
    public function setCodiPres($value)
    {
        if ($this->validateId($value)) {
            $this->codi_pres = $value;
            return true;

        } else {
            return false;
        }
    }
    public function getCodiPres($value)
    {
        return $this->codi_pres;
    }
    public function setCodiCasa($value)
    {
        if ($this->validateId($value)) {
            $this->codi_casa = $value;
            return true;
        } else {
            return false;
        }
    }
    public function getCodiCasa($value)
    {
        return $this->codi_casa;
    }
    public function setCodiUsua($value)
    {
        if ($this->validateId($value)) {
            $this->codi_usua = $value;
            return true;
        } else {
            return false;
        }
    }
    public function getCodiUsua($value)
    {
        return $this->codi_usua;
    }

    public function setCantPresDeta($value)
    {
        if ($value > 0) {
            $this->cant_pres_deta = $value;
            return true;
        } else {
            return false;
        }
    }
    public function getCantPresDeta()
    {
        return $this->cant_pres_deta;
    }
    public function setArchivoDeta($file)
    {
        if ($this->validateFile($file, $this->arch_pres_deta, "../../web/documentos/")) {
            $this->arch_pres_deta = $this->getImageName();
            return true;
        } else {
            return false;
        }
    }
    public function getArchivoDeta()
    {
        return $this->arch_pres_deta;
    }
    public function unsetArchivoDeta()
    {
        if (unlink("../../web/documentos/" . $this->arch_pres_deta)) {
            $this->arch_pres_deta = null;
            return true;
        } else {
            return false;
        }
    }
    public function setFechPresDeta($value)
    {
        $this->fech_pres_deta = $value;
        return true;
    }
    public function getFechPresDeta()
    {
        return $this->fech_pres_deta;
    }
    // Funciones para CRUD
    // Crear casa
    //Buscar el id del presupuesto del mes
    public function buscarIdPresupuestoMes($mes, $anio)
    {
        $sql = "SELECT codi_pres FROM presupuesto WHERE codi_casa = ? AND MONTH(fech_pres) = ? AND YEAR(fech_pres)=?";
        $params = array($this->codi_casa, $mes, $anio);
        return Database::getRow($sql, $params);
    }
    //Funcion para agregar un nuevo egreso
    public function agregarEgreso()
    {
        $sql    = "INSERT INTO presupuesto_detalle(codi_pres,codi_casa, codi_usua, cant_pres_deta, arch_pres_deta, fech_pres_deta) VALUES(?,?,?,?,?,?)";
        $params = array($this->codi_pres, $this->codi_casa, $this->codi_usua, $this->cant_pres_deta, $this->arch_pres_deta, $this->fech_pres_deta);
        return Database::executeRow($sql, $params);
    }
    //Funcion para obtener el total de egresos en el mes y año para la casa logeada
    public function obtenerTotalEgresosPresupuestoMesAnio($mes, $anio)
    {
        $sql = "SELECT SUM(cant_pres_deta) as 'cantidad' FROM presupuesto_detalle WHERE MONTH(fech_pres_deta) = ? AND YEAR(fech_pres_deta)=? AND codi_pres=?";
        $params = array($mes, $anio, $this->codi_pres);
        return Database::getRow($sql, $params);
    }
    //Funcion para validar que la nueva cantidad a agregar no sobrepase el presupuesto del mes
    public function obtenerCantidadIngreso()
    {
        $sql = "SELECT p.cant_pres- IFNULL((SELECT SUM(pda.cant_pres_deta) as cant FROM presupuesto_detalle as pda WHERE pda.codi_pres=?),0) as cant_pres FROM presupuesto as p WHERE p.codi_pres=?";
        $params = array($this->codi_pres,$this->codi_pres);
        $data = Database::getRow($sql, $params);
        if ($data) {
            return $data['cant_pres'];
        } else {
            return 0;
        }
        
    }
    public function obtenerCantidadEgreso()
    {
        $sql = "SELECT SUM(cant_pres_deta) as 'cant_pres_deta' FROM presupuesto_detalle WHERE codi_pres = ?";
        $params = array($this->codi_pres);
        $data = Database::getRow($sql, $params);
        if ($data) {
            return $data['cant_pres_deta'];
        } else {
            return 0;
        }
        
    }
    //Funcion para modificar el egreso ingresado
    public function updateEgreso()
    {
        $sql    = "UPDATE presupuesto_detalle SET cant_pres=? WHERE codi_pres_deta=?";
        $params = array($this->cant_pres, $this->codi_pres);
        return Database::executeRow($sql, $params);
    }
    //Funcion para modificar el archivo agregado con el egreso
    public function updateArchivo()
    {
        $sql    = "UPDATE presupuesto_detalle SET arch_pres_deta=? WHERE codi_pres_deta=?";
        $params = array($this->arch_pres_deta, $this->codi_pres_deta);
        return Database::executeRow($sql, $params);
    }
    //Funcion para obtener Egresos de cada casa por mes y año
    public function getListaEgresos($mes, $anio)
    {
        $sql="SELECT codi_pres_deta, cant_pres_deta, fech_pres_deta, arch_pres_deta FROM presupuesto_detalle WHERE codi_casa = ? AND MONTH(fech_pres_deta)=? AND YEAR(fech_pres_deta)=?";
        $params = array($this->codi_casa, $mes, $anio);
        return Database::getRowsAjax($sql, $params);
    }
    public function deleteEgreso()
    {
        $sql="DELETE FROM presupuesto_detalle WHERE codi_pres_deta = ?";
        $params = array($this->codi_pres_deta);
        return Database::executeRow($sql, $params);
    }
}
