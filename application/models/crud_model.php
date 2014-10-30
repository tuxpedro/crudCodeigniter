<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Crud_model extends CI_Model {

	public function do_insert($dados = NULL) {
		//insere dos dados no banco de dados
		$this -> db -> insert('aulas', $dados);

		//session class, variavel unidirecional, valido somente para a proxíma url acessada.
		$this -> session -> set_flashdata('cadastrook', 'Cadastro efetuado com Sucesso' . '<table class="table table-bordered">'.
			 '<tr>'.	
			 '<th>Nome</th>'.
			 '<th>Email</th>'.
			 '<th>login</th>'.
			 '</tr>'.
			 '<tr>'.
			 
			 '<td>'.  $dados['name'] . '</td>'.
			 '<td> '. $dados['email'] .' </td>'.
			 '<td> '. $dados['login'] .' </td>'.
			 '</tr>'.
			 '</table>');

		//url helper, redireciona a mensagem de cadastro ok para a url desejada
		redirect('crud/create');
	}
	
	public function do_update($dados=NULL, $condicao=NULL)
	{
		//Atualiza os dados na tabela
		$this -> db -> update('aulas', $dados, $condicao);
		//session class, variavel unidirecional, valido somente para a proxíma url acessada.
		$this -> session -> set_flashdata('edicaook', 'Cadastro atualizado efetuado com Sucesso');
		//url helper, redireciona a mensagem de cadastro ok para a url desejada
		redirect(current_url());
	}
	
	public function do_delete($condicao=NULL)
	{
		if($condicao!=NULL):
			$this->db->delete('aulas', $condicao);
			$this -> session -> set_flashdata('excluirok', 'Registro excluido com sucesso');
			redirect('crud/retrieve');
		endif;
	}
	
	public function get_all($qtde=NULL, $inicio=NULL) {
		if($qtde > 0) $this->db->limit($qtde, $inicio);
		return $this -> db -> get('aulas');
	}

	public function get_byid($id = NULL) {
		if ($id != NULL) :
			$this -> db -> where('id', $id);
			$this -> db -> limit(1);
			return $this -> db -> get('aulas');
		else :
			return FALSE;
		endif;
	}
	
}
