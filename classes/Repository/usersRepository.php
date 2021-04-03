<?php
namespace Repository;


use DB\MySQL;


class usersRepository{
    public object $MySQL;
    public const TABLE = 'usuarios';


    public function __construct(){
        $this->MySQL = new MySQL();
    }


    public function insertUser($login, $pass){
        $queryInsert = 'INSERT INTO ' . self::TABLE . '(login, senha) VALUES (:login, sha1(:pass))';
        $this->MySQL->getDb()->beginTransaction();
        $stmt = $this->MySQL->getDb()->prepare($queryInsert);
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':pass', $pass);
        $stmt->execute();

        return $stmt->rowCount();
    }


    public function updateUser($id, $data){
        $queryUpdate = 'UPDATE ' . self::TABLE . ' SET login = :login, senha = sha1(:pass) WHERE id = :id';
        $this->MySQL->getDb()->beginTransaction();
        $stmt = $this->MySQL->getDb()->prepare($queryUpdate);
        $stmt->bindParam(':login', $data['login']);
        $stmt->bindParam(':pass', $data['senha']);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->rowCount();
    }


    public function getMySQL(){
        return $this->MySQL;
    }
}