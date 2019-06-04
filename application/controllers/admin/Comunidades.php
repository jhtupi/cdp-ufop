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
	
	public function index($criada=null) {
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
		$dados['criada'] = $criada;

		// Dados a serem enviados para o Cabeçalho

		// Faz as chamadas dos templates dos views de header, footer, aside
		$this->load->view('backend/template/html-header', $dados); 
		$this->load->view('backend/template/template');
		$this->load->view('backend/comunidades');
		$this->load->view('backend/template/html-footer');
	}

	public function inserir() {

	// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url());
		}

		$this->load->model('comunidades_model', 'modelcomunidades'); // Carrega o Model de usuários

		// Validações do Formulário

		// Tema
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txt-tema', 'Tema',
			'required|min_length[3]'); 
		// Preenchimento requerido | no mínimo 3 caracteres 
		
		// Descrição
		$this->form_validation->set_rules('txt-descricao', 'Descrição',
			'required|min_length[20]');
		// Preenchimento requerido | Mínimo de 20 caracteres
		
		
		if ($this->form_validation->run() == FALSE) { 
			redirect(base_url('admin/comunidades/2'));

		} else {
			// Validação correta, resgata as variáveis
			$tema= $this->input->post('txt-tema');
			$descricao= $this->input->post('txt-descricao');
			$idUser= $this->input->post('txt-iduser');
			$dataCriacao = date('Y-m-d');

			if($this->modelcomunidades->adicionar($tema,$descricao,$idUser,$dataCriacao)) { // Se conseguiu acessar o model e adicionar
				redirect(base_url('admin/comunidades/1'));
			} else { // Caso não tenha conseguido acessar o model
				redirect(base_url('admin/comunidades/3'));
			}

		}
	}

	public function excluir($idComunidade, $idUsuario) {
		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url());
		}
		

		$this->load->model('comunidades_model', 'modelcomunidades'); // Carrega o Model de usuários
		//echo $this->modelcomunidades->excluir($idComunidade, $idUsuario);
		//return;
		if($this->modelcomunidades->excluir($idComunidade, $idUsuario)) { // Se conseguiu acessar o model e adicionar
			redirect(base_url('admin/comunidades'));
		} else { // Caso não tenha conseguido acessar o model
			echo "Houve um erro na exclusão da comunidade!";
		}
	}

	
}


