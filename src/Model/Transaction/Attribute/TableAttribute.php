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

namespace Proximax\Model\Transaction\Attribute;

/**
 * TableAttribute class Doc Comment
 *
 * @category class
 * @package  Proximax
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class TableAttribute extends SchemaAttribute {
    private $schema; //array SchemaAttribute

    public function __construct($name, $schema) {
        parent::__construct($name);
        $this->schema = $schema;
    }

    protected function serialize3Params($buffer, $position, $innerObjectPosition) {
        $resultBytes = array();
        $tableStartPosition = $this->findObjectStartPosition($innerObjectPosition, $position, $buffer);
        for ($i=0;$i<count($this->schema);++$i) {
            $tmp = $this->schema[$i]->serialize($buffer, 4 + ($i * 2), $tableStartPosition);
            $resultBytes = array_merge($resultBytes, $tmp);
        }
        return $resultBytes;
    }
}
?>