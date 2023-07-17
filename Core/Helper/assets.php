<?php

function assets($path): string|null
{
    $part = explode('.', $path);
    $fileName = array_pop($part);
    $path = implode(DIRECTORY_SEPARATOR, $part);
    $absolutePath = '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Assets' . DIRECTORY_SEPARATOR . $path;
    $folder = scandir($absolutePath);
    foreach ($folder as $file) {
        if (pathinfo($file, PATHINFO_FILENAME) === $fileName) {
            $fullPath = $absolutePath . DIRECTORY_SEPARATOR . $file;
        } else {
            $fullPath = null;
        }
    }
    return $fullPath;
}