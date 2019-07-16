<?php
namespace NEM\Sdk;
use NEM\Core\KeyPair;
use NEM\API\TransactionRoutesApi;
use NEM\Model\TransactionDTO;
use NEM\Model\TransactionStatusDTO;
use NEM\ApiClient;
use Base32\Base32;
use NEM\Infrastructure\TransactionMapping;
use NEM\Model\HeightDTO;
use NEM\Model\Mosaic;
use NEM\Model\TransactionInfo;
use NEM\Model\Address;
use NEM\Model\PublicAccount;
use NEM\Model\Message;

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
            $transaction = $this->formatData($networkType, $data[0]);
        }
        else $transaction = null;

        return new TransactionDTO($transaction);
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
                $transactionDTO = new TransactionDTO($transaction);
                $arr_trans[$i] = $transactionDTO;
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
     * @return TransactionDTO array
     */
    private function formatData($networkType, $data){
        $Height = $data->meta->height;
        $Index = $data->meta->index;
        $Id = $data->meta->id;
        $Content = $data->meta->hash;
        $MerkleComponentHash = $data->meta->merkleComponentHash;

        if (isset($data->meta->AggregateHash)){
            $AggregateHash = $data->meta->AggregateHash;
        }
        else $AggregateHash = "";

        if (isset($data->meta->AggregateId)){
            $AggregateId = $data->meta->AggregateId;
        }
        else $AggregateId = "";

        $transMap = new TransactionMapping;
        $Type = dechex($data->transaction->type);
        $Version = $transMap->ExtractVersion($data->transaction->version);
        $MaxFee = $transMap->ExtractMaxFee($data->transaction->maxFee);
        $Deadline = $transMap->ExtractDeadline($data->transaction->deadline);
        $Signature = $data->transaction->signature;

        $Address = Address::fromPublicKey($data->transaction->signer,$networkType);
        $Signer = new PublicAccount($Address,$data->transaction->signer);

        $mosaics_raw = $data->transaction->mosaics;
        $Mosaics = array();
        for ($i=0;$i<count($mosaics_raw);$i++){
            $mosaic = new Mosaic;
            $mosaic->createFromId($mosaics_raw[$i]->id,$mosaics_raw[$i]->amount);
            $Mosaics[$i] = $mosaic;
        }

        $hex = new \NEM\Utils\Hex;
        $addrDecode = $hex->DecodeString($data->transaction->recipient);
        $addrString = Base32::encode(implode(array_map("chr", $addrDecode)));
        $Recipient = new Address($addrString,$networkType);
        
        $mess = pack('H*', $data->transaction->message->payload);
        $Message = new Message($mess,$data->transaction->message->type);
        
        $TransactionInfo = new TransactionInfo($Height,$Index,$Id,$Content,$MerkleComponentHash,$AggregateHash,$AggregateId);

        $AbstractTransaction = new \stdClass();
        $AbstractTransaction->NetworkType = $networkType;
        $AbstractTransaction->TransactionInfo = $TransactionInfo;
        $AbstractTransaction->Type = $Type;
        $AbstractTransaction->Version = $Version;
        $AbstractTransaction->MaxFee = $MaxFee;
        $AbstractTransaction->Deadline = $Deadline;
        $AbstractTransaction->Signature = $Signature;
        $AbstractTransaction->Signer = $Signer;

        $transaction = array(
            'AbstractTransaction' => $AbstractTransaction,
            'Mosaics' => $Mosaics,
            'Recipient' => $Recipient,
            'Message' => $Message
        );
        return $transaction;
    }

    /**
     *
     * @param array $data
     * 
     * @return TransactionStatusDTO array
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
        
        //var_dump($data);
        if ($data[1] == 202){ // successfull
            return $data[0]->message;
        }
        else throw new Exception("Error");
    }
}
?>