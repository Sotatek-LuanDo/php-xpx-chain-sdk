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
use Proximax\Model\Mutators\ModelMutator;
use Proximax\Model\ModelCollection;
use Proximax\Contracts\DataTransferObject;

use BadMethodCallException;

/**
 * CollectionMutator class Doc Comment
 *
 * @category class
 * @package  Proximax
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class CollectionMutator
{
    /**
     * Collect several items into a Collection of Models.
     *
     * The \Proximax\Models\ModelMutator will be used internally to craft singular
     * model objects for each item you pass to this method.
     *
     * @internal
     * @param  string   $name           The model name you would like to store in the collection.
     * @param  array    $items          The collection's items data.
     * @return \Illuminate\Support\Collection
     */
    public function mutate($name, $items)
    {
        // snake_case to camelCase
        $modelClass = "\\Proximax\\Model\\" . Str::studly($name);

        if (!class_exists($modelClass)) {
            throw new BadMethodCallException("Model class '" . $modelClass . "' could not be found in \\Proximax\\Model namespace.");
        }

        if ($items instanceof ModelCollection)
            // collection already provided
            return $items;

        $mutator = new ModelMutator();
        $collection = new ModelCollection;
        $reflection = new $modelClass;

        if ($reflection instanceof ModelCollection) {
            // mutating Collection object, the model class is the singular
            // representation of the passed `$name`.

            $collection = $reflection; // specialize collection
            $name = Str::singular($name); // attachments=attachment, properties=property, etc..
        }

        for ($i = 0, $m = count($items); $i < $m; $i++) {
            if (!isset($items[$i]))
                $data = $items;
            elseif ($items[$i] instanceof DataTransferObject)
                $data = $items[$i]->toDTO();
            else
                $data = $items[$i];

            // load Model instance with item data
            $collection->push($mutator->mutate($name, $data));
        }

        return $collection;
    }
}
