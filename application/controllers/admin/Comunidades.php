<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comunidades extends CI_Controller {

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
		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url());
		}

		// Carrega o Model de comunidades
		$this->load->model('comunidades_model', 'modelcomunidades'); 

		$this->load->helper('funcoes');

		$this->load->library('table'); // Chama a biblioteca de tabelas
		$this->load->library('pagination'); // Chama a biblioteca de paginação

		// Dados para paginação
		$config['base_url'] = base_url('admin/comunidades');
		$config['total_rows'] = $this->modelcomunidades->contar();
		$post_por_pagina = 5;
		$config['per_page'] = $post_por_pagina; // mudar para 5
		$this->pagination->initialize($config);

		// Insere os dados da postagem no array dados
		$dados['comunidades'] = $this->modelcomunidades->listar_comunidades($pular,$post_por_pagina);
		$dados['titulo'] = 'Painel de Controle';
		$dados['subtitulo'] = 'Comunidades';
		$dados['links_paginacao'] = $this->pagination->create_links();

		// Dados a serem enviados para o Cabeçalho

		// Faz as chamadas dos templates dos views de header, footer, aside
		$this->load->view('backend/template/html-header', $dados); 
		$this->load->view('backend/template/template');
		$this->load->view('backend/comunidades');
		$this->load->view('backend/template/html-footer');
	}

	public function inserir() {

	// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url());
		}

		$this->load->model('comunidades_model', 'modelcomunidades'); // Carrega o Model de usuários

		// Validações do Formulário

		// Tema
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txt-tema', 'Tema',
			'required|min_length[3]'); 
		// Preenchimento requerido | no mínimo 3 caracteres 
		
		// Descrição
		$this->form_validation->set_rules('txt-descricao', 'Descrição',
			'required|min_length[20]');
		// Preenchimento requerido | Mínimo de 20 caracteres
		
		
		if ($this->form_validation->run() == FALSE) { 
			redirect(base_url('admin/comunidades/2'));

		} else {
			// Validação correta, resgata as variáveis
			$tema= $this->input->post('txt-tema');
			$descricao= $this->input->post('txt-descricao');
			$idUser= $this->input->post('txt-iduser');
			$dataCriacao = date('Y-m-d');

			if($this->modelcomunidades->adicionar($tema,$descricao,$idUser,$dataCriacao)) { // Se conseguiu acessar o model e adicionar
				redirect(base_url('admin/comunidades/1'));
			} else { // Caso não tenha conseguido acessar o model
				redirect(base_url('admin/comunidades/3'));
			}

		}
	}

	public function alterar($id, $enviado = null) {
		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url());
		}
		$this->load->helper('funcoes');

		$this->load->model('comunidades_model', 'modelcomunidades');
		$dados['comunidades'] = $this->modelcomunidades->listar_comunidade($id);


		$dados['titulo'] = 'Painel de Controle';
		$dados['subtitulo'] = 'Alterar comunidade';
		$dados['enviado'] = $enviado;
		// Dados a serem enviados para o Cabeçalho


		// Faz as chamadas dos templates dos views de header, footer, aside
		$this->load->view('backend/template/html-header', $dados); 
		$this->load->view('backend/template/template');
		$this->load->view('backend/alterar-comunidade');
		$this->load->view('backend/template/html-footer');
	}

	public function salvar_alteracoes() {

		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url('admin/login'));
		}

		$this->load->model('comunidades_model', 'modelcomunidades'); // Carrega o Model de usuários

		$this->load->library('form_validation');
		// Validações do Formulário

		// Tema
		$this->load->library('form_validation');

		$this->form_validation->set_rules('txt-tema', 'Tema',
			'required|min_length[3]'); 
		// Preenchimento requerido | no mínimo 3 caracteres 
		
		// Descrição
		$this->form_validation->set_rules('txt-descricao', 'Descrição',
			'required|min_length[20]');
		// Preenchimento requerido | Mínimo de 20 caracteres
		 
		$id= $this->input->post('txt-id');

		if ($this->form_validation->run() == FALSE) { // Se encontrar um erro, retorna à página
			//echo validation_errors('<div class="alert alert-danger">', '</div>'); // imprime todos os erros de validação que podem ter 
			redirect(base_url('admin/comunidades/alterar/'.$id.'/2'));
		} else {
			// Recebe os dados do formulário
			$tema= $this->input->post('txt-tema');
			$descricao= $this->input->post('txt-descricao');
			
			if($this->modelcomunidades->alterar($id,$tema,$descricao)) { // Se conseguiu acessar o model e adicionar
				redirect(base_url('admin/comunidades/alterar/'.$id.'/1'));
			} else { // Caso não tenha conseguido acessar o model
				redirect(base_url('admin/comunidades/alterar/'.$id.'/3'));
			}

		}
	}

	public function excluir($idComunidade, $idUsuario) {
		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url());
		}
		

		$this->load->model('comunidades_model', 'modelcomunidades'); // Carrega o Model de usuários
		//echo $this->modelcomunidades->excluir($idComunidade, $idUsuario);
		//return;
		if($this->modelcomunidades->excluir($idComunidade, $idUsuario)) { // Se conseguiu acessar o model e adicionar
			redirect(base_url('admin/comunidades'));
		} else { // Caso não tenha conseguido acessar o model
			echo "Houve um erro na exclusão da comunidade!";
		}
	}

	
}


