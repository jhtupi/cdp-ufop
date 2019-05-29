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
	public function destaques_comunidade() {
		$this->db->select('id,tema,nps_medio');
		$this->db->from('comunidade'); // seleciona a tabela
		$this->db->limit(4);	// limita a chamada para apenas os primeiros 4 itens
		$this->db->order_by('nps_medio', 'DESC'); // Ordenar por data da mais antiga para mais nova
		return $this->db->get()->result();
	}
	public function listar_comunidade_reuniao($idReuniao) {
		$this->db->select('comunidade.id,comunidade.tema,comunidade.descricao,comunidade.imagem,comunidade.nps_medio,comunidade.id_usuario,comunidade.data_criacao');
		//$this->db->from('comunidade'); // seleciona a tabela
		//$this->db->where('id ='.$id); // Compara com a variável id foi enviada
		$this->db->from('reuniao')->where('reuniao.id ='.$idReuniao); // seleciona a tabela
		$this->db->join('comunidade', 'reuniao.id_comunidade = comunidade.id', 'inner');
		return $this->db->get()->result();
	}

	public function criador_comunidade($idComunidade) {
		$this->db->select('usuario.id,usuario.nome,usuario.foto');
		$this->db->from('comunidade')->where('comunidade.id ='.$idComunidade);; // seleciona a tabela
		$this->db->join('usuario', 'comunidade.id_usuario = usuario.id', 'inner');
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
	public function remover_membro_comunidade($idComunidade,$idUsuario) { // A fazer
		$this->db->where('id_usuario='.$idUsuario)->where('id_comunidade='.$idComunidade);
		return $this->db->delete('entra');
	}

	public function adicionar($tema,$descricao,$idUser) {
		// Adiciona as variáveis como colunas da matriz $dados
		// A posição deve ter o mesmo nome que está na coluna da tabela que irei referenciar
		$dados['tema'] = $tema;
		$dados['descricao'] = $descricao;
		$dados['id_usuario'] = $idUser;

		// Insere na tabela usuario os dados da variável na tabela
		return $this->db->insert('comunidade', $dados); 
	}

	public function calcularNPSMedio($idComunidade) {

		// Seleciona promotores
		$result = $this->db->select('*')->where('id_comunidade ='.$idComunidade);
		if ($query = $this->db->get('reuniao')->result()) {
			$todos = 0;
			$nTodos = 0;
			foreach($query as $q) {
				$todos = $todos + $q->nps;		
				$nTodos++;
			}
			$nps = $todos/$nTodos;
			$dados['nps_medio'] = $nps;
			$this->db->where('id='.$idComunidade);
			if($this->db->update('comunidade', $dados)) {
				return $nps;
			} else {
				return NULL;
			}

		} else {
			$this->db->set('nps_medio', null);
		    $this->db->where('id', $idComunidade);
		    $this->db->update('comunidade');
			return NULL;
		  }
		
	}


}
