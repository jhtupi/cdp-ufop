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
	
	public function index()
	{
		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url());
		}
		$this->load->helper('funcoes');

		$this->load->model('reunioes_model', 'modelreunioes');
		// O modelo de destaques é carregado aqui na função index pois não será requerido em toda pasta como as categorias que ficam no header e aside
		$dados['reunioes'] = $this->modelreunioes->listar_reunioes_recentes();
		$dados['destaques'] = $this->destaques;
		// Insere os dados da postagem no array dados
	
		$this->load->model('comunidades_model', 'modelcomunidades');
		$dados['comunidades'] = $this->modelcomunidades->listar_comunidades();
	

		$dados['titulo'] = 'Página Inicial';
		$dados['subtitulo'] = 'Postagens Recentes';
		// Dados a serem enviados para o Cabeçalho

		// Faz as chamadas dos templates dos views de header, footer, aside
		$this->load->view('frontend/template/html-header', $dados); // Aqui a variável $dados é carregada na view
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/home');	// Chamada do conteúdo da página em si
		$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}

}
