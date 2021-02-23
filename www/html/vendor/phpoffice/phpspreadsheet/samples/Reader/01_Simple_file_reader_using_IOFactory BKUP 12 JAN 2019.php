<?php

require 'common_functions.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

require __DIR__ . '/../Header.php';

//$inputFileName = __DIR__ . '/sampleData/example1.xls';
$inputFileName = __DIR__ . '/sampleData/ISIN.xls';
$helper->log('Loading file ' . pathinfo($inputFileName, PATHINFO_BASENAME) . ' using IOFactory to identify the format');
$spreadsheet = IOFactory::load($inputFileName);
$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
dbug($sheetData,'$sheetData');
