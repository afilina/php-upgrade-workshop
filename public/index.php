<?php
declare(strict_types=1);

require '../include/common.inc';

// Transitional mini-router (url = /index.php)
preg_match('/\/([\w-]+)\.php/', $_GET['url'], $matches);
$controller = $matches[1];
$action = $_GET['action'] ?? 'default';

require sprintf('src/Controller/%s.php', $controller); // src/Controller/index.php
$class = sprintf('%sController', ucfirst($controller)); // IndexController
$method = sprintf('%sAction', $action);
(new $class())->{$method}(); // (new IndexController)->defaultAction()
