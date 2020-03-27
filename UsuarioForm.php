<?php
require_once 'classes/Usuario.php';

class UsuarioForm 
{
    private $html;
    private $data;

    public  function __construct()
    {
        $this->html = file_get_contents('html/form.html');
        $this->data = ['id' => null,
                       'nome' => null, 
                       'email' => null,
                       'senha' => null];
    }

    public function edit($param)
    {
        try
        {
            $id = (int)$param['id'];
            $usuario = Usuario::find($id);      
            $this->data = $usuario;
        }
        catch(Exception $e)
        {
            print $e->getMessage();
        }
    }

    public function save($param)
    {
        try
        {
            Usuario::save($param);
            $this->data = $param;
            header ("Location:index.php?class=UsuarioForm");
        }
        catch(Exception $e)
        {
            print $e->getMessage();
        }
    }

    public function show()
    {
        $this->html = str_replace('{id}', $this->data['id'], $this->html);
        $this->html = str_replace('{nome}', $this->data['nome'], $this->html);
        $this->html = str_replace('{email}', $this->data['email'], $this->html);
        $this->html = str_replace('{senha}', $this->data['senha'], $this->html);

        print $this->html;
    }
}


?>