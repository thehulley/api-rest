<?php
namespace Repository;


use DB\MySQL;
use Util\GenericConstantsUtil;


class tokensRepository{
    public object $MySQL;
    public const TABLE = 'tokens_autorizados';


    public function __construct(){
        $this->MySQL = new MySQL();
    }


    public function tokenValidate($token){
        $token = str_replace(['Bearer', ' '], '', $token);

        if ($token){
            $queryToken = "SELECT * FROM " . self::TABLE . " WHERE token = :token AND status = :status";
            $stmt = $this->getMySQL()->getDb()->prepare($queryToken);
            $stmt->bindValue(':token', $token);
            $stmt->bindValue(':status', GenericConstantsUtil::SIM);
            $stmt->execute();
            
            if ($stmt->rowCount() !== 1){
                throw new \Exception(GenericConstantsUtil::MSG_ERRO_TOKEN_NAO_AUTORIZADO);
            }
        }else {
            throw new \Exception(GenericConstantsUtil::MSG_ERRO_TOKEN_VAZIO);
        }
    }


    public function getMySQL(){
        return $this->MySQL;
    }
}