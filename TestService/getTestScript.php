<?php
require_once '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

function extractSheet($testName,$testScript){
    $testFunc = array_shift($testScript);
    $testParam = array_shift($testScript);
    $sheetObj = new stdClass();
    $sheetObj->testName = $testName;
    $sheetObj->testFunc = $testFunc;
    $sheetObj->testParam = $testParam;
    $sheetObj->testValue = $testScript;
   return $sheetObj;
}

$result = new stdClass();
$data =  array();

$appName = $_GET["app"];
$config = "../$appName/config.txt";
$reader = new Xlsx();
$reader->setReadDataOnly(true);
$fp = @fopen($config, 'r');
if ($fp) {
   $fileList = explode("\n", fread($fp, filesize($config)));
//    print_r($fileList);
}

foreach ($fileList as $file) {
    if($file == '' || $file == ' '){
        break;
    }
    $spreadsheet = $reader->load("../$appName/$file.xlsx");
    $testList = $spreadsheet->getActiveSheet()->rangeToArray('A3:C20', NULL, TRUE, TRUE, TRUE);
    foreach ($testList as $testSheet) {
        if($testSheet['A'] && $testSheet['B']){
            $testScript = $spreadsheet->getSheetByName($testSheet['B'])->toArray();
            array_push($data,extractSheet($testSheet['A'],$testScript));
        }
    }
}
$result->data = $data;
echo json_encode($result);
?>
