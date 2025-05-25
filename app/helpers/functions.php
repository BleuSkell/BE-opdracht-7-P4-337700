<?php

function logger($line, $method, $file, $message)
{
    $logDir = dirname(__DIR__, 2) . '/logs';
    if (!is_dir($logDir)) {
        mkdir($logDir, 0777, true);
    }
    $logFile = $logDir . '/app.log';
    $log = "[" . date('Y-m-d H:i:s') . "] "
         . "Error in $file at $method (line $line): $message" . PHP_EOL;
    file_put_contents($logFile, $log, FILE_APPEND);
}