<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

	public $id;
	public $nome;
	public $user;
	public $email;
	public $foto;
	public $telefone;
	public $cpf;
	public $senha;
	public $adm;
	public $prof;

	public function __construct() {
		parent::__construct();
	}


	public function listar_usuario($id) {
		$this->db->select('id,nome,user,email,foto,telefone');
		$this->db->from('usuario'); // seleciona a tabela
		$this->db->where('id ='.$id); // Compara com a variável id foi enviada
		return $this->db->get()->result();
	}

	public function listar_usuarios() {
		$this->db->select('id,nome,user,email,foto,telefone');
		$this->db->from('usuario'); 
		$this->db->order_by('nome', 'ASC');
		return $this->db->get()->result();
	}


}
