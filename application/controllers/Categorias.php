<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('categorias_model','modelcategorias'); 
						// Faz a chamada do model dentro do costrutor para chamar ainda que hajam outras funções
						// 'modelcategorias' é um alias, m apelido para o model
		$this->categorias = $this->modelcategorias->listar_categorias(); 
						// variavel categorias que recebe o que foi resgatado pela função
	}
	
	public function index($id, $nome, $pular=null, $post_por_pagina=null)
	{
		$this->load->model('publicacoes_model', 'modelpublicacoes');
		$this->load->helper('funcoes');
		$this->load->library('pagination');
		$dados['categorias'] = $this->categorias;
		// Cria uma variável array chamada dados para receber as categorias
		// Poderia ter sido chamado direto porém é criada a variável por organização de código		

		// Monta a paginação das publicações
		$config['base_url'] = base_url("categoria/".$id."/".$nome);
		$config['total_rows'] = $this->modelpublicacoes->contar_frontend($id); // Número de linhas totais que a tabela deve ter
		$post_por_pagina = 2;
		$config['per_page'] = $post_por_pagina; // Total de itens por página
		$this->pagination->initialize($config); // Inicia a paginação com as configurações acima
		$dados['links_paginacao'] = $this->pagination->create_links(); // Envia os links da paginação para a view


		
		
		// O modelo de destaques é carregado aqui na função index pois não será requerido em toda pasta como as categorias que ficam no header e aside
		$dados['postagem'] = $this->modelpublicacoes->categoria_pub($id, $pular, $post_por_pagina);
		// Insere os dados da postagem no array dados


		$dados['titulo'] = 'Categorias';
		$dados['subtitulo'] = '';	// Sem pesquisa no banco
		$dados['subtitulodb'] = $this->modelcategorias->listar_titulo($id); // Com pesquisa no banco
		// Dados a serem enviados para o Cabeçalho

		// Faz as chamadas dos templates dos views de header, footer, aside
		$this->load->view('frontend/template/html-header', $dados); // Aqui a variável $dados é carregada na view
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/categoria');	// Chamada do conteúdo da página em si
		$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}

}
