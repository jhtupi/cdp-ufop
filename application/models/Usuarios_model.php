<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

	public $id;
	public $nome;
	public $email;
	public $img;
	public $historico;
	public $user;
	public $senha;

	public function __construct() {
		parent::__construct();
	}


	public function listar_autor($id) {
		$this->db->select('id,nome,historico,img');
		$this->db->from('usuario'); // seleciona a tabela
		$this->db->where('id ='.$id); // Compara com a variável id foi enviada
		return $this->db->get()->result();
	}

	public function listar_autores() {
		$this->db->select('id,nome,img');
		$this->db->from('usuario'); 
		$this->db->order_by('nome', 'ASC');
		return $this->db->get()->result();
	}

	public function adicionar($nome,$email,$historico,$user,$senha) {
		// Adiciona as variáveis como colunas da matriz $dados
		// A posição deve ter o mesmo nome que está na coluna da tabela que irei referenciar, no caso, 'categoria'
		$dados['nome'] = $nome;
		$dados['email'] = $email;
		$dados['historico'] = $historico;
		$dados['user'] = $user;
		$dados['senha'] = md5($senha); // Criptografa a senha por segurança
									
		return $this->db->insert('usuario', $dados); // Insere na tabela categoria os dados da variável na tabela
	}

	public function excluir($id) {
		$this->db->where('md5(id)', $id); // compara o id criptografado
		return $this->db->delete('usuario'); // deleta a categoria selecionada
	}

	public function listar_usuario($id) {
		$this->db->select('id,nome,historico,email,user,img');
		$this->db->from('usuario'); // seleciona a tabela
		$this->db->where('md5(id)',$id); // Compara com a variável id foi enviada
		return $this->db->get()->result();
	}

	public function alterar($nome,$email,$historico,$user,$senha,$id) {
		$dados['nome']= $nome;
		$dados['email']= $email;
		$dados['historico']= $historico;
		$dados['user']= $user;
		if($senha != ""){
			$dados['senha']= md5($senha);
		}
		$this->db->where('id', $id);
		return $this->db->update('usuario', $dados);
	}

	public function alterar_img($id) {
		$dados['img']= 1;
		$this->db->where('md5(id)', $id);
		return $this->db->update('usuario', $dados);
	}
	

}
