<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comunidades extends CI_Controller {

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
		$this->load->model('comunidades_model', 'modelcomunidades'); 

		$this->load->library('table'); // Chama a biblioteca de tabelas

		// Dados para paginação
		$this->load->library('pagination'); // Chama a biblioteca de paginação
		$config['base_url'] = base_url('comunidades');
		$config['total_rows'] = $this->modelcomunidades->contar();
		$post_por_pagina = 5;
		$config['per_page'] = $post_por_pagina; // mudar para 5
		$this->pagination->initialize($config);

		// Insere os dados da postagem no array dados
		$dados['comunidades'] = $this->modelcomunidades->listar_comunidades($pular,$post_por_pagina);

		$dados['titulo'] = 'Comunidades existentes';
		$dados['subtitulo'] = '';
		$dados['destaques'] = $this->destaques;
		$dados['links_paginacao'] = $this->pagination->create_links();

		// Dados a serem enviados para o Cabeçalho

		// Faz as chamadas dos templates dos views de header, footer, aside
		$this->load->view('frontend/template/html-header', $dados); // Aqui a variável $dados é carregada na view
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/comunidades');	// Chamada do conteúdo da página em si
		$this->load->view('frontend/template/aside-comunidades');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}

	public function comunidade($id, $pular=null, $post_por_pagina=null) {
		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url());
		}
		$this->load->helper('funcoes');

		$this->load->model('comunidades_model', 'modelcomunidades');

		// Dados para paginação
		$this->load->library('pagination'); // Chama a biblioteca de paginação
		$config['page_query_string'] = FALSE;
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url("comunidade/".$id."/");
		$config['total_rows'] = $this->modelcomunidades->contar_reunioes($id);
		$post_por_pagina = 2;
		$config['per_page'] = $post_por_pagina; 
		$this->pagination->initialize($config);



		$dados['comunidades'] = $this->modelcomunidades->listar_comunidade($id);
		$dados['criador'] = $this->modelcomunidades->criador_comunidade($id);
		$dados['membros'] = $this->modelcomunidades->membros_comunidade($id);
		$dados['reunioes'] = $this->modelcomunidades->reunioes_comunidade($id,$pular,$post_por_pagina);
		$dados['npsCom'] = $this->modelcomunidades->calcularNPSMedio($id);
		$dados['destaques'] = $this->destaques;
		$dados['links_paginacao'] = $this->pagination->create_links();
		

		$dados['titulo'] = 'Visualizar comunidade';
		$dados['subtitulo'] = '';
		// Dados a serem enviados para o Cabeçalho


		// Faz as chamadas dos templates dos views de header, footer, aside
		$this->load->view('frontend/template/html-header', $dados); 
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/comunidade');	
		$this->load->view('frontend/template/aside-comunidade');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}

	public function minhas_comunidades($idUsuario) {
		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url());
		}
		$this->load->helper('funcoes');

		$this->load->library('table'); // Chama a biblioteca de tabelas

		// Carrega o Model de comunidades
		$this->load->model('comunidades_model', 'modelcomunidades'); 
		// Insere os dados da postagem no array dados
		$dados['comunidades'] = $this->modelcomunidades->listar_minhas_comunidades($idUsuario);



		$dados['titulo'] = 'Comunidades que pertenço';
		$dados['subtitulo'] = '';
		$dados['destaques'] = $this->destaques;

		// Dados a serem enviados para o Cabeçalho

		// Faz as chamadas dos templates dos views de header, footer, aside
		$this->load->view('frontend/template/html-header', $dados); // Aqui a variável $dados é carregada na view
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/minhas-comunidades');	// Chamada do conteúdo da página em si
		$this->load->view('frontend/template/aside-comunidades');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}


	public function criar_comunidade($criada=null) {
		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url());
		}
		$this->load->helper('funcoes');

		$dados['titulo'] = 'Criar Comunidade';
		$dados['subtitulo'] = 'CdP-UFOP';
		$dados['criada'] = $criada;
		$dados['destaques'] = $this->destaques;
		// Dados a serem enviados para o Cabeçalho

		// Faz as chamadas dos templates dos views de header, footer, aside
		$this->load->view('frontend/template/html-header', $dados); // Aqui a variável $dados é carregada na view
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/criar-comunidade');	// Chamada do conteúdo da página em si
		$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
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
			redirect(base_url('criar_comunidade'.'/2'));

		} else {
			// Validação correta, resgata as variáveis
			$tema= $this->input->post('txt-tema');
			$descricao= $this->input->post('txt-descricao');
			$idUser= $this->input->post('txt-iduser');
			$dataCriacao = date('Y-m-d');

			if($this->modelcomunidades->adicionar($tema,$descricao,$idUser,$dataCriacao)) { // Se conseguiu acessar o model e adicionar
				redirect(base_url('criar_comunidade/'.'/1'));
			} else { // Caso não tenha conseguido acessar o model
				redirect(base_url('criar_comunidade/'.'/3'));
			}

		}
	}

	public function editar_comunidade($id) {
		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url());
		}
		$this->load->helper('funcoes');

		$this->load->model('comunidades_model', 'modelcomunidades');
		$dados['comunidades'] = $this->modelcomunidades->listar_comunidade($id);
		$dados['destaques'] = $this->destaques;


		$dados['titulo'] = 'Visualizar reunião';
		$dados['subtitulo'] = '';
		// Dados a serem enviados para o Cabeçalho


		// Faz as chamadas dos templates dos views de header, footer, aside
		$this->load->view('frontend/template/html-header', $dados); 
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/editar-comunidade');	
		$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}

	public function participar_comunidade($idComunidade, $idUsuario) {
		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url());
		}

		// Adiciona o usuário na comunidade
		$this->load->model('comunidades_model', 'modelcomunidades'); // Carrega o Model de usuários
		$this->modelcomunidades->inserir_membro_comunidade($idComunidade,$idUsuario);

		// Retorna o usuário à comunidade
		redirect(base_url('comunidade/'.$idComunidade));
	}

	public function salvar_alteracoes() {

		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url('admin/login'));
		}

		$this->load->model('comunidades_model', 'modelcomunidades'); // Carrega o Model de usuários

		// Validações do Formulário
		$this->load->library('form_validation');

		$this->form_validation->set_rules('txt-tema', 'Tema',
			'required|min_length[3]'); 
		// Preenchimento requerido | no mínimo 3 caracteres 
		
		// Descrição
		$this->form_validation->set_rules('txt-descricao', 'Descrição',
			'required|min_length[20]');
		// Preenchimento requerido | Mínimo de 20 caracteres
		 
		$id= $this->input->post('txt-id');

		if ($this->form_validation->run() == FALSE) { // Se encontrar um erro, retorna à página
			//echo validation_errors('<div class="alert alert-danger">', '</div>'); // imprime todos os erros de validação que podem ter 
			redirect(base_url('comunidade/'.$id.'/2'));
		} else {
			// Recebe os dados do formulário
			$tema= $this->input->post('txt-tema');
			$descricao= $this->input->post('txt-descricao');
			if($this->modelcomunidades->alterar($id,$tema,$descricao)) { // Se conseguiu acessar o model e adicionar
				redirect(base_url('comunidade/'.$id.'/1'));
			} else { // Caso não tenha conseguido acessar o model
				redirect(base_url('comunidade/'.$id.'/3'));
			}

		}
	}

	public function sair_comunidade($idComunidade, $idUsuario) {
		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url());
		}

		// Adiciona o usuário na comunidade
		$this->load->model('comunidades_model', 'modelcomunidades'); // Carrega o Model de usuários
		$this->modelcomunidades->remover_membro_comunidade($idComunidade,$idUsuario);

		// Retorna o usuário à comunidade
		redirect(base_url('comunidade/'.$idComunidade));
	}

	public function excluir_comunidade($idComunidade, $idUsuario) {
		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url());
		}
		

		$this->load->model('comunidades_model', 'modelcomunidades'); // Carrega o Model de usuários
		//echo $this->modelcomunidades->excluir($idComunidade, $idUsuario);
		//return;
		if($this->modelcomunidades->excluir($idComunidade, $idUsuario)) { // Se conseguiu acessar o model e adicionar
			redirect(base_url());
		} else { // Caso não tenha conseguido acessar o model
			echo "Houve um erro na exclusão da comunidade!";
		}
	}
}


