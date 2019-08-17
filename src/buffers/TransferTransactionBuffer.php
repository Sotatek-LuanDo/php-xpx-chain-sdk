<?php
// automatically generated by the FlatBuffers compiler, do not modify

namespace Catapult\Buffers;

use \Google\FlatBuffers\Struct;
use \Google\FlatBuffers\Table;
use \Google\FlatBuffers\ByteBuffer;
use \Google\FlatBuffers\FlatBufferBuilder;

class TransferTransactionBuffer extends Table
{
    /**
     * @param ByteBuffer $bb
     * @return TransferTransactionBuffer
     */
    public static function getRootAsTransferTransactionBuffer(ByteBuffer $bb)
    {
        $obj = new TransferTransactionBuffer();
        return ($obj->init($bb->getInt($bb->getPosition()) + $bb->getPosition(), $bb));
    }

    /**
     * @param int $_i offset
     * @param ByteBuffer $_bb
     * @return TransferTransactionBuffer
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
     * @return byte
     */
    public function getRecipient($j)
    {
        $o = $this->__offset(18);
        return $o != 0 ? $this->bb->getByte($this->__vector($o) + $j * 1) : 0;
    }

    /**
     * @return int
     */
    public function getRecipientLength()
    {
        $o = $this->__offset(18);
        return $o != 0 ? $this->__vector_len($o) : 0;
    }

    /**
     * @return string
     */
    public function getRecipientBytes()
    {
        return $this->__vector_as_bytes(18);
    }

    /**
     * @return ushort
     */
    public function getMessageSize()
    {
        $o = $this->__offset(20);
        return $o != 0 ? $this->bb->getUshort($o + $this->bb_pos) : 0;
    }

    /**
     * @return byte
     */
    public function getNumMosaics()
    {
        $o = $this->__offset(22);
        return $o != 0 ? $this->bb->getByte($o + $this->bb_pos) : 0;
    }

    public function getMessage()
    {
        $obj = new MessageBuffer();
        $o = $this->__offset(24);
        return $o != 0 ? $obj->init($this->__indirect($o + $this->bb_pos), $this->bb) : 0;
    }

    /**
     * @returnVectorOffset
     */
    public function getMosaics($j)
    {
        $o = $this->__offset(26);
        $obj = new MosaicBuffer();
        return $o != 0 ? $obj->init($this->__indirect($this->__vector($o) + $j * 4), $this->bb) : null;
    }

    /**
     * @return int
     */
    public function getMosaicsLength()
    {
        $o = $this->__offset(26);
        return $o != 0 ? $this->__vector_len($o) : 0;
    }

    /**
     * @param FlatBufferBuilder $builder
     * @return void
     */
    public static function startTransferTransactionBuffer(FlatBufferBuilder $builder)
    {
        $builder->StartObject(12);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @return TransferTransactionBuffer
     */
    public static function createTransferTransactionBuffer(FlatBufferBuilder $builder, $size, $signature, $signer, $version, $type, $maxFee, $deadline, $recipient, $messageSize, $numMosaics, $message, $mosaics)
    {
        $builder->startObject(12);
        self::addSize($builder, $size);
        self::addSignature($builder, $signature);
        self::addSigner($builder, $signer);
        self::addVersion($builder, $version);
        self::addType($builder, $type);
        self::addMaxFee($builder, $maxFee);
        self::addDeadline($builder, $deadline);
        self::addRecipient($builder, $recipient);
        self::addMessageSize($builder, $messageSize);
        self::addNumMosaics($builder, $numMosaics);
        self::addMessage($builder, $message);
        self::addMosaics($builder, $mosaics);
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
    public static function addRecipient(FlatBufferBuilder $builder, $recipient)
    {
        $builder->addOffsetX(7, $recipient, 0);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param array offset array
     * @return int vector offset
     */
    public static function createRecipientVector(FlatBufferBuilder $builder, array $data)
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
    public static function startRecipientVector(FlatBufferBuilder $builder, $numElems)
    {
        $builder->startVector(1, $numElems, 1);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param ushort
     * @return void
     */
    public static function addMessageSize(FlatBufferBuilder $builder, $messageSize)
    {
        $builder->addUshortX(8, $messageSize, 0);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param byte
     * @return void
     */
    public static function addNumMosaics(FlatBufferBuilder $builder, $numMosaics)
    {
        $builder->addByteX(9, $numMosaics, 0);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param int
     * @return void
     */
    public static function addMessage(FlatBufferBuilder $builder, $message)
    {
        $builder->addOffsetX(10, $message, 0);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param VectorOffset
     * @return void
     */
    public static function addMosaics(FlatBufferBuilder $builder, $mosaics)
    {
        $builder->addOffsetX(11, $mosaics, 0);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param array offset array
     * @return int vector offset
     */
    public static function createMosaicsVector(FlatBufferBuilder $builder, array $data)
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
    public static function startMosaicsVector(FlatBufferBuilder $builder, $numElems)
    {
        $builder->startVector(4, $numElems, 4);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @return int table offset
     */
    public static function endTransferTransactionBuffer(FlatBufferBuilder $builder)
    {
        $o = $builder->endObject();
        return $o;
    }

    public static function finishTransferTransactionBufferBuffer(FlatBufferBuilder $builder, $offset)
    {
        $builder->finish($offset);
    }
}
