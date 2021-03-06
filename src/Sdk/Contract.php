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

namespace Proximax\Sdk;

use Proximax\API\ContractRoutesApi;
use Proximax\ApiClient;
use Base32\Base32;
use Proximax\Model\UInt64DTO;
use Proximax\Model\ContractInfoDTO;

/**
 * Contract class Doc Comment
 *
 * @category class
 * @package  Proximax
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class Contract{
    /**
     *
     * @param config $config
     *
     * @param $publicKey
     * 
     * @return ContractInfoDTO
     */
    public function GetContractsAccount($config, $publicKey){
        $ContractRoutesApi = new ContractRoutesApi;
        $ApiClient = new ApiClient;
        $url = $config->BaseURL;
        $ApiClient->setHost($url);
        $networkType = $config->NetworkType;

        $data = $ContractRoutesApi->getContractsAccount($publicKey);
        $contracts = array();
        if ($data[1] == 200){ // successfull
            for($i=0;$i<count($data[0]);$i++){
                $contract = $this->formatData($networkType, $data[0][$i]);
                $contracts[$i] = new ContractInfoDTO($contract);
            }
        }
        return $contracts;
    }

    /**
     *
     * @param config $config
     *
     * @param $publicKey array
     * 
     * @return ContractInfoDTO
     */
    public function GetContractsAccounts($config, $publicKeys){
        $ContractRoutesApi = new ContractRoutesApi;
        $ApiClient = new ApiClient;
        $url = $config->BaseURL;
        $ApiClient->setHost($url);
        $networkType = $config->NetworkType;

        $data = $ContractRoutesApi->getContractsAccounts($publicKeys);
        $contracts = array();
        if ($data[1] == 200){ // successfull
            for($i=0;$i<count($data[0]);$i++){
                $contract = $this->formatData($networkType, $data[0][$i]);
                $contracts[$i] = new ContractInfoDTO($contract);
            }
        }
        return $contracts;
    }

    /**
     *
     * @param config $config
     *
     * @param $contractId
     * 
     * @return ContractInfoDTO
     */
    public function GetContract($config, $contractId){
        $ContractRoutesApi = new ContractRoutesApi;
        $ApiClient = new ApiClient;
        $url = $config->BaseURL;
        $ApiClient->setHost($url);
        $networkType = $config->NetworkType;

        $data = $ContractRoutesApi->getContract($contractId);
        if ($data[1] == 200){ // successfull
            $contract = $this->formatData($networkType, $data[0]);
            return new ContractInfoDTO($contract);
        }
        else return null;
        
    }

    /**
     *
     * @param config $config
     *
     * @param $contractIds array
     * 
     * @return ContractInfoDTO
     */
    public function GetContracts($config, $contractIds){
        $ContractRoutesApi = new ContractRoutesApi;
        $ApiClient = new ApiClient;
        $url = $config->BaseURL;
        $ApiClient->setHost($url);
        $networkType = $config->NetworkType;

        $data = $ContractRoutesApi->getContracts($contractIds);
        $contracts = array();
        if ($data[1] == 200){ // successfull
            for($i=0;$i<count($data[0]);$i++){
                $contract = $this->formatData($networkType, $data[0][$i]);
                $contracts[$i] = new ContractInfoDTO($contract);
            }
        }
        return $contracts;
        
    }

    /**
     * @param int $networkType
     *
     * @param object $data
     * 
     * @return ContractDTO
     */
    private function formatData($networkType, $data){
        $multisig = $data->contract->multisig;

        $hex = new \Proximax\Utils\Hex;
        $multisigAddress = $hex->DecodeString($data->contract->multisigAddress);
        $multisigAddress = Base32::encode(implode(array_map("chr", $multisigAddress)));

        $start = new UInt64DTO($data->contract->start);
        $duration = new UInt64DTO($data->contract->duration);
        $hash = $data->contract->hash;
        $customers = $data->contract->customers;
        $executors = $data->contract->executors;
        $verifiers = $data->contract->verifiers;
        
        $contractDTO = array(
            "multisig" => $multisig,
            "multisigAddress" => $multisigAddress,
            "start" => $start,
            "duration" => $duration,
            "hash" => $hash,
            "customers" => $customers,
            "executors" => $executors,
            "verifiers" => $verifiers
        );
        return $contractDTO;
    }
}
?>