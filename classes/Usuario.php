<?php
class Usuario
{
    private static $conn;    

    public static function getConnection()
    {
        if(empty(self::$conn))
        {
            $conexão = parse_ini_file('config/livro.ini');
            $host = $conexão['host'];
            $name = $conexão['name'];
            $user = $conexão['user'];
            $pass = $conexão['pass'];

            self::$conn = new PDO("mysql:dbname={$name};host={$host}","{$user}","{$pass}");
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$conn;
    }

    public static function save($usuario)
     {
        $conn = self::getConnection();
        
        if(empty($usuario['id']))
        {
            $result = $conn->query("SELECT max(id) as next FROM tb_usuario");
            $row = $result->fetch();
            $usuario['id'] = (int) $row['next'] +1;
            
            $sql = "INSERT INTO tb_usuario(id,nome,email,senha)
                                    VALUES  (:id,:nome,:email,:senha)";
        }
        else 
        {
            $sql = "UPDATE tb_usuario SET nome   = :nome,
                                          email  = :email,
                                          senha  = :senha
                                          WHERE id= :id";
                            
        }

        $result = $conn->prepare($sql);
        $result->execute([':id'        => $usuario['id'],
                          ':nome'      => $usuario['nome'],
                          ':email'     => $usuario['email'],
                          ':senha'     => $usuario['senha'],
                          ]);                   
    }

    public static function find($id)
    {
        $conn = self::getConnection();
        
        $result = $conn->prepare("SELECT * FROM tb_usuario WHERE id=:id");
        $result->execute([':id'=>$id]);
        return $result->fetch();
    }

    public static function delete($id)
    {
        $conn = self::getConnection();
        
        $result = $conn->prepare("DELETE FROM tb_usuario WHERE id=:id");
        $result->execute([':id'=>$id]);
    }

    public static function all()
    {
        $conn = self::getConnection();
        $result = $conn->query("SELECT * FROM tb_usuario ORDER BY id");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

}

?>