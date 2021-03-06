<?php 
namespace App\Models;
use MF\Model\Model;

class Produtos extends Model {
	protected $id;
	protected $nome;
	protected $referencia;
	protected $preco;
	protected $fornecedores;

	public function getAll() {
		$query = '
			SELECT id, nome, preco, referencia FROM produtos
		';

		$stmt = $this->db->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function getSearch($search) {
		$search = '%'.$search.'%';
		$query = '
			SELECT id, nome, preco, referencia FROM produtos WHERE nome LIKE :search || referencia LIKE :search
		';

		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':search', $search);
		$stmt->execute();
		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function getIdPorReferencia() {
		$query = '
			SELECT id, preco FROM produtos WHERE referencia = :referencia
		';

		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':referencia', $this->__get('referencia'));
		$stmt->execute();
		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}

	public function getProdutoIdVenda($id) {
		$query = '
			SELECT 
				p.id, p.nome, venda.preco
			FROM 
				produtos as p 
			    LEFT JOIN merge_prod_vend as venda ON (p.id = venda.id_produto)
			WHERE
				id_venda = :id_venda
		';

		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_venda', $id);
		$stmt->execute();
		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}
}
?>