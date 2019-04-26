<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	public function __construct() {
		parent::__construct();

	}
	
	public function index() {
		$this->load->helper('funcoes');

		$this->load->library('table'); // Chama a biblioteca de tabelas

		// Carrega o Model de usuários
		$this->load->model('usuarios_model', 'modelusuarios'); 
		// Insere os dados da postagem no array dados
		$dados['usuarios'] = $this->modelusuarios->listar_usuarios();


		$dados['titulo'] = 'Usuários do sistema';
		$dados['subtitulo'] = '';

		// Dados a serem enviados para o Cabeçalho

		// Faz as chamadas dos templates dos views de header, footer, aside
		$this->load->view('frontend/template/html-header', $dados); // Aqui a variável $dados é carregada na view
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/usuarios');	// Chamada do conteúdo da página em si
		$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}

	public function usuario($id, $slug=null) {
		$this->load->helper('funcoes');

		$this->load->model('usuarios_model', 'modelusuarios');
		$dados['usuarios'] = $this->modelusuarios->listar_usuario($id);

		$dados['titulo'] = 'Visualizar usuário';
		$dados['subtitulo'] = '';
		// Dados a serem enviados para o Cabeçalho


		// Faz as chamadas dos templates dos views de header, footer, aside
		$this->load->view('frontend/template/html-header', $dados); 
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/usuario');	
		$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}

	public function criar_usuario($enviado=null) {
		$this->load->helper('funcoes');

		$this->load->model('usuarios_model', 'modelusuarios');
		//$dados['usuarios'] = $this->modelusuarios->listar_usuario($id);

		$dados['titulo'] = 'Criar usuário';
		$dados['subtitulo'] = '';
		$dados['enviado'] = $enviado;
		// Dados a serem enviados para o Cabeçalho


		// Faz as chamadas dos templates dos views de header, footer, aside
		$this->load->view('backend/template/html-header', $dados); 
		$this->load->view('backend/criar-usuario');	
		$this->load->view('backend/template/html-footer');
	}

	public function meu_perfil($id) {
		$this->load->helper('funcoes');

		$this->load->model('usuarios_model', 'modelusuarios');
		//$dados['usuarios'] = $this->modelusuarios->listar_usuario($id);

		$dados['usuarios'] = $this->modelusuarios->meu_perfil($id);
		$dados['titulo'] = 'Meu Perfil';
		$dados['subtitulo'] = '';
		// Dados a serem enviados para o Cabeçalho


		// Faz as chamadas dos templates dos views de header, footer, aside
		$this->load->view('frontend/template/html-header', $dados); 
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/meu-perfil');	
		$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}

	public function inserir() {


		$this->load->model('usuarios_model', 'modelusuarios'); // Carrega o Model de usuários

		// Validações do Formulário

		// Nome
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txt-nome', 'Nome do Usuário',
			'required|min_length[3]'); 
		// Preenchimento requerido | no mínimo 3 caracteres 

		// Email
		$this->form_validation->set_rules('txt-email', 'E-mail',
			'required|valid_email');
		// Preenchimento requerido | Formato de e-mail válido
		
		// CPF
		$this->form_validation->set_rules('txt-cpf', 'CPF',
			'required|min_length[11]');
		// Preenchimento requerido | Mínimo de 11 caracteres

		// Telefone
		$this->form_validation->set_rules('txt-telefone', 'Telefone',
			'required|min_length[11]');
		// Preenchimento requerido | Mínimo de 20 caracteres
		
		// User
		$this->form_validation->set_rules('txt-user', 'User',
			'required|min_length[3]|is_unique[usuario.user]|alpha_numeric');
		// Preenchimento requerido | Mínimo de 3 caracteres | Deve ser único		
		
		// Senha
		$this->form_validation->set_rules('txt-senha', 'Senha',
			'required|min_length[3]');
		// Preenchimento requerido | Mínimo de 3 caracteres
		
		// Confirmar senha
		$this->form_validation->set_rules('txt-confir-senha', 'Confirmar Senha',
			'required|matches[txt-senha]');
		// Preenchimento requerido | É comparado para ser igual ao txt-senha
		
		
		if ($this->form_validation->run() == FALSE) { 
			redirect(base_url('criar_usuario/2'));
		} else {
			// Validação correta, resgata as variáveis
			$nome= $this->input->post('txt-nome');
			$email= $this->input->post('txt-email');
			$cpf= $this->input->post('txt-cpf');
			$telefone= $this->input->post('txt-telefone');
			$user= $this->input->post('txt-user');
			$senha= $this->input->post('txt-senha');

			if($this->modelusuarios->adicionar($nome,$email,$cpf,$telefone,$user,$senha)) { // Se conseguiu acessar o model e adicionar
				redirect(base_url('criar_usuario/1'));
			} else { // Caso não tenha conseguido acessar o model
				echo "Houve um erro no sistema!";
			}

		}
	}




			 				// Funções de Login



	public function pag_login() {
		$dados['titulo'] = 'CdP-UFOP';
		$dados['subtitulo'] = 'Entrar no sistema';
		// Dados a serem enviados para o Cabeçalho

		// Faz as chamadas dos templates dos views de header, footer, aside
		$this->load->view('backend/template/html-header', $dados); // Aqui a variável $dados é carregada na view
		$this->load->view('backend/login');	// Chamada do conteúdo da página em si
		$this->load->view('backend/template/html-footer');
	}

	public function login() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txt-user', 'Usuário', // Identificador da categoria para colocar as regras
			'required|min_length[3]'); 
		// Preenchimento requerido | no mínimo 3 caracteres
		// A barra vertical serve para adicionar mais regras de validação
		
		$this->form_validation->set_rules('txt-senha', 'Senha', 
			'required|min_length[3]');

		if ($this->form_validation->run() == FALSE) { // Se encontrar um erro, retorna à página
			$this->pag_login();
		} else {

			// Recebe usuário e senha do formulários
			$usuario=$this->input->post('txt-user');
			$senha=$this->input->post('txt-senha');

			// Verifica se são existentes no banco
			$this->db->where('user', $usuario);
			$this->db->where('senha', md5($senha));
			$userlogado = $this->db->get('usuario')->result(); // Caso tenha encontrado um resultado, retornará verdadeiro
			if($userlogado){
				$dadosSessao['userlogado'] = $userlogado[0];	// Recebe todos os dados da tabela 'usuário'
				$dadosSessao['logado'] = TRUE;	// Confirmação que o usuário está logado no sistema

				$this->session->set_userdata($dadosSessao); // Envia os dados do usuário logado à sessão
				redirect(base_url()); // Redireciona o usuário para página de administrador
			} else { // Não encontrou usuário e senhas iguais
				$dadosSessao['userlogado'] = NULL; 
				$dadosSessao['logado'] = FALSE;	
				$this->session->set_userdata($dadosSessao); 
				redirect(base_url('login')); 
			}
		}
	}

	public function logout() {
		$dadosSessao['userlogado'] = NULL; 
		$dadosSessao['logado'] = FALSE;	
		$this->session->set_userdata($dadosSessao); 
		redirect(base_url('login')); 
	}


	public function esqueci_senha() {
		$dados['titulo'] = 'Esqueci minha senha';
		$dados['subtitulo'] = '';
		// Dados a serem enviados para o Cabeçalho

		// Faz as chamadas dos templates dos views de header, footer, aside
		$this->load->view('backend/template/html-header', $dados); // Aqui a variável $dados é carregada na view
		$this->load->view('backend/esqueci-senha');	// Chamada do conteúdo da página em si
		$this->load->view('backend/template/html-footer');
	}





}


