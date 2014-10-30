<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Crud extends CI_Controller {

	public function __construct() {
		parent::__construct();

		/*** carregamento do helpers ***/
		$this -> load -> helper('url');
		$this -> load -> helper('form');
		//auxilia no envio dos dados para o model
		$this -> load -> helper('array');

		/*** carregamento das bibliotecas ***/
		$this -> load -> library('form_validation');
		//gerenciamento de seções
		$this -> load -> library('session');
		//auxília na criação de tabelas usando arrays e resultados de consultas
		$this -> load -> library('table');

		/*** carregamento das models ***/
		$this -> load -> model('crud_model', 'crud');

	}

	public function index() {
		$dados = array('Titulo' => 'CRUD com CodeIgnite', 'tela' => '', );
		$this -> load -> view('crud', $dados);
	}

	public function create() {

		/*** validação de dados enviados do form ***/
		$this -> form_validation -> set_rules('name', 'NOME', 'trim|required|max_legth[50]|ucwords');
		$this -> form_validation -> set_rules('email', 'E-MAIL', 'trim|required|max_legth[50]|strtolower|valid_email|is_unique[aulas.email]');
		$this -> form_validation -> set_rules('login', 'LOGIN', 'trim|required|max_legth[25]|strtolower|is_unique[aulas.login]');
		$this -> form_validation -> set_rules('passwd', 'SENHA', 'trim|required');
		$this -> form_validation -> set_message('matches', 'O campo %s esta diferente do campor %s');
		$this -> form_validation -> set_rules('passwd2', 'REPITA A SENHA', 'trim|required|matches[passwd]');

		//verifica se os dados foram validados e envia para o model
		if ($this -> form_validation -> run() == TRUE) :
			$dados = elements(array('name', 'email', 'login', 'passwd'), $this -> input -> post());
			$dados['passwd'] = sha1($dados['passwd']);

			//chama a função do_insert do model crud_model pelo apelido crud
			$this -> crud -> do_insert($dados);

		endif;

		$dados = array('Titulo' => 'CRUD &raquo; Create', 'tela' => 'create', );
		$this -> load -> view('crud', $dados);
	}

	public function retrieve() {

		$this -> load -> library('pagination');

		$config['base_url'] = base_url('crud/retrieve');
		$config['total_rows'] = $this -> crud -> get_all() -> num_rows();
		$config['per_page'] = '5';

		$qtde = $config['per_page'];
		($this -> uri -> segment(3) != NULL) ? $inicio = $this -> uri -> segment(3) : $inicio = 0;
		
		$this->pagination->initialize($config);

		//O item usuario acessa a função get_all do crud_model(resultado em forma de objeto)
		$dados = array('Titulo' => 'CRUD &raquo; Retrieve', 
						'tela' => 'retrieve', 
						'usuarios' => $this -> crud -> get_all($qtde, $inicio) -> result(),
						'paginas' => $this->pagination->create_links());
						
		$this -> load -> view('crud', $dados);
	}

	public function update() {

		/*** validação de dados a serem atualizados ***/
		$this -> form_validation -> set_rules('name', 'NOME', 'trim|required|max_legth[50]|ucwords');
		$this -> form_validation -> set_rules('passwd', 'SENHA', 'trim|required');
		$this -> form_validation -> set_message('matches', 'O campo %s esta diferente do campor %s');
		$this -> form_validation -> set_rules('passwd2', 'REPITA A SENHA', 'trim|required|matches[passwd]');

		//verifica se os dados foram validados e envia para o model
		if ($this -> form_validation -> run() == TRUE) :
			$dados = elements(array('name', 'passwd'), $this -> input -> post());
			$dados['passwd'] = sha1($dados['passwd']);
			//chama a função do_update do model crud_model pelo apelido crud
			$this -> crud -> do_update($dados, array('id' => $this -> input -> post('idusuario')));

		endif;

		$dados = array('Titulo' => 'CRUD &raquo; Updete', 'tela' => 'update', );
		$this -> load -> view('crud', $dados);
	}

	public function delete() {
		if ($this -> input -> post('idusuario') != NULL) :
			$this -> crud -> do_delete(array('id' => $this -> input -> post('idusuario')));
		endif;

		$dados = array('Titulo' => 'CRUD &raquo; Delete', 'tela' => 'Delete', );
		$this -> load -> view('crud', $dados);
	}

}
