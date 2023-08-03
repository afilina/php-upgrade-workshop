<?php

final class Adapter53
{
    private static $mysqlConnection = null;

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

    public static function mysql_connect($server = null, $username = null, $password = null, $new_link = false, $client_flags = 0)
    {
        return self::$mysqlConnection = mysqli_connect($server, $username, $password);
    }

    public static function mysql_select_db($database_name, $link_identifier = null)
    {
        return mysqli_select_db($link_identifier ?? self::$mysqlConnection, $database_name);
    }

    public static function mysql_query($query, $link_identifier = null)
    {
        return mysqli_query($link_identifier ?? self::$mysqlConnection, $query);
    }

    public static function mysql_numrows($result)
    {
        return mysqli_num_rows($result);
    }

    public static function mysql_fetch_object($result, $class_name = 'stdClass', $params = [])
    {
        return mysqli_fetch_object($result, $class_name, $params);
    }

    public static function mysql_fetch_array($result, $result_type = MYSQLI_BOTH)
    {
        return mysqli_fetch_array($result, $result_type);
    }
}
