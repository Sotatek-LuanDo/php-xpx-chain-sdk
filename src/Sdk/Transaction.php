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
use Proximax\Core\KeyPair;
use Proximax\API\TransactionRoutesApi;
use Proximax\Model\TransactionDTO;
use Proximax\Model\TransactionStatusDTO;
use Proximax\ApiClient;
use Base32\Base32;
use Proximax\Infrastructure\TransactionMapping;
use Proximax\Model\HeightDTO;
use Proximax\Model\MosaicDTO;
use Proximax\Model\TransactionInfo;
use Proximax\Model\Address;
use Proximax\Model\PublicAccount;
use Proximax\Model\Message;
use Proximax\Model\AbstractTransaction;
use Proximax\Model\Account;
use Proximax\Model\TransactionType;
use Proximax\Model\TransferTransactionDTO;
use Proximax\Model\LockFundsTransactionDTO;
use Proximax\Model\AggregateTransactionDTO;
use Proximax\Model\CosignatureDTO;

/**
 * Transaction class Doc Comment
 *
 * @category class
 * @package  Proximax
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class Transaction{

    /**
     *
     * @param config $config
     *
     * @param String $transId
     * 
     * @return TransactionDTO
     */
    public function GetTransaction($config, $transId){
        $TransactionRoutesApi = new TransactionRoutesApi;
        $ApiClient = new ApiClient;
        $url = $config->BaseURL;
        $ApiClient->setHost($url);
        $networkType = $config->NetworkType;

        $data = $TransactionRoutesApi->getTransaction($transId);
        
        if ($data[1] == 200){ // successfull
            return $this->formatData($networkType, $data[0]);
        }
        else return null;
    }

    /**
     *
     * @param config $config
     *
     * @param String $transId Array of transaction ids or hashes
     * 
     * @return TransactionDTO array
     */
    public function GetTransactions($config, $transIds){
        $TransactionRoutesApi = new TransactionRoutesApi;
        $ApiClient = new ApiClient;
        $url = $config->BaseURL;
        $ApiClient->setHost($url);
        $networkType = $config->NetworkType;

        $data = $TransactionRoutesApi->getTransactions($transIds);
        $arr_trans = array();
        if ($data[1] == 200){ // successfull
            for($i=0;$i<count($data[0]);$i++){
                $transaction = $this->formatData($networkType, $data[0][$i]);
                $arr_trans[$i] = $transaction;
            }
        }
        return $arr_trans;
    }

    /**
     *
     * @param config $config
     *
     * @param String $hash
     * 
     * @return TransactionStatusDTO
     */
    public function GetTransactionStatus($config, $hash){
        $TransactionRoutesApi = new TransactionRoutesApi;
        $ApiClient = new ApiClient;
        $url = $config->BaseURL;
        $ApiClient->setHost($url);
        $networkType = $config->NetworkType;

        $data = $TransactionRoutesApi->getTransactionStatus($hash);
        
        if ($data[1] == 200){ // successfull
            $transactionStatus = $this->formatDataStatus($data[0]);
        }
        else $transactionStatus = null;

        return new TransactionStatusDTO($transactionStatus);
    }

    /**
     *
     * @param config $config
     *
     * @param String $hash array
     * 
     * @return TransactionStatusDTO
     */
    public function GetTransactionsStatuses($config, $hashes){
        $TransactionRoutesApi = new TransactionRoutesApi;
        $ApiClient = new ApiClient;
        $url = $config->BaseURL;
        $ApiClient->setHost($url);
        $networkType = $config->NetworkType;

        $data = $TransactionRoutesApi->getTransactionsStatuses($hashes);
        $arr_statuses = array();
        if ($data[1] == 200){ // successfull
            for($i=0;$i<count($data[0]);$i++){
                $transactionStatus = $this->formatDataStatus($data[0][$i]);
                $transactionStatusDTO = new TransactionStatusDTO($transactionStatus);
                $arr_statuses[$i] = $transactionStatusDTO;
            }
            
        }

        return $arr_statuses;
    }

/**
     * @param int $networkType
     *
     * @param array $data
     * 
     * @return TransactionDTO
     */
    public function formatData($networkType, $data){
        if (isset($data->meta->height)){
            $Height = $data->meta->height;
        }
        else $Height = "";
        
        if (isset($data->meta->index)){
            $Index = $data->meta->index;
        }
        else $Index = "";

        if (isset($data->meta->id)){
            $Id = $data->meta->id;
        }
        else $Id = "";

        if (isset($data->meta->hash)){
            $Content = $data->meta->hash;
        }
        else $Content = "";

        if (isset($data->meta->merkleComponentHash)){
            $MerkleComponentHash = $data->meta->merkleComponentHash;
        }
        else $MerkleComponentHash = "";

        if (isset($data->meta->aggregateHash)){
            $AggregateHash = $data->meta->aggregateHash;
        }
        else $AggregateHash = "";

        if (isset($data->meta->aggregateId)){
            $AggregateId = $data->meta->aggregateId;
        }
        else $AggregateId = "";

        $transMap = new TransactionMapping;

        if (isset($data->transaction->type)){
            $Type = dechex($data->transaction->type);
        }
        else $Type = "";
        
        if (isset($data->transaction->version)){
            $Version = $transMap->ExtractVersion($data->transaction->version);
        }
        else $Version = "";

        if (isset($data->transaction->maxFee)){
            $MaxFee = $transMap->ExtractMaxFee($data->transaction->maxFee);
        }
        else $MaxFee = "";

        if (isset($data->transaction->deadline)){
            $Deadline = $transMap->ExtractDeadline($data->transaction->deadline);
        }
        else $Deadline = "";
        
        if (isset($data->transaction->signature)){
            $Signature = $data->transaction->signature;
        }
        else $Signature = "";
        
        if (isset($data->transaction->signer)){
            $Address = Address::fromPublicKey($data->transaction->signer,$networkType);
            $Signer = new PublicAccount($Address,$data->transaction->signer);
        }
        else $Signer = "";
        
        $TransactionInfo = new TransactionInfo($Height,$Index,$Id,$Content,$MerkleComponentHash,$AggregateHash,$AggregateId);

        $AbstractTransaction = new AbstractTransaction($TransactionInfo,$Deadline,$networkType,$Type,$Version,$MaxFee,$Signature,$Signer);

        $transaction = array(
            'AbstractTransaction' => $AbstractTransaction
        );
        
        switch ($Type){
            case TransactionType::AGGREGATE_BONDED: //aggregate bonded 
                $data = $this->formatAggregate($networkType,$data->transaction->cosignatures,$data->transaction->transactions);
                $transaction["Cosignatures"] = $data->cosignatures;
                $transaction["Transactions"] = $data->transactions;
                return new AggregateTransactionDTO($transaction);

            case TransactionType::AGGREGATE_COMPLETED: //aggregate completed
                $data = $this->formatAggregate($networkType,$data->transaction->cosignatures,$data->transaction->transactions);
                $transaction["Cosignatures"] = $data->cosignatures;
                $transaction["Transactions"] = $data->transactions;
                return new AggregateTransactionDTO($transaction);

            case TransactionType::LOCK: //lock transaction
                $data = $this->formatLockFunds($data->transaction->duration,$data->transaction->mosaicId,$data->transaction->amount,$data->transaction->hash);
                $transaction["Duration"] = $data->duration;
                $transaction["Mosaic"] = $data->mosaic;
                $transaction["Hash"] = $data->hash;
                return new LockFundsTransactionDTO($transaction);
                
            case TransactionType::TRANSFER: //transfer transaction
                $data = $this->formatTransfer($networkType,$data->transaction->mosaics,$data->transaction->recipient,$data->transaction->message);
                $transaction["Mosaics"] = $data->mosaics;
                $transaction["Recipient"] = $data->recipient;
                $transaction["Message"] = $data->message;
                return new TransferTransactionDTO($transaction);
        }
        return $transaction;
    }

    /**
     *
     * @param array $data
     * 
     * @return TransactionStatusDTO
     */
    private function formatDataStatus($data){
        $group = $data->group;
        $status = $data->status;
        $hash = $data->hash;
        $height = new HeightDTO($data->height);
        $transMap = new TransactionMapping;
        $deadline = $transMap->ExtractDeadline($data->deadline);

        $transactionStatus = array(
            'group' => $group,
            'status' => $status,
            'hash' => $hash,
            'deadline' => $deadline,
            'height' => $height
        );
        return $transactionStatus;
    }

    /**
     *
     * @param config $config
     *
     * @param String $payload
     * 
     * @return response
     */
    public function AnnounceTransaction($config, $payload){
        $TransactionRoutesApi = new TransactionRoutesApi;
        $ApiClient = new ApiClient;
        $url = $config->BaseURL;
        $ApiClient->setHost($url);
        $networkType = $config->NetworkType;

        $data = $TransactionRoutesApi->announceTransaction($payload);
        
        if ($data[1] == 202){ // successfull
            return $data[0]->message;
        }
        else throw new \Exception("Error");
    }

    /**
     *
     * @param config $config
     *
     * @param String $payload
     * 
     * @return response
     */
    public function AnnounceAggregateBondedTransaction($config, $payload){
        $TransactionRoutesApi = new TransactionRoutesApi;
        $ApiClient = new ApiClient;
        $url = $config->BaseURL;
        $ApiClient->setHost($url);
        $networkType = $config->NetworkType;

        $data = $TransactionRoutesApi->announcePartialTransaction($payload);
        
        if ($data[1] == 202){ // successfull
            return $data[0]->message;
        }
        else throw new \Exception("Error");
    }

    /**
     *
     * @param config $config
     *
     * @param String $payload
     * 
     * @return response
     */
    public function AnnounceAggregateBondedCosignatureTransaction($config, $payload){
        $TransactionRoutesApi = new TransactionRoutesApi;
        $ApiClient = new ApiClient;
        $url = $config->BaseURL;
        $ApiClient->setHost($url);
        $networkType = $config->NetworkType;

        $data = $TransactionRoutesApi->announceCosignatureTransaction($payload);
        
        if ($data[1] == 202){ // successfull
            return $data[0]->message;
        }
        else throw new \Exception("Error");
    }

    public function formatTransfer($networkType,$mosaics_raw,$recipient_raw,$message_raw){
        $Mosaics = array();
        for ($i=0;$i<count($mosaics_raw);$i++){
            $mosaic = new MosaicDTO($mosaics_raw[$i]->id,$mosaics_raw[$i]->amount);
            $Mosaics[$i] = $mosaic;
        }

        $hex = new \Proximax\Utils\Hex;
        $addrDecode = $hex->DecodeString($recipient_raw);
        $addrString = Base32::encode(implode(array_map("chr", $addrDecode)));
        $Recipient = new Address($addrString,$networkType);
        
        $mess = pack('H*', $message_raw->payload);
        $Message = new Message($mess,$message_raw->type);

        $result = new \stdClass();
        $result->mosaics = $Mosaics;
        $result->recipient = $Recipient;
        $result->message = $Message;
        
        return $result;
    }

    public function formatLockFunds($duration_raw,$mosaicId_raw,$amount_raw,$hash_raw){
        $mosaic = new MosaicDTO($mosaicId_raw,$amount_raw);

        $result = new \stdClass();
        $result->mosaic = $mosaic;
        $result->duration = (($duration_raw[1] << 32) | ($duration_raw[0]));
        $result->hash = $hash_raw;

        return $result;
    }

    public function formatAggregate($networkType,$cosignatures_raw,$transactions_raw){
        $cosignatures = array();
        for ($i=0;$i<count($cosignatures_raw);$i++){
            $signer = (new Account)->newAccountFromPublicKey($cosignatures_raw[$i]->signer,$networkType);
            $cosignatures[$i] = new CosignatureDTO($cosignatures_raw[$i]->signature,$signer);
        }

        $transactions = array();
        for ($i=0;$i<count($transactions_raw);$i++){
            $transactions[$i] = $this->formatData($networkType,$transactions_raw[$i]);
        }
        $result = new \stdClass();
        $result->cosignatures = $cosignatures;
        $result->transactions = $transactions;

        return $result;
    }
}
?>