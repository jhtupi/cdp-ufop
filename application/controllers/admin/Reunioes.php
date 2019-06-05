<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reunioes extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// Adiciona a proteção da página

		// Se a variável de sessão não existir, redirecionar para o login
		if(!$this->session->userdata('logado')) { 
			redirect(base_url());
		}

		// Se o usuário não for administrador
		if(!$this->session->userdata('userlogado')->adm == 1) {
			redirect(base_url());	
		}

	}
	
	public function index($pular=null, $post_por_pagina=null) {
		$this->load->helper('funcoes');

		$this->load->library('table'); // Chama a biblioteca de tabelas

		$this->load->library('pagination'); // Chama a biblioteca de paginação

		// Carrega o Model de reunioes
		$this->load->model('reunioes_model', 'modelreunioes'); 
		// Insere os dados da postagem no array dados


		// Dados para paginação
		$config['base_url'] = base_url('admin/reunioes');
		$config['total_rows'] = $this->modelreunioes->contar();
		$post_por_pagina = 10;
		$config['per_page'] = $post_por_pagina; 
		$this->pagination->initialize($config);


		$dados['reunioes'] = $this->modelreunioes->listar_reunioes($pular,$post_por_pagina);
		$dados['titulo'] = 'Painel de Controle';
		$dados['subtitulo'] = 'Reuniões';
		$dados['links_paginacao'] = $this->pagination->create_links();

		// Dados a serem enviados para o Cabeçalho

		// Faz as chamadas dos templates dos views de header, footer, aside
		$this->load->view('backend/template/html-header', $dados); 
		$this->load->view('backend/template/template');
		$this->load->view('backend/reunioes');
		$this->load->view('backend/template/html-footer');
	}

	public function alterar($id, $enviado = null) {

		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url('admin/login'));
		}

		$this->load->model('reunioes_model', 'modelreunioes'); // Carrega o Model de usuários
		$dados['reunioes'] = $this->modelreunioes->listar_reuniao($id);

		$this->load->model('comunidades_model', 'modelcomunidades');
		$dados['comunidades'] = $this->modelcomunidades->listar_comunidade_reuniao($id);
		$dados['enviado'] = $enviado;
		
		// Dados a serem enviados para o Cabeçalho
		$dados['titulo'] = 'Painel de Controle';
		$dados['subtitulo'] = 'Alterar reunião';
		

		// Faz as chamadas dos templates dos views de header, footer, aside
		$this->load->view('backend/template/html-header', $dados); // Aqui a variável $dados é carregada na view
		$this->load->view('backend/template/template');
		$this->load->view('backend/alterar-reuniao');	// Chamada do conteúdo da página em si
		$this->load->view('backend/template/html-footer');
	}

	public function salvar_alteracoes() {

		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url('admin/login'));
		}

		$this->load->model('reunioes_model', 'modelreunioes'); // Carrega o Model de usuários

		$this->load->library('form_validation');
		// Validações do Formulário

		// Título
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txt-titulo', 'Título',
			'required|min_length[3]'); 
		// Preenchimento requerido | no mínimo 3 caracteres 

		// Data
		$this->form_validation->set_rules('txt-data', 'Data',
			'required');
		// Preenchimento requerido
		
		// Horário
		$this->form_validation->set_rules('txt-horario', 'Horário',
			'required');
		// Preenchimento requerido
		
		// Local
		$this->form_validation->set_rules('txt-local', 'Local',
			'required');
		// Preenchimento requerido | Mínimo de 20 caracteres
		
		// Resumo
		$this->form_validation->set_rules('txt-resumo', 'Resumo',
			'min_length[20]');
		// Mínimo de 20 caracteres

		// Preenchimento requerido | É comparado para ser igual ao txt-senha
		 
		$id= $this->input->post('txt-id');

		if ($this->form_validation->run() == FALSE) { // Se encontrar um erro, retorna à página
			//echo validation_errors('<div class="alert alert-danger">', '</div>'); // imprime todos os erros de validação que podem ter 
			redirect(base_url('admin/reunioes/alterar/'.$id.'/2'));
		} else {
			// Recebe os dados do formulário
			$titulo= $this->input->post('txt-titulo');
			$data= $this->input->post('txt-data');
			$horario= $this->input->post('txt-horario');
			$local= $this->input->post('txt-local');
			$resumo= $this->input->post('txt-resumo');
			if($this->modelreunioes->alterar($id,$titulo,$data,$horario,$local,$resumo)) { // Se conseguiu acessar o model e adicionar
				redirect(base_url('admin/reunioes/alterar/'.$id.'/1'));
			} else { // Caso não tenha conseguido acessar o model
				redirect(base_url('admin/reunioes/alterar/'.$id.'/3'));
			}

		}
	}

	public function excluir($idReuniao) {
		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url());
		}

		$this->load->model('reunioes_model', 'modelreunioes'); // Carrega o Model de usuários
		//echo $this->modelcomunidades->excluir($idComunidade, $idUsuario);
		//return;
		if($this->modelreunioes->excluir_reuniao($idReuniao)) { // Se conseguiu acessar o model e adicionar
			redirect(base_url('admin/reunioes'));
		} else { // Caso não tenha conseguido acessar o model
			echo "Houve um erro na exclusão da comunidade!";
		}
	}


													// MATERIAIS



	public function materiais() {
		$this->load->helper('funcoes');

		$this->load->library('table'); // Chama a biblioteca de tabelas

		// Carrega o Model de reunioes
		$this->load->model('reunioes_model', 'modelreunioes'); 
		// Insere os dados da postagem no array dados
		$dados['materiais'] = $this->modelreunioes->listar_todos_materiais();


		$dados['titulo'] = 'Painel de Controle';
		$dados['subtitulo'] = 'Materiais';

		// Dados a serem enviados para o Cabeçalho

		// Faz as chamadas dos templates dos views de header, footer, aside
		$this->load->view('backend/template/html-header', $dados); 
		$this->load->view('backend/template/template');
		$this->load->view('backend/materiais');
		$this->load->view('backend/template/html-footer');
	}

	public function excluir_material($id,$idReuniao) {
		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url());
		}
		$this->load->model('reunioes_model', 'modelreunioes'); 

		if($this->modelreunioes->remover_material($id)) { // Se conseguiu acessar o model e adicionar
			redirect(base_url('admin/materiais'));
		} else { // Caso não tenha conseguido acessar o model
			echo "Houve um erro no sistema!";
		}
	}


	
}


