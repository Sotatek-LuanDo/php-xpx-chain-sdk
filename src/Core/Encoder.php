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

namespace Proximax\Core;

use Proximax\Contracts\Serializable;
use InvalidArgumentException;
use RuntimeException;

/**
 * Encoder class Doc Comment
 *
 * @category class
 * @package  Proximax
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class Encoder
{
    /**
     * Encode a Hexadecimal string to corresponding string characters
     * using the Buffer class as a backbone.
     *
     * @param   string  $hex
     * @return  string
     */
    public function hex2bin($hex)
    {
        $binLen = ceil(mb_strlen($hex) / 2);

        // size validation while creating
        $buffer = Buffer::fromHex($hex, $binLen);
        return $buffer->getBinary();
    }

    /**
     * Encode a Binary string to corresponding Hexadecimal representation
     * using the Buffer class as a backbone.
     *
     * @param   string  $hex
     * @return  string
     */
    public function bin2hex($bin)
    {
        $buf = new Buffer($bin);
        return $buf->getHex(); // automatically zero padded
    }

    /**
     * Encode a UInt8 array to its bytes representation.
     *
     * @param   array   $uint8      UInt8 array to convert to its bytes representation.
     * @return  string              Byte-level representation of the UInt8 array.
     */
    public function ua2bin(array $uint8)
    {
        $bin = "";
        foreach ($uint8 as $ix => $char) {
            $buf = Buffer::fromInt($char, 1);
            $bin .= $buf->getBinary();
        }

        $buffer = new Buffer($bin);
        return $buffer->getBinary();
    }

    /**
     * Convert a UInt8 array to a Int32 array (WordArray).
     *
     * The returned array contains entries of type Int32.
     *
     * @param   array   $uint8      UInt8 array to convert to Int32 array.
     * @return  array               Array of Int32 representations.
     */
    public function ua2words(array $uint8)
    {
        $uint8 = $uint8;
        $int32 = [];
        // 4 bytes in a row ! => 4 times uint8 is an int32.
        for ($i = 0, $bytes = count($uint8); $i < $bytes; $i += 4) {

            $b1 = $uint8[$i];
            $b2 = isset($uint8[$i+1]) ? $uint8[$i+1] : 0;
            $b3 = isset($uint8[$i+2]) ? $uint8[$i+2] : 0;
            $b4 = isset($uint8[$i+3]) ? $uint8[$i+3] : 0;

            // (byte_1 * 16777216) + (byte_2 * 65536) + (byte_3 * 256) + byte_4
            $i32 = $b1 * 0x1000000 + $b2 * 0x10000 + $b3 * 0x100 + $b4;

            // negative amounts are represented in [0, 2147483647] range
            // 0x100000000 is double of 2147483647 minus 2.
            $signed = $i32 > 0x7fffffff ? $i32 - 0x100000000 : $i32;

            array_push($int32, $signed);
        }

        return $int32;
    }

    /**
     * Encode a UInt8 array (WordArray) to its hexadecimal representation.
     *
     * @param   array   $uint8      UInt8 array to convert to Int32 array.
     * @return  string              Hexadecimal representation of the UInt8 array.
     */
    public function ua2hex(array $uint8)
    {
        $uint8 = $uint8 ?: $this->toUInt8();
        $hex = "";
        $enc = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f'];
        for ($i = 0, $bytes = count($uint8); $i < $bytes; $i++) {
            $code = $uint8[$i];

            $hex .= $enc[static::unsignedRightShift($code, 4)];
            $hex .= $enc[($code & 0x0f)];
        }

        return $hex;
    }

    /**
     * Perform unsigned right shift operation. This method
     * mocks the `>>>` operator of Javacript and Java.
     * 
     * @param   integer     $a
     * @param   integer     $b
     * @return  integer
     */
    static public function unsignedRightShift($a, $b)
    {
        if ($b >= 32 || $b < -32) {
            $m = (int)($b/32);
            $b = $b-($m*32);
        }

        if ($b < 0) {
            $b = 32 + $b;
        }

        if ($b == 0) {
            return (($a>>1)&0x7fffffff)*2+(($a>>$b)&1);
        }

        if ($a < 0) {
            $a = ($a >> 1);
            $a &= 2147483647;
            $a |= 0x40000000;
            $a = ($a >> ($b - 1));
        }
        else {
            $a = ($a >> $b);
        }

        return $a; 
    }
}
