<?php
define('SITE_URL', (!empty($_SERVER['HTTPS']))? 'https://'.$_SERVER['HTTP_HOST']:'http://'.$_SERVER['HTTP_HOST']);
define('ROOT', __DIR__);

require_once 'mvc/router.php';
require_once 'mvc/controller.php';
require_once 'mvc/model.php';
require_once 'mvc/view.php';
new Router();
?>