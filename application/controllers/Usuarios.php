<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('comunidades_model', 'modelcomunidades');
		$this->destaques = $this->modelcomunidades->destaques_comunidade();

	}
	
	public function index($pular=null, $post_por_pagina=null) {
		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url());
		}
		$this->load->helper('funcoes');

		$this->load->library('table'); // Chama a biblioteca de tabelas
		// Carrega o Model de usuários
		$this->load->model('usuarios_model', 'modelusuarios'); 
		

		// Dados para paginação
		$this->load->library('pagination'); // Chama a biblioteca de paginação
		$config['base_url'] = base_url('usuarios');
		$config['total_rows'] = $this->modelusuarios->contar();
		$post_por_pagina = 6;
		$config['per_page'] = $post_por_pagina; // mudar para 5
		$this->pagination->initialize($config);


		$dados['usuarios'] = $this->modelusuarios->listar_usuarios($pular,$post_por_pagina);
		$dados['titulo'] = 'Usuários do sistema';
		$dados['subtitulo'] = '';
		$dados['destaques'] = $this->destaques;
		$dados['links_paginacao'] = $this->pagination->create_links();

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
		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url());
		}
		$this->load->helper('funcoes');

		$this->load->model('usuarios_model', 'modelusuarios');
		$dados['usuarios'] = $this->modelusuarios->listar_usuario($id);
		$dados['destaques'] = $this->destaques;

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
		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url());
		}
		$this->load->helper('funcoes');

		$this->load->model('departamentos_model', 'modeldepartamentos');
		//$dados['usuarios'] = $this->modelusuarios->listar_usuario($id);

		$dados['titulo'] = 'Criar usuário';
		$dados['subtitulo'] = '';
		$dados['enviado'] = $enviado;
		$dados['departamentos'] = $this->modeldepartamentos->listar_departamentos();
		// Dados a serem enviados para o Cabeçalho


		// Faz as chamadas dos templates dos views de header, footer, aside
		$this->load->view('backend/template/html-header', $dados); 
		$this->load->view('backend/criar-usuario');	
		$this->load->view('backend/template/html-footer');
	}

	public function meu_perfil($id, $enviado=null) {
		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url());
		}
		$this->load->helper('funcoes');

		$this->load->model('usuarios_model', 'modelusuarios');
		$this->load->model('departamentos_model', 'modeldepartamentos');
		$dados['departamentos'] = $this->modeldepartamentos->listar_departamentos();

		$dados['usuarios'] = $this->modelusuarios->meu_perfil($id);
		$dados['titulo'] = 'Meu Perfil';
		$dados['subtitulo'] = '';
		$dados['destaques'] = $this->destaques;
		$dados['enviado'] = $enviado;
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
		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url());
		}


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

	public function salvar_alteracoes($userCom) {

		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url('admin/login'));
		}

		$this->load->model('usuarios_model', 'modelusuarios'); // Carrega o Model de usuários

		$this->load->library('form_validation');
		// Validações do Formulário

		// Departamento
		$this->form_validation->set_rules('txt-depto', 'Departamento',
			'required'); 
		// Preenchimento requerido | no mínimo 3 caracteres 

		// Nome
		$this->form_validation->set_rules('txt-nome', 'Nome do Usuário',
			'required|min_length[3]'); 
		// Preenchimento requerido | no mínimo 3 caracteres 

		// Email
		$this->form_validation->set_rules('txt-email', 'E-mail',
			'required|valid_email');
		// Preenchimento requerido | Formato de e-mail válido

		// Telefone
		$this->form_validation->set_rules('txt-telefone', 'Telefone',
			'required|min_length[11]');
		// Preenchimento requerido | Mínimo de 20 caracteres
		
		// User
		$user= $this->input->post('txt-user');
 
		// verificamos se ele é diferente do que veio inicialmente do banco e que foi passado como parâmetro na URL.
		// Caso seja diferente ele irá verificar se é único e caso seja igual ele não fara nada
		 if($userCom != $user){
		     $this->form_validation->set_rules('txt-user','User', 'required|min_length[3]|is_unique[usuario.user]');
		 }
		
		// Senha e Confirmar
		$senha= $this->input->post('txt-senha');
		if($senha != ""){
		 $this->form_validation->set_rules('txt-senha','Senha', 'required|min_length[3]');
		 $this->form_validation->set_rules('txt-confir-senha','Confirmar Senha', 'required|matches[txt-senha]');
		}

		// Preenchimento requerido | É comparado para ser igual ao txt-senha
		 
		$id= $this->input->post('txt-id');

		if ($this->form_validation->run() == FALSE) { // Se encontrar um erro, retorna à página
			//echo validation_errors('<div class="alert alert-danger">', '</div>'); // imprime todos os erros de validação que podem ter 
			redirect(base_url('meu_perfil/'.$id.'/2'));
		} else {
			// Recebe os dados do formulário
			$nome= $this->input->post('txt-nome');
			$email= $this->input->post('txt-email');
			$telefone= $this->input->post('txt-telefone');
			$user= $this->input->post('txt-user');
			$senha= $this->input->post('txt-senha');
			$id_depto = $this->input->post('txt-depto');
			if($this->modelusuarios->alterar($id,$nome,$email,$telefone,$user,$senha,$id_depto)) { // Se conseguiu acessar o model e adicionar
				redirect(base_url('meu_perfil/'.$id.'/1'));
			} else { // Caso não tenha conseguido acessar o model
				redirect(base_url('meu_perfil/'.$id.'/3'));
			}

		}
	}


	public function nova_foto() {

		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url());
		}
		$this->load->model('usuarios_model', 'modelusuarios'); // Carrega o Model de usuários


		// Configurações antes de fazer o upload da imagem
		$id= $this->input->post('id'); // Recebe o ID do formulário
		$config['upload_path']= './assets/frontend/img/usuarios'; // Aponta para a pasta onde salvo as imagens dos usuários
		$config['allowed_types']= 'jpg'; // Tipos de arquivos suportados
		$config['file_name']= $id.'.jpg'; // Configuração relacionada ao nome do arquivo
		$config['overwrite']= TRUE; // Substitui(Reescreve) a imagem que já existe para este usuário
		$this->load->library('upload', $config); // Carrega a biblioteca de upload e envia as configurações feitas para ela


		// Faz o upload da imagem
		if(!$this->upload->do_upload()) { // Se não conseguir fazer o upload, mostrar erros
			echo $this->upload->display_errors();
		} else {

			// Configuração de alterações da imagem
			$config2['source_img']= './assets/frontend/img/usuarios/'.$id.'.jpg'; // Caminho da imagem
			$config2['create_thumb'] = FALSE; // Não cria Thumbnails
			$config2['width'] = 200; // Largura da imagem em pixels
			$config2['height'] = 200; // Altura da imagem em pixels

			$this->load->library('image_lib'); // Carrega a biblioteca de alterações de imagem 
			$this->image_lib->initialize($config2); // Envia as configurações feitas para ela
			$this->image_lib->clear();

			if($this->image_lib->resize()) { // Se foi possível fazer as alterações

				// Se conseguiu acessar o model e adicionar ao banco de dados
				if($this->modelusuarios->alterar_img($id)) { 
					redirect(base_url('usuarios/meu_perfil/'.$id));
				} else { // Caso não tenha conseguido acessar o model
					echo "Houve um erro no sistema!";
				}
				
			} else {
				echo $this->image_lib->display_errors();
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


