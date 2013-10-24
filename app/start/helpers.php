<?php

if (!function_exists('array_try_get')) {
    function array_try_get($key, array $array, $default = null) {
        if (array_key_exists($key, $array)) {
            return $array[$key];
        }
        return $default;
    }
}

// See http://stackoverflow.com/questions/3349753/delete-directory-with-files-in-it
if (!function_exists('delete_dir')) {
    function delete_dir($dirPath) {
        if (!is_dir($dirPath)) {
            return;
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }
}