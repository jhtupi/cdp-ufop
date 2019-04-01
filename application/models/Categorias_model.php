<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias_model extends CI_Model {

	public $id;
	public $titulo;

	public function __construct() {
		parent::__construct();
	}

	
	public function listar_categorias() {
		$this->db->order_by('titulo', 'ASC');		// Ordenar em ordem alfabética
		return $this->db->get('categoria')->result(); // Chama as categorias do banco de dados
	}

	public function listar_titulo($id) {
		$this->db->from('categoria'); // seleciona a tabela
		$this->db->where('id ='.$id); // Compara com a variável id foi enviada
		return $this->db->get()->result();
	}

	public function adicionar($titulo) {
		$dados['titulo'] = $titulo; // cria uma variável (matriz) 'dados' com uma coluna 'título'
									// A posição deve ter o mesmo nome que está na coluna da tabela que irei referenciar, no caso, 'categoria'
		return $this->db->insert('categoria', $dados); // Insere na tabela categoria os dados da variável na tabela
	}

	public function excluir($id) {
		$this->db->where('md5(id)', $id); // compara o id criptografado
		return $this->db->delete('categoria'); // deleta a categoria selecionada
	}

	public function listar_categoria($id) {
		$this->db->from('categoria'); // seleciona a tabela
		$this->db->where('md5(id)', $id); // Compara com a variável id foi enviada
		return $this->db->get()->result();
	}

	public function alterar($titulo, $id) {
		$dados['titulo']= $titulo;
		$this->db->where('id', $id);
		return $this->db->update('categoria', $dados);
	}
	

}
