<?php

//require 'db/usuario_db.php';
require_once 'classes/Usuario.php';

try{

  if(!empty($_GET['action']) AND $_GET['action'] == 'delete')
  {
      $id = (int)$_GET['id'];
      Usuario::delete($id);
  }
  $usuarios = Usuario::all();

}
catch (Exception $e)
{
  print $e->getMessage();
}


$items = '';
foreach($usuarios as $usuario)
{     
      
      $item  = file_get_contents('html/item.html'); 
      $item  = str_replace('{id}',      $usuario['id'],    $item); 
      $item  = str_replace('{nome}',    $usuario['nome'],  $item); 
      $item  = str_replace('{email}',   $usuario['email'], $item); 

      $items.= $item;  
} 

$list = file_get_contents('html/list.html');
$list = str_replace('{items}', $items, $list);
print $list;

?>
