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
use Proximax\Model\Transaction\Schema\ModifyAccountPropertyTransactionSchema;
use \Google\FlatBuffers\FlatbufferBuilder;
use \Catapult\Buffers\PropertyModificationBuffer;
use \Catapult\Buffers\MosaicBuffer;
use \Catapult\Buffers\AccountPropertiesTransactionBuffer;
use Proximax\Utils\Hex;
use Proximax\Utils\Utils;
use Proximax\Model\AbstractTransaction;
use Base32\Base32;

/**
 * ModifyAccountPropertyTransaction class Doc Comment
 *
 * @category class
 * @package  Proximax
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class ModifyAccountPropertyTransaction extends \Proximax\Model\Transaction{

    private $propertyType; //AccountPropertyTypeEnum

    private $modifications; //array AccountPropertyModification
     
    public function __construct($deadline, $propertyType, $modifications, $networkType){
        $version = "";
        $type = "";
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

        $this->propertyType = $propertyType;
        $this->modifications = $modifications;
    }

    public function createForAddress(){
        $this->getAbstractTransaction()->setVersion(TransactionVersion::ACCOUNT_PROPERTY_ADDRESS_VERSION);
        $this->getAbstractTransaction()->setType(hexdec(TransactionType::ACCOUNT_PROPERTY_ADDRESS));
    }

    public function createForMosaic(){
        $this->getAbstractTransaction()->setVersion(TransactionVersion::ACCOUNT_PROPERTY_MOSAIC_VERSION);
        $this->getAbstractTransaction()->setType(hexdec(TransactionType::ACCOUNT_PROPERTY_MOSAIC));
    }

    public function createForEntityType(){
        $this->getAbstractTransaction()->setVersion(TransactionVersion::ACCOUNT_PROPERTY_ENTITY_TYPE_VERSION);
        $this->getAbstractTransaction()->setType(hexdec(TransactionType::ACCOUNT_PROPERTY_ENTITY_TYPE));
    }

    public function generateBytes() {
        $networkType = $this->getAbstractTransaction()->getNetworkType();
        $version = $this->getAbstractTransaction()->getVersion();
        $deadline = $this->getAbstractTransaction()->getDeadline();
        $signature = $this->getAbstractTransaction()->getSignature();
        $signer = $this->getAbstractTransaction()->getSigner();
        $maxFee = $this->getAbstractTransaction()->getMaxFee();
        $type = $this->getAbstractTransaction()->getType();

        $propertyType = $this->propertyType;
        $modifications = $this->modifications;

        $builder = new FlatbufferBuilder(1);
        
        // track the size of the whole transaction
        $totalSize = 0;
        // load modifications
        $modificationOffsets = array();
        for ($i=0;$i<count($modifications);$i++) {
            $mod = $modifications[$i];
            $modType = $mod->getType();
            // prepare intermediate data
            if ($type == hexdec(TransactionType::ACCOUNT_PROPERTY_ADDRESS)){
                $valueBytes = $this->getValueBytesFromAddressModification($mod);
            }
            else if ($type == hexdec(TransactionType::ACCOUNT_PROPERTY_MOSAIC)){
                $valueBytes = $this->getValueBytesFromMosaicModification($mod);
            }
            if ($type == hexdec(TransactionType::ACCOUNT_PROPERTY_ENTITY_TYPE)){
                $valueBytes = $this->getValueBytesFromEntityModification($mod);
            }
            // prepare vectors for collections
            $valueOffset = PropertyModificationBuffer::createValueVector($builder, $valueBytes);

            // compute number of bytes: modType + value bytes
            $modSize = 1 + count($valueBytes);
            // increase total size
            $totalSize += $modSize;

            // populate flat-buffer
            PropertyModificationBuffer::startPropertyModificationBuffer($builder);
            PropertyModificationBuffer::addValue($builder, $valueOffset);
            PropertyModificationBuffer::addModificationType($builder, $modType);
            $modificationOffsets[$i] = PropertyModificationBuffer::endPropertyModificationBuffer($builder);
        }
        
        $v = ($networkType << 24) + $version;

        // Create Vectors
        $signatureVector = AccountPropertiesTransactionBuffer::createSignatureVector($builder, (new Utils)->createArrayZero(64));
        $signerVector = AccountPropertiesTransactionBuffer::createSignerVector($builder, (new Utils)->createArrayZero(32));
        $deadlineVector = AccountPropertiesTransactionBuffer::createDeadlineVector($builder, $deadline->getTimeArray());
        $feeVector = AccountPropertiesTransactionBuffer::createMaxFeeVector($builder, $maxFee);
        $modificationsOffset = AccountPropertiesTransactionBuffer::createModificationsVector($builder, $modificationOffsets);

        // add size of the header (120) + size of prop type (1) + size of mod count (1)
        $totalSize += self::HEADER_SIZE + 1 + 1;

        AccountPropertiesTransactionBuffer::startAccountPropertiesTransactionBuffer($builder);
        AccountPropertiesTransactionBuffer::addSize($builder, $totalSize);
        AccountPropertiesTransactionBuffer::addSignature($builder, $signatureVector);
        AccountPropertiesTransactionBuffer::addSigner($builder, $signerVector);
        AccountPropertiesTransactionBuffer::addVersion($builder, $v);
        AccountPropertiesTransactionBuffer::addType($builder, $type);
        AccountPropertiesTransactionBuffer::addMaxFee($builder, $feeVector);
        AccountPropertiesTransactionBuffer::addDeadline($builder, $deadlineVector);

        AccountPropertiesTransactionBuffer::addPropertyType($builder, hexdec($propertyType));
        AccountPropertiesTransactionBuffer::addModificationCount($builder, count($modifications));
        AccountPropertiesTransactionBuffer::addModifications($builder, $modificationsOffset);
        
        $codedTransaction = AccountPropertiesTransactionBuffer::endAccountPropertiesTransactionBuffer($builder);
        
        $builder->finish($codedTransaction);
        $ModifyAccountPropertyTransactionSchema = new ModifyAccountPropertyTransactionSchema;
        
        $tmp = unpack("C*",$builder->sizedByteArray());
        $builder_byte = array_slice($tmp,0,count($tmp));
        $output = $ModifyAccountPropertyTransactionSchema->serialize($builder_byte);
        return $output;
    }

    private function getValueBytesFromAddressModification($mod){
        $address = $mod->getValue()->toClean();
        $tmp = Base32::decode($address);
        $bytes = (new Utils)->stringToByteArray($tmp);
        return $bytes;
    }

    private function getValueBytesFromMosaicModification($mod){
        $id = $mod->getValue()->getId();
        $bytes = (new Utils)->getBytes($id);
        return $bytes;
    }

    private function getValueBytesFromEntityModification($mod){
        $bytes = (new Utils)->putUint16LittleEndian(hexdec($mod->getValue()));
        return $bytes;
    }
}
?>