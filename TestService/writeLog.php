<?php
$appName = $_GET["app"];
$logText = $_GET["logText"];
$fileName = $_GET["fileName"];
$newLine = $_GET["newLine"];
$logpath = "../$appName/log/";
if(empty($fileName)){
    $fileName = (new DateTime('NOW'))->format("Y-m-d");
}
$logfile = $fileName.".txt";
if (!file_exists($logpath)) {
    mkdir($logpath, 0777, true);
}
$fp = @fopen($logpath.$logfile, 'a+');
if ($fp) {
    if($newLine == 1){
        fwrite($fp, "\n");
    }
    $txt = $logText."\n";
    fwrite($fp, $txt);
    fclose($fp);
 }
echo 'log done';
?>
