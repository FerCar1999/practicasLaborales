<?php

class Usuario extends Validator
{
    // Declaracion de propiedades
    private $codi_usua = null;
    private $nomb_usua = null;
    private $apel_usua = null;
    private $corre_usua = null;
    private $cont_usua = null;
    private $codi_casa = null;
    private $nomb_casa = null;
    private $logo_casa = null;
    private $codi_tipo_casa = null;
    private $codi_tipo_usua = null;
    private $codi_cate = null;
    private $esta_usua = null;

    // Encapsulando
    public function setCodiUsua($value)
    {
        if ($this->validateId($value)) {
            $this->codi_usua = $value;
            return true;
        } else {
            return false;
        }
    }

    public function getCodiUsua()
    {
        return $this->codi_usua;
    }

    public function setNombUsua($value)
    {
        if ($this->validateAlphabetic($value,1,100)) {
            $this->nomb_usua = $value;
            return true;
        } else {
            return false;
        }
    }

    public function getNombUsua()
    {
        return $this->nomb_usua;
    }

    public function setNombCasa($value)
    {
        if ($this->validateAlphanumeric($value,1,100)) {
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

    public function setLogoCasa($value)
    {
        if ($this->validateAlphanumeric($value,1,100)) {
            $this->logo_casa = $value;
            return true;
        } else {
            return false;
        }
    }

    public function getLogoCasa()
    {
        return $this->logo_casa;
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

    public function getCodiTipoCasa()
    {
        return $this->codi_tipo_casa;
    }
    public function setApelUsua($value)
    {
        if ($this->validateAlphabetic($value,1,100)) {
            $this->apel_usua = $value;
            return true;
        } else {
            return false;
        }
    }

    public function getApelUsua()
    {
        return $this->apel_usua;
    }

    public function setCorreUsua($value)
    {
        if ($this->validateEmail($value)) {
            $this->corre_usua = $value;
            return true;
        } else {
            return false;
        }
    }

    public function getCorreUsua()
    {
        return $this->corre_usua;
    }

    public function setContUsua($value)
    {
        if ($this->validatePassword($value)) {
            $this->cont_usua = $value;
            return true;
        } else {
            return false;
        }
    }

    public function getContUsua()
    {
        return $this->cont_usua;
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

    public function getCodiCasa()
    {
        return $this->codi_casa;
    }

    public function setTipoUsua($value)
    {
        if($this->validateId($value)) {
            $this->codi_tipo_usua = $value;
            return true;
        } else {
            return false;
        }
    }

    public function getTipoUsua()
    {
        return $this->codi_tipo_usua;
    }
    public function setCodiCate($value)
    {
            $this->codi_cate = $value;
            return true;
    }

    public function getCodiCate()
    {
        return $this->codi_cate;
    }
    public function setEstaUsua($value)
    {
        if ($this->validateId($value)) {
            $this->esta_usua = $value;
            return true;
        } else {
            return false;
        }
    }

    public function getEstaUsua()
    {
        return $this->esta_usua;
    }

    // Funciones para CRUD

    // Crear usuario
    public function createUsuario()
    {
        //Encriptando la contraseña ingresada
        $hash   = password_hash($this->cont_usua, PASSWORD_DEFAULT);
        //realizando consuta
        $sql    = "INSERT INTO usuario(nomb_usua,apel_usua,corre_usua,cont_usua,codi_casa,codi_tipo_usua,codi_cate,esta_usua) VALUES (?,?,?,?,?,?,?,?)";
        //parametros a ingresar
        $params = array($this->nomb_usua, $this->apel_usua, $this->corre_usua, $hash, $this->codi_casa, $this->codi_tipo_usua,$this->codi_cate,1);
        return Database::executeRow($sql, $params);
    }

    // Obtener usuarios encargados de la casa
    public function getUsuariosCasa()
    {
        $sql    = "SELECT u.codi_usua as 'codi_usua', u.nomb_usua as 'nomb_usua', u.apel_usua as 'apel_usua' , u.corre_usua as 'corre_usua', tp.codi_tipo_usua as 'codi_tipo_usua', u.codi_cate, tp.nomb_tipo_usua as 'nomb_tipo_usua' FROM usuario as u INNER JOIN tipo_usuario as tp USING (codi_tipo_usua) WHERE u.esta_usua=1 AND u.codi_casa=? ORDER BY u.codi_usua";
        $params = array($this->codi_casa);
        return Database::getRowsAjax($sql, $params);
    }

    // Obtener usuarios encargados de la casa
    public function getInfoUsuario()
    {
        $sql    = "SELECT codi_usua, nomb_usua, apel_usua , corre_usua FROM usuario WHERE codi_usua = ?";
        $params = array($this->codi_usua);
        return Database::getRow($sql, $params);
    }

    //Verificar usuario login
    public function checkUser()
	{
        //buscando datos del usuario con el correo ingresado
		$sql = "SELECT u.codi_usua as codi_usua, u.nomb_usua as nomb_usua, u.apel_usua as apel_usua, u.codi_tipo_usua as codi_tipo_usua, u.codi_casa as codi_casa, c.nomb_casa as nomb_casa, c.logo_casa as logo_casa, c.codi_tipo_casa as codi_tipo_casa, u.codi_cate as codi_cate FROM usuario as u INNER JOIN casa as c USING (codi_casa) WHERE u.corre_usua=? AND c.esta_casa = 1 AND u.esta_usua=1";
        //agregando parametros
        $params = array($this->corre_usua);
        //ejecutando consulta y obteniendo los datos
        $data = Database::getRow($sql, $params);
        //si hay datos de la consulta anterior
		if($data){
            //se setearan las variables de codigo de usuario y de tipo de usuario
            $this->codi_usua = $data['codi_usua'];
            $this->nomb_usua = $data['nomb_usua'];
            $this->apel_usua = $data['apel_usua'];
            $this->codi_tipo_usua = $data['codi_tipo_usua'];
            $this->codi_casa = $data['codi_casa'];
            $this->nomb_casa = $data['nomb_casa'];
            $this->logo_casa = $data['logo_casa'];
            $this->codi_tipo_casa = $data['codi_tipo_casa'];
            $this->codi_cate = $data['codi_cate'];
            //retornando true
			return true;
		}else{
            //retornando false
			return false;
		}
    }
    
	//verificando contraseña
	public function checkPassword(){
        //preparando la consulta para traer la contraseña(encriptada) del usuario
        $sql = "SELECT cont_usua FROM usuario WHERE codi_usua = ?";
        //agregando parametros
        $params = array($this->codi_usua);
        //obteniendo valor de la consutla anterior
        $data = Database::getRow($sql, $params);
        //verificando si la contraseña ingrasada
        if (password_verify($this->cont_usua, $data['cont_usua'])) {
            return true;
        } else {
            return false;
        }
    }

    //funcion para cerrar sesion
    public function logOut(){
        //destruyendo variables de sesion
		return session_destroy();
    }

    // Modificar informacion de usuario
    public function updateInformacionUsuario()
    {   
        $sql    = "UPDATE usuario SET nomb_usua = ?, apel_usua = ?, corre_usua = ?, codi_cate=? WHERE codi_usua = ?";
        $params = array($this->nomb_usua, $this->apel_usua, $this->corre_usua, $this->codi_cate, $this->codi_usua);
        return Database::executeRow($sql, $params);
    }
    public function updateContraUsuario()
    {
        $hash   = password_hash($this->cont_usua, PASSWORD_DEFAULT);
        $sql    = "UPDATE usuario SET cont_usua = ? WHERE codi_usua = ?";
        $params = array($hash, $this->codi_usua);
        return Database::executeRow($sql, $params);
    }
    public function updateContraUsuarioCorreo()
    {
        $hash   = password_hash($this->cont_usua, PASSWORD_DEFAULT);
        $sql    = "UPDATE usuario SET cont_usua = ? WHERE corre_usua = ?";
        $params = array($hash, $this->corre_usua);
        return Database::executeRow($sql, $params);
    }
    // Eliminar usuario
    public function deleteUsuario()
    {
        $sql    = "UPDATE usuario SET  esta_usua = 0 WHERE codi_usua = ?";
        $params = array($this->codi_usua);
        return Database::executeRow($sql, $params);
    }

    public function verificarCorreoExistente()
    {
        $sql = "SELECT COUNT(*) as conteo FROM usuario WHERE corre_usua=?";
        $params = array($this->corre_usua);
        return Database::getRow($sql, $params);
    }
    public function verificarCorreoPropio()
    {
        $sql = "SELECT COUNT(*) as conteo FROM usuario WHERE corre_usua=? AND codi_usua=?";
        $params = array($this->corre_usua, $this->codi_usua);
        return Database::getRow($sql, $params);
    }
    //funcion es para los casos de cambios de contraseña cuando el usuario ingresa su contraseña vieja con la contraseña ingresada  
    public function verificarContraseniaAntigua()
    {
        $sql = "SELECT cont_usua FROM usuario WHERE codi_usua = ?";
        $params = array($this->codi_usua);
        return Database::getRow($sql, $params);
    }
    public function verificarExistenciaUsuarios()
    {
        $sql = "SELECT COUNT(*) as 'cantidad' FROM usuario as u INNER JOIN casa as c USING(codi_casa) WHERE u.esta_usua = 1 AND c.esta_casa=1 AND c.codi_tipo_casa=1";
        $params = array(null);
        return Database::getRow($sql,$params);
    }
    public function eliminandoCasaDefinitivo()
    {
        $sql = "DELETE FROM casa WHERE codi_casa = ?";
        $params = array($this->codi_casa);
        return Database::executeRow($sql, $params);
    }
}