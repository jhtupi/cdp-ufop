<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comunidades_model extends CI_Model {

	public $id;
	public $tema;
	public $descricao;
	public $nps_medio;
	public $id_usuario;
	public $data_criacao;

	public function __construct() {
		parent::__construct();
	}


	public function listar_comunidade($id) {
		$this->db->select('id,tema,descricao,nps_medio,id_usuario,data_criacao');
		$this->db->from('comunidade'); // seleciona a tabela
		$this->db->where('id ='.$id); // Compara com a variável id foi enviada
		return $this->db->get()->result();
	}

	public function listar_comunidades($pular=null,$post_por_pagina=null) {
		$this->db->select('comunidade.id,comunidade.tema,comunidade.descricao,comunidade.nps_medio,comunidade.data_criacao, comunidade.id_usuario, usuario.nome');
		$this->db->from('comunidade'); 
		$this->db->join('usuario', 'usuario.id = comunidade.id_usuario', 'inner');
		$this->db->order_by('tema', 'ASC');

		if($pular && $post_por_pagina) {
			$this->db->limit($post_por_pagina,$pular);
		} else {
			$this->db->limit(5);
		}
		return $this->db->get()->result();
	}

	public function listar_minhas_comunidades($idUsuario) {
		$this->db->select('comunidade.id,comunidade.tema,comunidade.descricao,comunidade.nps_medio,comunidade.data_criacao, comunidade.id_usuario, usuario.nome');
		$this->db->from('comunidade'); 
		$this->db->join('usuario', 'usuario.id = comunidade.id_usuario', 'inner');
		$this->db->join('entra', 'entra.id_usuario='.$idUsuario, 'inner');
		$this->db->where('comunidade.id = entra.id_comunidade');
		$this->db->order_by('tema', 'ASC');
		return $this->db->get()->result();
	}

	public function destaques_comunidade() {
		$this->db->select('id,tema,nps_medio');
		$this->db->from('comunidade')->where('nps_medio <= 100'); // seleciona a tabela
		$this->db->limit(4);	// limita a chamada para apenas os primeiros 4 itens
		$this->db->order_by('nps_medio', 'DESC'); // Ordenar por data da mais antiga para mais nova
		return $this->db->get()->result();
	}
	public function listar_comunidade_reuniao($idReuniao) {
		$this->db->select('comunidade.id,comunidade.tema,comunidade.descricao,comunidade.nps_medio,comunidade.id_usuario,comunidade.data_criacao');
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
		$this->db->from('entra')->where('id_comunidade='.$id); // seleciona a tabela
		//$this->db->join('comunidade', 'entra.id_comunidade ='.$id, 'inner');

		$this->db->join('usuario', 'entra.id_usuario = usuario.id', 'inner');
		return $this->db->get()->result();
	}

	public function reunioes_comunidade($id,$pular=null,$post_por_pagina=null) {
		$this->db->select('*');
		$this->db->from('reuniao'); // seleciona a tabela
		$this->db->where('id_comunidade ='.$id); // Compara com a variável id foi enviada
		//$this->db->order_by('data', 'DESC');

		if($pular && $post_por_pagina) {
			$this->db->limit($post_por_pagina,$pular);
		} else {
			$this->db->limit(2);
		}

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

	public function adicionar($tema,$descricao,$idUser,$dataCriacao) {
		// Adiciona as variáveis como colunas da matriz $dados
		// A posição deve ter o mesmo nome que está na coluna da tabela que irei referenciar
		$dados['tema'] = $tema;
		$dados['descricao'] = $descricao;
		$dados['id_usuario'] = $idUser;
		$dados['data_criacao'] = $dataCriacao;

		// Insere na tabela usuario os dados da variável na tabela
		return $this->db->insert('comunidade', $dados); 
	}

	public function alterar($id,$tema,$descricao) {
		$dados['tema'] = $tema;
		$dados['descricao'] = $descricao;
		$this->db->where('id', $id);
		return $this->db->update('comunidade', $dados);
	}

	public function excluir($idComunidade, $idUsuario) {
		$this->db->select('*')->from('comunidade')->where('id ='.$idComunidade); 
		$ids = $this->db->get()->result();
		foreach($ids as $id) {
			$idUser = $id->id_usuario;
		}
		if ($idUser == $idUsuario) {
			$this->load->model('reunioes_model', 'modelreunioes');
			$this->modelreunioes->excluir_reunioes($idComunidade);
			$this->modelcomunidades->excluir_entra($idComunidade);
			$this->db->where('id', $idComunidade);
			return $this->db->delete('comunidade'); // deleta a categoria selecionada
		} else {
			return 0;
		}
	}

	public function calcularNPSMedio($idComunidade) {

		$this->db->select('*')->from('reuniao')->where('id_comunidade ='.$idComunidade);
		if ($query = $this->db->get()->result()) {
			$todos = 0;
			$nTodos = 0;
			$houveNPS = 0; // Verifica se já houve alguma reunião avaliada (Previnir o caso de NPS = 0)
			foreach($query as $q) {
				if($q->nps != 101) {
				$todos = $todos + $q->nps;		
				$houveNPS = 1;
				}
				$nTodos++;
			}
			$nps = $todos/$nTodos;
			if($houveNPS) {
				$dados['nps_medio'] = $nps;
			} else {
				$dados['nps_medio'] = 101;
			}
			$this->db->where('id='.$idComunidade);
			if($this->db->update('comunidade', $dados)) {
				return $nps;
			} else {
				return 102;
			}

		} else {
			$this->db->set('nps_medio', 104);
		    $this->db->where('id', $idComunidade);
		    $this->db->update('comunidade');
			return 103;
		  }
		
	}
/* 
0 - Não rolou update avaliar
$nps_medio - Rolou update NPS Médio
-102 - Não rolou update
-103 - Não obteve resultado
*/

	public function contar() {
		return $this->db->count_all('comunidade');
	}

	public function contar_reunioes($idComunidade) {
		$this->db->where('id_comunidade ='.$idComunidade);
		return $this->db->count_all_results('reuniao');
	}

	public function excluir_entra($idComunidade) {
		$this->db->where('id_comunidade',$idComunidade);
		return $this->db->delete('entra'); // deleta a categoria selecionada 
	}



}
