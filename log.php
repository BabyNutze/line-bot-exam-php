<?php
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$log = new Logger('name');
$log->pushHandler(new StreamHandler('php://stderr', Logger::WARNING));

$log->addWarning('hoello');
?>
