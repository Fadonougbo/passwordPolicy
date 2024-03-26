<?php

use PasswordPolicy\PasswordPolicy;

describe('withUpper test',function() {

    test('word with one uppercase letter: normal case', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->withUppercase(1,1)
                                 ->getStatus();
      
         expect($result)->toBeTrue();

    
    })->with(['Gautier','D','doE','joHn','iiD#2002']);

    test('word with one uppercase letter: error case', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->withUppercase(1,1)
                                 ->getStatus();
      
         expect($result)->toBeFalse();

    
    })->with(['GaUtier','DDe','J@oHn']);

    test('accept one or many upercase letters:normal case', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->withUppercase(1,4)
                                 ->getStatus();
      
         expect($result)->toBeTrue();

    
    })->with(['GaUtieR','DDe','J@oHn']);

    test('accept one or many upercase letters: error case ', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->withUppercase(1)
                                 ->getStatus();
      
         expect($result)->toBeFalse();

    
    })->with(['gautier','doe','user@gmail.com']);

    test('accept 0 upercase letters', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->withUppercase()
                                 ->getStatus();
      
         expect($result)->toBeTrue();

    
    })->with(['gautier','doe','User@gmail.com']);

});




?>