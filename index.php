<?php
use Util\RoutesUtil;
use Util\JsonUtil;
use Validator\RequestValidator;
use Service\usersRepository;
use Util\GenericConstantsUtil;


include 'bootstrap.php';


try {
    $RequestValidator = new RequestValidator(RoutesUtil::getRoutes());
    $return = $RequestValidator->processRequest();

    $JsonUtil = new JsonUtil();
    $JsonUtil->processArray($return);
} catch (\Exception $exception) {
    echo json_encode([
        GenericConstantsUtil::TIPO => GenericConstantsUtil::TIPO_ERRO,
        GenericConstantsUtil::RESPOSTA => $exception->getMessage()
    ]);
}