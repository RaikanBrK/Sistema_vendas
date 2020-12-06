<?php 
namespace App\Controllers;
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {
	public function index() {
		$this->view->css = ['index'];
		$this->view->js = ['index'];

		$mProdutos = Container::getModel('Produtos');
		$mFornecedores = Container::getModel('Fornecedores');

		$produtos = $mProdutos->getAll();

		$produtosUpdate = [];
		foreach ($produtos as $key => $produto) {
			$mFornecedores->__set('id', $produto['id']);
			$fornecedores = $mFornecedores->getAllWithIdProduct();
			$count = count($fornecedores);

			$queryFornecedor = '';
			foreach ($fornecedores as $key => $fornecedor) {

				$queryFornecedor .= '<span class="fornecedor">'.$fornecedor['nome'].'</span>';
				if ($key < $count - 1) {
					$queryFornecedor .= ', ';
				}

			}
			$produto['fornecedores'] = $queryFornecedor;
			$produtosUpdate[] = $produto;
		}

		$this->view->produtos = $produtosUpdate;

		$this->render('index');
	}

	public function get_produtos() {
		$mProdutos = Container::getModel('Produtos');
		$mFornecedores = Container::getModel('Fornecedores');

		$produtos = $mProdutos->getAll();

		$produtosUpdate = [];
		foreach ($produtos as $key => $produto) {
			$mFornecedores->__set('id', $produto['id']);
			$fornecedores = $mFornecedores->getAllWithIdProduct();
			$count = count($fornecedores);

			$queryFornecedor = '';
			foreach ($fornecedores as $key => $fornecedor) {

				$queryFornecedor .= '<span class="fornecedor">'.$fornecedor['nome'].'</span>';
				if ($key < $count - 1) {
					$queryFornecedor .= ', ';
				}

			}
			$produto['fornecedores'] = $queryFornecedor;
			$produtosUpdate[] = $produto;
		}

		echo json_encode($produtosUpdate);
	}


	
}
?>