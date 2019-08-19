<?php
// automatically generated by the FlatBuffers compiler, do not modify

namespace Catapult\Buffers;

use \Google\FlatBuffers\Struct;
use \Google\FlatBuffers\Table;
use \Google\FlatBuffers\ByteBuffer;
use \Google\FlatBuffers\FlatBufferBuilder;

class ModifyContractTransactionBuffer extends Table
{
    /**
     * @param ByteBuffer $bb
     * @return ModifyContractTransactionBuffer
     */
    public static function getRootAsModifyContractTransactionBuffer(ByteBuffer $bb)
    {
        $obj = new ModifyContractTransactionBuffer();
        return ($obj->init($bb->getInt($bb->getPosition()) + $bb->getPosition(), $bb));
    }

    /**
     * @param int $_i offset
     * @param ByteBuffer $_bb
     * @return ModifyContractTransactionBuffer
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
    public function getDurationDelta($j)
    {
        $o = $this->__offset(18);
        return $o != 0 ? $this->bb->getUint($this->__vector($o) + $j * 4) : 0;
    }

    /**
     * @return int
     */
    public function getDurationDeltaLength()
    {
        $o = $this->__offset(18);
        return $o != 0 ? $this->__vector_len($o) : 0;
    }

    /**
     * @param int offset
     * @return byte
     */
    public function getHash($j)
    {
        $o = $this->__offset(20);
        return $o != 0 ? $this->bb->getByte($this->__vector($o) + $j * 1) : 0;
    }

    /**
     * @return int
     */
    public function getHashLength()
    {
        $o = $this->__offset(20);
        return $o != 0 ? $this->__vector_len($o) : 0;
    }

    /**
     * @return string
     */
    public function getHashBytes()
    {
        return $this->__vector_as_bytes(20);
    }

    /**
     * @return byte
     */
    public function getNumCustomers()
    {
        $o = $this->__offset(22);
        return $o != 0 ? $this->bb->getByte($o + $this->bb_pos) : 0;
    }

    /**
     * @return byte
     */
    public function getNumExecutors()
    {
        $o = $this->__offset(24);
        return $o != 0 ? $this->bb->getByte($o + $this->bb_pos) : 0;
    }

    /**
     * @return byte
     */
    public function getNumVerifiers()
    {
        $o = $this->__offset(26);
        return $o != 0 ? $this->bb->getByte($o + $this->bb_pos) : 0;
    }

    /**
     * @returnVectorOffset
     */
    public function getCustomers($j)
    {
        $o = $this->__offset(28);
        $obj = new CosignatoryModificationBuffer();
        return $o != 0 ? $obj->init($this->__indirect($this->__vector($o) + $j * 4), $this->bb) : null;
    }

    /**
     * @return int
     */
    public function getCustomersLength()
    {
        $o = $this->__offset(28);
        return $o != 0 ? $this->__vector_len($o) : 0;
    }

    /**
     * @returnVectorOffset
     */
    public function getExecutors($j)
    {
        $o = $this->__offset(30);
        $obj = new CosignatoryModificationBuffer();
        return $o != 0 ? $obj->init($this->__indirect($this->__vector($o) + $j * 4), $this->bb) : null;
    }

    /**
     * @return int
     */
    public function getExecutorsLength()
    {
        $o = $this->__offset(30);
        return $o != 0 ? $this->__vector_len($o) : 0;
    }

    /**
     * @returnVectorOffset
     */
    public function getVerifiers($j)
    {
        $o = $this->__offset(32);
        $obj = new CosignatoryModificationBuffer();
        return $o != 0 ? $obj->init($this->__indirect($this->__vector($o) + $j * 4), $this->bb) : null;
    }

    /**
     * @return int
     */
    public function getVerifiersLength()
    {
        $o = $this->__offset(32);
        return $o != 0 ? $this->__vector_len($o) : 0;
    }

    /**
     * @param FlatBufferBuilder $builder
     * @return void
     */
    public static function startModifyContractTransactionBuffer(FlatBufferBuilder $builder)
    {
        $builder->StartObject(15);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @return ModifyContractTransactionBuffer
     */
    public static function createModifyContractTransactionBuffer(FlatBufferBuilder $builder, $size, $signature, $signer, $version, $type, $maxFee, $deadline, $durationDelta, $hash, $numCustomers, $numExecutors, $numVerifiers, $customers, $executors, $verifiers)
    {
        $builder->startObject(15);
        self::addSize($builder, $size);
        self::addSignature($builder, $signature);
        self::addSigner($builder, $signer);
        self::addVersion($builder, $version);
        self::addType($builder, $type);
        self::addMaxFee($builder, $maxFee);
        self::addDeadline($builder, $deadline);
        self::addDurationDelta($builder, $durationDelta);
        self::addHash($builder, $hash);
        self::addNumCustomers($builder, $numCustomers);
        self::addNumExecutors($builder, $numExecutors);
        self::addNumVerifiers($builder, $numVerifiers);
        self::addCustomers($builder, $customers);
        self::addExecutors($builder, $executors);
        self::addVerifiers($builder, $verifiers);
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
    public static function addDurationDelta(FlatBufferBuilder $builder, $durationDelta)
    {
        $builder->addOffsetX(7, $durationDelta, 0);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param array offset array
     * @return int vector offset
     */
    public static function createDurationDeltaVector(FlatBufferBuilder $builder, array $data)
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
    public static function startDurationDeltaVector(FlatBufferBuilder $builder, $numElems)
    {
        $builder->startVector(4, $numElems, 4);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param VectorOffset
     * @return void
     */
    public static function addHash(FlatBufferBuilder $builder, $hash)
    {
        $builder->addOffsetX(8, $hash, 0);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param array offset array
     * @return int vector offset
     */
    public static function createHashVector(FlatBufferBuilder $builder, array $data)
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
    public static function startHashVector(FlatBufferBuilder $builder, $numElems)
    {
        $builder->startVector(1, $numElems, 1);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param byte
     * @return void
     */
    public static function addNumCustomers(FlatBufferBuilder $builder, $numCustomers)
    {
        $builder->addByteX(9, $numCustomers, 0);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param byte
     * @return void
     */
    public static function addNumExecutors(FlatBufferBuilder $builder, $numExecutors)
    {
        $builder->addByteX(10, $numExecutors, 0);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param byte
     * @return void
     */
    public static function addNumVerifiers(FlatBufferBuilder $builder, $numVerifiers)
    {
        $builder->addByteX(11, $numVerifiers, 0);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param VectorOffset
     * @return void
     */
    public static function addCustomers(FlatBufferBuilder $builder, $customers)
    {
        $builder->addOffsetX(12, $customers, 0);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param array offset array
     * @return int vector offset
     */
    public static function createCustomersVector(FlatBufferBuilder $builder, array $data)
    {
        $builder->startVector(4, count($data), 4);
        for ($i = count($data) - 1; $i >= 0; $i--) {
            $builder->putOffset($data[$i]);
        }
        return $builder->endVector();
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param int $numElems
     * @return void
     */
    public static function startCustomersVector(FlatBufferBuilder $builder, $numElems)
    {
        $builder->startVector(4, $numElems, 4);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param VectorOffset
     * @return void
     */
    public static function addExecutors(FlatBufferBuilder $builder, $executors)
    {
        $builder->addOffsetX(13, $executors, 0);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param array offset array
     * @return int vector offset
     */
    public static function createExecutorsVector(FlatBufferBuilder $builder, array $data)
    {
        $builder->startVector(4, count($data), 4);
        for ($i = count($data) - 1; $i >= 0; $i--) {
            $builder->putOffset($data[$i]);
        }
        return $builder->endVector();
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param int $numElems
     * @return void
     */
    public static function startExecutorsVector(FlatBufferBuilder $builder, $numElems)
    {
        $builder->startVector(4, $numElems, 4);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param VectorOffset
     * @return void
     */
    public static function addVerifiers(FlatBufferBuilder $builder, $verifiers)
    {
        $builder->addOffsetX(14, $verifiers, 0);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param array offset array
     * @return int vector offset
     */
    public static function createVerifiersVector(FlatBufferBuilder $builder, array $data)
    {
        $builder->startVector(4, count($data), 4);
        for ($i = count($data) - 1; $i >= 0; $i--) {
            $builder->putOffset($data[$i]);
        }
        return $builder->endVector();
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param int $numElems
     * @return void
     */
    public static function startVerifiersVector(FlatBufferBuilder $builder, $numElems)
    {
        $builder->startVector(4, $numElems, 4);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @return int table offset
     */
    public static function endModifyContractTransactionBuffer(FlatBufferBuilder $builder)
    {
        $o = $builder->endObject();
        return $o;
    }

    public static function finishModifyContractTransactionBufferBuffer(FlatBufferBuilder $builder, $offset)
    {
        $builder->finish($offset);
    }
}
