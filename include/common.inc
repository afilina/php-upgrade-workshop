<?
error_reporting(E_ERROR);
$root = realpath(__DIR__ . '/../');
set_include_path(join(':', array(
    $root . '/include',
    $root . '/plugins'
)));

$hostname = 'http://localhost:8000';

$config_file = $root . '/include/config.inc';
$fh = fopen($config_file, 'r');
$config = fread($fh, filesize($config_file));
fclose($fh);

$config = split("[\n]", $config);
while (list($k, $v) = each($config)) {
    $separator = strpos($v, '=');
    define(strtoupper(substr($v, 0, $separator)), substr($v, $separator + 1));
}

$user = new stdClass();
$user->is_admin = true;

include 'functions.inc';
include 'db.inc';
