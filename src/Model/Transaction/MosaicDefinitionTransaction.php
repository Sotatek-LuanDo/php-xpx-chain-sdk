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

namespace Proximax\Model\Transaction;
use Proximax\Model\TransactionType;
use Proximax\Model\Deadline;
use Proximax\Model\TransactionVersion;
use Proximax\Model\TransactionInfo;
use Proximax\Model\PublicAccount;
use Proximax\Infrastructure\Network;
use Proximax\Model\Transaction\Schema\MosaicDefinitionTransactionSchema;
use \Google\FlatBuffers\FlatbufferBuilder;
use \Catapult\Buffers\MosaicProperty;
use \Catapult\Buffers\MosaicDefinitionTransactionBuffer;
use Proximax\Utils\Hex;
use Proximax\Utils\Utils;
use Proximax\Model\AbstractTransaction;
use Proximax\Model\Transaction\IdGenerator;
use Proximax\Model\MosaicProperties;
use Proximax\Model\MosaicPropertyId;

/**
 * MosaicDefinitionTransaction class Doc Comment
 *
 * @category class
 * @package  Proximax
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class MosaicDefinitionTransaction extends \Proximax\Model\Transaction{

    private $mosaicNonce; //MosaicNonce

    private $mosaicId; //MosaicId

    private $mosaicProperties; //MosaicProperties
     
    public function __construct($deadline, $mosaicNonce, $publickey, $mosaicProperties, $networkType){
        $version = TransactionVersion::MOSAIC_DEFINITION_VERSION;
        $type = hexdec(TransactionType::MOSAIC_DEFINITION);
        if (is_string($networkType) && in_array(strtolower($networkType), ["mijin", "mijintest", "public", "publictest", "private", "privatetest", "NotSupportedNet", "aliasaddress"])){
            $networkType = Network::$networkInfos[strtolower($networkType)]["id"];
        }
        else if (is_numeric($networkType) && !in_array($networkType, [96, 144, 184, 168, 200, 176, 0, 145])) {
            throw new NISInvalidNetworkId("Invalid netword ID '" . $networkType . "'");
        } 
        $maxFee = array(0,0);
        $signature = ""; 
        $signer = new PublicAccount;
        $transactionInfo = new TransactionInfo;

        $abstractTransaction = new AbstractTransaction($transactionInfo,$deadline,$networkType,
                                                    $type,$version,$maxFee,$signature,$signer);
        $this->setAbstractTransaction($abstractTransaction);

        $this->mosaicNonce = $mosaicNonce;
        $this->mosaicId = IdGenerator::generateMosaicId($mosaicNonce,$publickey);
        $this->mosaicProperties = $mosaicProperties;
    }

    public function generateBytes() {
        $networkType = $this->getAbstractTransaction()->getNetworkType();
        $version = $this->getAbstractTransaction()->getVersion();
        $deadline = $this->getAbstractTransaction()->getDeadline();
        $signature = $this->getAbstractTransaction()->getSignature();
        $signer = $this->getAbstractTransaction()->getSigner();
        $maxFee = $this->getAbstractTransaction()->getMaxFee();
        $type = $this->getAbstractTransaction()->getType();

        $mosaicNonce = $this->mosaicNonce;
        $mosaicId = $this->mosaicId;
        $mosaicProperties = $this->mosaicProperties;

        $builder = new FlatbufferBuilder(1);
        
        $flags = 0;
        if ($mosaicProperties->isSupplyMutable()) {
            $flags |= MosaicProperties::FLAG_SUPPLY_MUTABLE;
        }
        if ($mosaicProperties->isTransferable()) {
            $flags |= MosaicProperties::FLAG_TRANSFERABLE;
        }

        $propertyList = array();
        $duration = $mosaicProperties->getDuration();
        if ($duration !== null) {
            $propertyList = array(
                array(MosaicPropertyId::DURATION,$duration)
            );
        }
        $optinalPropertiesVector = array();
        for ($i=0;$i<count($propertyList);$i++) {
            $property = $propertyList[$i];
            // prepare offset for the value
            $valueOffset = MosaicProperty::createValueVector($builder,$property[1]);
            // increase size - id + value
            MosaicProperty::startMosaicProperty($builder);
            MosaicProperty::addMosaicPropertyId($builder, $property[0]);
            MosaicProperty::addValue($builder, $valueOffset);
            $optinalPropertiesVector[$i] = MosaicProperty::endMosaicProperty($builder);
        }

        
        $v = ($networkType << 24) + $version;

        // Create Vectors
        $signatureVector = MosaicDefinitionTransactionBuffer::createSignatureVector($builder, (new Utils)->createArrayZero(64));
        $signerVector = MosaicDefinitionTransactionBuffer::createSignerVector($builder, (new Utils)->createArrayZero(32));
        $deadlineVector = MosaicDefinitionTransactionBuffer::createDeadlineVector($builder, $deadline->getTimeArray());
        $feeVector = MosaicDefinitionTransactionBuffer::createMaxFeeVector($builder, $maxFee);
        
        $mosaicIdVector = MosaicDefinitionTransactionBuffer::createMosaicIdVector($builder,$mosaicId->getId());
        $optionalPropertiesVector = MosaicDefinitionTransactionBuffer::createOptionalPropertiesVector($builder,$optinalPropertiesVector);

        // header + nonce + id + numOptProp + flags + divisibility + (id + value)*numOptProp
        $size = self::HEADER_SIZE + 4 + 8 + 1 + 1 + 1 + (1 + 8) * count($optinalPropertiesVector);

        MosaicDefinitionTransactionBuffer::startMosaicDefinitionTransactionBuffer($builder);
        MosaicDefinitionTransactionBuffer::addSize($builder, $size);
        MosaicDefinitionTransactionBuffer::addSignature($builder, $signatureVector);
        MosaicDefinitionTransactionBuffer::addSigner($builder, $signerVector);
        MosaicDefinitionTransactionBuffer::addVersion($builder, $v);
        MosaicDefinitionTransactionBuffer::addType($builder, $type);
        MosaicDefinitionTransactionBuffer::addMaxFee($builder, $feeVector);
        MosaicDefinitionTransactionBuffer::addDeadline($builder, $deadlineVector);

        MosaicDefinitionTransactionBuffer::addMosaicNonce($builder, $mosaicNonce->getNonceAsInt());
        MosaicDefinitionTransactionBuffer::addMosaicId($builder, $mosaicIdVector);
        MosaicDefinitionTransactionBuffer::addNumOptionalProperties($builder, count($optinalPropertiesVector));
        MosaicDefinitionTransactionBuffer::addFlags($builder, $flags);
        MosaicDefinitionTransactionBuffer::addDivisibility($builder, $mosaicProperties->getDivisibility());
        MosaicDefinitionTransactionBuffer::addOptionalProperties($builder, $optionalPropertiesVector);
        
        $codedTransaction = MosaicDefinitionTransactionBuffer::endMosaicDefinitionTransactionBuffer($builder);
        
        $builder->finish($codedTransaction);
        $MosaicDefinitionTransactionSchema = new MosaicDefinitionTransactionSchema;
        
        $tmp = unpack("C*",$builder->sizedByteArray());
        $builder_byte = array_slice($tmp,0,count($tmp));
        $output = $MosaicDefinitionTransactionSchema->serialize($builder_byte);
        return $output;
    }
}
?>