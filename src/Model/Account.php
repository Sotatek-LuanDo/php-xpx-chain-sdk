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
use NEM\Utils\Hex;
use NEM\Model\Transaction;
use NEM\Model\SignedTransaction;
use NEM\Core\KeyPair;
use NEM\Model\PublicAccount;

/**
 * Account class Doc Comment
 *
 * @category class
 * @package  NEM
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class Account{
    public $keyPair;

    public $publicAccount;

    public function __construct(KeyPair $keyPair = null,PublicAccount $publicAccount = null){
        $this->keyPair = $keyPair;
        $this->publicAccount = $publicAccount;
    }

    public function sign($transaction){
        $byte_data = $transaction->generateBytes();
        $new = array_slice($byte_data,4,count($byte_data)-4);

        $signature = $this->keyPair->sign($new,"sha3-512",8);

        $p1 = array_slice($byte_data,0,4);
        $p = array_merge($p1,$signature,$this->keyPair->getPublicKey(8),$new);

        $hex = new Hex;
        $ph = $hex->EncodeToString($p);

        $h = $transaction->createTransactionHash($ph);

        $signedTransaction = new SignedTransaction($transaction->getAbstractTransaction()->type,strtoupper($ph),strtoupper($h));

        return $signedTransaction;

    }

    public function newAccountFromPrivateKey($privateKey,$networkType){
        $keyPair = new KeyPair($privateKey);
        $publicAccount = new PublicAccount($keyPair->getAddress($networkType),$keyPair->getPublicKey());
        return new Account($keyPair,$publicAccount);
    }

    public function newAccountFromPublicKey($publicKey,$networkType){
        $address = Address::fromPublicKey($publicKey,$networkType);
        $publicAccount = new PublicAccount($address,$publicKey);
        return $publicAccount ;
    }

    public function getPublicAccount(){
        return $this->publicAccount;
    }

    public function getKeyPair(){
        return $this->keyPair;
    }
}
