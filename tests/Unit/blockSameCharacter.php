<?php

use PasswordPolicy\PasswordPolicy;

    test('word with same charactere : min case', function (string $secret) {

       $passwordPolicy=new PasswordPolicy($secret);

       $result=$passwordPolicy->blockSameCharacter()
                                ->getStatus();
     
        expect($result)->toBeTrue();

   
   })->with(['eeeeeeeeeeeeee','3333333333333333']);

   test('word with same charactere : error case', function (string $secret) {

       $passwordPolicy=new PasswordPolicy($secret);

       $result=$passwordPolicy->blockSameCharacter()
                                ->getStatus();
     
        expect($result)->toBeFalse();

   
   })->with(['22222222222ss22','UUUQI']);

   test('word with same charactere : min max case', function (string $secret) {

       $passwordPolicy=new PasswordPolicy($secret);

       $result=$passwordPolicy->blockSameCharacter()
                                ->getStatus();
     
        expect($result)->toBeTrue();

   
   })->with(['kkkk','ooooooo','UUUUU','1111']);

   


