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
}
?>