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

namespace NEM\Model\Transaction;
use NEM\Model\TransactionType;
use NEM\Model\Deadline;
use NEM\Model\TransactionVersion;
use NEM\Model\TransactionInfo;
use NEM\Model\PublicAccount;
use NEM\Infrastructure\Network;
use NEM\Model\Transaction\Schema\ModifyMultisigAccountTransactionSchema;
use \Google\FlatBuffers\FlatbufferBuilder;
use \Catapult\Buffers\MessageBuffer;
use \Catapult\Buffers\MosaicBuffer;
use \Catapult\Buffers\ModifyMultisigAccountTransactionBuffer;
use \Catapult\Buffers\TransferTransactionBuffer;
use \Catapult\Buffers\CosignatoryModificationBuffer;
use NEM\Utils\Hex;

/**
 * ModifyMultisigAccountTransaction class Doc Comment
 *
 * @category class
 * @package  NEM
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class ModifyMultisigAccountTransaction extends \NEM\Model\Transaction{

    private $minApprovalDelta; //int

    private $minRemovalDelta; //int

    private $modifications; //MultisigCosignatoryModification
     
    public function __construct($deadline, $minApprovalDelta, $minRemovalDelta, $modifications, $networkType){
        $abstractTransaction = new \stdClass();
        $abstractTransaction->version = TransactionVersion::MODIFY_MULTISIG_VERSION;
        $abstractTransaction->deadline = $deadline;
        $abstractTransaction->type = hexdec(TransactionType::MODIFY_MULTISIG);
        if (is_string($networkType) && in_array(strtolower($networkType), ["mijin", "mijintest", "public", "publictest", "private", "privatetest", "NotSupportedNet", "aliasaddress"])){
            $networkType = Network::$networkInfos[strtolower($networkType)]["id"];
        }
        else if (is_numeric($networkType) && !in_array($networkType, [96, 144, 184, 168, 200, 176, 0, 145])) {
            throw new NISInvalidNetworkId("Invalid netword ID '" . $networkType . "'");
        } 
        $abstractTransaction->networkType = $networkType;

        $abstractTransaction->maxFee = array(0,0);
        $abstractTransaction->signature = ""; 
        $abstractTransaction->signer = new PublicAccount;
        $abstractTransaction->transactionInfo = new TransactionInfo;

        $this->setAbstractTransaction($abstractTransaction);

        $this->minApprovalDelta = $minApprovalDelta;
        $this->minRemovalDelta = $minRemovalDelta;
        $this->modifications = $modifications;
    }

    public function generateBytes() {
        $networkType = $this->getAbstractTransaction()->networkType;
        $version = $this->getAbstractTransaction()->version;
        $deadline = $this->getAbstractTransaction()->deadline;
        $signature = $this->getAbstractTransaction()->signature;
        $signer = $this->getAbstractTransaction()->signer;
        $maxFee = $this->getAbstractTransaction()->maxFee;
        $type = $this->getAbstractTransaction()->type;

        $minApprovalDelta = $this->minApprovalDelta;
        $minRemovalDelta = $this->minRemovalDelta;
        $modifications = $this->modifications;

        $builder = new FlatbufferBuilder(1);
        
        // Create Modifications
        for ($i=0;$i<count($modifications);++$i) {
            $multisigCosignatoryModification = $modifications[$i];
            $byteCosignatoryPublicKey = (new Hex)->DecodeString($multisigCosignatoryModification->getPublicAccount()->getPublicKey());
            $cosignatoryPublicKey = CosignatoryModificationBuffer::createCosignatoryPublicKeyVector($builder, $byteCosignatoryPublicKey);
            CosignatoryModificationBuffer::startCosignatoryModificationBuffer($builder);
            CosignatoryModificationBuffer::addType($builder, $multisigCosignatoryModification->getType());
            CosignatoryModificationBuffer::addCosignatoryPublicKey($builder, $cosignatoryPublicKey);
            $modificationsBuffers[$i] = CosignatoryModificationBuffer::endCosignatoryModificationBuffer($builder);
        }
        $modificationsVector = ModifyMultisigAccountTransactionBuffer::createModificationsVector($builder, $modificationsBuffers);
        
        $v = ($networkType << 8) + $version;

        // Create Vectors
        $signatureVector = ModifyMultisigAccountTransactionBuffer::createSignatureVector($builder, array());
        $signerVector = ModifyMultisigAccountTransactionBuffer::createSignerVector($builder, array());
        $deadlineVector = ModifyMultisigAccountTransactionBuffer::createDeadlineVector($builder, $deadline->getTimeArray());
        $feeVector = ModifyMultisigAccountTransactionBuffer::createFeeVector($builder, $maxFee);
        

        $fixSize = 123; // replace by the all numbers sum or add a comment explaining this

        ModifyMultisigAccountTransactionBuffer::startModifyMultisigAccountTransactionBuffer($builder);
        ModifyMultisigAccountTransactionBuffer::addSize($builder, $fixSize + (33 * count($modifications)));
        ModifyMultisigAccountTransactionBuffer::addSignature($builder, $signatureVector);
        ModifyMultisigAccountTransactionBuffer::addSigner($builder, $signerVector);
        ModifyMultisigAccountTransactionBuffer::addVersion($builder, $v);
        ModifyMultisigAccountTransactionBuffer::addType($builder, $type);
        ModifyMultisigAccountTransactionBuffer::addFee($builder, $feeVector);
        ModifyMultisigAccountTransactionBuffer::addDeadline($builder, $deadlineVector);

        ModifyMultisigAccountTransactionBuffer::addMinRemovalDelta($builder, $minRemovalDelta);
        ModifyMultisigAccountTransactionBuffer::addMinApprovalDelta($builder, $minApprovalDelta);
        ModifyMultisigAccountTransactionBuffer::addNumModifications($builder, count($modifications));
        ModifyMultisigAccountTransactionBuffer::addModifications($builder, $modificationsVector);
        
        $codedTransfer = ModifyMultisigAccountTransactionBuffer::endModifyMultisigAccountTransactionBuffer($builder);
        
        $builder->finish($codedTransfer);
        $ModifyMultisigAccountTransactionSchema = new ModifyMultisigAccountTransactionSchema;
        
        $tmp = unpack("C*",$builder->sizedByteArray());
        $builder_byte = array_slice($tmp,0,count($tmp));
        $output = $ModifyMultisigAccountTransactionSchema->serialize($builder_byte);
        return $output;
    }

    // public function DecodeString(string $s){
    //     $CHARS = "ABCDEFGHIJKLMNOPQRSTUVWXYZ234567";
    //     $arr = unpack('C*', $s);
    //     $convertedBytes = array();
    //     $index = 0;
    //     $bitCount = 0;
    //     $current = 0;
    //     for ($i=1;$i<=count($arr);$i++){
    //         //echo "1";
    //         $symbolValue = strpos($CHARS,chr($arr[$i]));
    //         if ($symbolValue < 0) {
    //             throw new Exception("symbol value must bigger than 0");
    //         }
    //         for ($j=4;$j>=0;$j--) {
    //             $current = ($current << 1) + ($symbolValue >> $j & 0x1);
    //             $bitCount++;
    //             if ($bitCount == 8) {
    //                 $convertedBytes[$index++] = $current;

    //                 $bitCount = 0;
    //                 $current = 0;
    //             }
    //         }
    //     }
    //     return $convertedBytes;
    // }
}
?>