<?php

namespace PangyaCalculateMiddleware;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;


class PinGenerator
{
  const POWER_1W_CELL = 'E2';

  public function __construct($fileName, $shotType)
  {
    $this->pinSpreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load
                        (__DIR__ . '/../hwis/generators/'. $shotType .'/'. $fileName);

    $this->activeSheet = $this->pinSpreadsheet->getActiveSheet();
  }

  public function getPinValues($clubPower)
  {
    $this->setPinPower($clubPower);

    $pinsRows = ['1', '2', '3'];

    foreach($pinsRows as $row) {
      $pins[] = array(
        'percent' => $this->activeSheet->getCell('A'.$row)->getCalculatedValue(),
        'pin' => $this->activeSheet->getCell('B'.$row)->getCalculatedValue(),
        'hwi' => $this->activeSheet->getCell('C'.$row)->getCalculatedValue(),
      );
    }

    return $pins;
  }

  private function setPinPower($power1w) 
  {
    $this->activeSheet->setCellValue(self::POWER_1W_CELL, $power1w);
  }
}
