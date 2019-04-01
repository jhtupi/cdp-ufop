<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publicacoes_model extends CI_Model {

	public $id;
	public $categoria;
	public $titulo;
	public $subtitulo;
	public $conteudo;
	public $data;
	public $img;
	public $user;

	public function __construct() {
		parent::__construct();
	}

	
	public function destaques_home() {

											 // seleciona a coluna id da tabela usuário e colocar um alias 
		$this->db->select('usuario.id as idautor, 
			usuario.nome, postagens.id, postagens.titulo, 
			postagens.subtitulo, postagens.user, postagens.data, postagens.img'); 
		$this->db->from('postagens'); // referencia para o sistema de qual tabela vou puxar os dados
		$this->db->join('usuario', 'usuario.id = postagens.user'); // seleciona qual tabela estou juntando a postagem e referencia qual o campo da tabela usuário deve bater com a tabela postagem

		$this->db->limit(4);	// limita a chamada para apenas os primeiros 4 itens
		$this->db->order_by('postagens.data', 'DESC'); // Ordenar por data da mais antiga para mais nova
		return $this->db->get()->result(); 
	}


	public function categoria_pub($id, $pular, $post_por_pagina) {

		$this->db->select('usuario.id as idautor, 
			usuario.nome, postagens.id, postagens.titulo, 
			postagens.subtitulo, postagens.user, postagens.data, postagens.img,
			postagens.categoria'); 
		$this->db->from('postagens'); // referencia para o sistema de qual tabela vou puxar os dados
		$this->db->join('usuario', 'usuario.id = postagens.user'); // seleciona qual tabela estou juntando a postagem e referencia qual o campo da tabela usuário deve bater com a tabela postagem
		$this->db->where('postagens.categoria ='.$id);
		
		$this->db->order_by('postagens.data', 'DESC'); // Ordenar por data da mais antiga para mais nova

		// Cria o limite para fazer a paginação
		if ($pular && $post_por_pagina) { // Se houver valor nas variáveis
			$this->db->limit($post_por_pagina,$pular); // Determina as publicações que irão aparecer
													   // Compara $post_por_pagina com $pular
		} else {
			$this->db->limit(2); // Determina o número de publicações irá aparecer
		}

		return $this->db->get()->result(); 

	}

	public function publicacao($id) {

		$this->db->select('usuario.id as idautor, 
			usuario.nome, postagens.id, postagens.titulo, 
			postagens.subtitulo, postagens.user, postagens.data, postagens.img,
			postagens.categoria, postagens.conteudo'); 
		$this->db->from('postagens'); // referencia para o sistema de qual tabela vou puxar os dados
		$this->db->join('usuario', 'usuario.id = postagens.user'); // seleciona qual tabela estou juntando a postagem e referencia qual o campo da tabela usuário deve bater com a tabela postagem
		$this->db->where('postagens.id ='.$id); // Procura a postagem diretamente relacionada com o ID
		return $this->db->get()->result();
	}


	public function listar_titulo($id) {
		$this->db->select('id, titulo');
		$this->db->from('postagens'); // seleciona a tabela
		$this->db->where('id ='.$id); // Compara com a variável id foi enviada
		return $this->db->get()->result();
	}

	public function listar_publicacao($pular=null, $post_por_pagina=null) { // Variaveis podem chegar sem valor
		$this->db->order_by('data', 'DESC'); // Ordenar pela data mais antiga

		if ($pular && $post_por_pagina) { // Se houver valor nas variáveis
			$this->db->limit($post_por_pagina,$pular); // Determina as publicações que irão aparecer
													   // Compara $post_por_pagina com $pular
		} else {
			$this->db->limit(5); // Determina o número de publicações irá aparecer
		}

		return $this->db->get('postagens')->result(); // Chama as publicacoes do banco de dados
	}

	public function listar_publicacoes($id) {
		$this->db->where('md5(id)', $id);
		return $this->db->get('postagens')->result(); // Chama as publicacoes do banco de dados
	}

	public function adicionar($titulo, $subtitulo, $conteudo, $datapub, $categoria, $userpub) {
		// Adiciona as variáveis como colunas da matriz $dados
		// A posição deve ter o mesmo nome que está na coluna da tabela que irei referenciar, no caso, 'publicacoes'
		$dados['titulo'] = $titulo;
		$dados['subtitulo'] = $subtitulo;
		$dados['conteudo'] = $conteudo;
		$dados['user'] = $userpub;
		$dados['data'] = $datapub;
		$dados['categoria'] = $categoria;
									
		return $this->db->insert('postagens', $dados); // Insere na tabela os dados da variável na tabela
	}

	public function excluir($id) {
		$this->db->where('md5(id)', $id); // compara o id criptografado
		return $this->db->delete('postagens'); // deleta a categoria selecionada
	}

	public function alterar($titulo, $subtitulo, $conteudo, $datapub, $categoria, $id) {
		$dados['titulo']= $titulo;
		$dados['subtitulo']= $subtitulo;
		$dados['conteudo']= $conteudo;
		$dados['data']= $datapub;
		$dados['categoria']= $categoria;
		$this->db->where('id', $id);
		return $this->db->update('postagens', $dados);
	}

	public function alterar_img($id) {
		$dados['img']= 1;
		$this->db->where('md5(id)', $id);
		return $this->db->update('postagens', $dados);
	}

	public function contar() {
		return $this->db->count_all('postagens');
	}

	public function contar_frontend($id) {
		$this->db->where('categoria ='.$id);
		return $this->db->count_all_results('postagens');
	}

}
