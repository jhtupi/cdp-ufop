<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comunidades_model extends CI_Model {

	public $id;
	public $tema;
	public $descricao;
	public $imagem;
	public $nps_medio;
	public $id_usuario;
	public $data_criacao;

	public function __construct() {
		parent::__construct();
	}


	public function listar_comunidade($id) {
		$this->db->select('id,tema,descricao,imagem,nps_medio,id_usuario,data_criacao');
		$this->db->from('comunidade'); // seleciona a tabela
		$this->db->where('id ='.$id); // Compara com a variável id foi enviada
		return $this->db->get()->result();
	}

	public function membros_comunidade($id) {
		$this->db->select('usuario.id,usuario.nome,usuario.foto');
		$this->db->from('entra'); // seleciona a tabela
		$this->db->join('usuario', 'entra.id_usuario = usuario.id', 'inner');
		$this->db->join('comunidade', 'entra.id_comunidade ='.$id, 'inner');
		return $this->db->get()->result();
	}

	public function reunioes_comunidade($id) {
		$this->db->select('id,titulo,imagem,data,horario,resumo');
		$this->db->from('reuniao'); // seleciona a tabela
		$this->db->where('id_comunidade ='.$id); // Compara com a variável id foi enviada
		$this->db->order_by('horario', 'DESC');
		$this->db->order_by('data', 'DESC');
		return $this->db->get()->result();
	}

	public function listar_comunidades() {
		$this->db->select('id,tema,descricao,imagem,nps_medio,id_usuario,data_criacao');
		$this->db->from('comunidade'); 
		$this->db->order_by('tema', 'ASC');
		return $this->db->get()->result();
	}

	public function inserir_membro_comunidade($idComunidade,$idUsuario) {
		$dados['id_usuario'] = $idUsuario;
		$dados['id_comunidade'] = $idComunidade;
		$dados['data'] = date("y-m-d");
		return $this->db->insert('entra', $dados); 
	}



}
