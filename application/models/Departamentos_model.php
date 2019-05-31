<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departamentos_model extends CI_Model {

	public $nome;

	public function __construct() {
		parent::__construct();
	}

	public function listar_departamentos() {
		$this->db->select('id,nome');
		$this->db->from('departamento'); 
		$this->db->order_by('nome', 'ASC');
		return $this->db->get()->result();
	}

	public function adicionar($nome) {
		// Adiciona as variáveis como colunas da matriz $dados
		// A posição deve ter o mesmo nome que está na coluna da tabela que irei referenciar
		$dados['nome'] = $nome;

									
		// Insere na tabela usuario os dados da variável na tabela
		return $this->db->insert('departamento', $dados); 
	}


}

