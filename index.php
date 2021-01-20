<?php
include "includes.php";

use Count\Classes\DirectoryStructureHandler;
use Count\Classes\DirectoryHandler;
use Count\Classes\FileHandler;


$directoryHandler = new DirectoryHandler();
$dirHandler = new DirectoryStructureHandler('example', $directoryHandler);

try {
    $filePath = $dirHandler->lookForFile('count');
    $fileHandler = new FileHandler();
    echo $fileHandler->countSum($filePath);
} catch (Exception $e) {
    echo $e->getMessage();
}
