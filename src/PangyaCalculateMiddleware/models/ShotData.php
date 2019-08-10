<?php

namespace PangyaCalculateMiddleware\models;

class ShotData
{
  private $data = array();

  public function __construct($distance, $height, $wind, $angle, $ballSlope, $greenSlope, $field)
  {
    $this->data['distance'] = $distance;
    $this->data['height'] = $height;
    $this->data['wind'] = $distance;
    $this->data['angle'] = $wind;
    $this->data['ballSlope'] = $ballSlope;
    $this->data['greenSlope'] = $greenSlope;
    $this->data['field'] = $field;
  }

  public function __set($name, $value)
  {
    $this->data[$name] = $value;
  }

  public function __get($name)
  {
    if (array_key_exists($name, $this->data)) {
      return $this->data[$name];
    }
    return null;
  }
}
