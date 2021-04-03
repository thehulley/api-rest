<?php
namespace Util;


use JsonException as JsonExceptionAlias;
use Util\GenericConstantsUtil;


class JsonUtil{
    public function processArray($return){
        $data = [];
        $data[GenericConstantsUtil::TIPO] = GenericConstantsUtil::TIPO_ERRO;

        if (is_array($return) && count($return) || strlen($return) > 10){
            $data[GenericConstantsUtil::TIPO] = GenericConstantsUtil::TIPO_SUCESSO;
            $data[GenericConstantsUtil::RESPOSTA] = $return;
        }

        $this->returnJson($data);
    }


    private function returnJson($json){
        header('Content-Type: application/json');
        header('Cache-Content: no-cache, no-store, must-revalidate');
        header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE');

        echo json_encode($json); exit;
    }


    public static function bodyRequestJson(){
        try {
            $postJson = (array) json_decode(file_get_contents('php://input'));
        } catch (\JsonException $exception) {
            throw new \JsonException(GenericConstantsUtil::MSG_ERR0_JSON_VAZIO);
        }

        if (count($postJson) > 0){
            return $postJson;
        }
    }
}