<?php
$appName = $_GET["app"];
$logText = $_GET["logText"];
$logpath = "../$appName/log/";
$date = (new DateTime('NOW'))->format("Y-m-d");
$logfile = $date.".txt";
if (!file_exists($logpath)) {
    mkdir($logpath, 0777, true);
}
$fp = @fopen($logpath.$logfile, 'a+');
if ($fp) {
    $txt = $logText."\n";
    fwrite($fp, $txt);
    fclose($fp);
 }
echo 'log done';
?>
