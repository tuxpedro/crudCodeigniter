<?php
echo '<h2>Lista de usuários</h2>';

if ($this -> session -> flashdata('excluirok')) :
	echo '<p>' . $this -> session -> flashdata('excluirok') . '</p>';
endif;

echo '<div class="table-responsive">';
$tmpl = array('table_open' => '<table  class="table table-hover"');
$this -> table -> set_template($tmpl);
$this -> table -> set_heading('ID', 'NOME', 'E-MAIL', 'LOGIN', 'EDITAR/REMOVER');
foreach ($usuarios as $linha) {
	$this -> table -> add_row($linha -> id, $linha -> name, $linha -> email, $linha -> login, anchor("crud/update/$linha->id", 'EDITAR') . ' | ' . anchor("crud/delete/$linha->id", 'REMOVER'));
}

echo $this -> table -> generate();
if($paginas)echo $paginas;
echo '</div>';
