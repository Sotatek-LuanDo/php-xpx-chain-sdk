<?php
// automatically generated by the FlatBuffers compiler, do not modify

namespace Catapult\Buffers;

use \Google\FlatBuffers\Struct;
use \Google\FlatBuffers\Table;
use \Google\FlatBuffers\ByteBuffer;
use \Google\FlatBuffers\FlatBufferBuilder;

class CatapultConfigTransactionBuffer extends Table
{
    /**
     * @param ByteBuffer $bb
     * @return CatapultConfigTransactionBuffer
     */
    public static function getRootAsCatapultConfigTransactionBuffer(ByteBuffer $bb)
    {
        $obj = new CatapultConfigTransactionBuffer();
        return ($obj->init($bb->getInt($bb->getPosition()) + $bb->getPosition(), $bb));
    }

    /**
     * @param int $_i offset
     * @param ByteBuffer $_bb
     * @return CatapultConfigTransactionBuffer
     **/
    public function init($_i, ByteBuffer $_bb)
    {
        $this->bb_pos = $_i;
        $this->bb = $_bb;
        return $this;
    }

    /**
     * @return uint
     */
    public function getSize()
    {
        $o = $this->__offset(4);
        return $o != 0 ? $this->bb->getUint($o + $this->bb_pos) : 0;
    }

    /**
     * @param int offset
     * @return byte
     */
    public function getSignature($j)
    {
        $o = $this->__offset(6);
        return $o != 0 ? $this->bb->getByte($this->__vector($o) + $j * 1) : 0;
    }

    /**
     * @return int
     */
    public function getSignatureLength()
    {
        $o = $this->__offset(6);
        return $o != 0 ? $this->__vector_len($o) : 0;
    }

    /**
     * @return string
     */
    public function getSignatureBytes()
    {
        return $this->__vector_as_bytes(6);
    }

    /**
     * @param int offset
     * @return byte
     */
    public function getSigner($j)
    {
        $o = $this->__offset(8);
        return $o != 0 ? $this->bb->getByte($this->__vector($o) + $j * 1) : 0;
    }

    /**
     * @return int
     */
    public function getSignerLength()
    {
        $o = $this->__offset(8);
        return $o != 0 ? $this->__vector_len($o) : 0;
    }

    /**
     * @return string
     */
    public function getSignerBytes()
    {
        return $this->__vector_as_bytes(8);
    }

    /**
     * @return uint
     */
    public function getVersion()
    {
        $o = $this->__offset(10);
        return $o != 0 ? $this->bb->getUint($o + $this->bb_pos) : 0;
    }

    /**
     * @return ushort
     */
    public function getType()
    {
        $o = $this->__offset(12);
        return $o != 0 ? $this->bb->getUshort($o + $this->bb_pos) : 0;
    }

    /**
     * @param int offset
     * @return uint
     */
    public function getMaxFee($j)
    {
        $o = $this->__offset(14);
        return $o != 0 ? $this->bb->getUint($this->__vector($o) + $j * 4) : 0;
    }

    /**
     * @return int
     */
    public function getMaxFeeLength()
    {
        $o = $this->__offset(14);
        return $o != 0 ? $this->__vector_len($o) : 0;
    }

    /**
     * @param int offset
     * @return uint
     */
    public function getDeadline($j)
    {
        $o = $this->__offset(16);
        return $o != 0 ? $this->bb->getUint($this->__vector($o) + $j * 4) : 0;
    }

    /**
     * @return int
     */
    public function getDeadlineLength()
    {
        $o = $this->__offset(16);
        return $o != 0 ? $this->__vector_len($o) : 0;
    }

    /**
     * @param int offset
     * @return uint
     */
    public function getApplyHeightDelta($j)
    {
        $o = $this->__offset(18);
        return $o != 0 ? $this->bb->getUint($this->__vector($o) + $j * 4) : 0;
    }

    /**
     * @return int
     */
    public function getApplyHeightDeltaLength()
    {
        $o = $this->__offset(18);
        return $o != 0 ? $this->__vector_len($o) : 0;
    }

    /**
     * @return ushort
     */
    public function getBlockChainConfigSize()
    {
        $o = $this->__offset(20);
        return $o != 0 ? $this->bb->getUshort($o + $this->bb_pos) : 0;
    }

    /**
     * @return ushort
     */
    public function getSupportedEntityVersionsSize()
    {
        $o = $this->__offset(22);
        return $o != 0 ? $this->bb->getUshort($o + $this->bb_pos) : 0;
    }

    /**
     * @param int offset
     * @return byte
     */
    public function getBlockChainConfig($j)
    {
        $o = $this->__offset(24);
        return $o != 0 ? $this->bb->getByte($this->__vector($o) + $j * 1) : 0;
    }

    /**
     * @return int
     */
    public function getBlockChainConfigLength()
    {
        $o = $this->__offset(24);
        return $o != 0 ? $this->__vector_len($o) : 0;
    }

    /**
     * @return string
     */
    public function getBlockChainConfigBytes()
    {
        return $this->__vector_as_bytes(24);
    }

    /**
     * @param int offset
     * @return byte
     */
    public function getSupportedEntityVersions($j)
    {
        $o = $this->__offset(26);
        return $o != 0 ? $this->bb->getByte($this->__vector($o) + $j * 1) : 0;
    }

    /**
     * @return int
     */
    public function getSupportedEntityVersionsLength()
    {
        $o = $this->__offset(26);
        return $o != 0 ? $this->__vector_len($o) : 0;
    }

    /**
     * @return string
     */
    public function getSupportedEntityVersionsBytes()
    {
        return $this->__vector_as_bytes(26);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @return void
     */
    public static function startCatapultConfigTransactionBuffer(FlatBufferBuilder $builder)
    {
        $builder->StartObject(12);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @return CatapultConfigTransactionBuffer
     */
    public static function createCatapultConfigTransactionBuffer(FlatBufferBuilder $builder, $size, $signature, $signer, $version, $type, $maxFee, $deadline, $applyHeightDelta, $blockChainConfigSize, $supportedEntityVersionsSize, $blockChainConfig, $supportedEntityVersions)
    {
        $builder->startObject(12);
        self::addSize($builder, $size);
        self::addSignature($builder, $signature);
        self::addSigner($builder, $signer);
        self::addVersion($builder, $version);
        self::addType($builder, $type);
        self::addMaxFee($builder, $maxFee);
        self::addDeadline($builder, $deadline);
        self::addApplyHeightDelta($builder, $applyHeightDelta);
        self::addBlockChainConfigSize($builder, $blockChainConfigSize);
        self::addSupportedEntityVersionsSize($builder, $supportedEntityVersionsSize);
        self::addBlockChainConfig($builder, $blockChainConfig);
        self::addSupportedEntityVersions($builder, $supportedEntityVersions);
        $o = $builder->endObject();
        return $o;
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param uint
     * @return void
     */
    public static function addSize(FlatBufferBuilder $builder, $size)
    {
        $builder->addUintX(0, $size, 0);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param VectorOffset
     * @return void
     */
    public static function addSignature(FlatBufferBuilder $builder, $signature)
    {
        $builder->addOffsetX(1, $signature, 0);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param array offset array
     * @return int vector offset
     */
    public static function createSignatureVector(FlatBufferBuilder $builder, array $data)
    {
        $builder->startVector(1, count($data), 1);
        for ($i = count($data) - 1; $i >= 0; $i--) {
            $builder->putByte($data[$i]);
        }
        return $builder->endVector();
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param int $numElems
     * @return void
     */
    public static function startSignatureVector(FlatBufferBuilder $builder, $numElems)
    {
        $builder->startVector(1, $numElems, 1);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param VectorOffset
     * @return void
     */
    public static function addSigner(FlatBufferBuilder $builder, $signer)
    {
        $builder->addOffsetX(2, $signer, 0);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param array offset array
     * @return int vector offset
     */
    public static function createSignerVector(FlatBufferBuilder $builder, array $data)
    {
        $builder->startVector(1, count($data), 1);
        for ($i = count($data) - 1; $i >= 0; $i--) {
            $builder->putByte($data[$i]);
        }
        return $builder->endVector();
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param int $numElems
     * @return void
     */
    public static function startSignerVector(FlatBufferBuilder $builder, $numElems)
    {
        $builder->startVector(1, $numElems, 1);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param uint
     * @return void
     */
    public static function addVersion(FlatBufferBuilder $builder, $version)
    {
        $builder->addUintX(3, $version, 0);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param ushort
     * @return void
     */
    public static function addType(FlatBufferBuilder $builder, $type)
    {
        $builder->addUshortX(4, $type, 0);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param VectorOffset
     * @return void
     */
    public static function addMaxFee(FlatBufferBuilder $builder, $maxFee)
    {
        $builder->addOffsetX(5, $maxFee, 0);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param array offset array
     * @return int vector offset
     */
    public static function createMaxFeeVector(FlatBufferBuilder $builder, array $data)
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
    public static function startMaxFeeVector(FlatBufferBuilder $builder, $numElems)
    {
        $builder->startVector(4, $numElems, 4);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param VectorOffset
     * @return void
     */
    public static function addDeadline(FlatBufferBuilder $builder, $deadline)
    {
        $builder->addOffsetX(6, $deadline, 0);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param array offset array
     * @return int vector offset
     */
    public static function createDeadlineVector(FlatBufferBuilder $builder, array $data)
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
    public static function startDeadlineVector(FlatBufferBuilder $builder, $numElems)
    {
        $builder->startVector(4, $numElems, 4);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param VectorOffset
     * @return void
     */
    public static function addApplyHeightDelta(FlatBufferBuilder $builder, $applyHeightDelta)
    {
        $builder->addOffsetX(7, $applyHeightDelta, 0);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param array offset array
     * @return int vector offset
     */
    public static function createApplyHeightDeltaVector(FlatBufferBuilder $builder, array $data)
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
    public static function startApplyHeightDeltaVector(FlatBufferBuilder $builder, $numElems)
    {
        $builder->startVector(4, $numElems, 4);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param ushort
     * @return void
     */
    public static function addBlockChainConfigSize(FlatBufferBuilder $builder, $blockChainConfigSize)
    {
        $builder->addUshortX(8, $blockChainConfigSize, 0);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param ushort
     * @return void
     */
    public static function addSupportedEntityVersionsSize(FlatBufferBuilder $builder, $supportedEntityVersionsSize)
    {
        $builder->addUshortX(9, $supportedEntityVersionsSize, 0);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param VectorOffset
     * @return void
     */
    public static function addBlockChainConfig(FlatBufferBuilder $builder, $blockChainConfig)
    {
        $builder->addOffsetX(10, $blockChainConfig, 0);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param array offset array
     * @return int vector offset
     */
    public static function createBlockChainConfigVector(FlatBufferBuilder $builder, array $data)
    {
        $builder->startVector(1, count($data), 1);
        for ($i = count($data) - 1; $i >= 0; $i--) {
            $builder->putByte($data[$i]);
        }
        return $builder->endVector();
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param int $numElems
     * @return void
     */
    public static function startBlockChainConfigVector(FlatBufferBuilder $builder, $numElems)
    {
        $builder->startVector(1, $numElems, 1);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param VectorOffset
     * @return void
     */
    public static function addSupportedEntityVersions(FlatBufferBuilder $builder, $supportedEntityVersions)
    {
        $builder->addOffsetX(11, $supportedEntityVersions, 0);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param array offset array
     * @return int vector offset
     */
    public static function createSupportedEntityVersionsVector(FlatBufferBuilder $builder, array $data)
    {
        $builder->startVector(1, count($data), 1);
        for ($i = count($data) - 1; $i >= 0; $i--) {
            $builder->putByte($data[$i]);
        }
        return $builder->endVector();
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param int $numElems
     * @return void
     */
    public static function startSupportedEntityVersionsVector(FlatBufferBuilder $builder, $numElems)
    {
        $builder->startVector(1, $numElems, 1);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @return int table offset
     */
    public static function endCatapultConfigTransactionBuffer(FlatBufferBuilder $builder)
    {
        $o = $builder->endObject();
        return $o;
    }

    public static function finishCatapultConfigTransactionBufferBuffer(FlatBufferBuilder $builder, $offset)
    {
        $builder->finish($offset);
    }
}
