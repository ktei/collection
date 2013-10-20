<?php

if (!function_exists('array_try_get')) {
    function array_try_get($key, array $array, $default = null) {
        if (array_key_exists($key, $array)) {
            return $array[$key];
        }
        return $default;
    }
}