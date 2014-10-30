<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Site extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this -> load -> helper('url');
	}

	public function index() {

		$dados = array('titulo_pagina' => 'Titulo da pagina principal', 'view_principal' => 'home');

		$this -> load -> view('site', $dados);
	}

	public function contato() {

		$dados = array('titulo_pagina' => 'Este é form de contato', 'view_principal' => 'contato');

		$this -> load -> view('site', $dados);
	}

}
