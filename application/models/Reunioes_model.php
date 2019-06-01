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
		$this->db->select('id,titulo,imagem,data,horario,local,resumo,id_usuario,id_comunidade,nps');
		$this->db->from('reuniao'); // seleciona a tabela
		$this->db->where('id ='.$id); // Compara com a variável id foi enviada
		return $this->db->get()->result();
	}
	
	public function listar_comentarios($id) {
		$this->db->select('comentario,usuario.nome,timestamp');
		$this->db->from('comentarios_reuniao'); // seleciona a tabela
		$this->db->join('usuario', 'comentarios_reuniao.id_usuario = usuario.id', 'inner');
		$this->db->where('id_reuniao ='.$id); // Compara com a variável id foi enviada
		$this->db->order_by('timestamp', 'ASC');
		return $this->db->get()->result();
	}

	public function listar_reunioes() {
		$this->db->select('id,titulo,imagem,data,horario,local,resumo,id_usuario,id_comunidade,nps');
		$this->db->from('reuniao'); 
		$this->db->order_by('titulo', 'ASC');
		return $this->db->get()->result();
	}

	public function listar_reunioes_recentes() {
		$this->db->select('id,titulo,imagem,data,horario,local,resumo,id_usuario,id_comunidade,nps');
		$this->db->from('reuniao'); 
		$this->db->order_by('data', 'ASC');
		return $this->db->get()->result();
	}

	public function participantes_reuniao($id) {
		$this->db->select('usuario.id,usuario.nome,usuario.foto, participa.nps');
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

	public function adicionar($titulo,$data,$horario,$local,$resumo,$idUser,$idComunidade) {
		// Adiciona as variáveis como colunas da matriz $dados
		// A posição deve ter o mesmo nome que está na coluna da tabela que irei referenciar
		$dados['titulo'] = $titulo;
		$dados['data'] = $data;
		$dados['horario'] = $horario;
		$dados['local'] = $local;
		$dados['resumo'] = $resumo;
		$dados['id_usuario'] = $idUser;
		$dados['id_comunidade'] = $idComunidade;

									
		// Insere na tabela usuario os dados da variável na tabela
		return $this->db->insert('reuniao', $dados); 
	}

	public function adicionar_comentario($comentario,$idUser,$idReuniao,$timestamp) {
		// Adiciona as variáveis como colunas da matriz $dados
		// A posição deve ter o mesmo nome que está na coluna da tabela que irei referenciar
		$dados['comentario'] = $comentario;
		$dados['id_usuario'] = $idUser;
		$dados['id_reuniao'] = $idReuniao;
		$dados['timestamp'] = $timestamp;
									
		// Insere na tabela usuario os dados da variável na tabela
		return $this->db->insert('comentarios_reuniao', $dados); 
	}


	public function calcularNPS($idReuniao) {

	// Seleciona promotores
	$result = $this->db->select('*')->where('id_reuniao ='.$idReuniao)->where('nps >= 9');
	$query = $this->db->get('participa')->result();
	$promotores = 0;
	foreach($query as $q) {
		$promotores = $promotores + $q->nps;
	}
	
	// Seleciona detratores
	$result = $this->db->select('*')->where('id_reuniao ='.$idReuniao)->where('nps <= 6');
	$query = $this->db->get('participa')->result();
	$detratores = 0;
	foreach($query as $q) {
		$detratores = $detratores + $q->nps;
	}

	// Seleciona neutros
	$result = $this->db->select('*')->where('id_reuniao ='.$idReuniao)->where('nps > 6')->where('nps < 9');
	$query = $this->db->get('participa')->result();
	$neutros = 0;
	foreach($query as $q) {
		$neutros = $neutros + $q->nps;
	}
	

	$todos = $promotores + $detratores + $neutros;

		// Calcula o NPS e atualiza
		$dados['nps'] = (($promotores-$detratores)/$todos)*100;
		$this->db->where('id='.$idReuniao);
		return $this->db->update('reuniao', $dados);
	}

	public function avaliar($idReuniao, $idUsuario, $nps, $idComunidade) {
		$dados['nps'] = $nps;
		$this->db->where('id_usuario='.$idUsuario)->where('id_reuniao='.$idReuniao);
		if ($this->db->update('participa', $dados)) {
			// Atualiza comunidade
			$this->load->model('comunidades_model', 'modelcomunidades');
			$npsMedio = $this->modelcomunidades->calcularNPSMedio($idComunidade);
			return $npsMedio;				
			
		} else {
			return 0;
		}
	}

}

