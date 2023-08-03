<?php

final class Adapter53
{
    public static function split($pattern, $string, $limit = -1)
    {
        $pattern = '/' . addcslashes($pattern, '/') . '/';
        return preg_split($pattern, $string, $limit);
    }

    public static function each(&$array)
    {
        if (is_scalar($array) || $array === null) {
            return null;
        }

        $current = current($array);
        if ($current === false || $current === null) {
            return false;
        }

        $key = key($array);
        $value = $current;
        next($array);

        return [
            1 => $value,
            'value' => $value,
            0 => $key,
            'key' => $key,
        ];
    }
}
