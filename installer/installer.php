<?php

define('PROJECT_ROOT', realpath(__DIR__ . '/../'));

ensureTmpFolders();

function ensureTmpFolders()
{
    $tmpDir = PROJECT_ROOT . '/tmp';
    $mode = 0755;

    if (!is_dir($tmpDir)) {
        mkdir($tmpDir, $mode);
    }

    if (!is_writable($tmpDir)) {
        throw new Exception('tmp folder is not writable');
    }
}
