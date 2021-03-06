<?php
// automatically generated by the FlatBuffers compiler, do not modify

namespace Catapult\Buffers;

use \Google\FlatBuffers\Struct;
use \Google\FlatBuffers\Table;
use \Google\FlatBuffers\ByteBuffer;
use \Google\FlatBuffers\FlatBufferBuilder;

class MosaicBuffer extends Table
{
    /**
     * @param ByteBuffer $bb
     * @return MosaicBuffer
     */
    public static function getRootAsMosaicBuffer(ByteBuffer $bb)
    {
        $obj = new MosaicBuffer();
        return ($obj->init($bb->getInt($bb->getPosition()) + $bb->getPosition(), $bb));
    }

    /**
     * @param int $_i offset
     * @param ByteBuffer $_bb
     * @return MosaicBuffer
     **/
    public function init($_i, ByteBuffer $_bb)
    {
        $this->bb_pos = $_i;
        $this->bb = $_bb;
        return $this;
    }

    /**
     * @param int offset
     * @return uint
     */
    public function getId($j)
    {
        $o = $this->__offset(4);
        return $o != 0 ? $this->bb->getUint($this->__vector($o) + $j * 4) : 0;
    }

    /**
     * @return int
     */
    public function getIdLength()
    {
        $o = $this->__offset(4);
        return $o != 0 ? $this->__vector_len($o) : 0;
    }

    /**
     * @param int offset
     * @return uint
     */
    public function getAmount($j)
    {
        $o = $this->__offset(6);
        return $o != 0 ? $this->bb->getUint($this->__vector($o) + $j * 4) : 0;
    }

    /**
     * @return int
     */
    public function getAmountLength()
    {
        $o = $this->__offset(6);
        return $o != 0 ? $this->__vector_len($o) : 0;
    }

    /**
     * @param FlatBufferBuilder $builder
     * @return void
     */
    public static function startMosaicBuffer(FlatBufferBuilder $builder)
    {
        $builder->StartObject(2);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @return MosaicBuffer
     */
    public static function createMosaicBuffer(FlatBufferBuilder $builder, $id, $amount)
    {
        $builder->startObject(2);
        self::addId($builder, $id);
        self::addAmount($builder, $amount);
        $o = $builder->endObject();
        return $o;
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param VectorOffset
     * @return void
     */
    public static function addId(FlatBufferBuilder $builder, $id)
    {
        $builder->addOffsetX(0, $id, 0);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param array offset array
     * @return int vector offset
     */
    public static function createIdVector(FlatBufferBuilder $builder, array $data)
    {
        $builder->startVector(4, count($data), 4);
        for ($i = count($data) - 1; $i >= 0; $i--) {
            $builder->putUint($data[$i]);
        }
        return $builder->endVector();
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param int $numElems
     * @return void
     */
    public static function startIdVector(FlatBufferBuilder $builder, $numElems)
    {
        $builder->startVector(4, $numElems, 4);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param VectorOffset
     * @return void
     */
    public static function addAmount(FlatBufferBuilder $builder, $amount)
    {
        $builder->addOffsetX(1, $amount, 0);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param array offset array
     * @return int vector offset
     */
    public static function createAmountVector(FlatBufferBuilder $builder, array $data)
    {
        $builder->startVector(4, count($data), 4);
        for ($i = count($data) - 1; $i >= 0; $i--) {
            $builder->putUint($data[$i]);
        }
        return $builder->endVector();
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param int $numElems
     * @return void
     */
    public static function startAmountVector(FlatBufferBuilder $builder, $numElems)
    {
        $builder->startVector(4, $numElems, 4);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @return int table offset
     */
    public static function endMosaicBuffer(FlatBufferBuilder $builder)
    {
        $o = $builder->endObject();
        return $o;
    }
}
