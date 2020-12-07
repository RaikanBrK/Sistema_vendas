<?php 
namespace App\Models;
use MF\Model\Model;

class Vendas extends Model {
	protected $id;
	protected $total;
	protected $cep;
	protected $date_venda;
	protected $uf;
	protected $bairro;
	protected $cidade;
	protected $rua;

	public function setVenda() {
		$query = '
			INSERT INTO vendas(
				total, cep, date_venda, uf, bairro, cidade, rua
			) VALUE (
				:total, :cep, :date_venda, :uf, :bairro, :cidade, :rua
			)
		';

		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':total', $this->__get('total'));
		$stmt->bindValue(':cep', $this->__get('cep'));
		$stmt->bindValue(':date_venda', $this->__get('date_venda'));
		$stmt->bindValue(':uf', $this->__get('uf'));
		$stmt->bindValue(':bairro', $this->__get('bairro'));
		$stmt->bindValue(':cidade', $this->__get('cidade'));
		$stmt->bindValue(':rua', $this->__get('rua'));
		$stmt->execute();
		return $this->db->lastInsertId();
	}

	public function setProdutosDeVenda($id_venda, $id_produto, $preco) {
		$query = '
			INSERT INTO merge_prod_vend(
				id_venda, id_produto, preco
			) VALUE (
				:id_venda, :id_produto, :preco
			)
		';

		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_venda', $id_venda);
		$stmt->bindValue(':id_produto', $id_produto);
		$stmt->bindValue(':preco', $preco);
		$stmt->execute();
		return $this->db->lastInsertId();
	}

	public function getAll() {
		$query = '
			SELECT id, total, cep, DATE_FORMAT(date_venda, "%d/%m/%Y") as date_venda_f, uf, bairro, cidade, rua FROM vendas ORDER BY date_create DESC
		';

		$stmt = $this->db->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function clearMergeVendas() {
		$query = '
			DELETE FROM merge_prod_vend
		';

		$stmt = $this->db->prepare($query);
		$stmt->execute();
	}

	public function clearAllVendas() {
		$query = '
			DELETE FROM vendas
		';

		$stmt = $this->db->prepare($query);
		$stmt->execute();
	}
}
?>