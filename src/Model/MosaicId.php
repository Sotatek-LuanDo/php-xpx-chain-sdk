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
 * MosaicId class Doc Comment
 *
 * @category class
 * @package  Proximax
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class MosaicId{

    private $id; //big Int

    public function __construct($id = null){
        if(is_string($id)){
            $this->id = (new Utils)->fromBigInt(hexdec($id));
        }
        else if(is_array($id)){
            $this->id = $id;
        }
    }

    public function getId(){
        return $this->id;
    }
    
    public function getIdValue(){
        $utils = new Utils;
        return $utils->bigIntToHexString($this->id);
    }
}


