<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reunioes extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->load->model('comunidades_model', 'modelcomunidades');
		$this->destaques = $this->modelcomunidades->destaques_comunidade();

	}
	
	
	public function reuniao($id) {
		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url());
		}
		$this->load->helper('funcoes');

		$this->load->model('reunioes_model', 'modelreunioes');
		$dados['reunioes'] = $this->modelreunioes->listar_reuniao($id);
		$dados['participantes'] = $this->modelreunioes->participantes_reuniao($id);
		$dados['comentarios'] = $this->modelreunioes->listar_comentarios($id);

		$this->load->model('comunidades_model', 'modelcomunidades');
		$dados['comunidades'] = $this->modelcomunidades->listar_comunidade_reuniao($id);
		$dados['destaques'] = $this->destaques;


		$dados['titulo'] = 'Visualizar reunião';
		$dados['subtitulo'] = '';
		// Dados a serem enviados para o Cabeçalho


		// Faz as chamadas dos templates dos views de header, footer, aside
		$this->load->view('frontend/template/html-header', $dados); 
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/reuniao');	
		$this->load->view('frontend/template/aside-reuniao');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}

	public function participar_reuniao($idReuniao, $idUsuario) {
		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url());
		}

		// Adiciona o usuário na comunidade
		$this->load->model('reunioes_model', 'modelreunioes'); // Carrega o Model de usuários
		$this->modelreunioes->inserir_participante_reuniao($idReuniao,$idUsuario);

		// Retorna o usuário à comunidade
		redirect(base_url('reuniao/'.$idReuniao));
	}

	public function sair_reuniao($idReuniao, $idUsuario) {
		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url());
		}

		// Adiciona o usuário na comunidade
		$this->load->model('reunioes_model', 'modelreunioes'); // Carrega o Model de usuários
		$this->modelreunioes->remover_participante_reuniao($idReuniao,$idUsuario);

		// Retorna o usuário à comunidade
		redirect(base_url('reuniao/'.$idReuniao));
	}

	public function criar_reuniao($idComunidade, $idUser,$criada=null) {
		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url());
		}
		$this->load->helper('funcoes');

		// Carrega os modelos responsáveis
		$this->load->model('reunioes_model', 'modelreunioes');
		$this->load->model('comunidades_model', 'modelcomunidades');
		$dados['comunidades'] = $this->modelcomunidades->listar_comunidade($idComunidade);
		$this->load->model('usuarios_model', 'modelusuarios');
		$dados['usuarios'] = $this->modelusuarios->listar_usuario($idUser);
		$dados['destaques'] = $this->destaques;


		$dados['titulo'] = 'Criar reunião';
		$dados['subtitulo'] = 'CdP-UFOP';
		$dados['criada'] = $criada;
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
		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url());
		}


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
		
		// Local
		$this->form_validation->set_rules('txt-local', 'Local',
			'required');
		// Preenchimento requerido | Mínimo de 20 caracteres
		
		// Resumo
		$this->form_validation->set_rules('txt-resumo', 'Resumo',
			'min_length[20]');
		// Mínimo de 20 caracteres
		
		
		if ($this->form_validation->run() == FALSE) { 
			redirect(base_url('criar_reuniao/'.$this->input->post('txt-comunidade').'/'.$this->input->post('txt-iduser').'/2'));
		} else {
			// Validação correta, resgata as variáveis
			$titulo= $this->input->post('txt-titulo');
			$data= $this->input->post('txt-data');
			$horario= $this->input->post('txt-horario');
			$local= $this->input->post('txt-local');
			$resumo= $this->input->post('txt-resumo');
			$idUser= $this->input->post('txt-iduser');
			$idComunidade= $this->input->post('txt-comunidade');

			if($this->modelreunioes->adicionar($titulo,$data,$horario,$local,$resumo,$idUser,$idComunidade)) { // Se conseguiu acessar o model e adicionar
				redirect(base_url('criar_reuniao/'.$idComunidade.'/'.$idUser.'/1'));
			} else { // Caso não tenha conseguido acessar o model
				redirect(base_url('criar_reuniao/'.$idComunidade.'/'.$idUser.'/2'));
			}

		}
	}

	public function enviar_comentario() {
		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url());
		}

		$this->load->model('reunioes_model', 'modelreunioes'); // Carrega o Model de usuários
		$this->load->helper('date');

		// Validações do Formulário

		// Título
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txt-comentario', 'Comentário',
			'required|max_length[200]'); 
		// Preenchimento requerido 
		
		
		if ($this->form_validation->run() == FALSE) { 
			redirect(base_url('reuniao/'.$idReuniao));
		} else {
			// Validação correta, resgata as variáveis
			$comentario= $this->input->post('txt-comentario');
			$idUser= $this->input->post('txt-usuario');
			$idReuniao= $this->input->post('txt-reuniao');
			$timestamp = now('America/Sao_Paulo');


			if($this->modelreunioes->adicionar_comentario($comentario,$idUser,$idReuniao,$timestamp)) { // Se conseguiu acessar o model e adicionar
				redirect(base_url('reuniao/'.$idReuniao));
			} else { // Caso não tenha conseguido acessar o model
				redirect(base_url('reuniao/'.$idReuniao));
			}

		}
	}

	public function excluir_comentario($idUsuario, $idReuniao, $timestamp) {
		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url());
		}
		$this->load->model('reunioes_model', 'modelreunioes'); 

		if($this->modelreunioes->remover_comentario($idUsuario,$idReuniao, $timestamp)) { // Se conseguiu acessar o model e adicionar
			redirect(base_url('reuniao/'.$idReuniao));
		} else { // Caso não tenha conseguido acessar o model
			echo "Houve um erro no sistema!";
		}
	}

	public function avaliar($idReuniao, $idUsuario) {
		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url());
		}


		// Carrega o model
		$this->load->model('reunioes_model', 'modelreunioes'); // Carrega o Model de usuários

		// Faz a validação do formulário
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nps-reuniao', 'NPS',
			'required|greater_than[0]|less_than[11]');


		if ($this->form_validation->run() == FALSE) { 
			redirect(base_url('reuniao/'.$idReuniao));
		} else {
			// Validação correta, resgata as variáveis
			$nps= $this->input->post('nps-reuniao');
			$idComunidade= $this->input->post('id-comunidade');

			$aval = $this->modelreunioes->avaliar($idReuniao,$idUsuario,$nps,$idComunidade);
			if($aval >= -100 && $aval <= 100) { // Se conseguiu acessar o model e adicionar e NPS Médio tbm
				if($this->modelreunioes->calcularNPS($idReuniao)) {
					redirect(base_url('reuniao/'.$idReuniao));
				} else {
				echo "Houve um erro no calculo do NPS!";
				}
			} else if ($aval == 102) { // Não rolou update NPS médio
				echo "Houve um erro no cálculo NPS Médio!";
			
			} else if ($aval == 103) { // Não rolou resultado da busca por reuniões desta comunidade
				echo "Houve um erro no resultado da busca por reuniões desta comunidade!";
			} else {
				echo "Houve um erro na avaliação!";	
			}

		}
	}

	public function postar_material() {

		// Adiciona a proteção da página
		if(!$this->session->userdata('logado')) { // Se a variável de sessão não existir, redirecionar para o login
			redirect(base_url());
		}
		$this->load->model('reunioes_model', 'modelreunioes'); // Carrega o Model de usuários

		$idReuniao= $this->input->post('id-reuniao'); // Recebe o ID do formulário
		$idUsuario= $this->input->post('id-usuario'); // Recebe o ID do formulário

		// Faz a validação do formulário
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nome-material', 'Nome do material',
			'required');

		if ($this->form_validation->run() == FALSE) { 
			redirect(base_url('reuniao/'.$idReuniao));
			} else {
			// Caso não haja, cria uma pasta com o id da reunião
	        $nome= $this->input->post('nome-material'); 
			// Configurações antes de fazer o upload da imagem
			$config['upload_path']= './assets/frontend/materiais/'.$idReuniao; // Aponta para a pasta onde salvo as imagens dos usuários
			$config['allowed_types']= 'jpg|png|jpeg|pdf|docx|xlsx'; // Tipos de arquivos suportados
			$config['file_name']= $nome; // Configuração relacionada ao nome do arquivo
			$config['overwrite']= TRUE; // Substitui(Reescreve) a imagem que já existe para este usuário
			if (!is_dir('./assets/frontend/materiais/'.$idReuniao)) {
		        mkdir('./assets/frontend/materiais/'.$idReuniao, 0777, TRUE);
	        }

			$this->load->library('upload', $config); // Carrega a biblioteca de upload e envia as configurações feitas para ela

			// Faz o upload da imagem
			if(!$this->upload->do_upload()) { // Se não conseguir fazer o upload, mostrar erros
				echo $this->upload->display_errors();
			} else {
				if($this->modelreunioes->adicionar_material($nome,$idUsuario,$idReuniao)) { 
					redirect(base_url('reuniao/'.$idReuniao));
				} else { // Caso não tenha conseguido acessar o model
					echo "Houve um erro no sistema!";
				}
			}
		}
	}


}

/* 
0 - Não rolou update avaliar
$nps_medio - Rolou update NPS Médio
102 - Não rolou update
103 - Não obteve resultado
*/

