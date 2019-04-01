<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url('admin/login'));
		}
	}
	
	public function index()
	{
		
		$dados['titulo'] = 'Painel de Controle';
		$dados['subtitulo'] = 'Home';
		// Dados a serem enviados para o Cabeçalho

		// Faz as chamadas dos templates dos views de header, footer, aside
		$this->load->view('backend/template/html-header', $dados); // Aqui a variável $dados é carregada na view
		$this->load->view('backend/template/template');
		$this->load->view('backend/home');	// Chamada do conteúdo da página em si
		$this->load->view('backend/template/html-footer');
	}

}
