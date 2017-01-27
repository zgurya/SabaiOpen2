<?php
class Router {
	public function __construct() {
		session_start();
		
		/*
		 * Session timeout
		 */
		if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > SESSION_TIMEOUT)) {
			session_unset();
			session_destroy();
		}
		$_SESSION['last_activity'] = time();
		
		/*
		 * Check login credentials
		 */ 
		if (!isset($_SESSION['login'])){
			unset($_SESSION['login_msg']);
			if(isset($_POST['username'])&&isset($_POST['password'])){
				$hash=exec("cat /etc/shadow | grep admin | awk -F: '{print $2}'");
				$hash='$1$VUeS9QjD$h5n5Pe.WsezuCRpfdtRQB/';
				if (password_verify($_POST['password'], $hash) && $_POST['username']=='admin') {
					$_SESSION['login'] = true;
					$_SESSION['username'] = $_POST['username'];
				}else{
					$_SESSION['login_msg'] = 'Login or password is incorrect.';
					require_once 'controllers/login.php';
					new Login();
					return false;
				}
			}else{
				require_once 'controllers/login.php';
				new Login();
				return false;
			}
		}
		
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
			/* Set default page */
			$controller='administration';
			$action='status';
		}
		if(file_exists('controllers/'.$controller.'.php')) {
			require_once 'controllers/'.$controller.'.php';
		}else{
			require_once 'controllers/404.php';
			new Not_found();
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
					new Not_found();
					return false;
				}
			}else{
				if(method_exists($controller, 'index')){
					$controller->index();
				}else{
					require_once 'controllers/404.php';
					new Not_found();
					return false;
				}
			}
		}
	}
	
}
?>