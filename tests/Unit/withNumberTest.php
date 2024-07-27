<?php

use PasswordPolicy\PasswordPolicy;

describe('withNumber test',function() {

    test('word with one number : normal case', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->withNumber(1,1)
                                 ->getStatus();
      
         expect($result)->toBeTrue();

    
    })->with(['user2','ID#)3']);

     test('word with one number : error case', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->withNumber(1,1)
                                 ->getStatus();
      
         expect($result)->toBeFalse();

    
    })->with(['User09','309827']);
 
     test('accept one or many numbers : normal case', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->withNumber(1,3)
                                 ->getStatus();
      
         expect($result)->toBeTrue();

    
     })->with(['#99','Doe@002']);

    test('accept one or  many numbers: error case ', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->withNumber(1,4)
                                 ->getStatus();
      
         expect($result)->toBeFalse();

    
    })->with(['john doe','Q','benin']); 

});





?>