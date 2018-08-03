<?php
    define('__BASE_DIR__', __DIR__ . './../src/');
    require_once './../src/routes/routing.php';

    $controller = getPageName();

    if (!empty($controller)) {
        require_once('./../src/app/Http/Controllers/' . $controller['controller'] . '.php');
        call_user_func([$controller['controller'], $controller['function']]);
    } else {
        echo 'not found';
    }
?>
