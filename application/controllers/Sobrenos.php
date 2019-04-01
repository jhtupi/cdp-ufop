<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sobrenos extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('categorias_model','modelcategorias'); 
						// Faz a chamada do model dentro do costrutor para chamar ainda que hajam outras funções
						// 'modelcategorias' é um alias, m apelido para o model
		$this->categorias = $this->modelcategorias->listar_categorias(); 
						// variavel categorias que recebe o que foi resgatado pela função
		$this->load->model('usuarios_model', 'modelusuarios'); 
	}
	
	public function index() {
		$this->load->helper('funcoes');
		$dados['categorias'] = $this->categorias;
		// Cria uma variável array chamada dados para receber as categorias
		// Poderia ter sido chamado direto porém é criada a variável por organização de código


		$dados['autores'] = $this->modelusuarios->listar_autores();
		// Insere os dados da postagem no array dados


		$dados['titulo'] = 'Sobre Nós';
		$dados['subtitulo'] = 'Conheça nossa equipe';
		// Dados a serem enviados para o Cabeçalho

		// Faz as chamadas dos templates dos views de header, footer, aside
		$this->load->view('frontend/template/html-header', $dados); // Aqui a variável $dados é carregada na view
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/sobrenos');	// Chamada do conteúdo da página em si
		$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}

	public function autores($id, $slug=null) {
		$this->load->helper('funcoes');
		$dados['categorias'] = $this->categorias;

		$dados['autores'] = $this->modelusuarios->listar_autor($id);

		$dados['titulo'] = 'Sobre Nós';
		$dados['subtitulo'] = 'Teste';	
		// Dados a serem enviados para o Cabeçalho


		// Faz as chamadas dos templates dos views de header, footer, aside
		$this->load->view('frontend/template/html-header', $dados); 
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/autor');	
		$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}

}
