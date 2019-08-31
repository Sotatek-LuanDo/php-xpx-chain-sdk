<?php
/**
 * NIS2 API
 *
 * This document defines all the nis2 api routes and behaviour
 *
 * OpenAPI spec version: 1.0.0
 * Contact: greg@evias.be
 *
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 * 
 */

namespace Proximax\Model;

/**
 * EmbeddedSecretLockTransactionDTO class Doc Comment
 *
 * @category class
 * @package  Proximax
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class EmbeddedSecretLockTransactionDTO extends EmbeddedTransactionDTO{

    private $duration; //UInt64DTO

    private $mosaicId; //UInt64DTO

    private $amount; //UInt64DTO

    private $hashAlgorithm; //HashAlgorithmEnum

    private $secret; //string

    private $recipient; //string

    public function __construct($dataArray){
        $this->signer = $dataArray["signer"];
        $this->version = $dataArray["version"];
        $this->type = $dataArray["type"];
        $this->duration = $dataArray["duration"];
        $this->mosaicId = $dataArray["mosaicId"];
        $this->amount = $dataArray["amount"];
        $this->hashAlgorithm = $dataArray["hashAlgorithm"];
        $this->secret = $dataArray["secret"];
        $this->recipient = $dataArray["recipient"];
    }

    public function getDuration(){
        return $this->duration;
    }

    public function getMosaicId(){
        return $this->mosaicId;
    }

    public function getAmount(){
        return $this->amount;
    }

    public function getHashAlgorithm(){
        return $this->hashAlgorithm;
    }

    public function getSecret(){
        return $this->secret;
    }

    public function getRecipient(){
        return $this->recipient;
    }

}
