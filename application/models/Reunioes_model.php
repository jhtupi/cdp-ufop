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

	public function participantes_reuniao($id) {
		$this->db->select('usuario.id,usuario.nome,usuario.foto');
		$this->db->from('participa'); // seleciona a tabela
		$this->db->join('usuario', 'participa.id_usuario = usuario.id', 'inner');
		$this->db->join('reuniao', 'participa.id_reuniao ='.$id, 'inner');
		return $this->db->get()->result();
	}

	public function inserir_participante_reuniao($idReuniao,$idUsuario) {
		$dados['id_usuario'] = $idUsuario;
		$dados['id_reuniao'] = $idReuniao;
		return $this->db->insert('participa', $dados); 
	}
	public function remover_participante_reuniao($idReuniao,$idUsuario) { // A fazer
		$this->db->where('id_usuario='.$idUsuario)->where('id_reuniao='.$idReuniao);
		return $this->db->delete('participa');
	}

	public function adicionar($titulo,$data,$horario,$resumo,$idUser,$idComunidade) {
		// Adiciona as variáveis como colunas da matriz $dados
		// A posição deve ter o mesmo nome que está na coluna da tabela que irei referenciar
		$dados['titulo'] = $titulo;
		$dados['data'] = $data;
		$dados['horario'] = $horario;
		$dados['resumo'] = $resumo;
		$dados['id_usuario'] = $idUser;
		$dados['id_comunidade'] = $idComunidade;
									
		// Insere na tabela usuario os dados da variável na tabela
		return $this->db->insert('reuniao', $dados); 
	}

	public function avaliar($idReuniao, $idUsuario, $nps) {
		$dados['nps'] = $nps;
		$this->db->where('id_usuario='.$idUsuario)->where('id_reuniao='.$idReuniao);
		return $this->db->update('participa', $dados);
	}


}
