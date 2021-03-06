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
 * BlockchainVersion Class Doc Comment
 *
 * @category Class
 * @package  Proximax
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class BlockchainVersion{

   const MAX_VALUE = 65535;

   const MASK_2_BYTES = "FFFF";
   
   private $major; //int

   private $minor; //int

   private $revision; //int

   private $build; //int

    public function __construct($major, $minor, $revision, $build){
        $this->major = $major;
        $this->minor = $minor;
        $this->revision = $revision;
        $this->build = $build;
    }

    public function getMajor(){
        return $this->major;
    }

    public function getMinor(){
        return $this->minor;
    }

    public function getRevision(){
        return $this->revision;
    }

    public function getBuild(){
        return $this->build;
    }

    public function getVersionValue(){
        $value2 = ($this->major << 16) | ($this->minor);
        $value1 = ($this->revision << 16) | ($this->build);
        return array($value1,$value2);
    }

    /**
    * create new instance using the big integer of 8 bytes
    * 
    * @param version
    * @return the version instance representing the version value
    */
    public static function fromVersionValue($version) {
        // 8 bytes can be stored in the long
        $build =  $rawValue & hexdec(self::MASK_2_BYTES);
        $rev =  ($rawValue >> 16) & hexdec(self::MASK_2_BYTES);
        $minor =  ($rawValue >> 32) & hexdec(self::MASK_2_BYTES);
        $major =  ($rawValue >> 48) & hexdec(self::MASK_2_BYTES);
        // create new instance
        return new BlockchainVersion($major, $minor, $rev, $build);
    }
}


