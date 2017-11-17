<?php

use Ellipse\Router\Adapter\Exceptions\RouterAdapterExceptionInterface;
use Ellipse\Router\Adapter\Exceptions\NotFoundException;

describe('NotFoundException', function () {

    it('should implement RouterAdapterExceptionInterface', function () {

        $test = new NotFoundException('GET', '/path');

        expect($test)->toBeAnInstanceOf(RouterAdapterExceptionInterface::class);

    });

});
