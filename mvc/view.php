<?php
class View {
	public function template($file) {
		$this->tmplf=$file;
		require_once 'views/template.php';
	}
}
?>