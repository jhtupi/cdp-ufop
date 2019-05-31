<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departamentos extends CI_Controller {

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
		$this->load->helper('funcoes');

		$this->load->library('table'); // Chama a biblioteca de tabelas

		// Carrega o Model de reunioes
		$this->load->model('departamentos_model', 'modeldepartamentos'); 
		// Insere os dados da postagem no array dados
		$dados['departamentos'] = $this->modeldepartamentos->listar_departamentos();


		$dados['titulo'] = 'Painel de Controle';
		$dados['subtitulo'] = 'Departamentos';

		// Dados a serem enviados para o Cabeçalho

		// Faz as chamadas dos templates dos views de header, footer, aside
		$this->load->view('backend/template/html-header', $dados); 
		$this->load->view('backend/template/template');
		$this->load->view('backend/departamentos');
		$this->load->view('backend/template/html-footer');
	}

	
}


