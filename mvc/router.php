<?php
class Router {
	public function __construct() {
		if(isset($_GET['url']) && !empty($_GET['url'])){
			$url=rtrim(strtolower($_GET['url']), '/');
			$url=explode('/', $url);
			$controller=$url[0];
			
			/* Check action */
			if(isset($url[1])){
				$action=$url[1];
			}
			
			/* Check agrs */
			if(isset($_GET)&&!empty($_GET)){
				$args=$_GET;
				unset($args['url']);
			}
			
		}else{
			$controller='index';
		}
		if(file_exists('controllers/'.$controller.'.php')) {
			require_once 'controllers/'.$controller.'.php';
		}else{
			require_once 'controllers/404.php';
			$controller = new Not_found();
			return false;
		}
		$controller=new $controller;
		if(isset($args)&&!empty($args)){
			$controller->$action($args);
		}else{
			if(isset($action)){
				if(method_exists($controller, $action)){
					$controller->$action();
				}else{
					require_once 'controllers/404.php';
					$controller = new Not_found();
					return false;
				}
			}else{
				if(method_exists($controller, 'index')){
					$controller->index();
				}else{
					require_once 'controllers/404.php';
					$controller = new Not_found();
					return false;
				}
			}
		}
	}
}
?>