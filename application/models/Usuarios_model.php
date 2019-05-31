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

	public function meu_perfil($id) {
		$this->db->select('id,nome,user,email,foto,telefone,cpf,senha');
		$this->db->from('usuario'); // seleciona a tabela
		$this->db->where('id ='.$id); // Compara com a variável id foi enviada
		return $this->db->get()->result();
	}

	public function adicionar($nome,$email,$cpf,$telefone,$user,$senha) {
		// Adiciona as variáveis como colunas da matriz $dados
		// A posição deve ter o mesmo nome que está na coluna da tabela que irei referenciar, no caso, 'usuario'
		$dados['nome'] = $nome;
		$dados['user'] = $user;
		$dados['email'] = $email;
		$dados['telefone'] = $telefone;
		$dados['cpf'] = $cpf;
		$dados['senha'] = md5($senha); // Criptografa a senha por segurança
		$dados['adm'] = 0;
		$dados['prof'] = 1;
									
		return $this->db->insert('usuario', $dados); // Insere na tabela usuario os dados da variável na tabela
	}

	public function alterar_img($id) {
		$dados['foto']= 1;
		$this->db->where('md5(id)', $id);
		return $this->db->update('usuario', $dados);
	}


}
