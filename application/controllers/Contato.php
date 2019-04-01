<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contato extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('categorias_model','modelcategorias'); // Faz a chamada do model de categorias
		$this->categorias = $this->modelcategorias->listar_categorias(); 
						// variavel categorias que recebe o que foi resgatado pela função
	}

	public function index($enviado=null)
	{
		$this->load->helper('funcoes');
		$dados['categorias'] = $this->categorias;
		$this->load->model('publicacoes_model','modelpublicacoes');
		$dados['postagem'] = $this->modelpublicacoes->destaques_home();
		// Insere os dados da postagem no array dados


		$dados['titulo'] = 'Contato';
		$dados['subtitulo'] = 'Fale Conosco';
		$dados['enviado'] = $enviado;
		// Dados a serem enviados para o Cabeçalho

		// Faz as chamadas dos templates dos views de header, footer, aside
		$this->load->view('frontend/template/html-header', $dados); // Aqui a variável $dados é carregada na view
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/contato');	// Chamada do conteúdo da página em si
		$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}

	public function enviar_mensagem() {
		$this->load->library('form_validation'); // Carrega biblioteca para validação de formulário

		// Define as validações do formulário
		$this->form_validation->set_rules('txtNome', 'Nome', 'required');
		$this->form_validation->set_rules('txtEmail', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('txtMsg', 'Mensagem', 'required');


		if ($this->form_validation->run()) { // Se houver a validação no formulário
			
			// Busca dos dados no formulário
			$nome = $this->input->post('txtNome');
			$email = $this->input->post('txtEmail');
			$msg = $this->input->post('txtMsg');
			$ip = $this->input->ip_address(); // Pega também o IP do usuário que enviou a mensagem

			// Configura a mensagem
			$this->load->library('email');
			$this->email->from($email, $nome);
			$this->email->to('teste@gmail.com');
			$this->email->subject('Formulário de Contato - Nosso Blog');
			$this->email->message(
				"
				<p><strong>Nome: </strong> $nome</p>
				<p><strong>Email: </strong> $email</p>
				<p><strong>Mensagem: </strong> $msg</p>
				<p><strong>IP Usuário: </strong> $ip</p>
				"
			);

			if ($this->email->send()) { // Se o e-mail foi enviado
				redirect(base_url("contato/1"));
			} else {
				redirect(base_url("contato/2"));
			}


		} else {
			$this->index();
		}
	}
	
}
