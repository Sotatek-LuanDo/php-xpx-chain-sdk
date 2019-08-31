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
 * TransactionStatusDTO class Doc Comment
 *
 * @category class
 * @package  Proximax
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class TransactionStatusDTO {
    private $group; //string

    private $status;//string

    private $hash;//string

    private $deadline;//UInt64DTO

    private $height;//UInt64DTO

    public function __construct($dataArray){
        $this->group = $dataArray["group"];
        $this->status = $dataArray["status"];
        $this->hash = $dataArray["hash"];
        $this->deadline = $dataArray["deadline"];
        $this->height = $dataArray["height"];
    }

    public function getGroup(){
        return $this->group;
    }

    public function getStatus(){
        return $this->status;
    }

    public function getHash(){
        return $this->hash;
    }

    public function getDeadline(){
        return $this->deadline;
    }

    public function getHeight(){
        return $this->height;
    }
}


