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

namespace Proximax\Model\Transaction\Schema;
use Proximax\Model\Transaction\Attribute\ScalarAttribute;
use Proximax\Model\Transaction\Attribute\ArrayAttribute;
use Proximax\Model\Transaction\Attribute\TableArrayAttribute;
use Proximax\Model\Transaction\Constants;

/**
 * MosaicDefinitionTransactionSchema class Doc Comment
 *
 * @category class
 * @package  Proximax
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class MosaicDefinitionTransactionSchema extends Schema{
    public function __construct() {
        $arr = array(
            new ScalarAttribute("size", Constants::SIZEOF_INT),
            new ArrayAttribute ("signature", Constants::SIZEOF_BYTE),
            new ArrayAttribute ("signer", Constants::SIZEOF_BYTE),
            new ScalarAttribute("version", Constants::SIZEOF_SHORT),
            new ScalarAttribute("type", Constants::SIZEOF_SHORT),
            new ArrayAttribute ("maxFee", Constants::SIZEOF_INT),
            new ArrayAttribute ("deadline", Constants::SIZEOF_INT),
            new ScalarAttribute("mosaicNonce", Constants::SIZEOF_INT),
            new ArrayAttribute ("mosaicId", Constants::SIZEOF_INT),
            new ScalarAttribute("numOptionalProperties", Constants::SIZEOF_BYTE),
            new ScalarAttribute("flags", Constants::SIZEOF_BYTE),
            new ScalarAttribute("divisibility", Constants::SIZEOF_BYTE),
            new TableArrayAttribute("optionalProperties", array(
                new ScalarAttribute("mosaicPropertyId", Constants::SIZEOF_BYTE),
                new ArrayAttribute ("value", Constants::SIZEOF_INT)
            ))
        );
        parent::__construct($arr);
    }
}
?>