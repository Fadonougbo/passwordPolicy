<?php

use PasswordPolicy\PasswordPolicy;

describe('withSymbol test',function() {

    test('word with one symbol : normal case', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->withSymbol()
                                 ->getStatus();
      
         expect($result)->toBeTrue();

    
    })->with(['user2@','#user','id#09p']);

    test('word with one symbol : error case', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->withSymbol(max:1)
                                 ->getStatus();
      
         expect($result)->toBeFalse();

    
    })->with(['doe@gmail.com','www.google.com']);
  
     test('accept one or many symbols : normal case', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->withSymbol(1)
                                 ->getStatus();
      
         expect($result)->toBeTrue();

    
     })->with(['doe@gmail.com',':D)']);

     test('accept one or  many number: error case ', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->withSymbol(1)
                                 ->getStatus();
      
         expect($result)->toBeFalse();

    
    })->with(['doegmailcom','']); 
 

     test('accept between 3 and 5 symbols : normal case', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->withSymbol(3,5)
                                 ->getStatus();
      
         expect($result)->toBeTrue();

    
     })->with(['doe@gm#ai$l.com','$ueser()']); 


      test('accept between 3 and 5 symbols : error case', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->withSymbol(3,5)
                                 ->getStatus();
      
         expect($result)->toBeFalse();

    
     })->with(['>>>>>>>>','**']);

     test('accept min 3 symbols : normal case', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->withSymbol(3)
                                 ->getStatus();
      
         expect($result)->toBeTrue();

    
     })->with(['#####','user@*&^']);


     test('accept max 3 symbols : normal case', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->withSymbol(max:3)
                                 ->getStatus();
      
         expect($result)->toBeFalse();

    
     })->with(['#####','user@*&^4$']);

     test('accept 0 symbols\ : normal case', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->withSymbol()
                                 ->getStatus();

                                
      
         expect($result)->toBeTrue();

    
     })->with(['johnDoe']);

     test('accept 1 symbols\ : error case', function (string $secret) {

        $passwordPolicy=new PasswordPolicy($secret);

        $result=$passwordPolicy->withSymbol(1)
                                 ->getStatus();

                                
      
         expect($result)->toBeFalse();

    
     })->with(['johnDoe']);

    

    

});