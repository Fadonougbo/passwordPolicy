<?php

use PasswordPolicy\PasswordPolicy;

    test('word with same charactere : error case', function (string $secret) {

       $passwordPolicy=new PasswordPolicy($secret);

       $result=$passwordPolicy->blockSameCharacter()
                                ->getStatus();
     
        expect($result)->toBeFalse();

   
   })->with(['1111111111111','dddddddddddd','IIIIIIIII','UUUUU']);

   test('word with same charactere : normal case', function (string $secret) {

       $passwordPolicy=new PasswordPolicy($secret);

       $result=$passwordPolicy->blockSameCharacter()
                                ->getStatus();
     
        expect($result)->toBeTrue();

   
   })->with(['UUUUdowaj','gautier2000','2222']);

   test('password with same charactere with limit : normal case', function (string $secret) {

    $passwordPolicy=new PasswordPolicy($secret);

    $result=$passwordPolicy->blockSameCharacter(4)
                             ->getStatus();
  
     expect($result)->toBeFalse();


})->with(['99999','userrrr']);

   


