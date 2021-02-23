<?php

require '/home/stockpatrol_sftp/www/stockpatrol.cowraweb.com.au/public_html/includes/common_functions.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

//require __DIR__ . '/../Header.php';

use PhpOffice\PhpSpreadsheet\Helper\Sample;

error_reporting(E_ALL);

require_once __DIR__ . '/../../src/Bootstrap.php';

//require_once __DIR__ . '/../src/Bootstrap.php';

$helper = new Sample();

// Return to the caller script when runs by CLI
if ($helper->isCli()) {
    return;
}

//$inputFileName = __DIR__ . '/sampleData/example1.xls';
$inputFileName = __DIR__ . '/sampleData/ISIN.xls';
$helper->log('Loading file ' . pathinfo($inputFileName, PATHINFO_BASENAME) . ' using IOFactory to identify the format');
$spreadsheet = IOFactory::load($inputFileName);
$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
dbug($sheetData,'$sheetData');
