<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reunioes_model extends CI_Model {

	public $id;
	public $titulo;
	public $data;
	public $horario;
	public $resumo;
	public $id_usuario;
	public $id_comunidade;

	public function __construct() {
		parent::__construct();
	}


	public function listar_reuniao($id) {
		$this->db->select('id,titulo,data,horario,local,resumo,id_usuario,id_comunidade,nps');
		$this->db->from('reuniao'); // seleciona a tabela
		$this->db->where('id ='.$id); // Compara com a variável id foi enviada
		return $this->db->get()->result();
	}
	

	public function listar_reunioes($pular=null,$post_por_pagina=null) {
		$this->db->select('id,titulo,data,horario,local,resumo,id_usuario,id_comunidade,nps');
		$this->db->from('reuniao'); 
		$this->db->order_by('titulo', 'ASC');

		if($pular && $post_por_pagina) {
			$this->db->limit($post_por_pagina,$pular);
		} else {
			$this->db->limit(10);
		}
		return $this->db->get()->result();
	}

	public function listar_reunioes_recentes($pular=null,$post_por_pagina=null) {
		$this->db->select('id,titulo,data,horario,local,resumo,id_usuario,id_comunidade,nps');
		$this->db->from('reuniao'); 
		$this->db->order_by('data', 'DESC');
		if($pular && $post_por_pagina) {
			$this->db->limit($post_por_pagina,$pular);
		} else {
			$this->db->limit(5);
		}
		return $this->db->get()->result();
	}
	public function listar_prox_reunioes($idUsuario, $pular=null, $post_por_pagina=null) {
		$this->load->helper('date');
		$this->db->select('reuniao.id,reuniao.titulo,reuniao.data,reuniao.horario,reuniao.local,reuniao.resumo,reuniao.id_usuario idUser,reuniao.id_comunidade,reuniao.nps npsReuniao');
		$this->db->from('participa'); 
		$this->db->join('reuniao', 'reuniao.id = participa.id_reuniao', 'inner');		
		$this->db->where('participa.id_usuario ='.$idUsuario);
		$this->db->where("reuniao.data >= STR_TO_DATE('".date('Y-m-d',now('America/Sao_Paulo'))."','%Y-%m-%d')");
		$this->db->order_by('data', 'ASC');
	

		if($pular && $post_por_pagina) {
			$this->db->limit($post_por_pagina,$pular);
		} else {
			$this->db->limit(3);
		}

		return $this->db->get()->result();
	}

	public function listar_reunioes_ant($idUsuario, $pular=null, $post_por_pagina=null) {
		$this->load->helper('date');
		$this->db->select('reuniao.id,reuniao.titulo,reuniao.data,reuniao.horario,reuniao.local,reuniao.resumo,reuniao.id_usuario idUser,reuniao.id_comunidade,reuniao.nps npsReuniao');
		$this->db->from('participa'); 
		$this->db->join('reuniao', 'reuniao.id = participa.id_reuniao', 'inner');		
		$this->db->where('participa.id_usuario ='.$idUsuario);
		$this->db->where("reuniao.data < STR_TO_DATE('".date('Y-m-d',now('America/Sao_Paulo'))."','%Y-%m-%d')");
		$this->db->order_by('data', 'DESC');

		if($pular && $post_por_pagina) {
			$this->db->limit($post_por_pagina,$pular);
		} else {
			$this->db->limit(3);
		}

		return $this->db->get()->result();
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

	public function alterar($id,$titulo,$data,$horario,$local,$resumo) {
		$dados['titulo'] = $titulo;
		$dados['data'] = $data;
		$dados['horario'] = $horario;
		$dados['local'] = $local;
		$dados['resumo'] = $resumo;
		$this->db->where('id', $id);
		return $this->db->update('reuniao', $dados);
	}

	public function excluir_reuniao($idReuniao) {
		
		// Deleta os comentários e materiais
		$this->modelreunioes->excluir_comentarios($idReuniao);
		$this->modelreunioes->excluir_materiais($idReuniao);
		$this->modelreunioes->excluir_participa($idReuniao);


		$this->db->where('id',$idReuniao);;
		return $this->db->delete('reuniao'); // deleta a categoria selecionada 
	}

	public function excluir_reunioes($idComunidade) {
		// Deleta os comentários e materiais
		$result = $this->db->select('*')->where('id_comunidade ='.$idComunidade);
		$query = $this->db->get('reuniao')->result();
		$this->load->model('reunioes_model', 'modelreunioes');
		foreach($query as $q) {
			// Deleta os comentários e materiais
			$this->modelreunioes->excluir_comentarios($q->id);
			$this->modelreunioes->excluir_materiais($q->id);
			$this->modelreunioes->excluir_participa($q->id);
		}

		$this->db->where('id_comunidade',$idComunidade);;
		return $this->db->delete('reuniao'); // deleta a categoria selecionada 
	}


										// COMENTÁRIOS DA REUNIÃO


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

	public function listar_comentarios($id) {
		$this->db->select('comentario,usuario.nome,usuario.id,timestamp');
		$this->db->from('comentarios_reuniao'); // seleciona a tabela
		$this->db->join('usuario', 'comentarios_reuniao.id_usuario = usuario.id', 'inner');
		$this->db->where('id_reuniao ='.$id); // Compara com a variável id foi enviada
		$this->db->order_by('timestamp', 'ASC');
		return $this->db->get()->result();
	}
	public function remover_comentario($idUsuario,$idReuniao,$timestamp) { // A fazer
		$this->db->where('id_usuario='.$idUsuario)->where('id_reuniao='.$idReuniao)->where('timestamp='.$timestamp);
		return $this->db->delete('comentarios_reuniao');
	}

	public function excluir_comentarios($idReuniao) {
		$this->db->where('id_reuniao',$idReuniao);
		return $this->db->delete('comentarios_reuniao'); // deleta a categoria selecionada 
	}


										// MATERIAIS DA REUNIÃO


	public function adicionar_material($nome,$idUsuario,$idReuniao) {
		$dados['arquivo']= $nome;
		$dados['id_usuario']= $idUsuario;
		$dados['id_reuniao']= $idReuniao;
		$this->db->where('id', $id);
		return $this->db->insert('material', $dados);
	}

	public function listar_todos_materiais() {
		$this->db->select('material.id,arquivo,usuario.nome,reuniao.titulo reuniao, reuniao.id idReuniao');
		$this->db->from('material');
		$this->db->join('usuario', 'material.id_usuario = usuario.id', 'inner');
		$this->db->join('reuniao', 'material.id_reuniao = reuniao.id', 'inner');
		return $this->db->get()->result();
	}
	public function listar_materiais($idReuniao) {
		$this->db->select('id,arquivo,id_usuario');
		$this->db->from('material');
		$this->db->where('id_reuniao', $idReuniao);
		return $this->db->get()->result();
	}
	public function download_material($idReuniao,$nome) {
		$this->load->helper('download');
		$data = file_get_contents('./assets/frontend/materiais/'.$idReuniao.'/'.$nome);
		force_download($nome, $data);
	}

	public function remover_material($id) { // A fazer
		$this->db->where('id='.$id);
		return $this->db->delete('material');
	}

	public function excluir_materiais($idReuniao) {
		// Deleta a pasta com os materiais
		$path = './assets/frontend/materiais/'.$idReuniao;
		$this->load->helper("file"); // load codeigniter file helper
		delete_files($path, true , false);

		$this->db->where('id_reuniao',$idReuniao);
		return $this->db->delete('material'); // deleta a categoria selecionada 
	}


										// PARTICIPANTES DA REUNIÃO


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


										// FUNÇÕES EXTRAS	


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

	public function contar() {
		return $this->db->count_all('reuniao');
	}

	public function contar_recentes($idUsuario) {
		$this->load->helper('date');
		
		$this->db->from('participa');
		$this->db->where('participa.id_usuario ='.$idUsuario);
		$this->db->where("reuniao.data >= STR_TO_DATE('".date('Y-m-d',now('America/Sao_Paulo'))."','%Y-%m-%d')");
		$this->db->join('reuniao', 'reuniao.id = participa.id_reuniao', 'inner');		

		return $this->db->count_all_results();
	}
	public function contar_passadas($idUsuario) {
		$this->load->helper('date');
		
		$this->db->join('reuniao', 'reuniao.id = participa.id_reuniao', 'inner');		
		$this->db->where('participa.id_usuario ='.$idUsuario);
		$this->db->where("reuniao.data < STR_TO_DATE('".date('Y-m-d',now('America/Sao_Paulo'))."','%Y-%m-%d')");

		return $this->db->count_all_results('participa');
	}

	public function excluir_participa($idReuniao) {
		$this->db->where('id_reuniao',$idReuniao);
		return $this->db->delete('participa'); // deleta a categoria selecionada 
	}

}

