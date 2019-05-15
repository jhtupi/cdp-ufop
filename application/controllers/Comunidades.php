<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comunidades extends CI_Controller {

	public function __construct() {
		parent::__construct();

	}
	
	public function index() {
		$this->load->helper('funcoes');

		$this->load->library('table'); // Chama a biblioteca de tabelas

		// Carrega o Model de comunidades
		$this->load->model('comunidades_model', 'modelcomunidades'); 
		// Insere os dados da postagem no array dados
		$dados['comunidades'] = $this->modelcomunidades->listar_comunidades();


		$dados['titulo'] = 'Comunidades existentes';
		$dados['subtitulo'] = '';

		// Dados a serem enviados para o Cabeçalho

		// Faz as chamadas dos templates dos views de header, footer, aside
		$this->load->view('frontend/template/html-header', $dados); // Aqui a variável $dados é carregada na view
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/comunidades');	// Chamada do conteúdo da página em si
		$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}

	public function comunidade($id) {
		$this->load->helper('funcoes');

		$this->load->model('comunidades_model', 'modelcomunidades');
		$dados['comunidades'] = $this->modelcomunidades->listar_comunidade($id);

		$this->load->model('comunidades_model', 'modelcomunidades');
		$dados['membros'] = $this->modelcomunidades->membros_comunidade($id);

		$this->load->model('comunidades_model', 'modelcomunidades');
		$dados['reunioes'] = $this->modelcomunidades->reunioes_comunidade($id);

		$dados['titulo'] = 'Visualizar comunidade';
		$dados['subtitulo'] = '';
		// Dados a serem enviados para o Cabeçalho


		// Faz as chamadas dos templates dos views de header, footer, aside
		$this->load->view('frontend/template/html-header', $dados); 
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/comunidade');	
		$this->load->view('frontend/template/aside-comunidade');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}


	public function criar_comunidade($enviado=null) {
		$this->load->helper('funcoes');

		$dados['titulo'] = 'Criar Comunidade';
		$dados['subtitulo'] = 'CdP-UFOP';
		$dados['enviado'] = $enviado;
		// Dados a serem enviados para o Cabeçalho

		// Faz as chamadas dos templates dos views de header, footer, aside
		$this->load->view('frontend/template/html-header', $dados); // Aqui a variável $dados é carregada na view
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/criar-comunidade');	// Chamada do conteúdo da página em si
		$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}
}


