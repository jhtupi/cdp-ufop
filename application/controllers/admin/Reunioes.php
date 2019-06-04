<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reunioes extends CI_Controller {

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
		$this->load->model('reunioes_model', 'modelreunioes'); 
		// Insere os dados da postagem no array dados
		$dados['reunioes'] = $this->modelreunioes->listar_reunioes();


		$dados['titulo'] = 'Painel de Controle';
		$dados['subtitulo'] = 'Reuniões';

		// Dados a serem enviados para o Cabeçalho

		// Faz as chamadas dos templates dos views de header, footer, aside
		$this->load->view('backend/template/html-header', $dados); 
		$this->load->view('backend/template/template');
		$this->load->view('backend/reunioes');
		$this->load->view('backend/template/html-footer');
	}

	public function materiais() {
		$this->load->helper('funcoes');

		$this->load->library('table'); // Chama a biblioteca de tabelas

		// Carrega o Model de reunioes
		$this->load->model('reunioes_model', 'modelreunioes'); 
		// Insere os dados da postagem no array dados
		$dados['materiais'] = $this->modelreunioes->listar_todos_materiais();


		$dados['titulo'] = 'Painel de Controle';
		$dados['subtitulo'] = 'Materiais';

		// Dados a serem enviados para o Cabeçalho

		// Faz as chamadas dos templates dos views de header, footer, aside
		$this->load->view('backend/template/html-header', $dados); 
		$this->load->view('backend/template/template');
		$this->load->view('backend/materiais');
		$this->load->view('backend/template/html-footer');
	}

	public function excluir_material($id,$idReuniao) {
		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url());
		}
		$this->load->model('reunioes_model', 'modelreunioes'); 

		if($this->modelreunioes->remover_material($id)) { // Se conseguiu acessar o model e adicionar
			redirect(base_url('admin/materiais'));
		} else { // Caso não tenha conseguido acessar o model
			echo "Houve um erro no sistema!";
		}
	}


	
}


