<?php declare(strict_types=1);

namespace Soyhuce\Rules\Database;

use Soyhuce\Rules\Exceptions\Unimplemented;

class DatabaseRange
{
    /**
     * @return array<int>
     */
    public function tinyInteger(): array
    {
        return [$this->minInt8(), $this->maxInt8()];
    }

    /**
     * @return array<int>
     */
    public function unsignedTinyInteger(): array
    {
        return [0, $this->maxUInt8()];
    }

    /**
     * @return array<int>
     */
    public function smallInteger(): array
    {
        return [$this->minInt16(), $this->maxInt16()];
    }

    /**
     * @return array<int>
     */
    public function unsignedSmallInteger(): array
    {
        return [0, $this->maxUInt16()];
    }

    /**
     * @return array<int>
     */
    public function mediumInteger(): array
    {
        return [$this->minInt24(), $this->maxInt24()];
    }

    /**
     * @return array<int>
     */
    public function unsignedMediumInteger(): array
    {
        return [0, $this->maxUInt24()];
    }

    /**
     * @return array<int>
     */
    public function integer(): array
    {
        return [$this->minInt32(), $this->maxInt32()];
    }

    /**
     * @return array<int>
     */
    public function unsignedInteger(): array
    {
        return [0, $this->maxUInt32()];
    }

    /**
     * @return array<int>
     */
    public function bigInteger(): array
    {
        return [$this->minInt64(), $this->maxInt64()];
    }

    /**
     * @return array<int>
     */
    public function unsignedBigInteger(): array
    {
        return [0, $this->maxInt64()];
    }

    /**
     * @return array<int>
     */
    public function smallIncrements(): array
    {
        return [1, $this->maxUInt16()];
    }

    /**
     * @return array<int>
     */
    public function mediumIncrements(): array
    {
        return [1, $this->maxUInt24()];
    }

    /**
     * @return array<int>
     */
    public function increments(): array
    {
        return [1, $this->maxUInt32()];
    }

    /**
     * @return array<int>
     */
    public function bigIncrements(): array
    {
        return [1, $this->maxInt64()];
    }

    /**
     * @return array<float>
     */
    public function float(): array
    {
        return [$this->minFloat(), $this->maxFloat()];
    }

    /**
     * @return array<float>
     */
    public function double(): array
    {
        throw new Unimplemented(static::class, __FUNCTION__);
    }

    protected function minInt8(): int
    {
        return -128; // -0x80
    }

    protected function maxInt8(): int
    {
        return 127; // 0x7f
    }

    protected function maxUInt8(): int
    {
        return 255; // 0x00ff
    }

    protected function minInt16(): int
    {
        return -32768; // -0x8000
    }

    protected function maxInt16(): int
    {
        return 32767; // 0x7fff
    }

    protected function maxUInt16(): int
    {
        return 65535; // 0x00ffff
    }

    protected function minInt24(): int
    {
        return -8_388_608; // -0x800000
    }

    protected function maxInt24(): int
    {
        return 8_388_607; // 0x7fffff
    }

    protected function maxUInt24(): int
    {
        return 16_777_215; // 0x00ffffff
    }

    protected function minInt32(): int
    {
        return -2_147_483_648; // -0x80000000
    }

    protected function maxInt32(): int
    {
        return 2_147_483_647; // 0x7fffffff
    }

    protected function maxUInt32(): int
    {
        return 4_294_967_295; // 0x00ffffffff
    }

    protected function minFloat(): float
    {
        return -3.4028234E38;
    }

    protected function maxFloat(): float
    {
        return 3.4028234E38;
    }

    protected function minInt64(): int
    {
        // should be -9223372036854775808 but easier to exclude this value
        // because php transforms -9223372036854775808 to -9.2233720368548E+18
        return -9_223_372_036_854_775_807;
    }

    protected function maxInt64(): int
    {
        return 9_223_372_036_854_775_807;
    }
}
