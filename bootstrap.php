<?php

// system constants
define("APP_START", microtime(true));
define("APP_ROOT", __DIR__.'/');
define('WEB_ROOT', "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['HTTP_HOST']}");

// env constants
define('SESSION_LIFETIME', getenv('SESSION_LIFETIME') ? getenv('SESSION_LIFETIME') : 86400);
define('SESSION_KEY', getenv('SESSION_KEY') ? getenv('SESSION_KEY') : '4hfjHuiUEH74fdsfdskj89Hhudy');
define('CORS_WHITELIST', getenv('CORS_WHITELIST') ? getenv('CORS_WHITELIST') : 'localhost');

require_once(APP_ROOT."vendor/autoload.php");
