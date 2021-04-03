<?php
namespace Validator;


use Repository\tokensRepository;
use Util\GenericConstantsUtil;
use Util\JsonUtil;
use Util\RoutesUtil;
use DB\MySQL;
use Service\usersService;


class RequestValidator{
    private array $request;
    private array $dataRequest = [];
    private object $tokensRepository;


    const get = 'GET';
    const del = 'DELETE';
    const users = 'USUARIOS';


    public function __construct($request){
        $this->request = $request;
        $this->tokensRepository = new tokensRepository();
    }


    public function processRequest(){
        $return = utf8_encode(GenericConstantsUtil::MSG_ERRO_TIPO_ROTA);
        
        if (in_array($this->request['metodo'], GenericConstantsUtil::TIPO_REQUEST, true)){
            $return = $this->directRequest();
        }

        return $return;
    }


    private function directRequest(){
        if ($this->request['metodo'] !== self::get && $this->request['metodo'] !== self::del){
            $this->dataRequest = JsonUtil::bodyRequestJson();
        }

        $this->tokensRepository->tokenValidate(getallheaders()['Authorization']);
        $method = $this->request['metodo'];

        return $this->$method();
    }


    private function get(){
        $return = utf8_encode(GenericConstantsUtil::MSG_ERRO_TIPO_ROTA);

        if (in_array($this->request['rota'], GenericConstantsUtil::TIPO_GET)){
            switch ($this->request['rota']) {
                case self::users:
                    $usersService = new usersService($this->request);
                    $return = $usersService->validateGet();
                break;

                default:
                    throw new Exception(GenericConstantsUtil::MSG_ERRO_RECURSO_INEXISTENTE);
                break;
            }
        }

        return $return;
    }


    private function delete(){
        $return = utf8_encode(GenericConstantsUtil::MSG_ERRO_TIPO_ROTA);

        if (in_array($this->request['rota'], GenericConstantsUtil::TIPO_DELETE)){
            switch ($this->request['rota']) {
                case self::users:
                    $usersService = new usersService($this->request);
                    $return = $usersService->validateDelete();
                break;

                default:
                    throw new Exception(GenericConstantsUtil::MSG_ERRO_RECURSO_INEXISTENTE);
                break;
            }
        }

        return $return;
    }


    private function post(){
        $return = utf8_encode(GenericConstantsUtil::MSG_ERRO_TIPO_ROTA);

        if (in_array($this->request['rota'], GenericConstantsUtil::TIPO_POST)){
            switch ($this->request['rota']) {
                case self::users:
                    $usersService = new usersService($this->request);
                    $usersService->setDataBodyRequest($this->dataRequest);
                    $return = $usersService->validatePost();
                break;

                default:
                    throw new Exception(GenericConstantsUtil::MSG_ERRO_RECURSO_INEXISTENTE);
                break;
            }
        }

        return $return;
    }


    private function put(){
        $return = utf8_encode(GenericConstantsUtil::MSG_ERRO_TIPO_ROTA);

        if (in_array($this->request['rota'], GenericConstantsUtil::TIPO_PUT)){
            switch ($this->request['rota']) {
                case self::users:
                    $usersService = new usersService($this->request);
                    $usersService->setDataBodyRequest($this->dataRequest);
                    $return = $usersService->validatePut();
                break;

                default:
                    throw new Exception(GenericConstantsUtil::MSG_ERRO_RECURSO_INEXISTENTE);
                break;
            }
        }

        return $return;
    }
}