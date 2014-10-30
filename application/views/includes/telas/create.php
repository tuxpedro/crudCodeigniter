<?php
echo '<div class="container-fluid">';
echo form_open('crud/create', array('class' => 'form-horizontal', 'role' => 'form'));

echo validation_errors('<p>', '</p>');

if ($this -> session -> flashdata('cadastrook')) :
	echo '<p>' . $this -> session -> flashdata('cadastrook') . '</p>';
endif;

echo form_label('Name', 'name');
//Input name
echo form_input(array('name' => 'name', 'class' => 'form-control'), set_value('name'), 'autofocus');

echo form_label('Email', 'email');
//Input email
echo form_input(array('name' => 'email', 'class' => 'form-control'), set_value('email'));

echo form_label('Login', 'login');
//login
echo form_input(array('name' => 'login', 'class' => 'form-control'), set_value('login'));

echo form_label('Enter Password', 'passwd');
//password1
echo form_password(array('name' => 'passwd', 'class' => 'form-control'), set_value('passwd'));

echo form_label('Repita a senha', 'passwd2');
//password2
echo form_password(array('name' => 'passwd2', 'class' => 'form-control'), set_value('passwd2'));

echo "<br />";
echo "<br />";

//btn submit
echo form_submit(array('name' => 'cadastrar', 'class' => 'btn btn-primary'), 'Cadastrar');

echo form_close();
echo '</div>';
