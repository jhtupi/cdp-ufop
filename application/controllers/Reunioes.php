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

	public function inserir() {


		$this->load->model('reunioes_model', 'modelreunioes'); // Carrega o Model de usuários

		// Validações do Formulário

		// Título
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txt-titulo', 'Título',
			'required|min_length[3]'); 
		// Preenchimento requerido | no mínimo 3 caracteres 

		// Data
		$this->form_validation->set_rules('txt-data', 'Data',
			'required');
		// Preenchimento requerido
		
		// Horário
		$this->form_validation->set_rules('txt-horario', 'Horário',
			'required');
		// Preenchimento requerido
		
		// Resumo
		$this->form_validation->set_rules('txt-user', 'Resumo',
			'min_length[20]');
		// Preenchimento requerido | Mínimo de 20 caracteres
		
		
		if ($this->form_validation->run() == FALSE) { 
			redirect(base_url('criar_reuniao/'.$this->input->post('txt-comunidade').'/'.$this->input->post('txt-iduser').'/2'));
		} else {
			// Validação correta, resgata as variáveis
			$titulo= $this->input->post('txt-titulo');
			$data= $this->input->post('txt-data');
			$horario= $this->input->post('txt-horario');
			$resumo= $this->input->post('txt-resumo');
			$idUser= $this->input->post('txt-iduser');
			$idComunidade= $this->input->post('txt-comunidade');

			if($this->modelreunioes->adicionar($titulo,$data,$horario,$resumo,$idUser,$idComunidade)) { // Se conseguiu acessar o model e adicionar
				redirect(base_url('criar_reuniao/'.$idComunidade.'/'.$idUser.'/1'));
			} else { // Caso não tenha conseguido acessar o model
				echo "Houve um erro no sistema!";
			}

		}
	}




}


