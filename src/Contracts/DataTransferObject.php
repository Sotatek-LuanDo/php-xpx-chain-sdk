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

namespace Proximax\Contracts;

/**
 * DataTransferObject interface Doc Comment
 *
 * @category interface
 * @package  Proximax
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
interface DataTransferObject
{
    /**
     * Setter for the `attributes` property.
     *
     * @return  \Proximax\Models\ModelInterface
     */
    public function setAttributes(array $attributes);

    /**
     * Getter for the `attributes` property.
     *
     * @return array
     */
    public function getAttributes();

    /**
     * Helper method to build NIS compliant Data Transfer
     * Objects.
     *
     * @return array
     */
    public function toDTO($filterByKey = null);
}
