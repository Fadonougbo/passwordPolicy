<?php

use PasswordPolicy\PasswordPolicy;

describe('withLower test',function() {

    test('word with one lowercase letters: normal case', function () {

        $test1=(new PasswordPolicy('Salut'))->withLowercase(1)->getStatus();

        $test2=(new PasswordPolicy('johnDoe'))->withLowercase(1,3)->getStatus();

        $test3=(new PasswordPolicy('JOHN DOE'))->withLowercase(max:0)->getStatus();

        $test4=(new PasswordPolicy('gautier'))->withLowercase(max:3)->getStatus();

        $test5=(new PasswordPolicy('Gautier2002'))->withLowercase(4)->getStatus();

        $test6=(new PasswordPolicy('Gautier2002'))->withLowercase(4,4)->getStatus();
      
        expect($test1)->toBeTrue();

        expect($test2)->toBeFalse();

        expect($test3)->toBeTrue();

        expect($test4)->toBeFalse();

        expect($test5)->toBeTrue();

        expect($test6)->toBeFalse();
    
    });



});