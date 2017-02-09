<?php
define('SITE_URL', (!empty($_SERVER['HTTPS']))? 'https://'.$_SERVER['HTTP_HOST']:'http://'.$_SERVER['HTTP_HOST']);
define('ROOT', __DIR__);
define('SESSION_TIMEOUT',1800);
date_default_timezone_set(exec('date +%Z'));

require_once 'mvc/router.php';
require_once 'mvc/controller.php';
require_once 'mvc/model.php';
require_once 'mvc/view.php';
new Router();
?>