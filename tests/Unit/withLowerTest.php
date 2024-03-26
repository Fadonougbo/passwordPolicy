<?php

use PasswordPolicy\PasswordPolicy;

describe('withLower test',function() {

    test('word with one lowercase letters: normal case', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->withLowercase(1,1)
                                 ->getStatus();
      
         expect($result)->toBeTrue();

    
    })->with(['Ga2003','q','Us394']);

    test('word with one lowercase letters: error case', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->withLowercase(1,1)
                                 ->getStatus();
      
         expect($result)->toBeFalse();

    
    })->with(['doe','User09','309827']);
 
    test('accept one or many lowercase letters: normal case', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->withLowercase(1,5)
                                 ->getStatus();
      
         expect($result)->toBeTrue();

    
    })->with(['GautieR','Doe@002','J@oHn']);

    test('accept one or  many lowercase letters: error case ', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->withLowercase(2)
                                 ->getStatus();
      
         expect($result)->toBeFalse();

    
    })->with(['GA2003','Q','US394']);

});