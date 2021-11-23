<?php

namespace Digitcode\Digitcodeflazz;

use Illuminate\Support\Facades\Facade;

/**
 * Class SvaflazzFacade
 * @package Svakode\Svaflazz
 */
class Digitcode extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'digitcode';
    }
}
