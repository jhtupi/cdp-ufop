<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}
	
	public function index()
	{
		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url('admin/login'));
		}

		$this->load->library('table'); // Chama a biblioteca de tabelas

		// Carrega o Model de usuários
		$this->load->model('usuarios_model', 'modelusuarios'); 
		$dados['usuarios'] = $this->modelusuarios->listar_usuarios();
		
		$dados['titulo'] = 'Painel de Controle';
		$dados['subtitulo'] = 'Usuários';
		// Dados a serem enviados para o Cabeçalho

		// Faz as chamadas dos templates dos views de header, footer, aside
		$this->load->view('backend/template/html-header', $dados); // Aqui a variável $dados é carregada na view
		$this->load->view('backend/template/template');
		$this->load->view('backend/usuarios');	// Chamada do conteúdo da página em si
		$this->load->view('backend/template/html-footer');
	}

	public function inserir() {

		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url('admin/login'));
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
		
		// Histórico
		$this->form_validation->set_rules('txt-historico', 'Histórico',
			'required|min_length[20]');
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
			$this->index();
		} else {
			// Validação correta, resgata as variáveis
			$nome= $this->input->post('txt-nome');
			$email= $this->input->post('txt-email');
			$historico= $this->input->post('txt-historico');
			$user= $this->input->post('txt-user');
			$senha= $this->input->post('txt-senha');

			if($this->modelusuarios->adicionar($nome,$email,$historico,$user,$senha)) { // Se conseguiu acessar o model e adicionar
				redirect(base_url('admin/usuarios'));
			} else { // Caso não tenha conseguido acessar o model
				echo "Houve um erro no sistema!";
			}

		}
	}

	public function excluir($id) {

		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url('admin/login'));
		}

		$this->load->model('usuarios_model', 'modelusuarios'); // Carrega o Model de usuários

		if($this->modelusuarios->excluir($id)) { // Se conseguiu acessar o model e adicionar
			redirect(base_url('admin/usuarios'));
		} else { // Caso não tenha conseguido acessar o model
			echo "Houve um erro no sistema!";
		}
	}

	public function alterar($id) {

		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url('admin/login'));
		}

		$this->load->model('usuarios_model', 'modelusuarios'); // Carrega o Model de usuários

		$dados['usuarios'] = $this->modelusuarios->listar_usuario($id);
		
		// Dados a serem enviados para o Cabeçalho
		$dados['titulo'] = 'Painel de Controle';
		$dados['subtitulo'] = 'Usuários';
		

		// Faz as chamadas dos templates dos views de header, footer, aside
		$this->load->view('backend/template/html-header', $dados); // Aqui a variável $dados é carregada na view
		$this->load->view('backend/template/template');
		$this->load->view('backend/alterar-usuario');	// Chamada do conteúdo da página em si
		$this->load->view('backend/template/html-footer');
	}

	public function salvar_alteracoes($idCrip, $userCom) {

		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url('admin/login'));
		}

		$this->load->model('usuarios_model', 'modelusuarios'); // Carrega o Model de usuários

		$this->load->library('form_validation');
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
		
		// Histórico
		$this->form_validation->set_rules('txt-historico', 'Histórico',
			'required|min_length[20]');
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
		 

		if ($this->form_validation->run() == FALSE) { // Se encontrar um erro, retorna à página
			$this->alterar($idCrip);
		} else {
			// Recebe os dados do formulário
			$nome= $this->input->post('txt-nome');
			$email= $this->input->post('txt-email');
			$historico= $this->input->post('txt-historico');
			$user= $this->input->post('txt-user');
			$senha= $this->input->post('txt-senha');
			$id= $this->input->post('txt-id');
			if($this->modelusuarios->alterar($nome,$email,$historico,$user,$senha,$id)) { // Se conseguiu acessar o model e adicionar
				redirect(base_url('admin/usuarios'));
			} else { // Caso não tenha conseguido acessar o model
				echo "Houve um erro no sistema!";
			}

		}
	}

	public function nova_foto() {

		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url('admin/login'));
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
					redirect(base_url('admin/usuarios/alterar/'.$id));
				} else { // Caso não tenha conseguido acessar o model
					echo "Houve um erro no sistema!";
				}
				
			} else {
				echo $this->image_lib->display_errors();
			}
		}
	}




}






	
