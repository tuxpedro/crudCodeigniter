<?php
$iduser = $this -> uri -> segment(3);
if ($iduser == NULL)
	redirect('crud/retrieve');

$query = $this -> crud -> get_byid($iduser) -> row();

echo '<div class="container-fluid">';
echo form_open("crud/delete/$iduser", array('class' => 'form-horizontal', 'role' => 'form'));

echo form_label('Name', 'name');
//Input name
echo form_input(array('name' => 'name', 'class' => 'form-control'), set_value('name', $query -> name), 'disabled="disabled"');

echo form_label('Email', 'email');
//Input email
echo form_input(array('name' => 'email', 'class' => 'form-control'), set_value('email', $query -> email), 'disabled="disabled"');

echo form_label('Login', 'login');
//login
echo form_input(array('name' => 'login', 'class' => 'form-control'), set_value('login', $query -> login), 'disabled="disabled"');

echo form_hidden('idusuario', $query -> id);

echo "<br />";
echo "<br />";

//btn submit
echo form_submit(array('name' => 'cadastrar', 'class' => 'btn btn-primary'), 'Excluir registro');

echo form_close();
echo '</div>';
