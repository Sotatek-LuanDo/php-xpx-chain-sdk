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

namespace Proximax\Model\Mutators;

use Illuminate\Support\Str;
use BadMethodCallException;

/**
 * ModelMutator class Doc Comment
 *
 * @category class
 * @package  Proximax
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class ModelMutator
{
    /**
     * Mutate a Model object.
     *
     * This method takes a *snake_case* model name and converts it
     * to a class name in the namespace \Proximax\Models.
     *
     * @internal
     * @param  string   $name           The model name you would like to create.
     * @param  array    $attributes     The model's attribute values.
     * @return \Proximax\Models\ModelInterface
     */
    public function mutate($name, $attributes)
    {
        // snake_case to camelCase
        $modelClass = "\\Proximax\\Models\\" . Str::studly($name);

        if (!class_exists($modelClass)) {
            throw new BadMethodCallException("Model class '" . $modelClass . "' could not be found in \\Proximax\\Model namespace.");
        }

        //XXX add fields list to Models
        $instance = new $modelClass($attributes);
        return $instance;
    }

    /**
     * This __call hook makes sure calls to the Mutator object
     * will always instantiate a Models class provided by the SDK.
     *
     * @example Example *method* calls for \Proximax\Models\ModelMutator
     *
     * $sdk = new SDK();
     * $sdk->models()->address(["address" => "NB72EM6TTSX72O47T3GQFL345AB5WYKIDODKPPYW"]); // will automatically craft a \Proximax\Models\Address object
     * $sdk->models()->namespace(["namespace" => "evias"]); // will automatically craft a \Proximax\Models\Namespace object
     *
     * @example Example building \Proximax\Models\Model objects with the ModelMutator
     *
     * $sdk = new SDK();
     * $addr = $sdk->models()->address();
     * $addr->address = "NB72EM6TTSX72O47T3GQFL345AB5WYKIDODKPPYW";
     * var_dump($addr->toDTO()); // will contain address field
     *
     * @internal
     * @param  string   $name           The model name you would like to create.
     * @param  array    $attributes     The model's attribute values.
     * @return \Proximax\Models\ModelInterface
     */
    public function __call($name, array $arguments)
    {
        if (method_exists($this, $name))
            // method overload exists, call it.
            return call_user_func_array([$this, $name], $arguments);

        // method does not exist, try to craft model class instance.
        return $this->mutate($name, $arguments);
    }
}