# php-math
A basic set of math scripts that deal in strings to handle long floating point values.

Internally, this uses PHP's [BC Math](https://www.php.net/manual/en/book.bc.php) functions, and [moneyphp](https://moneyphp.org)'s BcMathCalculator.

The main difference from MoneyPhp is that MoneyPhp's `round()` method always rounds to an integer, whereas this library can round to a chosen precision as well.

It also adds a few extra functions, such as `sum()` which will sum an iterable of numbers.

## Setup

```bash
composer require GreenImp/PhpMath
```
