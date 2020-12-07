<?php 
namespace App\Controllers;
use MF\Controller\Action;
use MF\Model\Container;
use App\Regras\Venda;

class IndexController extends Action {

	public function index() {
		$this->view->css = ['index'];
		$this->view->js = ['index'];
		$this->view->title = 'Produtos';

		if (!isset($_SESSION)) {
			session_start();
		}

		if (isset($_SESSION['vendas']['success']) && $_SESSION['vendas']['success']) {
			echo "<script src='/js/clear.js'></script>";
			$this->msg();
			unset($_SESSION['vendas']);
		}

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

	public function msg($msg = 'Venda criada com sucesso.') {
		echo "<script>const msg = '".$msg."'</script>";
		echo "<script src='/js/msg.js'></script>";
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

	public function registrar_venda() {
		$this->view->css = ['registrar_venda'];
		$this->view->js = ['registrar_venda'];
		$this->view->title = 'Registrar Venda';

		$this->render('registrar_venda', 'layoutClean');
	}

	public function dados_venda() {
		$this->view->css = ['dados_venda'];
		$this->view->js = ['dados_venda'];
		$this->view->title = 'Dados da venda';

		if (!isset($_SESSION)) {
			session_start();
		}

		if (isset($_SESSION['produtos'])) {
			$this->render('dados_venda', 'layoutClean');
		} else {
			header('location: /');
			die();
		}

	}

	public function validando_dados_venda() {
		if (!isset($_SESSION)) {
			session_start();
		}
		if (!isset($_SESSION['produtos'])) {
			header('location: /');
			die();	
		}

		$rVenda = new Venda();
		$rVenda->__set('dados', $_GET);
		$rVenda->validarAll();

		if ($rVenda->__get('error') == 0) {


			$vendas = Container::getModel('Vendas');
			$produtos = Container::getModel('Produtos');

			$vendas->__set('total', $this->getTotal());
			$vendas->__set('cep', $_GET['cep']);
			$vendas->__set('date_venda', $_GET['data']);
			$vendas->__set('uf', $_GET['uf']);
			$vendas->__set('bairro', $_GET['bairro']);
			$vendas->__set('cidade', $_GET['cidade']);
			$vendas->__set('rua', $_GET['rua']);
			$id = $vendas->setVenda();

			foreach ($_SESSION['produtos'] as $key => $referencia) {
				$produtos->__set('referencia', $referencia);
				$produto = $produtos->getIdPorReferencia();

				$vendas->setProdutosDeVenda($id, $produto['id'], $produto['preco']);
			}

			$_SESSION['vendas']['success'] = true;
			header('location: /');
		} else {
			if (!isset($_SESSION)) {
				session_start();
			}

			$_SESSION['vendas']['error'] = 1;
			header('location: /dados_venda');
		}
	}

	public function getTotal() {
		if (!isset($_SESSION)) {
			session_start();
		}

		$total = 0;

		$produtos = Container::getModel('Produtos');

		foreach ($_SESSION['produtos'] as $key => $referencia) {
			$produtos->__set('referencia', $referencia);
			$produto = $produtos->getIdPorReferencia();

			$total += $produto['preco'];
		}
		return $total;
	}

	public function registrarProdutosParaVenda() {
		if (!isset($_SESSION)) {
			session_start();
		}
		$_SESSION['produtos'] = $_GET;
	}

	public function vendas() {
		$this->view->css = ['vendas'];
		$this->view->js = ['vendas'];
		$this->view->title = 'Vendas';

		$mVendas = Container::getModel('Vendas');
		$produtos = Container::getModel('Produtos');
		$vendasAll = $mVendas->getAll();

		$vendas = [];
		foreach ($vendasAll as $key => $venda) {
			$produtosVendas = $produtos->getProdutoIdVenda($venda['id']);
			$vendas[$key] = $venda;
			$vendas[$key]['produtos'] = $produtosVendas;

			$max = ['preco' => 0];
			
			foreach ($produtosVendas as $indice => $prod) {

				if ($prod['preco'] > $max['preco']) {
					$max['preco'] = $prod['preco'];
					$max['nome'] = $prod['nome'];
				}
			}
			$vendas[$key]['max'] = $max;
		}			

		$this->view->vendas = $vendas;
		$this->render('vendas');
	}

	public function clearVendas() {
		$vendas = Container::getModel('Vendas');

		$vendas->clearMergeVendas();
		$vendas->clearAllVendas();

		header('location: /');
	}
}
?>