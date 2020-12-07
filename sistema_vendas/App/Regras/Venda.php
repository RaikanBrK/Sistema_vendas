<?php 
namespace App\Regras;
use MF\Model\Container;
use MF\Regras\Regras;

class Venda extends Regras {
	protected $dados;
	protected $data;
	protected $cep;
	protected $uf;
	protected $bairro;
	protected $cidade;
	protected $rua;
	protected $error = 0;

	public function validarAll() {
		
		$this->__set('data', $_GET['data']);
		$this->__set('cep', $_GET['cep']);
		$this->__set('uf', $_GET['uf']);
		$this->__set('bairro', $_GET['bairro']);
		$this->__set('cidade', $_GET['cidade']);
		$this->__set('rua', $_GET['rua']);

		$this->validarData();
		$this->validarCep();
		$this->validarUF();
		$this->notEmpt('bairro');
		$this->notEmpt('cidade');
		$this->notEmpt('rua');
	}

	public function validarError($valor) {
		if ($valor == false) {
			$this->error++;
		}
		return $valor;
	}

	public function validarData() {
		$dateTime = strtotime($this->__get('data'));
		$time = time();
		return $this->validarError($dateTime < $time);
	}

	public function validarCep() {
		$cep = $this->cep;
		return $this->validarError(strlen($cep) == 9);
	}

	public function validarUF() {
		$uf = $this->uf;
		return $this->validarError(strlen($uf) == 2);
	}

	public function notEmpt($selector) {
		$attr = $this->__get($selector);
		return $this->validarError(!empty($attr));
	}
}
?>