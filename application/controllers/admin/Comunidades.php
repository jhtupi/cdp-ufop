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
	
	public function index() {
		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url());
		}
		$this->load->helper('funcoes');

		$this->load->library('table'); // Chama a biblioteca de tabelas

		// Carrega o Model de comunidades
		$this->load->model('comunidades_model', 'modelcomunidades'); 
		// Insere os dados da postagem no array dados
		$dados['comunidades'] = $this->modelcomunidades->listar_comunidades();


		$dados['titulo'] = 'Painel de Controle';
		$dados['subtitulo'] = 'Comunidades';

		// Dados a serem enviados para o Cabeçalho

		// Faz as chamadas dos templates dos views de header, footer, aside
		$this->load->view('backend/template/html-header', $dados); 
		$this->load->view('backend/template/template');
		$this->load->view('backend/comunidades');
		$this->load->view('backend/template/html-footer');
	}

	
}


