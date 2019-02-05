<?php

namespace BotCredifintech\Prospectos;

class Prospecto {

  protected $nombre;
  protected $apellido;
  protected $telefono;
  protected $email;
  protected $monto;
  protected $identificacion;
  protected $tipo;
  protected $etiquetas = array();
  protected $notas;
  protected $id;

  static function constructWithInfo($nombre, $apellido, $telefono, $email, $monto, $identificacion){
    $object = new Prospecto();
    $object->nombre = $nombre;
    $object->apellido = $apellido;
    $object->telefono = $telefono;
    $object->identificacion = $identificacion;
    $object->email = $email;
    $object->monto = $monto;
    $object->tipo = $tipo;
    return $object;
  }

  public function __set($property, $value){
    if (property_exists($this, $property)) {
      $this->$property = $value;
    }
    return $this;
  }

  public function __get($property) {
    if (property_exists($this, $property)) {
      return $this->$property;
    }
  }

}

?>
