<?php

final class Adapter53
{
    public static function split($pattern, $string, $limit = -1)
    {
        $pattern = '/' . addcslashes($pattern, '/') . '/';
        return preg_split($pattern, $string, $limit);
    }
}
