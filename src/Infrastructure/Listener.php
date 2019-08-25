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
use Proximax\Infrastructure\Listener\ListenerChannel;

/**
 * Listener class Doc Comment
 *
 * @category class
 * @package  Proximax
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class Listener {
    public function newBlock() {
        this.subscribeTo(ListenerChannel::BLOCK);
        return BlockChannelMessage.subscribeTo(messageSubject);
    }
 
    public function confirmed($address) {
        $channel = ListenerChannel::CONFIRMED_ADDED;
        this.subscribeTo($channel, address);
        return TransactionChannelMessage.subscribeTo(messageSubject, channel, address);
    }
 
    public function unconfirmedAdded($address) {
        $channel = ListenerChannel::UNCONFIRMED_ADDED;
        this.subscribeTo($channel, address);
        return TransactionChannelMessage.subscribeTo(messageSubject, channel, address);
    }
 
    public function unconfirmedRemoved($address) {
        $channel = ListenerChannel::UNCONFIRMED_REMOVED;
        this.subscribeTo($channel, address);
        return SimpleChannelMessage.subscribeTo(messageSubject, channel, address);
    }
 
    public function aggregateBondedAdded($address) {
        $channel = ListenerChannel::AGGREGATE_BONDED_ADDED;
        this.subscribeTo($channel, $address);
        return TransactionChannelMessage.subscribeTo(messageSubject, channel, address)
                .map(transaction -> (AggregateTransaction)transaction);
    }
 
    public function aggregateBondedRemoved($address) {
       $channel = ListenerChannel::AGGREGATE_BONDED_REMOVED;
       this.subscribeTo($channel, $address);
       return SimpleChannelMessage.subscribeTo(messageSubject, channel, address);
    }
 
    public function status($address) {
        $channel = ListenerChannel::STATUS;
        this.subscribeTo($channel, $address);
        return StatusChannelMessage.subscribeTo(messageSubject, address);
    }
 
    public function cosignatureAdded($address) {
        $channel = ListenerChannel::COSIGNATURE;
        this.subscribeTo($channel, $address);
        return CosignatureChannelMessage.subscribeTo(messageSubject, address);
    }
}