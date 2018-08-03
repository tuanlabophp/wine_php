<?php

define('DEFAULT_PAGE_NAME', 'default');
$routes = require_once 'web.php';

function getPageName()
{
	global $routes;
	if (!array_key_exists($_SERVER['REQUEST_URI'], $routes)) {
		return [];
	}

	return $routes[$_SERVER['REQUEST_URI']];
}
