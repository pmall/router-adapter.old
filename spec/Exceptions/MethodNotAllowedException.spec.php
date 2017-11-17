<?php

use Ellipse\Router\Adapter\Exceptions\RouterAdapterExceptionInterface;
use Ellipse\Router\Adapter\Exceptions\MethodNotAllowedException;

describe('MethodNotAllowedException', function () {

    it('should implement RouterAdapterExceptionInterface', function () {

        $test =new MethodNotAllowedException('/path', ['GET', 'POST']);

        expect($test)->toBeAnInstanceOf(RouterAdapterExceptionInterface::class);

    });

});
