<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sobrenos extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('comunidades_model', 'modelcomunidades');
		$this->destaques = $this->modelcomunidades->destaques_comunidade();

	}
	
	public function index() {
		$this->load->helper('funcoes');


		$dados['titulo'] = 'Sobre Nós';
		$dados['subtitulo'] = 'Conheça nosso trabalho';
		$dados['destaques'] = $this->destaques;
		// Dados a serem enviados para o Cabeçalho

		// Faz as chamadas dos templates dos views de header, footer, aside
		$this->load->view('frontend/template/html-header', $dados); // Aqui a variável $dados é carregada na view
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/sobrenos');	// Chamada do conteúdo da página em si
		$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}

}
