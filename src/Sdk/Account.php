<?php
namespace NEM\Sdk;
use NEM\Core\KeyPair;
use NEM\API\AccountRoutesApi;
use NEM\Model\AccountDTO;
use NEM\Model\TransactionDTO;
use NEM\ApiClient;
use Base32\Base32;
use NEM\Infrastructure\TransactionMapping;
use NEM\Model\MosaicDTO;
use NEM\Model\TransactionInfo;
use NEM\Model\Address;
use NEM\Model\PublicAccount;
use NEM\Model\Message;
use NEM\Model\HeightDTO;

class Account{
    const EmptyPublicKey = "0000000000000000000000000000000000000000000000000000000000000000";

    public $KeyPair;

    public function __construct($KeyPair = null){
        if (!$KeyPair){
            $this->KeyPair = new KeyPair;
        }
        else $this->KeyPair = $KeyPair;
    }
    
    /**
     * Sign message
     *
     * @param  Transaction $tx
     *
     * @return SignedTransaction
     */
    public function Sign($tx){
        return signTransactionWith($tx, $this);
    }
    
    /**
     * sign AggregateTransaction with current Account and with every passed cosignatory Account's
     * returns announced Aggregate SignedTransaction
     *
     * @param  AggregateTransaction $tx
     *
     * @param Account[] $cosignatories 
     * 
     * @return SignedTransaction
     */
    // public function SignWithCosignatures($tx, $cosignatories){
    //     return signTransactionWithCosignatures(tx, a, cosignatories);
    // }
    
    // public function SignCosignatureTransaction(tx *CosignatureTransaction) (*CosignatureSignedTransaction, error) {
    //     return signCosignatureTransaction(a, tx)
    // }
    
    // public function EncryptMessage(message string, recipientPublicAccount *PublicAccount) (*SecureMessage, error) {
    //     rpk, err := crypto.NewPublicKeyfromHex(recipientPublicAccount.PublicKey)
    
    //     if err != nil {
    //         return nil, err
    //     }
    
    //     return NewSecureMessageFromPlaintText(message, a.KeyPair.PrivateKey, rpk)
    // }
    
    // public function DecryptMessage(encryptedMessage *SecureMessage, senderPublicAccount *PublicAccount) (*PlainMessage, error) {
    //     spk, err := crypto.NewPublicKeyfromHex(senderPublicAccount.PublicKey)
    
    //     if err != nil {
    //         return nil, err
    //     }
    
    //     return NewPlainMessageFromEncodedData(encryptedMessage.Payload(), a.KeyPair.PrivateKey, spk)
    // }

    /**
     *
     * @param config $config
     *
     * @param Address $accountId Account address or publicKey
     * 
     * @return AccountDTO
     */
    public function GetAccountInfo($config, $accountId){
        $AccountRoutesApi = new AccountRoutesApi;
        $ApiClient = new ApiClient;
        $url = $config->BaseURL;
        $ApiClient->setHost($url);
        $networkType = $config->NetworkType;

        $data = $AccountRoutesApi->getAccountInfo($accountId);
        if ($data[1] == 200){ // successfull
            $account = $this->formatDataAccount($networkType, $data[0]);
        }
        else $account = null;
        return new AccountDTO($account);
    }

    /**
     *
     * @param config $config
     *
     * @param array $accountIds Array of publicKeys and address
     * 
     * @return AccountDTO array
     */
    public function GetAccountsInfo($config, $addresses){
        $AccountRoutesApi = new AccountRoutesApi;
        $ApiClient = new ApiClient;

        $url = $config->BaseURL;
        $ApiClient->setHost($url);
        $networkType = $config->NetworkType;

        $data = $AccountRoutesApi->getAccountsInfo($addresses);
        $arr_account = array();
        if ($data[1] == 200){ // successfull
            for ($i=0;$i<count($data[0]);$i++){
                $account = $this->formatDataAccount($networkType, $data[0][$i]);
                $AccountDTO = new AccountDTO($account);
                $arr_account[$i] = $AccountDTO;
            }
        }
        return $arr_account;
    }

    /**
     *
     * @param config $config
     *
     * @param String $publicKey
     * 
     * @return TransactionDTO
     */
    public function Transactions($config, $publicKey, $option = null){
        $AccountRoutesApi = new AccountRoutesApi;
        $ApiClient = new ApiClient;
        $url = $config->BaseURL;
        $ApiClient->setHost($url);
        $networkType = $config->NetworkType;

        if ($option != null){
            $data = $AccountRoutesApi->transactions($publicKey, $option->pageSize, $option->id);
        }
        else $data = $AccountRoutesApi->transactions($publicKey);
        $arr_transaction = array();
        if ($data[1] == 200){ // successfull
            for ($i=0;$i<count($data[0]);$i++){
                $transaction = $this->formatDataTransaction($networkType, $data[0][$i]);
                $TransactionDTO = new TransactionDTO($transaction);
                $arr_transaction[$i] = $TransactionDTO;
            }
            
        }
        return $arr_transaction;
    }

    /**
     *
     * @param config $config
     *
     * @param String $publicKey
     * 
     * @return TransactionDTO
     */
    public function IncomingTransactions($config, $publicKey, $option = null){
        $AccountRoutesApi = new AccountRoutesApi;
        $ApiClient = new ApiClient;
        $url = $config->BaseURL;
        $ApiClient->setHost($url);
        $networkType = $config->NetworkType;

        if ($option != null){
            $data = $AccountRoutesApi->incomingTransactions($publicKey, $option->pageSize, $option->id);
        }
        else $data = $AccountRoutesApi->incomingTransactions($publicKey);
        $arr_transaction = array();
        if ($data[1] == 200){ // successfull
            for ($i=0;$i<count($data[0]);$i++){
                $transaction = $this->formatDataTransaction($networkType, $data[0][$i]);
                $TransactionDTO = new TransactionDTO($transaction);
                $arr_transaction[$i] = $TransactionDTO;
            }
            
        }
        return $arr_transaction;
    }

    /**
     *
     * @param config $config
     *
     * @param String $publicKey
     * 
     * @return TransactionDTO
     */
    public function OutgoingTransactions($config, $publicKey, $option = null){
        $AccountRoutesApi = new AccountRoutesApi;
        $ApiClient = new ApiClient;
        $url = $config->BaseURL;
        $ApiClient->setHost($url);
        $networkType = $config->NetworkType;

        if ($option != null){
            $data = $AccountRoutesApi->outgoingTransactions($publicKey, $option->pageSize, $option->id);
        }
        else $data = $AccountRoutesApi->outgoingTransactions($publicKey);
        $arr_transaction = array();
        if ($data[1] == 200){ // successfull
            for ($i=0;$i<count($data[0]);$i++){
                $transaction = $this->formatDataTransaction($networkType, $data[0][$i]);
                $TransactionDTO = new TransactionDTO($transaction);
                $arr_transaction[$i] = $TransactionDTO;
            }
            
        }
        return $arr_transaction;
    }


    /**
     *
     * @param config $config
     *
     * @param String $publicKey
     * 
     * @return TransactionDTO
     */
    public function UnconfirmedTransactions($config, $publicKey, $option = null){
        $AccountRoutesApi = new AccountRoutesApi;
        $ApiClient = new ApiClient;
        $url = $config->BaseURL;
        $ApiClient->setHost($url);
        $networkType = $config->NetworkType;

        if ($option != null){
            $data = $AccountRoutesApi->unconfirmedTransactions($publicKey, $option->pageSize, $option->id);
        }
        else $data = $AccountRoutesApi->unconfirmedTransactions($publicKey);
        $arr_transaction = array();
        if ($data[1] == 200){ // successfull
            for ($i=0;$i<count($data[0]);$i++){
                $transaction = $this->formatDataTransaction($networkType, $data[0][$i]);
                $TransactionDTO = new TransactionDTO($transaction);
                $arr_transaction[$i] = $TransactionDTO;
            }
            
        }
        return $arr_transaction;
    }

    /** Chưa xong
     *
     * @param config $config
     *
     * @param String $publicKey
     * 
     * @return TransactionDTO
     */
    public function GetAccountMultisig($config){
        $AccountRoutesApi = new AccountRoutesApi;
        $ApiClient = new ApiClient;
        $url = $config->BaseURL;
        $ApiClient->setHost($url);
        $networkType = $config->NetworkType;

        $data = $AccountRoutesApi->getAccountMultisig($publicKey);
        $arr_transaction = array();
        if ($data[1] == 200){ // successfull
            for ($i=0;$i<count($data[0]);$i++){
                $transaction = $this->formatDataTransaction($networkType, $data[0][$i]);
                $TransactionDTO = new TransactionDTO($transaction);
                $arr_transaction[$i] = $TransactionDTO;
            }
            
        }
        return $arr_transaction;
    }

    /**
     * @param int $networkType
     *
     * @param array $data
     * 
     * @return TransactionDTO array
     */
    private function formatDataTransaction($networkType, $data){
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
            $mosaic = new MosaicDTO($mosaics_raw[$i]->id,$mosaics_raw[$i]->amount);
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
     * @param Address $add
     *
     * @param array $data
     * 
     * @return AccountDTO array
     */
    private function formatDataAccount($networkType, $data){
        $hex = new \NEM\Utils\Hex;
        $add = $hex->DecodeString($data->account->address);
        
        $addr = Base32::encode(implode(array_map("chr", $add)));
        $address = new Address($addr,$networkType);
        $addressHeight = new HeightDTO($data->account->addressHeight);

        $publicKey = $data->account->publicKey;
        $publicKeyHeight = new HeightDTO($data->account->publicKeyHeight);

        $mosaics_raw = $data->account->mosaics;
        $mosaics = array();
        for ($i=0;$i<count($mosaics_raw);$i++){
            $mosaic = new MosaicDTO($mosaics_raw[$i]->id,$mosaics_raw[$i]->amount);
            $mosaics[$i] = $mosaic;
        }

        $accountType = $data->account->accountType;
        $linkedAccountKey = $data->account->linkedAccountKey;

        $account = array(
            "address" => $address,
            "addressHeight" => $addressHeight,
            "publicKey" => $publicKey,
            "publicKeyHeight" => $publicKeyHeight,
            "mosaics" => $mosaics,
            "accountType" => $accountType,
            "linkedAccountKey" => $linkedAccountKey
        );
        return $account;
    }
}
?>