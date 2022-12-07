<?php

namespace GreenImp\PhpMath;

use Money\Calculator;
use Money\Calculator\BcMathCalculator;
use Money\Number;

class Math implements Calculator
{
    public static function absolute(string $number): string
    {
        return BcMathCalculator::absolute($number);
    }

    /**
     * Adds two numbers and rounds to `$precision`.
     *
     * Works in much the same way as {@link bcadd}, but uses precision instead of scale, and accurately rounds numbers,
     * instead of truncating them.
     *
     * Note that this function returns a string.
     *
     * @param string $num1
     * @param string $num2
     * @return string
     * @see https://www.php.net/manual/en/function.bcadd.php
     */
    public static function add(string $num1, string $num2): string
    {
        return BcMathCalculator::add($num1, $num2);
    }

    public static function ceil(float|int|string $number): string
    {
        return BcMathCalculator::ceil($number);
    }

    public static function compare(string $a, string $b): int
    {
        return BcMathCalculator::compare($a, $b);
    }

    /**
     * Divides two numbers and rounds to `$precision`.
     *
     * Works in much the same way as {@link bcdiv}, but uses precision instead of scale, and accurately rounds numbers,
     * instead of truncating them.
     *
     * Note that this function returns a string.
     *
     * @param string $num1
     * @param string $num2
     * @return string
     * @see https://www.php.net/manual/en/function.bcdiv.php
     */
    public static function divide(string $num1, string $num2): string
    {
        return BcMathCalculator::divide($num1, $num2);
    }

    public static function floor(float|int|string $number): string
    {
        return BcMathCalculator::floor($number);
    }

    /**
     * Return whether `$a` is greater than `$b`.
     *
     * @param $a
     * @param $b
     * @return bool
     */
    public static function greaterThan($a, $b): bool
    {
        return static::compare($a, $b) > 0;
    }

    /**
     * Return whether `$a` is greater than, or equal to `$b`.
     *
     * @param $a
     * @param $b
     * @return bool
     */
    public static function greaterThanOrEqual($a, $b): bool
    {
        return static::compare($a, $b) >= 0;
    }

    public static function isNegative(float|int|string $number): bool
    {
        return static::compare($number, '0') < 0;
    }

    public static function isNegativeOrZero(float|int|string $number): bool
    {
        return static::compare($number, '0') <= 0;
    }

    public static function isPositive(float|int|string $number): bool
    {
        return static::isNegative($number) === false;
    }

    /**
     * Return whether `$a` is less than `$b`.
     *
     * @param $a
     * @param $b
     * @return bool
     */
    public static function lessThan($a, $b): bool
    {
        return static::compare($a, $b) < 0;
    }

    /**
     * Return whether `$a` is less than, or equal to `$b`.
     *
     * @param $a
     * @param $b
     * @return bool
     */
    public static function lessThanOrEqual($a, $b): bool
    {
        return static::compare($a, $b) <= 0;
    }

    public static function mod(float|int|string $number, float|int|string $divisor): string
    {
        return BcMathCalculator::floor($number, $divisor);
    }

    /**
     * Multiplies two numbers together and rounds to `$precision`.
     *
     * Works in much the same way as {@link bcmul}, but uses precision instead of scale, and accurately rounds numbers,
     * instead of truncating them.
     *
     * Note that this function returns a string.
     *
     * @param string $num1
     * @param string $num2
     * @return string
     * @see https://www.php.net/manual/en/function.bcmul.php
     */
    public static function multiply(string $num1, string $num2): string
    {
        return BcMathCalculator::multiply($num1, $num2);
    }

    /**
     * Round the number to the given precision.
     *
     * @param float|int|string $number
     * @param int $precision
     * @param int $roundingMode
     * @return string
     */
    public static function round(float|int|string $number, int $precision = 0, int $roundingMode = PHP_ROUND_HALF_UP): string
    {
        $number = Number::fromString($number);

        // BcMathCalculator always rounds to an integer, so only use it if that's what we want
        if ($precision === 0 || $number->isInteger() || $number->isHalf()) {
            return BcMathCalculator::round($number, $roundingMode);
        }

        if ($number->isNegative()) {
            return bcsub($number, '0.'.str_repeat('0', $precision).'5', $precision);
        }

        return bcadd($number, '0.'.str_repeat('0', $precision).'5', $precision);
    }

    public static function share(string $amount, string $ratio, string $total): string
    {
        return BcMathCalculator::share($amount, $ratio, $total);
    }

    /**
     * Subtracts two numbers and rounds to `$precision`.
     *
     * Works in much the same way as {@link bcsub()}, but uses precision instead of scale, and accurately rounds numbers,
     * instead of truncating them.
     *
     * Note that this function returns a string.
     *
     * @param string $num1
     * @param string $num2
     * @return string
     * @see https://www.php.net/manual/en/function.bcsub.php
     */
    public static function subtract(string $num1, string $num2): string
    {
        return BcMathCalculator::subtract($num1, $num2);
    }

    public static function sum(iterable $numbers): string
    {
        $amount = '0';

        foreach ($numbers as $number) {
            $amount = static::add($amount, $number);
        }

        return $amount;
    }
}
