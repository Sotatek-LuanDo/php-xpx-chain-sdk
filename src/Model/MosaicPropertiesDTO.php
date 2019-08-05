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

namespace NEM\Model;
use NEM\Utils\Utils;

/**
 * MosaicPropertiesDTO class Doc Comment
 *
 * @category class
 * @package  NEM
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class MosaicPropertiesDTO{
    private $supplyMutable; //bool

    private $transferable; //bool
  
    private $levyMutable; //bool
  
    private $divisibility; //int
  
    private $duration; //int

    public function __construct(array $properties){
        $utils = new Utils;
        $flag = '00' . base_convert($utils->bigIntToHexString($properties[0]),16,2);
        $bitMap = array($flag[strlen($flag)-3],$flag[strlen($flag)-2],$flag[strlen($flag)-1]);
        $this->supplyMutable = (bool)$bitMap[0];
        $this->transferable = (bool)$bitMap[1];
        $this->levyMutable = (bool)$bitMap[2];
        $this->divisibility = hexdec($utils->bigIntToHexString($properties[1]));
        $this->duration = hexdec($utils->bigIntToHexString($properties[2]));
    }

    public function getSupplyMutable(){
        return $this->supplyMutable;
    }
    
    public function getTransferable(){
        return $this->transferable;
    }

    public function getLevyMutable(){
        return $this->levyMutable;
    }

    public function getDivisibility(){
        return $this->divisibility;
    }

    public function getDuration(){
        return $this->duration;
    }
}