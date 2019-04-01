<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Esqueci_senha extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}
	
	public function index($enviado=null)
	{
		
		$dados['titulo'] = 'Esqueci minha senha';
		$dados['subtitulo'] = 'Home';
		$dados['enviado'] = $enviado;
		// Dados a serem enviados para o Cabeçalho

		// Faz as chamadas dos templates dos views de header, footer, aside
		$this->load->view('backend/template/html-header', $dados); // Aqui a variável $dados é carregada na view
		$this->load->view('backend/esqueci-senha');	// Chamada do conteúdo da página em si
		

	}

}
