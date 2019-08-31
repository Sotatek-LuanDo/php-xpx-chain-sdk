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
 * TransactionMetaDTO class Doc Comment
 *
 * @category class
 * @package  Proximax
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class TransactionMetaDTO {
    
    private $height; //UInt64DTO

    private $hash; //string

    private $merkleComponentHash; //string

    private $index; //int

    private $id; //string

    public function __construct($dataArray){
        $this->height = $dataArray["height"];
        $this->hash = $dataArray["hash"];
        $this->merkleComponentHash = $dataArray["merkleComponentHash"];
        $this->index = $dataArray["index"];
        $this->id = $dataArray["id"];
    }

    public function getHeight(){
        return $this->height;
    }

    public function getHash(){
        return $this->hash;
    }

    public function getMerkleComponentHash(){
        return $this->merkleComponentHash;
    }

    public function getIndex(){
        return $this->index;
    }

    public function getId(){
        return $this->id;
    }
}


