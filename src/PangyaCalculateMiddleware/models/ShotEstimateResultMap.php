<?php

namespace PangyaCalculateMiddleware\models;

class ShotEstimateResultMap
{
  private $data = array();

  public function __construct($resultPos, $resultNeg, $resultPosPB, $resultNegPB, $powerPos, $powerNeg, $calliperPos, $calliperNeg)
  {
    $this->data['resultPos'] = $resultPos;
    $this->data['resultNeg'] = $resultNeg;
    $this->data['resultPosPB'] = $resultPosPB;
    $this->data['resultNegPB'] = $resultNegPB;
    $this->data['powerPos'] = $powerPos;
    $this->data['powerNeg'] = $powerNeg;
    $this->data['calliperPos'] = $calliperPos;
    $this->data['calliperNeg'] = $calliperNeg;
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
