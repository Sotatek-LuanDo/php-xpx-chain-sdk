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
 * TransferTransactionDTO class Doc Comment
 *
 * @category class
 * @package  Proximax
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class TransferTransactionDTO extends TransactionDTO{

    private $mosaics; //array Mosaic

    private $recipient; //Address

    private $message; //Message

    public function __construct($arrayData){
        $this->abstractTransaction = $arrayData["AbstractTransaction"];
        $this->mosaics = $arrayData["Mosaics"];
        $this->recipient = $arrayData["Recipient"];
        $this->message = $arrayData["Message"];
    }

    public function getMosaics(){
        return $this->mosaics;
    }

    public function getRecipient(){
        return $this->recipient;
    }

    public function getMessage(){
        return $this->message;
    }
}
?>