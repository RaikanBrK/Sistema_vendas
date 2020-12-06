<?php 
namespace App\Models;
use MF\Model\Model;

class Fornecedores extends Model {
	protected $id;
	protected $nome;

	public function getAllWithIdProduct() {
		$query = '
			SELECT 
				merge.id_produto, f.nome
			FROM
				fornecedores as f
			    LEFT JOIN merge_prod_forn as merge ON (merge.id_fornecedor = f.id)
			WHERE 
				merge.id_produto = :id
		';

		$stmt = $this->db->prepare($query);
		$stmt->bindValue('id', $this->__get('id'));
		$stmt->execute();
		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}
}
?>