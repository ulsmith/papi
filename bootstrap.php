<?php

define("APP_START", microtime(true));
define("APP_ROOT", __DIR__.'/');
define('WEB_ROOT', "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['HTTP_HOST']}");

require_once(APP_ROOT."vendor/autoload.php");
