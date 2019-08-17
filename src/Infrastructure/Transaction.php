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

namespace Proximax\Infrastructure;

use Proximax\Model\Transaction as TxModel;
use Proximax\Core\KeyPair;
use Proximax\Core\Buffer;
use Proximax\Core\Serializer;

/**
 * Transaction class Doc Comment
 *
 * @category class
 * @package  Proximax
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class Transaction extends Service
{
    /**
     * The Base URL for this endpoint.
     *
     * @var string
     */
    protected $baseUrl = "/transaction";

    /**
     * Helper method to retrieve the transaction announce endpoint URL
     * given a pair of `transaction` and `kp` keypair parameters.
     * 
     * In cases where you don't provide a KeyPair, the `prepare-announce`
     * method will be used, please be warned that this only works on a 
     * locally running NIS API connection.
     * 
     * in case a `kp` keypair is provided, we will sign the transaction
     * locally so we can use `/transaction/announce` directly.
     * 
     * @param   \Proximax\Models\Transaction     $transaction
     * @param   null|\Proximax\Core\KeyPair      $kp
     * @return  string
     */
    public function getAnnouncePath(TxModel $transaction, KeyPair $kp = null)
    {
        // in case a `kp` keypair is provided, we will sign the transaction
        // locally so we can use `/transaction/announce` directly.
        return null !== $kp ? "announce" : "prepare-announce";
    }

    /**
     * Helper method to sign a transaction with a given keypair `kp`.
     * 
     * If no keypair is provided, this method will return `null`.
     * 
     * @internal This method is used internally to determined whether
     *           instanciated keypairs are detected and to make sure that
     *           Client Signatures are always created when possible.
     * 
     * @param   \Proximax\Models\Transaction     $transaction
     * @param   null|\Proximax\Core\KeyPair      $kp
     * @return  null|\Proximax\Core\Buffer
     */
    public function signTransaction(TxModel $transaction, KeyPair $kp = null)
    {
        // always set optional `signer` in case we provide a KeyPair
        if (null !== $kp) {
            $transaction->setAttribute("signer", $kp->getPublicKey("hex"));
        }

        // now we can serialize and sign
        $serialized = $transaction->serialize();
        $serialHex = Buffer::fromUInt8($serialized)->getHex();
        $serialBin = hex2bin($serialHex);
        return null !== $kp ? $kp->sign($serialBin) : null;
    }

    /**
     * Announce a transaction. The transaction will be serialized before
     * it is sent to the server. 
     * 
     * Additionally, a KeyPair object can be passed to this method *if you wish 
     * to have the transaction **signed locally** by the SDK instead of letting
     * the remote NIS sign for you*. The local signing method **is recommended**.
     * 
     * WARNING: In case you don't provide this method with a KeyPair, 
     * you must provide a `privateKey` in the transaction attributes. 
     * It is *not* recommended to send `privateKey` data over any network,
     * even local.
     * 
     * @param   \Proximax\Models\Transaction     $transaction
     * @return  \Proximax\Models\Model
     */
    public function announce(TxModel $transaction, KeyPair $kp = null)
    {
        // always set optional `signer` in case we provide a KeyPair
        if (null !== $kp) {
            $transaction->setAttribute("signer", $kp->getPublicKey("hex"));
        }

        // now we can serialize and sign
        $serialized = $transaction->serialize();
        $signature  = $this->signTransaction($transaction, $kp, $serialized);
        $broadcast  = [];

        if ($signature) {
            // valid KeyPair provided, signature was created.

            // recommended signed transaction broadcast method.
            // this will use the /transaction/announce endpoint.
            $broadcast = [
                "data" => Buffer::fromUInt8($serialized)->getHex(),
                "signature" => $signature->getHex(),
            ];
        }
        else {
            // WARNING: with this you must provide a `privateKey`
            // in the transaction attributes. This is *not* recommended.
            $broadcast = $transaction->toDTO();
        }

        $endpoint = $this->getAnnouncePath($transaction, $kp);
        $apiUrl   = $this->getPath($endpoint, []);
        $response = $this->api->postJSON($apiUrl, $broadcast);

        //XXX include Error checks
        $object = json_decode($response, true);
        return $this->createBaseModel($object); //XXX brr => error/content validation first
    }

    /**
     * Gets a transaction meta data pair where the transaction hash corresponds
     * to the said `hash` parameter.
     */
    public function byHash($hash)
    {
        $params = ["hash" => $hash];
        $apiUrl = $this->getPath('get', $params);
        $response = $this->api->getJSON($apiUrl);

        //XXX include Error checks
        $object = json_decode($response, true);
        return $this->createTransactionModel($object['data']); //XXX brr => error/content validation first
    }
}
