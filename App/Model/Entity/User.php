<?php
namespace App\Model\Entity;
use \WilliamCosta\DatabaseManager\Database;

class User{
    public $id;
    public $nome;
    public $email;
    public $senha;

    public static function getUserByEmail($email){
        return (new Database('usuarios'))->select('email = "'.$email.'"')->fetchObject(self::class);
    }

    public function cadastrar(){

        $this->id = (new Database('usuarios'))->insert([
            'nome' => $this->nome,
            'email' => $this->email,
            'senha'=> $this->senha
        ]);
        
        return true;
    }

    public static function getUsers($where = null, $order = null, $limit = null, $fields = '*'){
        return (new Database('usuarios'))->select($where, $order, $limit, $fields);
    }

    public static function getUserById($id){
        return self::getUsers('id = '.$id)->fetchObject(self::class);
    }

    public function atualizar(){
        return (new Database('usuarios'))->update('id = '.$this->id, [
            'nome' => $this->nome,
            'email' => $this->email,
            'senha' =>$this->senha
        ]);
    }
    
    public function excluir(){
        return (new Database('usuarios'))->delete('id = '.$this->id);
    }
}