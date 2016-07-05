<?php
error_reporting(E_ALL);
ini_set("memory_limit", "1024M");
ini_set("max_execution_time", "0");

define('DB_HOST',	'localhost');
define('DB_USER',	'hlstatsx');
define('DB_PASS',	'hlstatsx');
define('DB_NAME',	'hlstatsx');
define('HLXCE_WEB',	'/opt/hlstatsx-community-edition/web');
define('HUD_URL',	'http://ins.jballou.com/hlstatsx');
define('OUTPUT_SIZE',	'large');

define('DB_PREFIX',	'hlstats');
define('KILL_LIMIT',	10000);
define('DEBUG', 1);

// No need to change this unless you are on really low disk.
define('CACHE_DIR',	dirname(__FILE__) . '/cache');

