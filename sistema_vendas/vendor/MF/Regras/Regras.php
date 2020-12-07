<?php 
namespace MF\Regras;

abstract class Regras {
	public function __set($attr, $value) {
		$this->$attr = $value;
	}

	public function __get($attr) {
		return $this->$attr;
	}
}
?>