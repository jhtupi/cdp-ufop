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

	public function inserir() {


		// Validações do Formulário
		// Nome
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txt-nome', 'Nome do departamento',
			'required'); 

		
		if ($this->form_validation->run() == FALSE) { 
			$this->index();
		} else {
			// Validação correta, resgata as variáveis
			$nome= $this->input->post('txt-nome');

		$this->load->model('departamentos_model', 'modeldepartamentos'); // Carrega o Model de Departamentos
			if($this->modeldepartamentos->adicionar($nome)) { // Se conseguiu acessar o model e adicionar
				redirect(base_url('admin/departamentos'));
			} else { // Caso não tenha conseguido acessar o model
				echo "Houve um erro no sistema!";
			}

		}
	}

	public function alterar($id) {

		$this->load->model('departamentos_model', 'modeldepartamentos'); 

		$dados['departamentos'] = $this->modeldepartamentos->listar_departamento($id);
		
		// Dados a serem enviados para o Cabeçalho
		$dados['titulo'] = 'Painel de Controle';
		$dados['subtitulo'] = 'Departamentos';
		

		// Faz as chamadas dos templates dos views de header, footer, aside
		$this->load->view('backend/template/html-header', $dados); // Aqui a variável $dados é carregada na view
		$this->load->view('backend/template/template');
		$this->load->view('backend/alterar-departamento');	// Chamada do conteúdo da página em si
		$this->load->view('backend/template/html-footer');
	}

	public function salvar_alteracoes($id) {

		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url('admin'));
		}

		$this->load->model('departamentos_model', 'modeldepartamentos'); 

		$this->load->library('form_validation');
		// Validações do Formulário
		// Nome
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txt-nome', 'Nome do departamento',
			'required'); 
		// Preenchimento requerido 
		
		if ($this->form_validation->run() == FALSE) { // Se encontrar um erro, retorna à página
			$this->alterar($id);
		} else {
			// Recebe os dados do formulário
			$nome= $this->input->post('txt-nome');
			$id= $this->input->post('txt-id');
			if($this->modeldepartamentos->alterar($nome,$id)) { // Se conseguiu acessar o model e adicionar
				redirect(base_url('admin/departamentos'));
			} else { // Caso não tenha conseguido acessar o model
				echo "Houve um erro no sistema!";
			}

		}
	}

	public function excluir($id) {

		$this->load->model('departamentos_model', 'modeldepartamentos'); // Carrega o Model de usuários

		if($this->modeldepartamentos->excluir($id)) { // Se conseguiu acessar o model e adicionar
			redirect(base_url('admin/departamentos'));
		} else { // Caso não tenha conseguido acessar o model
			echo "Houve um erro no sistema!";
		}
	}

	
}


