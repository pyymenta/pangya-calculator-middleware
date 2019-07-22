<?php

namespace PangyaCalculateMiddleware;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;


class PinGenerator
{
  public function getGeneratorSimpleValue($fileName, $shotType)
  {
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(__DIR__. '/../hwis/generators/'. $shotType .'/'. $fileName);

    $activeCell = $spreadsheet->getActiveSheet();

    $pinsRows = ['1', '2', '3'];

    foreach($pinsRows as $row) {
      $pins[] = array(
        'percent' => $activeCell->getCell('A'.$row)->getCalculatedValue(),
        'pin' => $activeCell->getCell('B'.$row)->getCalculatedValue(),
        'hwi' => $activeCell->getCell('C'.$row)->getCalculatedValue(),
      );
    }

    return $pins;
  }
}