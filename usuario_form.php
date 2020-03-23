<?php

require_once 'classes/Usuario.php';
//require 'db/usuario_db.php';

if (!empty($_REQUEST['action']))
{
    try
    {
        if ($_REQUEST['action'] == 'edit')
        { 
            $id     = (int) $_GET['id'];
            $usuario = Usuario::find($id);
        }
        else if ($_REQUEST['action'] == 'save')
        {
            $usuario = $_POST;
            Usuario::save($usuario);
            header("Location: usuario_form.php"); 

        }
    }
    catch (Exception $e)
    {
        print $e->getMessage();
    }
}
else
{
    //caso o programa seja acessado sem nenhuma acao, o vetor pessoa é inicializado com conteudo vazio 
    $usuario = [];
    $usuario['id']     = '';
    $usuario['nome']   = '';
    $usuario['email']  = '';
    $usuario['senha']  = '';

    
}

$form = file_get_contents('html/form.html');
$form = str_replace('{id}',        $usuario['id'],        $form);
$form = str_replace('{nome}',      $usuario['nome'],      $form);
$form = str_replace('{email}',     $usuario['email'],     $form);
$form = str_replace('{senha}',     $usuario['senha'],     $form);

print $form;

?>