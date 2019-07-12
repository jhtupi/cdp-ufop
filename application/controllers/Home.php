<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url('login'));
		}
		
		$this->load->model('comunidades_model', 'modelcomunidades');
		$this->destaques = $this->modelcomunidades->destaques_comunidade();
	}
	
	public function index($pular=null, $post_por_pagina=null) {
		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url());
		}
		$this->load->helper('funcoes');
		$this->load->model('comunidades_model', 'modelcomunidades'); 

		$this->load->library('table'); // Chama a biblioteca de tabelas

		// Dados para paginação
		$this->load->library('pagination'); // Chama a biblioteca de paginação
		$config['base_url'] = base_url('comunidades');
		$config['total_rows'] = $this->modelcomunidades->contar();
		$post_por_pagina = 5;
		$config['per_page'] = $post_por_pagina; // mudar para 5
		$this->pagination->initialize($config);

		// Insere os dados da postagem no array dados
		$dados['comunidades'] = $this->modelcomunidades->listar_comunidades($pular,$post_por_pagina);

		$dados['titulo'] = 'Página inicial';
		$dados['subtitulo'] = 'Comunidades existentes';
		$dados['destaques'] = $this->destaques;
		$dados['links_paginacao'] = $this->pagination->create_links();

		// Dados a serem enviados para o Cabeçalho

		// Faz as chamadas dos templates dos views de header, footer, aside
		$this->load->view('frontend/template/html-header', $dados); // Aqui a variável $dados é carregada na view
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/home');	// Chamada do conteúdo da página em si
		$this->load->view('frontend/template/aside-comunidades');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}

}
