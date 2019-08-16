<?php

class Casa extends Validator
{   
    // Declaraion de propiedades
    private $codi_casa = null;
    private $nomb_casa = null;
    private $dire_casa = null;
    private $codi_tipo_casa = null;
    private $logo_casa = null;
    private $esta_casa = null;
    
    // Encapsulamiento
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

    public function setNombCasa($value)
    {
        if ($this->validateAlphanumeric($value, 1, 200)) {
            $this->nomb_casa = $value;
            return true;
        } else {
            return false;
        }
    }

    public function getNombCasa()
    {
        return $this->nomb_casa;
    }

    public function setDireCasa($value)
    {
        if ($this->validateAlphanumeric($value, 1, 500)) {
            $this->dire_casa = $value;
            return true;
        } else {
            return false;
        }
    }

    public function getDireCasa()
    {
        return $this->dire_casa;
    }

    public function setCodiTipoCasa($value)
    {
        if ($this->validateId($value)) {
            $this->codi_tipo_casa = $value;
            return true;
        } else {
            return false;
        }
    }

    public function getCodiTipoCasa($value)
    {
        return $this->codi_tipo_casa;
    }

    public function setImagen($file)
    {
        if ($this->validateImage($file, $this->logo_casa, "../../web/img/logos/", 1080, 1080)) {
            $this->logo_casa = $this->getImageName();
            return true;
        } else {
            return false;
        }
    }
    public function getImagen()
    {
        return $this->logo_casa;
    }
    public function unsetImagen()
    {
        if (unlink("../../web/img/logos/" . $this->logo_casa)) {
            $this->logo_casa = null;
            return true;
        } else {
            return false;
        }
    }

    public function setEstaCasa($value)
    {
            $this->esta_casa = $value;
            return true;
    }

    public function getEstaCasa($value)
    {
        return $this->esta_casa;
    }

    // Funciones para CRUD
    // Crear casa
    public function createCasa()
    {
        $sql    = "INSERT INTO casa(nomb_casa, dire_casa, codi_tipo_casa, logo_casa, esta_casa) VALUES (?,?,?,?,?)";
        $params = array($this->nomb_casa, $this->dire_casa, $this->codi_tipo_casa, $this->logo_casa, 1);
        return Database::executeRow($sql, $params);
    }
    public function obtenerIdUltimaCasaCreadad()
    {
        return Database::getLastRowId();
    }

    public function verficarExistenciaCasaEncargada()
    {
        $sql = "SELECT COUNT(*) as  FROM casa WHERE codi_tipo_casa = 1";
        $params = array(null);
        return Database::getRow($sql,$params);
    }
    // Obtener casas
    public function getCasas()
    {
        $sql    = "SELECT codi_casa,nomb_casa,dire_casa, logo_casa, esta_casa FROM casa WHERE esta_casa = 1 AND codi_tipo_casa=2  ORDER BY codi_casa";
        $params = array(null);
        return Database::getRowsAjax($sql, $params);
    }

    public function getInfoCasa()
    {
        $sql    = "SELECT codi_casa,nomb_casa,dire_casa, logo_casa FROM casa WHERE codi_casa=?";
        $params = array($this->codi_casa);
        return Database::getRow($sql, $params);
    }    

    public function getCasasN()
    {
        $sql    = "SELECT codi_casa,nomb_casa FROM casa WHERE esta_casa = 1 ORDER BY codi_casa";
        $params = array(null);
        return Database::getRows($sql, $params);
    }

    // Actualizar
    public function updateCasa()
    {
        $sql    = "UPDATE casa SET nomb_casa = ?, dire_casa = ? WHERE codi_casa = ?";
        $params = array($this->nomb_casa, $this->dire_casa, $this->codi_casa);
        return Database::executeRow($sql, $params);
    }

    public function updateCasaLogo()
    {
        $sql    = "UPDATE casa SET  logo_casa = ? WHERE codi_casa = ?";
        $params = array($this->logo_casa, $this->codi_casa);
        return Database::executeRow($sql, $params);
    }

    // Eliminar
    public function deleteCasa()
    {
        $sql    = "UPDATE casa SET esta_casa = 0 WHERE codi_casa = ?";
        $params = array($this->codi_casa);
        return Database::executeRow($sql, $params);
    }
}