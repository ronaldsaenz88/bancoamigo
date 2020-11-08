<?php
class Crud_Usuario
{
  public function login_query($conex_bd, $usuario='', $clave='')
  {
    if($usuario and $clave)
    {
      if ($result = mysqli_multi_query($conex_bd, "SELECT * from usuarios where login = '$usuario' and password  = '$clave';")) {
        if ($result = mysqli_store_result($conex_bd)) {
          $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
          mysqli_free_result($result);
          return $row;
        }
      }
    }
    return false;
  }

  public function listado($conex_bd)
  {
    $index = 0;
    $data = array();
    if ($result = mysqli_multi_query($conex_bd, "SELECT * from usuarios where estado = 'ACTIVO' ")) {
      if ($result = mysqli_store_result($conex_bd)) {
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
          $data[$index] = $row;
          $index++;
        }
        return $data;
      }
    }
    return false;
  }

  public function insertar($conex_bd, $usuario_creacion='admin', $nombres='', $login='', $password='')
  {
    $ipaddress = $_SERVER["REMOTE_ADDR"];
    $md5_password = md5($password);

    $index = 0;
    $data = array();

    #echo "INSERT INTO usuarios (estado, usuario_creacion, fecha_creacion, ip_creacion, nombres, login, password) VALUES ('ACTIVO', '$usuario_creacion', now(), '$ipaddress', '$nombres', '$login', '$md5_password')  ";
    if ($result = mysqli_multi_query($conex_bd, "INSERT INTO usuarios (estado, usuario_creacion, fecha_creacion, ip_creacion, nombres, login, password) VALUES ('ACTIVO', '$usuario_creacion', now(), '$ipaddress', '$nombres', '$login', '$md5_password') ")) {
      if ($result = mysqli_store_result($conex_bd)) {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
      }
      return true;
    }
    return false;
  }
}

class Crud_Agencia
{
  public function listado($conex_bd)
  {
    $index = 0;
    $data = array();
    if ($result = mysqli_multi_query($conex_bd, "SELECT * from agencia where estado = 'ACTIVO' ")) {
      if ($result = mysqli_store_result($conex_bd)) {
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
          $data[$index] = $row;
          $index++;
        }
        return $data;
      }
    }
    return false;
  }
}

class Crud_TipoPersona
{
  public function listado($conex_bd)
  {
    $index = 0;
    $data = array();
    if ($result = mysqli_multi_query($conex_bd, "SELECT * from tipo_persona where estado = 'ACTIVO' ")) {
      if ($result = mysqli_store_result($conex_bd)) {
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
          $data[$index] = $row;
          $index++;
        }
        return $data;
      }
    }
    return false;
  }
}

class Crud_TipoPoliza
{
  public function listado($conex_bd)
  {
    $index = 0;
    $data = array();
    if ($result = mysqli_multi_query($conex_bd, "SELECT * from tipo_poliza where estado = 'ACTIVO' ")) {
      if ($result = mysqli_store_result($conex_bd)) {
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
          $data[$index] = $row;
          $index++;
        }
        return $data;
      }
    }
    return false;
  }
}

class Crud_SoporteTicket
{
  public function listado($conex_bd)
  {
    $index = 0;
    $data = array();
    if ($result = mysqli_multi_query($conex_bd, "SELECT * from soporte_ticket where estado = 'ACTIVO' ")) {
      if ($result = mysqli_store_result($conex_bd)) {
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
          $data[$index] = $row;
          $index++;
        }
        return $data;
      }
    }
    return false;
  }

  public function insertar($conex_bd, $usuario_creacion='admin', $descripcion='')
  {
    $ipaddress = $_SERVER["REMOTE_ADDR"];

    $sql =  "INSERT INTO soporte_ticket (estado, usuario_creacion, fecha_creacion, ip_creacion, descripcion) VALUES ('ACTIVO', '$usuario_creacion', now(), '$ipaddress', '$descripcion');  ";
    echo "$sql";
    if ($result = mysqli_multi_query($conex_bd, "$sql")) {
      if ($result = mysqli_store_result($conex_bd)) {
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
        }
      }
      return true;
    }
    return false;
  }
}

class Crud_Persona
{
  public function listado($conex_bd)
  {
    $index = 0;
    $data = array();
    if ($result = mysqli_multi_query($conex_bd, "SELECT * from persona where estado = 'ACTIVO' ")) {
      if ($result = mysqli_store_result($conex_bd)) {
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
          $data[$index] = $row;
          $index++;
        }
        return $data;
      }
    }
    return false;
  }

  public function getByCedula($conex_bd, $cedula)
  {
    if ($result = mysqli_multi_query($conex_bd, "SELECT * from persona where estado = 'ACTIVO' and cedula='$cedula' ")) {
      if ($result = mysqli_store_result($conex_bd)) {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $row;
      }
    }
    return false;
  }

  public function insertar($conex_bd, $usuario_creacion='admin', $tipo_persona_id='', $nombres='', $cedula='', $fecha_nacimiento='', $lugar_nacimiento='', $lugar_domicilio='', $domicilio='', $telefono='')
  {
    $ipaddress = $_SERVER["REMOTE_ADDR"];

    $sql =  "INSERT INTO persona (estado, usuario_creacion, fecha_creacion, ip_creacion, tipo_persona_id, nombres, cedula, fecha_nacimiento, lugar_nacimiento, lugar_domicilio, domicilio, telefono) VALUES ('ACTIVO', '$usuario_creacion', now(), '$ipaddress', '$tipo_persona_id', '$nombres', '$cedula', '$fecha_nacimiento', '$lugar_nacimiento', '$lugar_domicilio', '$domicilio', '$telefono');  ";
    #echo "$sql";
    if ($result = mysqli_multi_query($conex_bd, "$sql")) {
      if ($result = mysqli_store_result($conex_bd)) {
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
        }
      }
      return true;
    }
    return false;
  }
}

class Crud_Poliza
{
  public function listado($conex_bd)
  {
    $index = 0;
    $data = array();
    if ($result = mysqli_multi_query($conex_bd, "SELECT * from poliza where estado = 'ACTIVO' ")) {
      if ($result = mysqli_store_result($conex_bd)) {
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
          $data[$index] = $row;
          $index++;
        }
        return $data;
      }
    }
    return false;
  }

  public function listado_vista($conex_bd)
  {
    $index = 0;
    $data = array();

    $query = "
            SELECT p.id as id_poliza, pe.nombres, pe.cedula, a.nombre as agencia, tp.nombre as tipo_poliza, p.monto, p.fecha_emision, p.fecha_aprobacion, p.fecha_caducidad, p.fecha_creacion, p.estado
            FROM poliza p
            LEFT JOIN tipo_poliza tp on tp.id = p.tipo_poliza_id
            LEFT JOIN agencia a on a.id = p.agencia_id
            LEFT JOIN persona pe on pe.id = p.persona_id

            ";
    #            where p.estado = 'ACTIVO'
    if ($result = mysqli_multi_query($conex_bd, $query)) {
      if ($result = mysqli_store_result($conex_bd)) {
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
          $data[$index] = $row;
          $index++;
        }
        return $data;
      }
    }
    return false;
  }

  public function insertar($conex_bd, $usuario_creacion='admin', $tipo_poliza_id='', $agencia_id='', $persona_id='', $monto='', $fecha_caducidad='')
  {
    $ipaddress = $_SERVER["REMOTE_ADDR"];

    $sql =  "INSERT INTO poliza (estado, usuario_creacion, fecha_creacion, ip_creacion, tipo_poliza_id, agencia_id, persona_id, monto, fecha_emision, fecha_caducidad) VALUES ('PENDIENTE', '$usuario_creacion', now(), '$ipaddress', '$tipo_poliza_id', '$agencia_id', '$persona_id', '$monto', now(), '$fecha_caducidad');  ";
    #echo "$sql";
    if ($result = mysqli_multi_query($conex_bd, "$sql")) {
      if ($result = mysqli_store_result($conex_bd)) {
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
        }
      }
      return true;
    }
    return false;
  }

  public function aprobar($conex_bd, $usuario_aprobacion='admin', $poliza_id='')
  {
    $ipaddress = $_SERVER["REMOTE_ADDR"];

    $sql =  "UPDATE poliza SET estado = 'ACTIVO', usuario_aprobacion='$usuario_aprobacion', fecha_aprobacion=now() WHERE id = '$poliza_id'; ";
    echo "$sql";
    if ($result = mysqli_multi_query($conex_bd, "$sql")) {
      if ($result = mysqli_store_result($conex_bd)) {
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
        }
      }
      return true;
    }
    return false;
  }



}
?>
