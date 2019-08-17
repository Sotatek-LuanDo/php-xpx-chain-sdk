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
use Proximax\Utils\Utils;

/**
 * BlockDTO class Doc Comment
 *
 * @category class
 * @package  Proximax
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class BlockDTO{

    private $signature;//string

    private $signer;//PublicAccount

    private $version;//int

    private $type;//int 

    private $height;//int

    private $timestamp;//deadline

    private $difficulty;//int

    private $feeMultiplier;//int

    private $previousBlockHash;//string

    private $blockTransactionsHash;//string

    private $blockReceiptsHash;//string

    private $stateHash;//string

    private $beneficiary;//string

    public function __construct($signature, $signer, $version, $type, $height, $timestamp, $difficulty, $feeMultiplier, $previousBlockHash, $blockTransactionsHash, $blockReceiptsHash, $stateHash, $beneficiary){
        $this->signature = $signature;
        $this->signer = $signer;
        $this->version = $version;
        $this->type = $type;
        $this->height = $height;
        $this->timestamp = $timestamp;
        $this->difficulty = $difficulty;
        $this->feeMultiplier = $feeMultiplier;
        $this->previousBlockHash = $previousBlockHash;
        $this->blockTransactionsHash = $blockTransactionsHash;
        $this->blockReceiptsHash = $blockReceiptsHash;
        $this->stateHash = $stateHash;
        $this->beneficiary = $beneficiary;
    }

    public function getSignature(){
        return $this->signature;
    }

    public function getSigner(){
        return $this->signer;
    }

    public function getVersion(){
        return $this->version;
    }

    public function getType(){
        return $this->type;
    }

    public function getHeight(){
        return $this->height;
    }

    public function getTimestamp(){
        return $this->timestamp;
    }

    public function getDifficulty(){
        return $this->difficulty;
    }

    public function getFeeMultiplier(){
        return $this->feeMultiplier;
    }

    public function getPreviousBlockHash(){
        return $this->previousBlockHash;
    }

    public function getBlockTransactionsHash(){
        return $this->blockTransactionsHash;
    }

    public function getBlockReceiptsHash(){
        return $this->blockReceiptsHash;
    }

    public function getStateHash(){
        return $this->stateHash;
    }

    public function getBeneficiary(){
        return $this->beneficiary;
    }
}