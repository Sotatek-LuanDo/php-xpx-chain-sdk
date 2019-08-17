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

use Proximax\API;

/**
 * ConnectionPool class Doc Comment
 *
 * @category class
 * @package  Proximax
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class ConnectionPool
{
    /**
     * List of currently used Proximax Nodes.
     * 
     * @var array
     */
    protected $nodes = [
        "mainnet" => [
            "http://hugealice.Proximax.ninja:7890",
            "http://alice2.Proximax.ninja:7890",
            "http://alice3.Proximax.ninja:7890",
            "http://alice4.Proximax.ninja:7890",
            "http://alice5.Proximax.ninja:7890",
            "http://alice6.Proximax.ninja:7890",
            "http://alice7.Proximax.ninja:7890",
            "http://alice8.Proximax.ninja:7890",
            "http://alice9.Proximax.ninja:7890",
            "http://bigalice3.Proximax.ninja:7890",
        ],
        "testnet" => [
            "http://bigalice2.Proximax.ninja:7890",
            "http://50.3.87.123:7890",
        ],
        "mijin"   => [],
    ];

    /**
     * List of currently connected Endpoints.
     * 
     * @var array
     */
    protected $endpoints = [
        "mainnet" => [],
        "testnet" => [],
        "mijin"   => [],
    ];

    /**
     * The current connection pool Index.
     * 
     * @var integer
     */
    protected $poolIndex = 0;

    /**
     * The current connection pool network
     * 
     * @var string
     */
    protected $network = "testnet";

    /**
     * Constructor for the Proximax ConnectionPool instances.
     * 
     * @param   null|string|integer     $network
     */
    public function __construct($network = "mainnet")
    {
        if (!empty($network) && is_integer($network)) {
            $netId = $network;
            $network = Network::getFromId($netId, "name");
        }
        elseif (!in_array(strtolower($network), ["mainnet", "testnet", "mijin"])) {
            $network = "mainnet";
        }

        $this->network = $network;
        $this->nodes[$network] = array_map(function($item) {
            return preg_replace("/(https?:\/\/)([^:]+)(.*)/", "$2", $item);
        }, $this->nodes[$network]);
    }

    /**
     * Get a connected API using the Proximax node configured
     * at the current `poolIndex`
     * 
     * @param   boolean     $forceNew
     * @return  \Proximax\API
     */
    public function getEndpoint($forceNew = false)
    {
        $index = $forceNew === true ? ++$this->poolIndex : $this->poolIndex;
        if ($index == count($this->nodes)) {
            $index = 0;
        }

        if (!isset($this->endpoints[$this->network][$index])) {
            $api = new API([
                "use_ssl"  => false,
                "protocol" => "http",
                "host" => $this->nodes[$this->network][$index],
                "port" => 7890,
                "endpoint" => "/",
            ]);

            $this->endpoints[$this->network][$index] = $api;
        }

        $this->poolIndex = $index;
        return $this->endpoints[$this->network][$index];
    }
}
