<?php

function array_get($array, $key, $default = null)
{
    if (isset($array[$key])) {
        return $array[$key];
    }

    return $default;
}