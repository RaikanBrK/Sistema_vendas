<?php 
namespace App\Controllers;
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {
	public function index() {
		$this->view->css = ['index'];
		$this->view->js = ['index'];

		$this->render('index');
	}

	public function updateProdutosComFornecedores($produtos) {
		$produtosUpdate = [];
		foreach ($produtos as $key => $produto) {
			$mFornecedores = Container::getModel('Fornecedores');

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
		return $produtosUpdate;
	}

	public function get_produtos() {
		$mProdutos = Container::getModel('Produtos');
		
		$produtos = $mProdutos->getAll();		
		$produtosUpdate = $this->updateProdutosComFornecedores($produtos);

		echo json_encode($produtosUpdate);
	}

	public function get_produto() {
		$mProdutos = Container::getModel('Produtos');
		
		$produtos = $mProdutos->getSearch($_GET['search']);	
		$produtosUpdate = $this->updateProdutosComFornecedores($produtos);

		echo json_encode($produtosUpdate);
	}
}
?>