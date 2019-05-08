<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reunioes extends CI_Controller {

	public function __construct() {
		parent::__construct();

	}
	
	
	public function reuniao($id) {
		$this->load->helper('funcoes');

		$this->load->model('reunioes_model', 'modelreunioes');
		$dados['reunioes'] = $this->modelreunioes->listar_reuniao($id);

		$dados['titulo'] = 'Visualizar reunião';
		$dados['subtitulo'] = '';
		// Dados a serem enviados para o Cabeçalho


		// Faz as chamadas dos templates dos views de header, footer, aside
		$this->load->view('frontend/template/html-header', $dados); 
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/reuniao');	
		$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}

	public function criar_reuniao($idComunidade, $idUser,$enviado=null) {
		$this->load->helper('funcoes');

		// Carrega os modelos responsáveis
		$this->load->model('reunioes_model', 'modelreunioes');
		$this->load->model('comunidades_model', 'modelcomunidades');
		$dados['comunidades'] = $this->modelcomunidades->listar_comunidade($idComunidade);
		$this->load->model('usuarios_model', 'modelusuarios');
		$dados['usuarios'] = $this->modelusuarios->listar_usuario($idUser);


		$dados['titulo'] = 'Criar reunião';
		$dados['subtitulo'] = 'CdP-UFOP';
		$dados['enviado'] = $enviado;
		// Dados a serem enviados para o Cabeçalho

		// Faz as chamadas dos templates dos views de header, footer, aside
		$this->load->view('frontend/template/html-header', $dados); // Aqui a variável $dados é carregada na view
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/criar-reuniao');	// Chamada do conteúdo da página em si
		$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}




}


