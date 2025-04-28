# Utility functions for [PSR-3](http://www.php-fig.org/psr/psr-3/)

[![Linux Build Status](https://travis-ci.org/WyriHaximus/php-psr-3-utilities.png)](https://travis-ci.org/WyriHaximus/php-psr-3-utilities)
[![Latest Stable Version](https://poser.pugx.org/WyriHaximus/psr-3-utilities/v/stable.png)](https://packagist.org/packages/WyriHaximus/psr-3-utilities)
[![Total Downloads](https://poser.pugx.org/WyriHaximus/psr-3-utilities/downloads.png)](https://packagist.org/packages/WyriHaximus/psr-3-utilities/stats)
[![Code Coverage](https://scrutinizer-ci.com/g/WyriHaximus/php-psr-3-utilities/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/WyriHaximus/php-psr-3-utilities/?branch=master)
[![License](https://poser.pugx.org/WyriHaximus/psr-3-utilities/license.png)](https://packagist.org/packages/wyrihaximus/psr-3-utilities)
[![PHP 7 ready](http://php7ready.timesplinter.ch/WyriHaximus/php-psr-3-utilities/badge.svg)](https://travis-ci.org/WyriHaximus/php-psr-3-utilities)

### Installation ###

To install via [Composer](http://getcomposer.org/), use the command below, it will automatically detect the latest version and bind it with `^`.

```
composer require wyrihaximus/psr-3-utilities
```

## Functions ##

* `Utils::processPlaceHolders` - Handle placeholders as specified in [PSR-3](http://www.php-fig.org/psr/psr-3/).
* `Utils::formatValue` - Format any given value as a string.
* `Utils::normalizeContext` - Normalize the context ensure resources are represented as strings.
* `Utils::checkCorrectLogLevel` - Throw an `Psr\Log\InvalidArgumentException` when the passed log level isn't defined on `Psr\Log\LogLevel`.

## Origins ##

The origins of this packages came from the need of complying to [PSR-3](http://www.php-fig.org/psr/psr-3/) place holders. (Like 'message {key}'.) And I came out at [`Monolog`](https://github.com/Seldaek/monolog/blob/6e6586257d9fb231bf039563632e626cdef594e5/src/Monolog/Processor/PsrLogMessageProcessor.php), initially the code was used on ['wyrihaximus/react-psr-3-loggly`](https://github.com/WyriHaximus/reactphp-psr-3-loggly) but extracted it into it's own package now that I needed it in more package.

## Contributing ##

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## License ##

Copyright 2022 [Cees-Jan Kiewiet](http://wyrihaximus.net/)

Permission is hereby granted, free of charge, to any person
obtaining a copy of this software and associated documentation
files (the "Software"), to deal in the Software without
restriction, including without limitation the rights to use,
copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the
Software is furnished to do so, subject to the following
conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
OTHER DEALINGS IN THE SOFTWARE.
