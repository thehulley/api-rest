<?php
namespace Service;


use Util\GenericConstantsUtil;
use Repository\usersRepository;


class usersService{
    private array $data;
    private object $usersRepository;
    private array $dataBodyRequest = [];


    public const TABLE = 'usuarios';
    public const RESOURCES_GET = ['listar'];
    public const RESOURCES_DELETE = ['deletar'];
    public const RESOURCES_POST = ['cadastrar'];
    public const RESOURCES_PUT = ['atualizar'];


    public function __construct($data){
        $this->data = $data;
        $this->usersRepository = new usersRepository();
    }


    public function validateGet(){
        $return = null;
        $resource = $this->data['recurso'];
    
        if (in_array($resource, self::RESOURCES_GET)){
            $return = $this->data['id'] > 0 ? $this->getOneByKey() : $this->$resource();
        }else {
            throw new \Exception(GenericConstantsUtil::MSG_ERRO_RECURSO_INEXISTENTE);
        }

        $this->validateReturnRequest($resource);

        return $return;
    }


    public function validateDelete(){
        $return = null;
        $resource = $this->data['recurso'];

        if (in_array($resource, self::RESOURCES_DELETE)){
            $return = $this->validateId($resource);
        }else {
            throw new \Exception(GenericConstantsUtil::MSG_ERRO_RECURSO_INEXISTENTE);
        }

        $this->validateReturnRequest($resource);

        return $return;
    }


    public function validatePost(){
        $return = null;
        $resource = $this->data['recurso'];

        if (in_array($resource, self::RESOURCES_POST)){
            $return = $this->$resource();
        }else {
            throw new \Exception(GenericConstantsUtil::MSG_ERRO_RECURSO_INEXISTENTE);
        }

        $this->validateReturnRequest($resource);    

        return $return;
    }


    public function validatePut(){
        $return = null;
        $resource = $this->data['recurso'];

        if (in_array($resource, self::RESOURCES_PUT)){
            $return = $this->validateId($resource);
        }else {
            throw new \Exception(GenericConstantsUtil::MSG_ERRO_RECURSO_INEXISTENTE);
        }

        $this->validateReturnRequest($resource);

        return $return;
    }


    public function setDataBodyRequest($dataRequest){
        $this->dataBodyRequest = $dataRequest;
    }


    private function getOneByKey(){
        return $this->usersRepository->getMySQL()->getOneByKey(self::TABLE, $this->data['id']);
    }


    private function listar(){
       return $this->usersRepository->getMySQL()->getAll(self::TABLE);
    }


    private function deletar(){
        return $this->usersRepository->getMySQL()->delete(self::TABLE, $this->data['id']);
    }


    private function cadastrar(){
        [$login, $pass] = [$this->dataBodyRequest['login'], $this->dataBodyRequest['senha']];

        if ($login && $pass){
            if ($this->usersRepository->insertUser($login, $pass) > 0){
                $idInsert = $this->usersRepository->getMySQL()->getDb()->lastInsertId();
                $this->usersRepository->getMySQL()->getDb()->commit();

                return ['id_inserido' => $idInsert];
            }

            $this->usersRepository->getMySQL()->getDb()->rollBack();
            throw new \Exception(GenericConstantsUtil::MSG_ERRO_NAO_AFETADO);
        }

        throw new \Exception(GenericConstantsUtil::MSG_ERRO_LOGIN_SENHA_OBRIGATORIO);
    }


    private function atualizar(){
        if ($this->usersRepository->updateUser($this->data['id'], $this->dataBodyRequest) > 0){
            $this->usersRepository->getMySQL()->getDb()->commit();

            return GenericConstantsUtil::MSG_ATUALIZADO_SUCESSO;
        }

        $this->usersRepository->getMySQL()->getDb()->rollBack();
        throw new \Exception(GenericConstantsUtil::MSG_ERRO_NAO_AFETADO);
    }


    public function validateReturnRequest($return){
        if ($return === null){
            throw new \Exception(GenericConstantsUtil::MSG_ERRO_GENERICO);
        }
    }


    private function validateId($resource){

        if ($this->data['id'] > 0){
            $return = $this->$resource();
        }else {
            throw new \Exception(GenericConstantsUtil::MSG_ERRO_ID_OBRIGATORIO);
        }

        return $return;
    }
}