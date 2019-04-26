<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reunioes_model extends CI_Model {

	public $id;
	public $titulo;
	public $imagem;
	public $data;
	public $horario;
	public $resumo;
	public $id_usuario;
	public $id_comunidade;

	public function __construct() {
		parent::__construct();
	}

	
	public function listar_reuniao($id) {
		$this->db->select('id,titulo,imagem,data,horario,resumo,id_usuario,id_comunidade');
		$this->db->from('reuniao'); // seleciona a tabela
		$this->db->where('id ='.$id); // Compara com a variável id foi enviada
		return $this->db->get()->result();
	}

	public function listar_reunioes() {
		$this->db->select('id,titulo,imagem,data,horario,resumo,id_usuario,id_comunidade');
		$this->db->from('reuniao'); 
		$this->db->order_by('titulo', 'ASC');
		return $this->db->get()->result();
	}

	public function listar_reunioes_recentes() {
		$this->db->select('id,titulo,imagem,data,horario,resumo,id_usuario,id_comunidade');
		$this->db->from('reuniao'); 
		$this->db->order_by('data', 'ASC');
		return $this->db->get()->result();
	}


}
