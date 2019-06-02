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
		$this->db->select('usuario.id,usuario.nome,user,email,foto,telefone,departamento.nome depto, departamento.id idDepto');
		$this->db->from('usuario'); // seleciona a tabela
		$this->db->join('departamento', 'usuario.id_depto = departamento.id', 'inner');
		$this->db->where('usuario.id ='.$id); // Compara com a variável id foi enviada
		return $this->db->get()->result();
	}

	public function listar_usuarios() {
		$this->db->select('id,nome,user,email,foto,telefone');
		$this->db->from('usuario'); 
		$this->db->order_by('nome', 'ASC');
		return $this->db->get()->result();
	}

	public function meu_perfil($id) {
		$this->db->select('usuario.id,usuario.nome,user,email,foto,telefone,cpf,senha,departamento.nome depto, departamento.id idDepto');
		$this->db->from('usuario'); // seleciona a tabela
		$this->db->join('departamento', 'usuario.id_depto = departamento.id', 'inner');
		$this->db->where('usuario.id ='.$id); // Compara com a variável id foi enviada
		return $this->db->get()->result();
	}

	public function adicionar($nome,$email,$cpf,$telefone,$user,$senha,$departamento) {
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

	public function alterar($id,$nome,$email,$telefone,$user,$senha,$id_depto) {
		$dados['nome'] = $nome;
		$dados['email'] = $email;
		$dados['telefone'] = $telefone;
		$dados['user'] = $user;
		if($senha != ""){
			$dados['senha']= md5($senha);
		}
		$dados['id_depto'] = $id_depto;
		$this->db->where('id', $id);
		return $this->db->update('usuario', $dados);
	}

	public function alterar_img($id) {
		$dados['foto']= 1;
		$this->db->where('md5(id)', $id);
		return $this->db->update('usuario', $dados);
	}


}
