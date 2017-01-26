<?php
class View {
	public function template($file=null) {
		if($file){
			$this->tmplf=$file;
		}else{
			$this->tmplf='administration.status';
		}
		require_once 'views/template.php';
	}
}
?>