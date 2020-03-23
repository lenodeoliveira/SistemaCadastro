<?php

require_once 'classes/Usuario.php';

class UsuarioLista 
{

    private $html;

    public function __construct()
    {
        $this->html = file_get_contents('html/list.html');

    }

    public function delete($param)
    {
        try
        {
            $id = (int) $param['id'];
            Usuario::delete($id);

        }
        catch(Exception $e)
        {
            print $e->getMessage();

        }

    }

    public function load()
    {
        try
        {
            $usuarios = Usuario::all();
            $items = '';
            foreach($usuarios as $usuario)
            {     
                
                $item  = file_get_contents('html/item.html'); 
                $item  = str_replace('{id}',      $usuario['id'],    $item); 
                $item  = str_replace('{nome}',    $usuario['nome'],  $item); 
                $item  = str_replace('{email}',   $usuario['email'], $item); 

                $items.= $item;  
            } 

            $this->html = str_replace('{items}', $items, $this->html);

        }
        catch(Exception $e)
        {

            print $e->getMessage();
        }


    }

    public function show()
    {
        $this->load();
        print $this->html;

    }

}


?>