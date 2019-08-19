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
 * LockFundsTransactionDTO class Doc Comment
 *
 * @category class
 * @package  Proximax
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class LockFundsTransactionDTO extends TransactionDTO{

    private $duration;//int

    private $mosaic;//Mosaic

    private $hash;//string

    public function __construct($data){
        $this->abstractTransaction = $data["AbstractTransaction"];
        $this->duration = $data["Duration"];
        $this->mosaic = $data["Mosaic"];
        $this->hash = $data["Hash"];
    }

    public function getDuration(){
        return $this->duration;
    }

    public function getMosaic(){
        return $this->mosaic;
    }

    public function getHash(){
        return $this->hash;
    }
}
